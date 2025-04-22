<?php

namespace App\Controller;

use App\Entity\Malus;
use App\Form\MalusType;
use App\Repository\MalusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/malus')]
final class MalusController extends AbstractController
{
    #[Route(name: 'app_malus_index', methods: ['GET'])]
    public function index(MalusRepository $malusRepository): Response
    {
        return $this->render('malus/index.html.twig', [
            'maluses' => $malusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_malus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $malu = new Malus();
        $form = $this->createForm(MalusType::class, $malu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($malu);
            $entityManager->flush();

            return $this->redirectToRoute('app_malus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('malus/new.html.twig', [
            'malu' => $malu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_malus_show', methods: ['GET'])]
    public function show(Malus $malu): Response
    {
        return $this->render('malus/show.html.twig', [
            'malu' => $malu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_malus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Malus $malu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MalusType::class, $malu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_malus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('malus/edit.html.twig', [
            'malu' => $malu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_malus_delete', methods: ['POST'])]
    public function delete(Request $request, Malus $malu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$malu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($malu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_malus_index', [], Response::HTTP_SEE_OTHER);
    }
}
