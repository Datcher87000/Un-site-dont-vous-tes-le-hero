<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\Histoire;
use App\Entity\User;
use App\Form\ChapitreType;
use App\Form\HistoireType;
use App\Repository\HistoireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/histoire')]
final class HistoireController extends AbstractController
{
    #[Route(name: 'app_histoire_index', methods: ['GET'])]
    public function index(HistoireRepository $histoireRepository): Response
    {
        return $this->render('histoire/index.html.twig', [
            'histoires' => $histoireRepository->findAll(),
        ]);
    }

    #[Route('/mes-histoires', name: 'app_histoire_user', methods: ['GET'])]
    public function userHistoire(HistoireRepository $histoireRepository): Response
    {
        $user = $this->getUser();

        // Récupérer les équipements de l'utilisateur connecté
        $histoires = $histoireRepository->findBy(['createur' => $user]);

        return $this->render('histoire/user_histoires.html.twig', [
            'histoires' => $histoires,
        ]);
    }

    #[Route('/new', name: 'app_histoire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $histoire = new Histoire();
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           if ($this->getUser() === null) {
               $anonyme = new User();
               $anonyme->setPseudo('Anonyme');
               $histoire->setCreateur($anonyme);
           } else {
               $histoire->setCreateur($this->getUser());
           }

            $entityManager->persist($histoire);
            $entityManager->flush();

            //créer un chapitre par défaut
            $chapitre = new Chapitre();
            $chapitre->setHistoire($histoire);
            $chapitre->setTitre('Chapitre 1');
            $chapitre->setNumChapitre(1);

           $this->addFlash('success', 'Histoire créée avec succès !');
           $this->addFlash('info', 'Vous pouvez maintenant ajouter des chapitres à votre histoire.');
           return $this->redirectToRoute('app_chapitre_new', ['id' => $histoire->getId()], Response::HTTP_SEE_OTHER);
       }

        return $this->render('histoire/new.html.twig', [
            'histoire' => $histoire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_histoire_show', methods: ['GET'])]
    public function show(Histoire $histoire): Response
    {
        $user = $this->getUser();
        $isCreator = $user && $user === $histoire->getCreateur();
        return $this->render('histoire/show.html.twig', [
            'histoire' => $histoire,
            'chapitres' => $histoire->getChapitres(),
            'canAddChapter' => $isCreator

        ]);
    }

    #[Route('/{id}/chapitre/new', name: 'app_chapitre_new', methods: ['GET', 'POST'])]
    public function newChapitre(Request $request, Histoire $histoire, EntityManagerInterface $entityManager): Response
    {
        $chapitre = new Chapitre();
        $chapitre->setHistoire($histoire);

        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chapitre);
            $entityManager->flush();

            $this->addFlash('success', 'Chapitre créé avec succès !');
            return $this->redirectToRoute('app_histoire_show', ['id' => $histoire->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chapitre/new.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form,
            'histoire' => $histoire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_histoire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Histoire $histoire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_histoire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('histoire/edit.html.twig', [
            'histoire' => $histoire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_histoire_delete', methods: ['POST'])]
    public function delete(Request $request, Histoire $histoire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$histoire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($histoire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_histoire_index', [], Response::HTTP_SEE_OTHER);
    }
}
