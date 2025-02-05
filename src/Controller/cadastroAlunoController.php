<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Form\AlunoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class cadastroAlunoController extends AbstractController
{
    
    #[Route('/', name:'home')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig', [
          
        ]);
    }
    #[Route('/aluno', name:'cadastro_aluno')]
    public function cadastrar(Request $request, EntityManagerInterface $em): Response
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

    #[Route('/aluno/editar/{id}', name: 'edita_aluno', methods: ['GET', 'POST'])]
    public function editar(Request $request, EntityManagerInterface $em, int $id): Response
    {
        // busca o aluno pelo id
        $aluno = $em->getRepository(aluno::class)->find($id);

        // se o aluno não existir, uma exceção
        if (!$aluno)
        {
            throw $this->createNotFoundException('Aluno não encontrado');
        }

        // cria o formulário de edição
        $form = $this->createForm(AlunoType::class, $aluno);

        // processa o formulário 
        $form->handleRequest($request);

        // se o formulário for enviado e válido
        if ($form->isSubmitted() && $form->isValid())
        {
            // salva as alterações no banco
            $em->flush();

            // redireciona para a página ver_aluno
            return $this->redirectToRoute('ver_aluno');
        }

        // renderiza o formulário de edição
        return $this->render('edita_aluno.html.twig',  [
            'form' => $form->createView(),
            
        ]);
    }
    
    #[Route('aluno/excluir/{id}', name: 'excluir_aluno', methods: ['POST','DELETE'])]
    public function excluir(Request $request, EntityManagerInterface $em, int $id): Response
    {
        // encontra o aluno pelo id
        $aluno = $em->getRepository(Aluno::class)->find($id);

        // se o aluno não existir, uma exceção
        if (!$aluno)
        {
            throw $this->createNotFoundException('Aluno não encontrado');
        }

        // verifica o token CSRF para segurança
        if ($this->isCsrfTokenValid('delete' . $aluno->getId(), $request->request->get('_token')))
        {
            // remove o aluno do banco
            $em->remove($aluno);
            $em->flush();
        }

        // redireciona para a página ver_aluno 
        return $this->redirectToRoute('ver_aluno');

    }

}