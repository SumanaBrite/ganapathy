<?php

namespace App\Controller;

use App\Entity\TauxTva;
use App\Form\TauxTvaType;
use App\Repository\TauxTvaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taux/tva")
 */
class TauxTvaController extends AbstractController
{
    /**
     * @Route("/", name="taux_tva_index", methods={"GET"})
     */
    public function index(TauxTvaRepository $tauxTvaRepository): Response
    {
        return $this->render('taux_tva/index.html.twig', [
            'taux_tvas' => $tauxTvaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="taux_tva_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tauxTva = new TauxTva();
        $form = $this->createForm(TauxTvaType::class, $tauxTva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tauxTva);
            $entityManager->flush();

            return $this->redirectToRoute('taux_tva_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('taux_tva/new.html.twig', [
            'taux_tva' => $tauxTva,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="taux_tva_show", methods={"GET"})
     */
    public function show(TauxTva $tauxTva): Response
    {
        return $this->render('taux_tva/show.html.twig', [
            'taux_tva' => $tauxTva,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="taux_tva_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TauxTva $tauxTva): Response
    {
        $form = $this->createForm(TauxTvaType::class, $tauxTva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('taux_tva_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('taux_tva/edit.html.twig', [
            'taux_tva' => $tauxTva,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="taux_tva_delete", methods={"POST"})
     */
    public function delete(Request $request, TauxTva $tauxTva): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tauxTva->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tauxTva);
            $entityManager->flush();
        }

        return $this->redirectToRoute('taux_tva_index', [], Response::HTTP_SEE_OTHER);
    }
}
