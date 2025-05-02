<?php

    namespace App\Controller;

    use App\Entity\Chapitre;
    use App\Entity\Choix;
    use App\Entity\Hero;
    use App\Entity\Histoire;
    use App\Entity\StatHero;
    use App\Repository\HeroRepository;
    use App\Repository\HistoireRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class JouerController extends AbstractController
    {
        #[Route('/jouer', name: 'app_jouer')]
        public function index(HistoireRepository $histoireRepository): Response
        {
            $histoires = $histoireRepository->findAll();

            return $this->render('jouer/index.html.twig', [
                'histoires' => $histoires,
            ]);
        }

        #[Route('/jouer/choisir-hero/{id}', name: 'app_jouer_choisir_hero')]
        public function choisirHero(Histoire $histoire, HeroRepository $heroRepository): Response
        {
            $heros = $heroRepository->findAll();

            return $this->render('jouer/choisir_hero.html.twig', [
                'histoire' => $histoire,
                'heros' => $heros,
            ]);
        }

       #[Route('/jouer/commencer/{histoireId}/{heroId}', name: 'app_jouer_commencer')]
        public function commencer(
            int $histoireId,
            int $heroId,
            HistoireRepository $histoireRepository,
            HeroRepository $heroRepository,
            EntityManagerInterface $entityManager
        ): Response {
            $histoire = $histoireRepository->find($histoireId);
            $hero = $heroRepository->find($heroId);

            if (!$histoire || !$hero) {
                throw $this->createNotFoundException('Histoire ou héros introuvable.');
            }

            // Copier les stats du héros dans StatHero
            $statHero = new StatHero();
            $statHero->setPvActu($hero->getPv());
            $statHero->setAtkActu($hero->getAtk());
            $statHero->setDefActu($hero->getDef());
            $statHero->setAgiActu($hero->getAgi());
            $statHero->setIntActu($hero->getIntel());
            $statHero->setHero($hero);
            $statHero->setHistoire($histoire); // Lier StatHero à l'Histoire

            $entityManager->persist($statHero);
            $entityManager->flush();

            return $this->render('jouer/commencer.html.twig', [
                'histoire' => $histoire,
                'statHero' => $statHero,
            ]);
        }

       #[Route('/jouer/chapitre/{id}', name: 'app_jouer_chapitre')]
       public function chapitre(Chapitre $chapitre, EntityManagerInterface $entityManager): Response
       {
           // Récupérer l'utilisateur connecté
           $user = $this->getUser();

           // Récupérer le héros associé à l'utilisateur
           $hero = $entityManager->getRepository(Hero::class)->findOneBy([
               'user' => $user,
           ]);

           if (!$hero) {
               throw $this->createNotFoundException('Aucun héros trouvé pour cet utilisateur.');
           }

           // Récupérer les statistiques du héros pour l'histoire en cours
           $statHero = $entityManager->getRepository(StatHero::class)->findOneBy([
               'histoire' => $chapitre->getHistoire(),
               'hero' => $hero,
           ]);

           if (!$statHero) {
               throw $this->createNotFoundException('Statistiques du héros introuvables pour cette histoire.');
           }

           return $this->render('jouer/chapitre.html.twig', [
               'chapitre' => $chapitre,
               'choix' => $chapitre->getChoix(),
               'statHero' => $statHero,
           ]);
       }

        #[Route('/jouer/choix/{id}', name: 'app_jouer_choix')]
        public function choix(Choix $choix, EntityManagerInterface $entityManager): Response
        {
            $chapitreCible = $entityManager->getRepository(Chapitre::class)->find($choix->getChapitreCible());

            if (!$chapitreCible) {
                throw $this->createNotFoundException('Chapitre cible introuvable.');
            }

            return $this->redirectToRoute('app_jouer_chapitre', ['id' => $chapitreCible->getId()]);
        }
    }