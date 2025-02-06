<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome_curso = null;

    #[ORM\Column]
    private ?int $carga_horaria = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descricao = null;

    #[ORM\Column(length: 255)]
    private ?string $area = null;

    /**
     * @var Collection<int, Matricula>
     */
    #[ORM\OneToMany(mappedBy: "curso", targetEntity: Matricula::class, cascade: ["remove"])]
    private Collection $matriculas;

    public function __construct()
    {
        $this->matriculas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeCurso(): ?string
    {
        return $this->nome_curso;
    }

    public function setNomeCurso(string $nome_curso): static
    {
        $this->nome_curso = $nome_curso;

        return $this;
    }

    public function getCargaHoraria(): ?int
    {
        return $this->carga_horaria;
    }

    public function setCargaHoraria(int $carga_horaria): static
    {
        $this->carga_horaria = $carga_horaria;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): static
    {
        $this->area = $area;

        return $this;
    }

     /**
     * @return Collection<int, Matricula>
     */
    public function getMatriculas(): Collection
    {
        return $this->matriculas;
    }

    public function addMatricula(Matricula $matricula): static
    {
        if (!$this->matriculas->contains($matricula)) {
            $this->matriculas->add($matricula);
            $matricula->setCurso($this);
        }

        return $this;
    }

    public function removeMatricula(Matricula $matricula): static
    {
        if ($this->matriculas->removeElement($matricula)) {
            // set the owning side to null (unless already changed)
            if ($matricula->getAluno() === $this) {
                $matricula->setAluno(null);
            }
        }

        return $this;
    }
}
