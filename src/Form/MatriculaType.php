<?php

namespace App\Form;

use App\Entity\Aluno;
use App\Entity\Curso;
use App\Entity\Matricula;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatriculaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero_matricula')
            ->add('data_matricula', null, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('aluno', EntityType::class, [
                'class' => Aluno::class,
                'choice_label' => 'nome_aluno',
            ])
            ->add('curso', EntityType::class, [
                'class' => Curso::class,
                'choice_label' => 'nome_curso',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matricula::class,
        ]);
    }
}
