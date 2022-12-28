<?php

namespace App\Form;

use App\Entity\MessageReceived;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageReceivedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sender', TextType::class, [
                'label'          => 'From',
                'label_attr'     => ['class' => 'message-received-form-label'],
                'attr'           => ['class' => 'message-received-form-input', 'placeholder' => 'John Cena'],
                'row_attr'       => ['class' => 'message-received-form-row']
            ])
            ->add('email', TextType::class, [
                'label'          => 'Email',
                'label_attr'     => ['class' => 'message-received-form-label'],
                'attr'           => ['class' => 'message-received-form-input', 'placeholder' => 'johdoe@gmail.com'],
                'row_attr'       => ['class' => 'message-received-form-row']
            ])
            ->add('phoneNumber', TelType::class, [
                'label'          => 'Phone number',
                'label_attr'     => ['class' => 'message-received-form-label'],
                'attr'           => ['class' => 'message-received-form-input', 'placeholder' => '0665667687'],
                'row_attr'       => ['class' => 'message-received-form-row']
            ])
            ->add('object', TextType::class, [
                'label'          => 'Ojbect',
                'label_attr'     => ['class' => 'message-received-form-label'],
                'attr'           => ['class' => 'message-received-form-input', 'placeholder' => 'Your object'],
                'row_attr'       => ['class' => 'message-received-form-row']
            ])
            ->add('content', TextareaType::class, [
                'label'          => 'Message',
                'label_attr'     => ['class' => 'message-received-form-label'],
                'attr'           => ['class' => 'message-received-form-input', 'placeholder' => 'What\'s up dude ?'],
                'row_attr'       => ['class' => 'message-received-form-row']
            ])
            ->add('save', SubmitType::class, [
                'label'         => 'Save',
                'attr'          => ['class' => 'btn-submit-message-form btn btn-success'],
                'row_attr'      => ['class' => 'message-received-form-row message-received-form-row-submit-btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MessageReceived::class,
        ]);
    }
}
