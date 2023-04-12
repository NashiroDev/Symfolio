<?php

namespace App\Form;

use App\Entity\Content;
use App\Entity\RowTheme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Controller\Backend\DelimitedStringToArrayTransformer;

class ContentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'required' => true,
                'attr' => [
                    'maxLength' => 255,
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('files', TextType::class, [
                'label' => 'Fichiers :',
                'required' => false,
            ])
            ->add('rowTheme', EntityType::class, [
                'label' => 'Theme :',
                'required' => true,
                'class' => RowTheme::class,
                'choice_label' => 'theme',
            ])
            ->get('files')
                ->addModelTransformer(new DelimitedStringToArrayTransformer(';'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}