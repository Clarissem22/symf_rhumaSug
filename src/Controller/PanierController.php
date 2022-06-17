<?php

namespace App\Controller;

use App\Services\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(PanierService $panierService): Response
    {
       
        $produits = $panierService;

        return $this->render('panier/index.html.twig', [
            'produits' => $produits
        ]);
    }

    #[Route('/ajoutPanier/{id}', name: 'app_ajout_panier')]
    public function ajoutPanier($id, PanierService $panierService): Response
    {
        $panierService->ajouterProduit($id);

        return $this->redirectToRoute('app_panier');
    }
}
