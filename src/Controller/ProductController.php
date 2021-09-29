<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'products', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function products(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'productList' => $productRepository->findAll(),

        ]);
    }

    #[Route('/products/{id}', name: 'product', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function productsId(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'product' => $productRepository->findbyId(),

        ]);
    }
}
