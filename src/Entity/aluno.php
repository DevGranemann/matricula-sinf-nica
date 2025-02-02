<?php

namespace App\Entity;

use App\Repository\AlunoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlunoRepository::class)]
class Aluno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $nome_aluno = null;

    #[ORM\Column]
    private ?int $idade = null;

    #[ORM\Column(length: 55, nullable: true)]
    private ?string $escolaridade = null;

    #[ORM\Column]
    private ?int $cpf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeAluno(): ?string
    {
        return $this->nome_aluno;
    }

    public function setNomeAluno(string $nome_aluno): static
    {
        $this->nome_aluno = $nome_aluno;

        return $this;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(int $idade): static
    {
        $this->idade = $idade;

        return $this;
    }

    public function getEscolaridade(): ?string
    {
        return $this->escolaridade;
    }

    public function setEscolaridade(?string $escolaridade): static
    {
        $this->escolaridade = $escolaridade;

        return $this;
    }

    public function getCpf(): ?int
    {
        return $this->cpf;
    }

    public function setCpf(int $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }
}
