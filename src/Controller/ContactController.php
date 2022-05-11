<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
  #[Route('/contact', name: 'contact_add')]
  public function createContact(ManagerRegistry $doctrine): Response
  {
    $entityManager = $doctrine->getManager();

    $contact = new Contact();

    $contact->setName('Elliot');
    $contact->setLastname('Sutton');
    $contact->setPhone('0632568956');
    $contact->setAdress('12 rue leclerc');
    $contact->setCity('Melun');
    $contact->setAge(20);

    $entityManager->persist($contact);

    $entityManager->flush();

    return new Response('Saved new contact with id ' . $contact->getId());
  }

  #[Route('/contact/view/{id}', name: 'view_contact')]

  public function helloWorldName(ManagerRegistry $doctrine, int $id): Response
  {
    $entityManager = $doctrine->getManager();

    $contact = $entityManager->getRepository(Contact::class)->find($id);

    return $this->render('contact/view.html.twig', ['data' => $contact]);
  }
}
