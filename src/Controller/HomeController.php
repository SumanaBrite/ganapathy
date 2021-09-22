<?php

namespace App\Controller;

use App\Entity\ArticleBoucherie;
use App\Repository\EventRepository;
use App\Repository\ArticleFastFoodRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleBoucherieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EventRepository $eventRepository, ArticleBoucherieRepository $articleBoucherieRepository, ArticleFastFoodRepository $fastFoodRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'events' => $eventRepository->findAll(),
            'articlesBoucherie' => $articleBoucherieRepository->findAll(),
            'articlesFastFood' => $fastFoodRepository->findAll(),

        ]);
    }

    
    /**
     * @Route("/coiffeur", name="coiffeur")
     */
    public function coiffeur(): Response
    {
        return $this->render('home/coiffeur.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    
    // /**
    //  * @Route("/eventSlider", name="eventSlider", methods={"GET"})
    //  */
    // public function event(EventRepository $eventRepository): Response
    // {
    //     return $this->render('home/eventSlider.html.twig', [
    //         'events' => $eventRepository->findAll(),
    //     ]);
    // }

    // /**
    //  * @Route("/boucherieSlider", name="boucherie_slider")
    //  */
    // public function boucherieSlider(ArticleBoucherieRepository $articleBoucherieRepository): Response
    // {
    //     return $this->render('home/boucherieSlider.html.twig', [
    //         'controller_name' => 'HomeController',
    //         'articlesBoucherie' => $articleBoucherieRepository->findAll(),

    //     ]);
    // }

    // /**
    //  * @Route("/fastFoodSlider", name="fast_food_slider")
    //  */
    // public function fastFoodSlider(ArticleFastFoodRepository $fastFoodRepository): Response
    // {
    //     return $this->render('home/fastFoodSlider.html.twig', [
    //         'controller_name' => 'HomeController',
    //         'articlesFastFood' => $fastFoodRepository->findAll(),

    //     ]);
    // }



    
}
