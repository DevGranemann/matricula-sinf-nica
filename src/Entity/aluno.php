<?php

namespace App\Entity;

use App\Repository\AlunoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AlunoRepository::class)]
class Aluno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 55)]
    #[Assert\Length(
        min: 3,
        max: 55,
        exactMessage: ''

    )]
    private ?string $nome_aluno = null;

    #[ORM\Column(type:'string', length: 3)]
    #[Assert\Length(
        min:1,
        max: 3,
        exactMessage: ''


    )]
    private ?int $idade = null;

    #[ORM\Column(type: 'string', length: 55, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 15,
        exactMessage: ''
    )]
    private ?string $escolaridade = null;

    #[ORM\Column(type: 'integer', length: 11, unique: true)]
    #[Assert\NotBlank(message: '')]
    #[Assert\Length(
        min: 11,
        max: 11,
        exactMessage: ''

    )]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: "Insira apenas números no CPF"
    )]
    private ?int $cpf = null;

    /**
     * @var Collection<int, Matricula>
     */
    #[ORM\OneToMany(mappedBy: "aluno", targetEntity: Matricula::class, cascade: ["remove"])]
    private Collection $matriculas;

    public function __construct()
    {
        $this->matriculas = new ArrayCollection();
    }

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
            $matricula->setAluno($this);
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
