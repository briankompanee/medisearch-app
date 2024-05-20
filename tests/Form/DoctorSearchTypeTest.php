<?php

namespace App\Tests\Form;

use App\Form\DoctorSearchType;
use Symfony\Component\Form\Test\TypeTestCase;

class DoctorSearchTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'doctor_name' => 'Dr. John Doe',
        ];

        // Create a new form instance
        $form = $this->factory->create(DoctorSearchType::class);

        // Submit the data to the form
        $form->submit($formData);

        // Check if the form is synchronized, meaning it successfully handled the input data
        $this->assertTrue($form->isSynchronized());

        // Retrieve the data object from the form
        $data = $form->getData();

        // Assert the form fields values
        $this->assertEquals('Dr. John Doe', $data['doctor_name']);

        // Check if the form view has the correct data
        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function testFormFields()
    {
        $form = $this->factory->create(DoctorSearchType::class);

        $view = $form->createView();
        $children = $view->children;

        $this->assertArrayHasKey('doctor_name', $children);
        $this->assertEquals('Doctor Name', $children['doctor_name']->vars['label']);
    }
}
