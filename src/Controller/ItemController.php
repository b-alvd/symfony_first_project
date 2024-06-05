<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Item;
use App\Form\AddArticleType;
use App\Form\ArticleType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ItemController extends AbstractController
{
    #[Route('categorie/item/{id}', name: 'app_item')]
    public function index(): Response
    {
        return $this->render('item/index.html.twig', [
            'controller_name' => 'ItemController',
        ]);
    }

    #[Route('item/new', name: 'app_item_new')]
    public function form(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setCreatedAt(new \DateTimeImmutable());
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('app_index');
        }
        
        return $this->render('item/form.html.twig', [
            'form_article' => $form
        ]);
    }
}
