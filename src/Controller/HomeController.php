<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

  #[Route('/', name: 'home')]
  public function index(ManagerRegistry $doctrine): Response
  {

    $entityManager = $doctrine->getManager();

    $contact = $entityManager->getRepository(Contact::class)->findAll();

    return $this->render('home/home.html.twig', ['contact' => $contact]);
  }
}
