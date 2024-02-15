<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\HtmlToTextConverter\DefaultHtmlToTextConverter;


#[Route('/contact')]
class ContactController extends AbstractController
{   
    #[Route('/', name: 'app_contact_index', methods: ['GET', 'POST'])]
    public function contact(Request $request, MailerInterface $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message = (new Email())
                ->from($contact->getEmail())
                ->to('contact@localhost.fr')
                ->subject('Nouveau message de contact')
                ->text($contact->getMessage());

            $mailer->send($message);

            $this->addFlash('success', '');

            return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}