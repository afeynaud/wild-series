<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\User;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $programs = $managerRegistry->getRepository(Program::class)->findAll();
        return $this->render('index.html.twig', [
            'website' => 'Wild Séries',
            'programs' => $programs,
        ]);
    }

    public function navbarTop(CategoryRepository $categoryRepository): Response
    {
        return $this->render('components/_navbartop.html.twig', [
            'categories' => $categoryRepository->findBy([], ['id' => 'DESC'])
        ]);
    }
}
