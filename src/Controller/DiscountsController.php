<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscountsController extends AbstractController
{
    #[Route('/discounts', name: 'discounts_page')]
    public function discountsPage() : Response
    {
        return $this->render('home/discounts.html.twig');
    }
}