<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'products', methods: ['GET'])]
    public function product(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'productList' => $productRepository->findAll(),

        ]);
    }

    #[Route('/product/{id}', name: 'product', methods: ['GET'])]
    public function productId($id, ProductRepository $productRepository): Response
    {
        return $this->render('product/productId.html.twig', [
            'product' => $productRepository->findbyId($id),

        ]);
    }
}
