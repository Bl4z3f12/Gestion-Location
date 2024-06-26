<?php
// src/Controller/LocationController.php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Product;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/location')]
class LocationController extends AbstractController
{
    #[Route('/', name: 'app_location_index', methods: ['GET'])]
    public function index(LocationRepository $locationRepository): Response
    {
        return $this->render('location/index.html.twig', [
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Adjust product quantity
            foreach ($location->getLocationDetails() as $detail) {
                $product = $detail->getProduct();
                $quantityToReduce = $detail->getQuantity(); // Assume LocationDetail has a getQuantity method
                if ($product->getQuantite() >= $quantityToReduce) {
                    $product->setQuantite($product->getQuantite() - $quantityToReduce);
                } else {
                    $this->addFlash('error', 'Not enough quantity in stock for product: ' . $product->getName());
                    return $this->render('location/new.html.twig', [
                        'location' => $location,
                        'form' => $form->createView(),
                    ]);
                }
            }

            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('location/new.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_location_show', methods: ['GET'])]
    public function show(Location $location): Response
    {
        return $this->render('location/show.html.twig', [
            'location' => $location,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Adjust product quantity
            foreach ($location->getLocationDetails() as $detail) {
                $product = $detail->getProduct();
                $quantityToReduce = $detail->getQuantity(); // Assume LocationDetail has a getQuantity method
                if ($product->getQuantite() >= $quantityToReduce) {
                    $product->setQuantite($product->getQuantite() - $quantityToReduce);
                } else {
                    $this->addFlash('error', 'Not enough quantity in stock for product: ' . $product->getName());
                    return $this->render('location/edit.html.twig', [
                        'location' => $location,
                        'form' => $form->createView(),
                    ]);
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('location/edit.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_location_delete', methods: ['POST'])]
    public function delete(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$location->getId(), $request->request->get('_token'))) {
            $entityManager->remove($location);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
    }
}
