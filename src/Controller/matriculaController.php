<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Form\AlunoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class matriculaController extends AbstractController
{
    
    #[Route('/', name:'app_index')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig', [
          
        ]);
    }
    #[Route('/aluno', name:'cadastro_aluno')]
    public function aluno(Request $request, EntityManagerInterface $em): Response
    {    

        // criando uma nova instância de Aluno
        $aluno = new Aluno();

        // criando o formulário
        $form = $this->createForm(AlunoType::class, $aluno);

        // processando o formulário
        $form->handleRequest($request);

        // verificando se o formulário foi enviado e é válido
        if ($form->isSubmitted() && $form->isValid())
        {
            //se for verdade então salva o aluno no banco
            $em->persist($aluno);
            $em->flush();

            //é redidirecionado para tabela de alunos cadastrados
            return $this->redirectToRoute('ver_aluno');
        }

        //renderiza o form na view
        return $this->render('aluno.html.twig', [

            'form' => $form->createView(),

        ]);


    }
    #[Route('/aluno/ver_aluno', name:'ver_aluno')]
    public function vizualizar(EntityManagerInterface $em): Response
    {

        //busca todos os aluno no banco
        $alunos = $em->getRepository(Aluno::class)->findAll();

        //Renderiza a view com tabela de alunos
        return $this->render('ver_aluno.html.twig',[
            'alunos' => $alunos,

        ]);

    }
    #[Route('/curso', name:'app_curso')]
    public function curso(string $slug=null): Response
    {
        return $this->render('curso.html.twig', [



        ]);


    }
    #[Route('/cadastro', name:'app_cadastro')]
    public function cadastro(): Response
    {
        return $this-> render('cadastro.html.twig', [

        ]);
    }
}