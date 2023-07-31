<?php

namespace App\Form;

use App\Entity\User;
use PhpParser\Node\Expr\New_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        
        ->add('firstName')
        ->add('lastName')
        ->add('imageFile', FileType::class,
        [
            'label' => 'image (png,jpeg,wbp,gif)',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpeg',
                        'image/webp',
                        'image/gif',
                    ],
                    'mimeTypesMessage' => 'le fichier n\'est pas au bon format (png, jpeg, webp, gif)',
                    'maxSizeMessage' => 'Le fichier est trop lourd (max: 5M)',
                ])                
            ]
        ])
            ->add('email')
            ->add('password')
            //->add('roles')
            ->add('endDate')
            ->add('sector', ChoiceType::class,
            [
                'label' => 'Activity area',
                'choices' => [
                                'HR' => 'HR',
                                'Computer science' => 'Computer science',
                                'Accounting' => 'Accounting',
                                'Direction' => 'Direction',
                            ]

            ])
            ->add('contractType', ChoiceType::class,
            [
                'label' => 'Type of contract',
                'choices' => [
                                'CDI' => 'CDI',
                                'CDD' => 'CDD',
                                'Interim' => 'Interim',
                            ]

            ])
        ;
    }  

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
