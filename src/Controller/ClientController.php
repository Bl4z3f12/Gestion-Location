<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class ClientController extends AbstractController
{
    #[Route("/client", name: "client_register")]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($client, $client->getPassword());
            $client->setPassword($hashedPassword);
            $client->setCreatedAt(new \DateTime());
            $entityManager->persist($client);
            $entityManager->flush();

            // Send a welcome email or perform other post-registration actions

            $this->addFlash('success', 'Your account has been created successfully!');

            return $this->redirectToRoute('app_list');
        }

        return $this->render('client/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}