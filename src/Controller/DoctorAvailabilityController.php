<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DoctorAvailabilityController extends AbstractController
{
    #[Route('/doctor/availability', name: 'app_doctor_availability')]
    public function index(): Response
    {
        return $this->render('doctor_availability/index.html.twig', [
            'controller_name' => 'DoctorAvailabilityController',
        ]);
    }
}
