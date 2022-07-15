<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController

{
    #[Route('/contacts', name: 'contacts_page')]
    public function discountsPage() : Response
    {
        return $this->render('home/contacts.html.twig');
    }
}
