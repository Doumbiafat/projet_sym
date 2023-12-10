<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\AjoutPersonneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'personne')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $personne = new Personne();
        $form = $this->createForm(AjoutPersonneType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($personne);

            $entityManager->flush();
            return new Response('Personne ajoutee avec succes');
        }
        return $this->render('personne/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
