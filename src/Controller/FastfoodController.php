<?php

namespace App\Controller;

use App\Entity\ArticleFastFood;
use App\Repository\ArticleFastFoodRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategorieFastFoodRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FastfoodController extends AbstractController
{
    /**
     * @Route("/fastfood", name="fastfood")
     */
    public function index(ArticleFastFoodRepository $articleFastFoodRepository, CategorieFastFoodRepository $categorieFastFoodRepository): Response
    
    {
        $articlesFastFood   =  $articleFastFoodRepository->findAll();
        $categoriesFastFood = $categorieFastFoodRepository->findAll();
        // $menusFastFood   =  $articleFastFoodRepository->findBy(['property'=>value]);
        
        return $this->render('fastfood/index.html.twig', [

            'controller_name' => 'FastfoodController',
            'articlesFastFood'   => $articlesFastFood,
            'categoriesFastFood' => $categoriesFastFood
        ]);
    }

    /**
     * @Route("/{id}/detail", name="articleFastFood_detail", methods={"GET"})
     */
    public function show(ArticleFastFood $articleFastFood): Response
    {
        return $this->render('fastfood/detail.html.twig', [
            'articleFastFood' => $articleFastFood,
        ]);
    }
}
