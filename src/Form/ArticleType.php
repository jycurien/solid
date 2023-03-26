<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'w-full p-2 text-gray-900',
                ],
            ])
            ->add('slug', TextType::class, [
                'attr' => [
                    'class' => 'w-full p-2 text-gray-900',
                ],
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'rows' => '8',
                    'class' => 'w-full p-2 text-gray-900',
                ],
            ])
            ->add('image', TextType::class, [
                'attr' => [
                    'class' => 'w-full p-2 text-gray-900',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
