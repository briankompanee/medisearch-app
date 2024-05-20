<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PatientAppointmentController extends AbstractController
{
    #[Route('/patient/appointment', name: 'app_patient_appointment')]
    public function index(): Response
    {
        return $this->render('patient_appointment/index.html.twig', [
            'controller_name' => 'PatientAppointmentController',
        ]);
    }
}
