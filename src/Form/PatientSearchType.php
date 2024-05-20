<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientSearchType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('search_type', ChoiceType::class, [
          'choices' => [
              'Name' => 'name',
              'Email' => 'email',
          ],
          'placeholder' => 'Select a search type',
          'required' => true,
      ])
      ->add('search_value', TextType::class, [
          'required' => true,
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
        'csrf_protection' => true,
    ]);
  }
}
