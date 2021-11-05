<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleBoucherieRepository;
use SessionIdInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, ArticleBoucherieRepository $articleBoucherieRepository)
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];
        foreach($panier as $id => $quantity){
            $panierWithData[] = [
                'product' => $articleBoucherieRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;
        foreach($panierWithData as $item){
                $totalItem = $item['product']->getPrixUnitaire() * $item['quantity'];
                $total += $totalItem;
            }

        // dd($panierWithData);
        return $this->render('panier/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }
    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */

    public function add($id, SessionInterface $session)
    {
        
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }
        else 
        {
            $panier[$id]=1;
        }
    
        $session->set('panier', $panier);
        // dd($session->get('panier'));
        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier/delete/{id}", name="panier_delete")
     */

    public function delete($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute("panier");
    }
}
