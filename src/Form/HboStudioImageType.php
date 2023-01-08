<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HboStudioImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('HboStudioImage', FileType::class, [
                'multiple'      => true,
                'mapped'        => false,
                'required'      => true,
                'label'         => ' ',
                'label_attr'    => ['class' => 'hbo-studio-form-label'],
                'attr'          => ['class' => 'hbo-studio-form-input'],
                'row_attr'      => ['class' => 'hbo-studio-form-row'],
            ])
            ->add('save', SubmitType::class, [
                'label'         => 'Save',
                'attr'          => ['class' => 'btn-submit-hbo-studio-form btn btn-success'],
                'row_attr'      => ['class' => 'hbo-studio-form-row hbo-studio-row-submit-btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
