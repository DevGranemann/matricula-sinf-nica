<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class matriculaController extends AbstractController
{
    #[Route('/', name:'app_index')]
    public function index(): Response
    {
        $categories =
        [
            ['title' => 'Aluno',         'text' => 'Matrícula de Aluno'],
            ['title' => 'Curso',         'text' => 'Matrícula de Curso'],
            ['title' => 'Cadastro',       'text' => 'Cadastro de Aluno'],

        ];

        
        return $this->render('home/home.html.twig', [
        
            'categories' => $categories,
            



        ]);
    }
}