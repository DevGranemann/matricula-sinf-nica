<?php

namespace App\Controller;

use App\Entity\Matricula;
use App\Form\MatriculaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class matriculaController extends AbstractController
{
    #[Route('/matricula', name:'matricula_aluno')]
    public function matricula(Request $request, EntityManagerInterface $em): Response
    {
        // cria uma nova instância de Matricula
        $matricula = new Matricula();

        // cria o form
        $form = $this->createForm(MatriculaType::class, $matricula);

        // processa o form
        $form->handleRequest($request);

        // verifica se o form enviado é válido
        if ($form->isSubmitted() && $form->isValid())
        {
            // se verdadeiro salva a matricula no banco
            $em->persist($matricula);
            $em->flush();

            // redirecionado para a tabela de turma
            return $this->redirectToRoute('ver_matricula');
        }

        // renderiza o form na view
        return $this->render('matricula.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/matricula/ver_matricula', name:'ver_matricula')]
    public function vizualizarMatricula(EntityManagerInterface $em): Response
    {

        //busca todos os aluno no banco
        $matriculas = $em->getRepository(Matricula::class)->findAll();

        //Renderiza a view com tabela de alunos
        return $this->render('ver_matricula.html.twig',[
            'matriculas' => $matriculas,

        ]);

    }           
}