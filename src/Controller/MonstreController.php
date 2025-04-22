<?php

namespace App\Controller;

use App\Entity\Monstre;
use App\Form\MonstreType;
use App\Repository\MonstreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/monstre')]
final class MonstreController extends AbstractController
{
    #[Route(name: 'app_monstre_index', methods: ['GET'])]
    public function index(MonstreRepository $monstreRepository): Response
    {
        return $this->render('monstre/index.html.twig', [
            'monstres' => $monstreRepository->findAll(),
        ]);
    }

    #[Route('/mes-monstres', name: 'app_monstre_user', methods: ['GET'])]
    public function userMonstres(MonstreRepository $monstreRepository): Response
    {
        $user = $this->getUser();

        // Récupérer les équipements de l'utilisateur connecté
        $monstres = $monstreRepository->findBy(['createur' => $user]);

        return $this->render('monstre/user_monstres.html.twig', [
            'monstres' => $monstres,
        ]);
    }

    #[Route('/new', name: 'app_monstre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monstre = new Monstre();
        $form = $this->createForm(MonstreType::class, $monstre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monstre->setCreateur($this->getUser());
            $entityManager->persist($monstre);
            $entityManager->flush();

            return $this->redirectToRoute('app_monstre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('monstre/new.html.twig', [
            'monstre' => $monstre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monstre_show', methods: ['GET'])]
    public function show(Monstre $monstre): Response
    {
        return $this->render('monstre/show.html.twig', [
            'monstre' => $monstre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monstre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Monstre $monstre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MonstreType::class, $monstre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monstre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('monstre/edit.html.twig', [
            'monstre' => $monstre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monstre_delete', methods: ['POST'])]
    public function delete(Request $request, Monstre $monstre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monstre->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($monstre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monstre_index', [], Response::HTTP_SEE_OTHER);
    }
}
