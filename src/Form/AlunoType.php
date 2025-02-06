<?php

namespace App\Form;

use App\Entity\Aluno;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class AlunoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome_aluno')
            ->add('idade')
            ->add('escolaridade')
            ->add('cpf', TextType::class, [
                'constraints' => [
                new Assert\NotBlank([
                    'message' => 'O CPF não pode estar vazio.'
                ]),
                new Assert\Length([
                    'min' => 11,
                    'max' => 11,
                    'exactMessage' => 'O CPF deve ter exatamente 11 dígitos.'
                ]),
                new Assert\Regex([
                    'pattern' => '/^\d+$/',
                    'message' => 'O CPF deve conter apenas números.'
                ])
            ],               
                    
                
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aluno::class,
        ]);
    }
}
