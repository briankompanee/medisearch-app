<?php

namespace App\Controller;

use App\Service\MockarooService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DoctorAvailabilityController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private MockarooService $mockarooService;

    public function __construct(EntityManagerInterface $entityManager, MockarooService $mockarooService)
    {
        $this->entityManager = $entityManager;
        $this->mockarooService = $mockarooService;
    }

    #[Route('/doctor/availability', name: 'app_doctor_availability')]
    public function index(): Response
    {
        return $this->render('doctor_availability/index.html.twig', [
            'controller_name' => 'DoctorAvailabilityController',
        ]);
    }
}
