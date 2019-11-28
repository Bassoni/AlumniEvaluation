<?php

namespace App\Form;

use App\Entity\Promotion;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname' ,TextType::class, ['label'=>'Remplissez le label' , 'constraints'=>[ new NotBlank(['message'=>"Veuillez entrez votre Prénom"]) ] ])
            ->add('lastname',TextType::class, ['label'=>'Remplissez le label' , 'constraints'=>[ new NotBlank(['message'=>"Veuillez entrez votre Nom"]) ] ])
            ->add('email',TextType::class, ['label'=>'Remplissez le label' , 'constraints'=>[ new NotBlank(['message'=>"Veuillez entrez votre Email"]) ] ])
            ->add('password',TextType::class, ['label'=>'Remplissez le label' , 'constraints'=>[ new NotBlank(['message'=>"Votre Mdp doit comporter au moins une lettre"]) ] ])
            ->add('city',TextType::class, ['label'=>'Remplissez le label' ])
            ->add('birthdate',DateType::class, ['label'=>'Remplissez le label' ])
            ->add('promotions',EntityType::class, ['label'=>'Remplissez le label' ,'class'=> Promotion::class ,
                'choice_label'=> function ($promotion){
                    return $promotion->getLabel();
            } ])
            ->add('avatar',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
