<?php

namespace App\Controller;

use App\Entity\ArticleFastFood;
use App\Form\ArticleFastFoodType;
use App\Repository\ArticleFastFoodRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/article/fast/food")
 */
class ArticleFastFoodController extends AbstractController
{
    /**
     * @Route("/", name="article_fast_food_index", methods={"GET"})
     */
    public function index(ArticleFastFoodRepository $articleFastFoodRepository): Response
    {
        return $this->render('article_fast_food/index.html.twig', [
            'article_fast_foods' => $articleFastFoodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_fast_food_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $articleFastFood = new ArticleFastFood();
        $form = $this->createForm(ArticleFastFoodType::class, $articleFastFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imagesDirectory = "images/uploads/";
            $imageFile = $form->get('path')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // on crée un nom unique de stockage du fichier
                $safeFileName = $slugger->slug($originalFilename);
                $finalFilename = $safeFileName . '-' . uniqid() . '.' . $imageFile->guessExtension();
                // on essaye de deplacer le fichier à sa place finale, sur le serveur
                $imageFile->move($imagesDirectory, $finalFilename);
                // Mise à jour du champ path dans l'objet image
                $articleFastFood->setPath($finalFilename);
            }

            $entityManager->persist($articleFastFood);
            $entityManager->flush();

            return $this->redirectToRoute('article_fast_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_fast_food/new.html.twig', [
            'article_fast_food' => $articleFastFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/show", name="article_fast_food_show", methods={"GET"})
     */
    public function show(ArticleFastFood $articleFastFood): Response
    {
        return $this->render('article_fast_food/show.html.twig', [
            'article_fast_food' => $articleFastFood,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_fast_food_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArticleFastFood $articleFastFood, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ArticleFastFoodType::class, $articleFastFood);
        $old_path = $articleFastFood->getPath();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagesDirectory = "images/uploads/";
            // donc, on commence par récuperer ce qui a été uploadé
            $imageFile = $form->get('path')->getData();
            // on test, au cas ou
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // on crée un nom unique de stockage du fichier
                $safeFileName = $slugger->slug($originalFilename);
                $finalFilename = $safeFileName . '-' . uniqid() . '.' . $imageFile->guessExtension();
                // on essaye de deplacer le fichier à sa place finale, sur le serveur
                $imageFile->move($imagesDirectory, $finalFilename);
                // Mise à jour à jour du champ path dans l'objet image
                $articleFastFood->setPath($finalFilename);

                if ($old_path != "") {

                    $old_path = $imagesDirectory . $old_path;
                    // unlink($old_path);
                }
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_fast_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_fast_food/edit.html.twig', [
            'article_fast_food' => $articleFastFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="article_fast_food_delete", methods={"POST"})
     */
    public function delete(Request $request, ArticleFastFood $articleFastFood): Response
    {
        if ($this->isCsrfTokenValid('delete' . $articleFastFood->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleFastFood);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_fast_food_index', [], Response::HTTP_SEE_OTHER);
    }
}
