<?php


namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Form\CartType;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_page')]
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        if ($request->request->has('cart')) {
            dd($request->request->all());
        }
//        $order = new Order;
//        $form = $this->createForm(CartType::class, $order);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->persist($order);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('cart_page');
//        }


        return $this->render('cart/cart.html.twig', [
            //'form' => $form->createView()
        ]);
    }

    #[Route('/cart/form', name: 'cart_form')]
    public function getForm(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $cart = $request->request->get('cart');
        if ($cart !== null) {
            $cart = json_decode($cart, true);
            $order = new Order();
            $sum = 0;
            foreach ($cart as $productId => $countItem) {
                $product = $productRepository->find($productId);
                $sum += ($product->getPrice() * $countItem);
                $orderProduct = new OrderProduct();
                $orderProduct
                    ->setProduct($product)
                    ->setCount($countItem);
                $order->addOrderProduct($orderProduct);
            }
            $form = $this->createForm(CartType::class, $order);

            return $this->render('cart/cart_form.html.twig', [
                'form' => $form->createView(),
                'sum' => $sum
            ]);
        }
    }

}