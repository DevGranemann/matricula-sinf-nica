<?php

namespace App\Entity;

use App\Repository\MatriculaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatriculaRepository::class)]
class Matricula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero_matricula = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data_matricula = null;

    #[ORM\ManyToOne(targetEntity: Aluno::class, inversedBy: 'matriculas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aluno $aluno = null;

    #[ORM\ManyToOne(targetEntity:Curso::class, inversedBy: 'matriculas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Curso $curso = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroMatricula(): ?int
    {
        return $this->numero_matricula;
    }

    public function setNumeroMatricula(int $numero_matricula): static
    {
        $this->numero_matricula = $numero_matricula;

        return $this;
    }

    public function getDataMatricula(): ?\DateTimeInterface
    {
        return $this->data_matricula;
    }

    public function setDataMatricula(\DateTimeInterface $data_matricula): static
    {
        $this->data_matricula = $data_matricula;

        return $this;
    }

    public function getAluno(): ?Aluno
    {
        return $this->aluno;
    }

    public function setAluno(?Aluno $aluno): static
    {
        $this->aluno = $aluno;

        return $this;
    }

    public function getCurso(): ?Curso
    {
        return $this->curso;
    }

    public function setCurso(?Curso $curso): static
    {
        $this->curso = $curso;

        return $this;
    }
}
