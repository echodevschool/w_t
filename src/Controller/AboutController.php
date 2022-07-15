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
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     */
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
            $message = 'Форма обратной связи: '.PHP_EOL.'Имя: '.$feedback->getName().PHP_EOL.'Сообщение: '.$feedback->getMessage();
            $telegram->sendMessage('-1001542886992', $message);

            return $this->redirectToRoute('about_page');
        }


        return $this->render('about/about.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

