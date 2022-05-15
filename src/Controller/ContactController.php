<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{


  #[Route('/contact/add', name: 'add_contact')]
  public function createContact(ManagerRegistry $doctrine, Request $request): Response
  {
    $entityManager = $doctrine->getManager();

    $contact = new Contact();

    $form = $this->createForm(ContactType::class, $contact);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $data = $form->getData();

      $contact->setName($data->getName());
      $contact->setLastname($data->getLastname());
      $contact->setPhone($data->getPhone());
      $contact->setAdress($data->getAdress());
      $contact->setCity($data->getCity());
      $contact->setAge($data->getAge());

      $entityManager->persist($contact);

      $entityManager->flush();

      return $this->redirectToRoute('home');
    }

    return $this->renderForm('contact/add.html.twig', ['form' => $form]);
  }


  #[Route('/contact/view/{id}', name: 'view_contact')]
  public function singleView(ManagerRegistry $doctrine, int $id): Response
  {
    $entityManager = $doctrine->getManager();

    $contact = $entityManager->getRepository(Contact::class)->find($id);

    return $this->render('contact/view.html.twig', ['data' => $contact]);
  }

  #[Route('/contact/edit/{id}', name: 'edit_contact')]
  public function editContact(ManagerRegistry $doctrine, Request $request, $id): Response
  {
    $entityManager = $doctrine->getManager();
    $contactSearch = $entityManager->getRepository(Contact::class)->find($id);

    $contact = new Contact();
    $contact->setName($contactSearch->getName());
    $contact->setLastname($contactSearch->getLastname());
    $contact->setPhone($contactSearch->getPhone());
    $contact->setAdress($contactSearch->getAdress());
    $contact->setCity($contactSearch->getCity());
    $contact->setAge($contactSearch->getAge());

    $form = $this->createForm(ContactType::class, $contact);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $data = $form->getData();

      $contactSearch->setName($data->getName());
      $contactSearch->setLastname($data->getLastname());
      $contactSearch->setPhone($data->getPhone());
      $contactSearch->setAdress($data->getAdress());
      $contactSearch->setCity($data->getCity());
      $contactSearch->setAge($data->getAge());

      $entityManager->flush();

      return $this->redirectToRoute('home');
    }

    return $this->renderForm('contact/edit.html.twig', ['form' => $form]);
  }

  #[Route('/contact/delete/{id}', name: 'delete_contact')]
  public function deleteContact(ManagerRegistry $doctrine, $id): Response
  {

    $entityManager = $doctrine->getManager();

    $contactTarget = $entityManager->getRepository(Contact::class)->find($id);

    $contact = $entityManager->getRepository(Contact::class)->remove($contactTarget);

    $entityManager->flush();

    return $this->redirectToRoute('home');
  }
}
