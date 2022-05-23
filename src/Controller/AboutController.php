<?php


namespace App\Controller;


use App\Entity\Feedback;
use App\Form\AboutType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about_page')]
    public function about(Request $request, EntityManagerInterface $entityManager)
    {
        $feedback = new Feedback();
        $form = $this->createForm(AboutType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->redirectToRoute('about_page');
        }


        return $this->render('about/about.html.twig', [
            'form' => $form->createView()
        ]);
    }
}