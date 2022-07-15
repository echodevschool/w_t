<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{$category_id}', name: 'catalog_page')]


    public function showForm($id, CategoryRepository $categoryRepository): Response
    {
        $products = $categoryRepository->find(1);

        return $this->render('home/catalog.html.twig', [
            'formovyye-svechi' => $products
        ]);
    }
//
//    public function showProduct(ManagerRegistry $doctrine, int $id): Response
//    {
//        $category = $doctrine->getRepository(Product::class)->find('1');
//        $products = $category->getProducts();
//
//
//        return $this->render('home/catalog.html.twig', [
//            'formovyye-svechi' => $products
//        ]);
//
//    }

}