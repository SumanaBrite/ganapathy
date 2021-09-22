<?php

namespace App\Controller;

use App\Entity\UniteFastFood;
use App\Form\UniteFastFoodType;
use App\Repository\UniteFastFoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/unite/fast/food")
 */
class UniteFastFoodController extends AbstractController
{
    /**
     * @Route("/", name="unite_fast_food_index", methods={"GET"})
     */
    public function index(UniteFastFoodRepository $uniteFastFoodRepository): Response
    {
        return $this->render('unite_fast_food/index.html.twig', [
            'unite_fast_foods' => $uniteFastFoodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="unite_fast_food_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $uniteFastFood = new UniteFastFood();
        $form = $this->createForm(UniteFastFoodType::class, $uniteFastFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($uniteFastFood);
            $entityManager->flush();

            return $this->redirectToRoute('unite_fast_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unite_fast_food/new.html.twig', [
            'unite_fast_food' => $uniteFastFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="unite_fast_food_show", methods={"GET"})
     */
    public function show(UniteFastFood $uniteFastFood): Response
    {
        return $this->render('unite_fast_food/show.html.twig', [
            'unite_fast_food' => $uniteFastFood,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="unite_fast_food_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UniteFastFood $uniteFastFood): Response
    {
        $form = $this->createForm(UniteFastFoodType::class, $uniteFastFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unite_fast_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unite_fast_food/edit.html.twig', [
            'unite_fast_food' => $uniteFastFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="unite_fast_food_delete", methods={"POST"})
     */
    public function delete(Request $request, UniteFastFood $uniteFastFood): Response
    {
        if ($this->isCsrfTokenValid('delete'.$uniteFastFood->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($uniteFastFood);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unite_fast_food_index', [], Response::HTTP_SEE_OTHER);
    }
}
