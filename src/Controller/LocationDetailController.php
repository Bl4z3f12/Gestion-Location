<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocationDetailController extends AbstractController
{
    #[Route('/location/detail', name: 'app_location_detail')]
    public function index(): Response
    {
        return $this->render('location_detail/index.html.twig', [
            'controller_name' => 'LocationDetailController',
        ]);
    }
}
