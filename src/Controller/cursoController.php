<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Form\CursoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class cursoController extends AbstractController
{
    #[Route('/curso', name:'cadastro_curso')]
    public function cadastrarCurso(Request $request, EntityManagerInterface $em): Response
    {
        // cria uma nova instância de curso
        $curso = new Curso();

        // cria o form
        $form = $this->createForm(CursoType::class, $curso);

        // processa o form
        $form->handleRequest($request);

        // verifica se o form enviado é válido
        if ($form->isSubmitted() && $form->isValid())
        {
            // se verdadeiro, salva o curso no banco
            $em->persist($curso);
            $em->flush();

            // é redirecionado para a tabela de cursos
            return $this->redirectToRoute('ver_curso');
        }

        // renderiza o form na view
        return $this->render('curso.html.twig', [
            
            'form' => $form->createView(),


        ]);

    }

    #[Route('/curso/ver_curso', name:'ver_curso')]
    public function vizualizar(EntityManagerInterface $em): Response
    {

        //busca todos os aluno no banco
        $cursos = $em->getRepository(Curso::class)->findAll();

        //Renderiza a view com tabela de alunos
        return $this->render('ver_curso.html.twig',[
            'cursos' => $cursos,

        ]);

    }
}