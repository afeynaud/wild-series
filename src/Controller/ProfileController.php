<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/my-profile", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="show")
     */
    public function show(): Response
    {
        $user = $this->getUser();
        $watchlist = $this->getUser()->getWatchlist();
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'watchlist' => $watchlist,
        ]);
    }
}
