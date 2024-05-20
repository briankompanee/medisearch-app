<?php

namespace App\Tests\Form;

use App\Form\PatientSearchType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientSearchTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'search_type' => 'name',
            'search_value' => 'John Doe',
        ];

        // Create a new form instance
        $form = $this->factory->create(PatientSearchType::class);

        // Submit the data to the form
        $form->submit($formData);

        // Check if the form is synchronized, meaning it successfully handled the input data
        $this->assertTrue($form->isSynchronized());

        // Retrieve the data object from the form
        $data = $form->getData();

        // Assert the form fields values
        $this->assertEquals('name', $data['search_type']);
        $this->assertEquals('John Doe', $data['search_value']);

        // Check if the form view has the correct data
        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function testFormFields()
    {
        $form = $this->factory->create(PatientSearchType::class);

        $view = $form->createView();
        $children = $view->children;

        $this->assertArrayHasKey('search_type', $children);
        $this->assertArrayHasKey('search_value', $children);

        $this->assertEquals('Select a search type', $children['search_type']->vars['placeholder']);
    }

    public function testConfigureOptions()
    {
        $resolver = new OptionsResolver();
        $formType = new PatientSearchType();
        $formType->configureOptions($resolver);

        $options = $resolver->resolve();

        $this->assertTrue($options['csrf_protection']);
    }
}
