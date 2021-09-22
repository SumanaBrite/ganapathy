<?php

namespace App\Controller;

use App\Entity\CategorieFastFood;
use App\Form\CategorieFastFoodType;
use App\Repository\CategorieFastFoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie/fast/food")
 */
class CategorieFastFoodController extends AbstractController
{
    /**
     * @Route("/", name="categorie_fast_food_index", methods={"GET"})
     */
    public function index(CategorieFastFoodRepository $categorieFastFoodRepository): Response
    {
        return $this->render('categorie_fast_food/index.html.twig', [
            'categorie_fast_foods' => $categorieFastFoodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categorie_fast_food_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorieFastFood = new CategorieFastFood();
        $form = $this->createForm(CategorieFastFoodType::class, $categorieFastFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorieFastFood);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_fast_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_fast_food/new.html.twig', [
            'categorie_fast_food' => $categorieFastFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/show", name="categorie_fast_food_show", methods={"GET"})
     */
    public function show(CategorieFastFood $categorieFastFood): Response
    {
        return $this->render('categorie_fast_food/show.html.twig', [
            'categorie_fast_food' => $categorieFastFood,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_fast_food_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategorieFastFood $categorieFastFood): Response
    {
        $form = $this->createForm(CategorieFastFoodType::class, $categorieFastFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_fast_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_fast_food/edit.html.twig', [
            'categorie_fast_food' => $categorieFastFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="categorie_fast_food_delete", methods={"POST"})
     */
    public function delete(Request $request, CategorieFastFood $categorieFastFood): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categorieFastFood->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorieFastFood);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_fast_food_index', [], Response::HTTP_SEE_OTHER);
    }
}
