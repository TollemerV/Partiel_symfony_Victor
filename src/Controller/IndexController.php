<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(AlbumRepository $albumRepo): Response
    {
        $albums = $albumRepo->findTop(30);
        return $this->render('index/index.html.twig', [
            'albums' => $albums,
        ]);
    }
}
