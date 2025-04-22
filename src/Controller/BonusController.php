<?php

namespace App\Controller;

use App\Entity\Bonus;
use App\Form\BonusType;
use App\Repository\BonusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bonus')]
final class BonusController extends AbstractController
{
    #[Route(name: 'app_bonus_index', methods: ['GET'])]
    public function index(BonusRepository $bonusRepository): Response
    {
        return $this->render('bonus/index.html.twig', [
            'bonuses' => $bonusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bonus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bonu = new Bonus();
        $form = $this->createForm(BonusType::class, $bonu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bonu);
            $entityManager->flush();

            return $this->redirectToRoute('app_bonus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bonus/new.html.twig', [
            'bonu' => $bonu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bonus_show', methods: ['GET'])]
    public function show(Bonus $bonu): Response
    {
        return $this->render('bonus/show.html.twig', [
            'bonu' => $bonu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bonus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bonus $bonu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BonusType::class, $bonu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bonus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bonus/edit.html.twig', [
            'bonu' => $bonu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bonus_delete', methods: ['POST'])]
    public function delete(Request $request, Bonus $bonu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bonu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bonu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bonus_index', [], Response::HTTP_SEE_OTHER);
    }
}
