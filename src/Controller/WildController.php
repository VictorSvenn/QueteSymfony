<?php

// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CategorySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class WildController
 * @package App\Controller
 * @Route("wild", name="wild_")
 */
class WildController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(Request $request): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if (!$programs){
            throw $this->createNotFoundException(
                'No program found in program\' s table'
            );
        }

        return $this->render('wild/add.html.twig', [
            'programs' => $programs,
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show")
     * @return Response
     */
    public function show(string $slug): Response
    {
        if (!$slug){
            throw $this
            ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            "/-/",
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' =>mb_strtolower($slug)]);
        if (!$program){
            throw $this->createNotFoundException(
                'No program with '.$slug.' title, found in program\'s table.'
            );
        }
        return $this->render('wild/show.html.twig', [
            'program' => $program,
            'slug' => $slug,
        ]);
    }

    /**
     * @Route("/showProgram/{slug}", name="show_program")
     */
    public function showByProgram(string $slug): Response
    {
        $slug = preg_replace(
            "/-/",
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' =>mb_strtolower($slug)]);
        $seasons=$program->getSeasons();

        return $this->render('wild/showProgram.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
            'slug' => $slug
        ]);
    }

    /**
     * @Route("/showSeason/{id}", methods={"GET"}, name="show_season")
     */
    public function showBySeason(int $id): Response
    {
        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['id'=> $id]);

        $program = $season->getProgram();
        $episodes = $season->getEpisodes();

        return $this->render('wild/showSeason.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);


    }

    /**
     * @Route("/showSeason/showEpisode/{id}", methods={"GET"}, name="show_episode")
     */
    public function showByEpisode(Episode $episode): Response
    {
        $season = $episode->getSeason();
        $program= $season->getProgram();

        return $this->render('wild/showEpisode.html.twig',[
            'episode' => $episode,
            'season' => $season,
            'program' => $program
        ]);
    }

    /**
     * @Route("/category/{categoryName}", name="show_category")
     */
    public function showByCategory(string $categoryName): Response
    {
        $showCategory = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($categoryName);
        $movies = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findByCategory($showCategory);
        return $this->render('wild/category.html.twig', [
            'movies' => $movies
            ]);
    }
}