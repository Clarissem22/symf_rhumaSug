<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class PanierService
{
    private $requestStack;
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        
    }


    public function ajouterProduit(int $id)
    {
        $session = $this->requestStack->getSession(); //$_SESSION
        $panier= $session->get('panier'); //$_SESSION["panier"]
        // si le produit est déjà dans le panier, on incrémente la quantité
        // id= 6
        if (isset($panier[$id])){  //$panier = [6 => 1]
            $panier[$id]++; //$panier = [6 => 2]
        } else { // si le produit n'est pas dans le panier, on l'ajoute avec la quantité
            $panier[$id] = 1; //$panier= [6 =>1]
        }
                $session->set('panier', $panier); // $_SESSION["panier][18]

       
    }
}