<?php


namespace App\Controller;

use App\Entity\Order;
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

    #[Route('/cart/form', name: 'cart_form')]
    public function getForm(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        //$request->query->get('id') // $_GET['id']
        //$request->request->get('id') // $_POST['id']
        $stringIds = $request->request->get('id');
        if ($stringIds !== null) {
            $ids = explode(',', $stringIds);
            $data = $productRepository->findBy(['id' => $ids]);
//            $data = $entityManager->getRepository(Product::class)
//                ->createQueryBuilder('o')
//                ->where('o.id in (:ids)')->setParameter('ids', $ids)
//                ->getQuery()
//                ->getResult();
        }
    }

}