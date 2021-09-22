<?php

namespace App\Form;

use App\Entity\Measure;
use App\Entity\ArticleBoucherie;
use App\Entity\CategorieBoucherie;
use App\Entity\TauxTva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleBoucherieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prixUnitaire')
            // ->add('Promotion')

            ->add('promotion', CheckboxType::class,[
                'label' => 'promotion',
                // 'choices' => ["true" => 'Oui', false => 'Non'],
                // 'expanded' => true,
                // 'multiple' => false,
                'required' => false
                ])

            ->add('prixPromotion')
            ->add('image' 
            ,TextType::class, [
                'required' => false,
                'label' => "Nom de l'image"
            //     ,[
            //         'mapped' => false
            //     // 'attr' => [
            //     //     'placeholder' => "écrivez le titre de votre image"
            //     // ]
            // ]
          ])
            ->add('path', FileType::class, [
                'mapped' => false,
                'required' => false,
                'multiple' => false,
                'label' => "uploader votre image",
                'attr' => [
                    'placeholder' => "parcourir pour trouver l'image",
                    'id'          =>  "file"
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048K',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            'image/gif'
                        ]
                    ])
                ]
            ])            
            ->add('unit', EntityType::class, [
                'label' => 'Unité :',
                // 'mapped' => false,
                'required' => true,
                'placeholder' => '-- Choisissez Unité --',
                'class' => Measure::class,
                'choice_label' => 'nom',
            ])
            
        ->add('categorie', EntityType::class, [
            'label' => 'la catégorie :',
            // 'mapped' => false,
            'required' => true,
            'placeholder' => '-- Choisissez la catégorie --',
            'class' => CategorieBoucherie::class,
            'choice_label' => 'nom',
        ])
        ->add('TVA', EntityType::class, [
            'label' => 'Taux TVA :',
            // 'mapped' => false,
            'required' => true,
            'placeholder' => '-- Choisissez le taux TVA --',
            'class' => TauxTva::class,
            'choice_label' => 'taux',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleBoucherie::class,
        ]);
    }
}
