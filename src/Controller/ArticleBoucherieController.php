<?php

namespace App\Controller;

use App\Entity\ArticleBoucherie;
use App\Entity\CategorieBoucherie;
use App\Form\ArticleBoucherieType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleBoucherieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/article/boucherie")
 */
class ArticleBoucherieController extends AbstractController
{
    /**
     * @Route("/", name="article_boucherie_index", methods={"GET"})
     */
    public function index(ArticleBoucherieRepository $articleBoucherieRepository): Response
    {
        return $this->render('article_boucherie/index.html.twig', [
            'article_boucheries' => $articleBoucherieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_boucherie_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $articleBoucherie = new ArticleBoucherie();
        $form = $this->createForm(ArticleBoucherieType::class, $articleBoucherie);
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
                $articleBoucherie->setPath($finalFilename);
            }

            $entityManager->persist($articleBoucherie);
            $entityManager->flush();

            return $this->redirectToRoute('article_boucherie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_boucherie/new.html.twig', [
            'article_boucherie' => $articleBoucherie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/show", name="article_boucherie_show", methods={"GET"})
     */
    public function show(ArticleBoucherie $articleBoucherie): Response
    {
        return $this->render('article_boucherie/show.html.twig', [
            'article_boucherie' => $articleBoucherie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_boucherie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArticleBoucherie $articleBoucherie, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ArticleBoucherieType::class, $articleBoucherie);
        $old_path = $articleBoucherie->getPath();
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
                $articleBoucherie->setPath($finalFilename);

                if ($old_path != "") {

                    $old_path = $imagesDirectory . $old_path;
                    // unlink($old_path);
                }
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_boucherie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_boucherie/edit.html.twig', [
            'article_boucherie' => $articleBoucherie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="article_boucherie_delete", methods={"POST"})
     */
    public function delete(Request $request, ArticleBoucherie $articleBoucherie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $articleBoucherie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleBoucherie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_boucherie_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}/{categorie}/addCard", name="product_boucherie", methods={"GET"})
     */
    public function addArticle(ArticleBoucherieRepository $articleBoucherieRepository , $id , $categorie ): Response
    {

        // $article2s = [];
        // $articles = [];
        // $article2s = $articleBoucherieRepository->findAll();

        // foreach ($article2s as $article) {
        //     $tmpCategorie = $article->getCategorie()->getNom();


        //     if ( strtoupper( $tmpCategorie ) ==  strtoupper( $categorie )  ){
        //         array_push($articles, $article);
        //     }
        // }
        
 

        // return $this->render('article_boucherie/boucherieCard.html.twig', [
        //     'controller_name' => 'ArticleBoucherieController',
        //     'articles_boucheries'  => $articles,
        //     'categorie'            => $categorie,

        // ]);
        return $this->redirectToRoute('liste_boucherie', 
          [ 'categorie'            => $categorie ], 
          Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{categorie}/listeboucherie", name="liste_boucherie",  methods={"GET","POST"})
     */
    public function achatboucherie(ArticleBoucherieRepository $articleBoucherieRepository, $categorie): Response
    {

        $article2s = [];
        $articles = [];
        $article2s = $articleBoucherieRepository->findAll();

        foreach ($article2s as $article) {
            $tmpCategorie = $article->getCategorie()->getNom();


            if ( strtoupper( $tmpCategorie ) ==  strtoupper( $categorie )  ){
                array_push($articles, $article);
            }
        }
        
 

        return $this->render('article_boucherie/boucherieCard.html.twig', [
            'controller_name' => 'ArticleBoucherieController',
            'articles_boucheries'  => $articles,
            'categorie'            => $categorie,

        ]);
    }
    
    /**
     * @Route("/agneau", name="agneau")
     */
    public function agneau(ArticleBoucherieRepository $articleBoucherieRepository): Response
    {
        
        return $this->render('article_boucherie/agneau.html.twig', [
            'controller_name' => 'HomeController',
            'article_boucheries' => $articleBoucherieRepository->findAll(),

        ]);
    }

    /**
     * @Route("/boeuf", name="boeuf")
     */
    public function boeuf(ArticleBoucherieRepository $articleBoucherieRepository): Response
    {
        return $this->render('article_boucherie/boeuf.html.twig', [
            'controller_name' => 'HomeController',
            'article_boucheries' => $articleBoucherieRepository->findAll(),

        ]);
    }

    /**
     * @Route("/veau", name="veau")
     */
    public function veau(ArticleBoucherieRepository $articleBoucherieRepository): Response
    {
        return $this->render('article_boucherie/veau.html.twig', [
            'controller_name' => 'HomeController',
            'article_boucheries' => $articleBoucherieRepository->findAll(),

        ]);
    }

    /**
     * @Route("/volaille", name="volaille")
     */
    public function volaille(ArticleBoucherieRepository $articleBoucherieRepository): Response
    {
        return $this->render('article_boucherie/volaille.html.twig', [
            'controller_name' => 'HomeController',
            'article_boucheries' => $articleBoucherieRepository->findAll(),

        ]);
    }

    /**
     * @Route("/barbecue", name="barbecue")
     */
    public function barbecue(ArticleBoucherieRepository $articleBoucherieRepository): Response
    {
        return $this->render('article_boucherie/barbecue.html.twig', [
            'controller_name' => 'HomeController',
            'article_boucheries' => $articleBoucherieRepository->findAll(),

        ]);
    }

    

}
