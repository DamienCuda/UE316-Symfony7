<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/', name: 'app_comment_index', methods: ['GET'])]
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_comment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {

        if($comment->getUser()->getId() !== $this->getUser()->getId()) {
            return $this->redirectToRoute('app_post_show', ['slug' => $comment->getPost()->getSlug()], Response::HTTP_SEE_OTHER);
        }

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_post_show', ['slug' => $comment->getPost()->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form,
            'post' => $comment->getPost(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_comment_delete', methods: ['GET'])]
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        if($comment->getUser()->getId() !== $this->getUser()->getId()) {
            return $this->redirectToRoute('app_post_show', ['slug' => $comment->getPost()->getSlug()], Response::HTTP_SEE_OTHER);
        }

        $entityManager->remove($comment);
        $entityManager->flush();

        return $this->redirectToRoute('app_post_show', ['slug' => $comment->getPost()->getSlug()], Response::HTTP_SEE_OTHER);
    }
}
