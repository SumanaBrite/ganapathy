<?php

namespace App\Controller;

use App\Entity\CategorieBoucherie;
use App\Form\CategorieBoucherieType;
use App\Repository\CategorieBoucherieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie/boucherie")
 */
class CategorieBoucherieController extends AbstractController
{
    /**
     * @Route("/", name="categorie_boucherie_index", methods={"GET"})
     */
    public function index(CategorieBoucherieRepository $categorieBoucherieRepository): Response
    {
        return $this->render('categorie_boucherie/index.html.twig', [
            'categorie_boucheries' => $categorieBoucherieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categorie_boucherie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorieBoucherie = new CategorieBoucherie();
        $form = $this->createForm(CategorieBoucherieType::class, $categorieBoucherie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorieBoucherie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_boucherie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_boucherie/new.html.twig', [
            'categorie_boucherie' => $categorieBoucherie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/show", name="categorie_boucherie_show", methods={"GET"})
     */
    public function show(CategorieBoucherie $categorieBoucherie): Response
    {
        return $this->render('categorie_boucherie/show.html.twig', [
            'categorie_boucherie' => $categorieBoucherie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_boucherie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategorieBoucherie $categorieBoucherie): Response
    {
        $form = $this->createForm(CategorieBoucherieType::class, $categorieBoucherie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_boucherie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_boucherie/edit.html.twig', [
            'categorie_boucherie' => $categorieBoucherie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="categorie_boucherie_delete", methods={"POST"})
     */
    public function delete(Request $request, CategorieBoucherie $categorieBoucherie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categorieBoucherie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorieBoucherie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_boucherie_index', [], Response::HTTP_SEE_OTHER);
    }
}
