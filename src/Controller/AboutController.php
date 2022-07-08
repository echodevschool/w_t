<?php


namespace App\Controller;


use App\Entity\Feedback;
use App\Form\AboutType;
use App\Services\Telegram;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about_page')]
    public function aboutUs(Request $request, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(AboutType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();
            $telegram = new Telegram($this->getParameter('telegram.token'));
            $telegram->sendMessage('-1001542886992', $feedback->getMessage());

            return $this->redirectToRoute('about_page');
        }


        return $this->render('about/about.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

