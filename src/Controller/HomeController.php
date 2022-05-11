<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  #[Route('/', name: 'home')]
  public function index(): Response
  {
    $arrayData = [
      ['id' => 1, 'firstname' => 'Tom', 'lastname' => 'Bost', 'phone' => '0641970576'],
      ['id' => 2, 'firstname' => 'Serge', 'lastname' => 'Lema', 'phone' => '0658965320'],
      ['id' => 3, 'firstname' => 'Florian', 'lastname' => 'Barraud', 'phone' => '0641156425'],

    ];

    return $this->render('home/home.html.twig', ['data' => $arrayData]);
  }

}
