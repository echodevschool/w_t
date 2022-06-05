<?php


namespace App\Controller;


use App\Entity\Feedback;
use App\Entity\SystemInformation;
use App\Repository\ProductRepository;
use App\Repository\SystemInformationRepository;
use App\Form\AboutType;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

class AboutController extends AbstractController
{
    #[NoReturn] #[Route('/about', name: 'about_page')]
    public function about(SystemInformationRepository $systemInformationRepository): \Symfony\Component\HttpFoundation\Response
    {
        $aboutUs = $systemInformationRepository->findAll();

        return $this->render(':about:about.html.twig', [
            'controller_name' => 'AboutController',
            'about' => $aboutUs
        ]);
    }
}
//    public function about(Request $request, EntityManagerInterface $entityManager)
//    {
//        $feedback = new Feedback();
//        $form = $this->createForm(AboutType::class, $feedback);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->persist($feedback);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('about_page');
//        }
//
//
//        return $this->render('about/about.html.twig', [
//            'form' => $form->createView()
//        ]);
//    }
//}