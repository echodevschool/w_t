<?php


namespace App\Controller;

use App\Entity\Order;
use App\Form\CartType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_page')]
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $order = new Order;
        $form = $this->createForm(CartType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('cart_page');
        }


        return $this->render('cart/cart.html.twig', [
            'form' => $form->createView()
        ]);
    }

}