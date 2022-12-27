<?php

namespace App\Form;

use App\Entity\CategoryExperience;
use App\Entity\WorkExperience;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'          => 'Title of experience',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input', 'placeholder' => 'Chief Executive Officer'],
                'row_attr'       => ['class' => 'experience-form-row']
            ])
            ->add('company', TextType::class, [
                'label'          => 'Company - School',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input', 'placeholder' => 'TESLA'],
                'row_attr'       => ['class' => 'experience-form-row']
            ])
            ->add('position', TextType::class, [
                'label'          => 'Position',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input', 'placeholder' => 'CEO'],
                'row_attr'       => ['class' => 'experience-form-row']
            ])
            ->add('startDate', DateType::class, [
                'label'          => 'Since',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input'],
                'row_attr'       => ['class' => 'experience-form-row'],
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day'
                    ],
                'years' => range(date('Y') - 50, date('Y') + 50),
             ])

            ->add('endDate', DateType::class, [
                'label'          => 'To',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input'],
                'row_attr'       => ['class' => 'experience-form-row'],
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day'
                ],
                'years' => range(date('Y') - 50, date('Y') + 50),
            ])
            ->add('country', TextType::class, [
                'label'          => 'Country',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input', 'placeholder' => 'FRANCE'],
                'row_attr'       => ['class' => 'experience-form-row']
            ])
            ->add('city', TextType::class, [
                'label'          => 'City',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input', 'placeholder' => 'Lyon'],
                'row_attr'       => ['class' => 'experience-form-row']
            ])
            ->add('description', TextareaType::class, [
                'label'          => 'Job description',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input', 'placeholder' => 'Tell us what you did in this experience ..'],
                'row_attr'       => ['class' => 'experience-form-row']
            ])
            ->add('categoryExperience', EntityType::class, [
                'class'         => CategoryExperience::class,
                'choice_label'  => 'title',
                'choice_value'  => 'id',
                'label'          => 'Category of experience',
                'label_attr'     => ['class' => 'experience-form-label'],
                'attr'           => ['class' => 'experience-form-input'],
                'row_attr'       => ['class' => 'experience-form-row']
            ])
            ->add('image', FileType::class, [
                'multiple'      => false,
                'mapped'        => false,
                'required'      => false,
                'label'         => 'Add company image',
                'label_attr'    => ['class' => 'experience-form-label'],
                'attr'          => ['class' => 'experience-form-input'],
                'row_attr'      => ['class' => 'experience-form-row experience-form-row-experience-image'],
            ])
            ->add('save', SubmitType::class, [
                'label'         => 'Save',
                'attr'          => ['class' => 'btn-submit-work-exp-form btn btn-success'],
                'row_attr'      => ['class' => 'experience-form-row experience-form-row-submit-btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkExperience::class,
        ]);
    }
}
