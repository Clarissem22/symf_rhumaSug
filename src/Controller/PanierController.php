<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $panier = $session->get('panier');

        return $this->render('panier/index.html.twig', [
            'panier' => $panier
        ]);
    }

    #[Route('/ajoutPanier/{id}', name: 'app_ajout_panier')]
    public function ajoutPanier($id, RequestStack $requestStack): Response
    {

        $session = $requestStack->getSession(); //$_SESSION
        $panier= $session->get('panier'); //$_SESSION["panier"]
        // si le produit est déjà dans le panier, on incrémente la quantité
        // id= 6
        if (isset($panier[$id])){  //$panier = [6 => 1]
            $panier[$id]++; //$panier = [6 => 2]
        } else { // si le produit n'est pas dans le panier, on l'ajoute avec la quantité
            $panier[$id] = 1; //$panier= [6 =>1]
        }
                $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier');
    }
}
