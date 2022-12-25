<?php

namespace App\Form;

use App\Entity\CategoryExperience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'          => 'Title of category',
                'label_attr'     => ['class' => 'category-form-label'],
                'attr'           => ['class' => 'category-form-input', 'placeholder' => 'Management, Sales, UX Design ..'],
                'row_attr'       => ['class' => 'category-form-row']
            ])
            ->add('save', SubmitType::class, [
                'label'         => 'Save',
                'attr'          => ['class' => 'btn-submit-category-exp-form btn btn-success'],
                'row_attr'      => ['class' => 'category-form-row category-form-row-submit-btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategoryExperience::class,
        ]);
    }
}
