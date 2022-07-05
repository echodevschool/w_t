<?php


namespace App\Controller;


use App\Entity\Feedback;
use App\Entity\SystemInformation;
use App\Repository\ProductRepository;
use App\Repository\SystemInformationRepository;
use App\Form\AboutType;
use App\Services\Telegram;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about_page')]
    public function aboutUs(Request $request, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(AboutType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();
//            $telegram = new Telegram($this->getParameter('telegram.token'));
//            $telegram->sendMessage('-1001542886992', $feedback->getMessage());

            return $this->redirectToRoute('about_page');
        }


        return $this->render('about/about.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

