<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\Promotion;
use App\Entity\Year;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PromotionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degree', EntityType::class, ['label'=>'Formation associée' ,
                'class'=> Degree::class , 'choice_label'=> 'name',
                'constraints'=>[
                new NotBlank(['message'=>"le nom de la formation n'est pas valide"])
            ] ])
            ->add('year', EntityType::class, ['label'=>'Année associée' ,
                'class'=> Year::class , 'choice_label'=> 'title',
                'constraints'=>[
                new NotBlank(['message'=>"l'année de la formation n'est pas valide"])
            ] ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}