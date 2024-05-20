<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class DoctorSearchType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
    ->add('doctor_name', TextType::class, [
      'label' => 'Doctor Name',
      'required' => true,
    ]);
  }
}