<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'categories_list')]
    public function list(CategoryRepository $categoryRepository): Response
    {
        // Récupère tous les articles de la catégorie
        // Puis les envoyer au template
        $categories = $categoryRepository->findAll();
        return $this->render('category/list.html.twig', [
            'categories'=> $categories,
        ]);
    }

    #[Route('/categorie/{name}', name: 'category_item')]
    public function item(Category $category): Response
    {
        return $this->render('category/item.html.twig', [
            'category' => $category,
        ]);
    }
}
