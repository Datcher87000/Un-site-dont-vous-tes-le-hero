<?php

namespace App\Controller;

use App\Entity\Hero;
use App\Form\HeroType;
use App\Repository\HeroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hero')]
final class HeroController extends AbstractController
{
    #[Route(name: 'app_hero_index', methods: ['GET'])]
    public function index(HeroRepository $heroRepository): Response
    {
        return $this->render('hero/index.html.twig', [
            'heroes' => $heroRepository->findAll(),
        ]);
    }

    #[Route('/mes-heros', name: 'app_hero_user', methods: ['GET'])]
    public function userHeros(HeroRepository $heroRepository): Response
    {
        $user = $this->getUser();

        // Récupérer les équipements de l'utilisateur connecté
        $heros = $heroRepository->findBy(['utilisateur' => $user]);

        return $this->render('hero/user_heros.html.twig', [
            'heros' => $heros,
        ]);
    }
    #[Route('/new', name: 'app_hero_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hero = new Hero();
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hero->setUtilisateur($this->getUser());
            $entityManager->persist($hero);
            $entityManager->flush();

            return $this->redirectToRoute('app_hero_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hero/new.html.twig', [
            'hero' => $hero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hero_show', methods: ['GET'])]
    public function show(Hero $hero): Response
    {
        return $this->render('hero/show.html.twig', [
            'hero' => $hero,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hero_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hero $hero, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hero_index');
        }

        return $this->render('hero/edit.html.twig', [
            'hero' => $hero,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_hero_delete', methods: ['POST'])]
    public function delete(Request $request, Hero $hero, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hero->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($hero);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hero_index', [], Response::HTTP_SEE_OTHER);
    }
}
