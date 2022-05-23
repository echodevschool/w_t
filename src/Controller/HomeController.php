<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class docker-compose up -d --build

HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'products' => $products
        ]);
    }

    #[Route('/product/{id}', name: 'show_product')]
    public function showProduct($id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);

        return $this->render('home/show_product.html.twig', [
            'product' => $product
        ]);
    }
}
