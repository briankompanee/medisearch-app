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

    #[Route('/doctor/availability', name: 'doctor_availability')]
    public function checkAvailability(Request $request): Response
    {
        $doctorSearchForm = $this->createForm(DoctorSearchType::class);
        $doctorSearchForm->handleRequest($request);

        $availability = [];
        $doctor = null;

        if ($doctorSearchForm->isSubmitted() && $doctorSearchForm->isValid()) {
            $doctorName = $doctorSearchForm->get('doctor_name')->getData();
            $doctor = $this->entityManager->getRepository(Doctor::class)->findOneBy(['name' => $doctorName]);

            if ($doctor) {
                $availability = $this->mockarooService->getDoctorAvailability($doctor->getId());

                if (empty($availability)) {
                    $this->addFlash('info', 'No available time slots for this doctor.');
                } else {
                    // Ensure the data is in the correct format
                    if (isset($availability['start_time'])) {
                        $availability = [$availability]; // Convert single entry to array
                    } elseif (is_array($availability) && !isset($availability[0]['start_time'])) {
                        $availability = array_map(function ($slot) {
                            return [
                                'date' => $slot['date'],
                                'start_time' => $slot['start_time'],
                                'end_time' => $slot['end_time']
                            ];
                        }, [$availability]);
                    } else {
                        $availability = array_map(function ($slot) {
                            return [
                                'date' => $slot['date'],
                                'start_time' => $slot['start_time'],
                                'end_time' => $slot['end_time']
                            ];
                        }, $availability);
                    }
                }
            } else {
                $this->addFlash('error', 'Doctor not found.');
            }
        }

        return $this->render('doctor_availability/index.html.twig', [
            'doctorSearchForm' => $doctorSearchForm->createView(),
            'availability' => $availability,
        ]);
    }
}
