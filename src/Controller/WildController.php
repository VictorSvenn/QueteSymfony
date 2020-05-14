<?php

// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class WildController
 * @package App\Controller
 * @Route("wild", name="wild")
 */
class WildController extends AbstractController
{
    /**
     * @Route("", name="wild_index")
     */
    public function index(): Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("/show/{slug}",
     * defaults={"slug"= "Aucune série sélectionnée, veuillez choisir une série"},
     * requirements={"slug"= "[a-z0-9-]+"},
     * name="wild_show")
     */
    public function show(string $slug): Response
    {
        $slug = str_replace("-", ' ', $slug);
        $slug = ucwords($slug);
        return $this->render('wild/show.html.twig', [
            'slug' => $slug,
        ]);
    }
}