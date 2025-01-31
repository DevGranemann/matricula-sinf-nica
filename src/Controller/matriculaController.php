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
        

        $pageTitle = "Menu";
        return $this->render('home/home.html.twig', [
        
            'pageTitle' => $pageTitle,
        ]);
    }
    #[Route('/aluno', name:'app_aluno')]
    public function aluno(string $slug=null): Response
    {    
        
        
        
        $pageTitle = "";
        return $this->render('aluno.html.twig', [
            
        ]);


    }
    #[Route('/curso', name:'app_curso')]
    public function curso(string $slug=null): Response
    {
        return $this->render('curso.html.twig', [



        ]);


    }
    #[Route('/cadastro', name:'app_cadastro')]
    public function cadastro(string $slug=null): Response
    {
        return $this-> render('cadastro.html.twig', [

        ]);
    }
}