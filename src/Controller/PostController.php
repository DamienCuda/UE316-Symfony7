<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Comment;
use App\Form\CommentType;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository, Request $request, PaginatorInterface  $paginator): Response
    {
        $post = $postRepository->findAll();

        $pagination = $paginator->paginate(
            $post,
            $request->query->getInt('page', 1),
            6
    );

        return $this->render('post/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_post_show', methods: ['GET', 'POST'])]
    public function show(Post $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        $commentsList = $entityManager->getRepository(Comment::class)->findBy(['post' => $post]);

        if($commentForm->isSubmitted() && $commentForm->isValid()) {
            if($this->getUser() === null) return $this->redirectToRoute('app_login');

            $comment->setUser($this->getUser());
            $comment->setPost($post);
            $comment->setContent($commentForm->get('content')->getData());
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('app_post_show', ['slug' => $post->getSlug()], Response::HTTP_SEE_OTHER);
        }
        
        $currentUser = $this->getUser();

        $userReportedComments = [];
        
        foreach($currentUser->getReports() as $key => $report) {
            $userReportedComments[] = $report->getComment();
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $commentForm,
            'comments' => $commentsList?: null,
            'user' => $currentUser?: null,
            'userReportedComments' => $userReportedComments,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
