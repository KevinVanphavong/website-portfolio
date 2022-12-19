<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'          => 'Firstname',
                'label_attr'     => ['class' => 'profile-form-label'],
                'attr'           => ['class' => 'profile-form-input', 'placeholder' => 'John'],
                'row_attr'       => ['class' => 'profile-form-row profile-form-row-firstname']
            ])
            ->add('lastname', TextType::class, [
                'label'          => 'Lastname',
                'label_attr'     => ['class' => 'profile-form-label'],
                'attr'           => ['class' => 'profile-form-input', 'placeholder' => 'Doe'],
                'row_attr'       => ['class' => 'profile-form-row profile-form-row-lastname']
            ])
            ->add('birthdate', BirthdayType::class, [
                'label'         => 'Birthdate',
                'label_attr'    => ['class' => 'profile-form-label'],
                'attr'          => ['class' =>'profile-form-input'],
                'row_attr'      => ['class' => 'profile-form-row profile-form-row-birthdate'],
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ],
            ])
            ->add('sex', ChoiceType::class, [
                'label'         => 'Sex',
                'label_attr'    => ['class' => 'profile-form-label'],
                'attr'          => ['class' =>'profile-form-input'],
                'row_attr'      => ['class' => 'profile-form-row profile-form-row-sex'],
                'choices'  => [
                    'female' => 'Female',
                    'male' => 'Male',
                ],
            ])
            ->add('currentPosition', TextType::class, [
                'label'          => 'Current position',
                'label_attr'     => ['class' => 'profile-form-label'],
                'attr'           => ['class' => 'profile-form-input'],
                'row_attr'       => ['class' => 'profile-form-row profile-form-row-curren-position']
            ])
            ->add('quickDescription', TextareaType::class, [
                'label'         => 'Quick description',
                'label_attr'    => ['class' => 'profile-form-label'],
                'attr'          => ['class' => 'profile-form-input', 'placeholder' => "Few words on what's going on for you on theses days"],
                'row_attr'      => ['class' => 'profile-form-row profile-form-row-description']
            ])
            ->add('profilePicture', FileType::class, [
                'multiple'      => false,
                'mapped'        => false,
                'required'      => false,
                'label'         => 'Add profile picture',
                'label_attr'    => ['class' => 'profile-form-label'],
                'attr'          => ['class' => 'profile-form-input'],
                'row_attr'      => ['class' => 'profile-form-row profile-form-row-profile-picture'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
