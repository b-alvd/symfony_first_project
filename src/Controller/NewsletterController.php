<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', name: 'newsletter_subscribe')]
    public function index(): Response
    {
        return $this->render('newsletter/subscribe.html.twig', [
            'controller_name' => 'NewsletterController',
        ]);
    }
}
