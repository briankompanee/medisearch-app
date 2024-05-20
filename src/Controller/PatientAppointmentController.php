<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Patient;
use App\Form\PatientSearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

class PatientAppointmentController extends AbstractController
{
  private EntityManagerInterface $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  #[Route('/patient/appointment', name: 'patient_appointments')]
  public function search(Request $request): Response
  {
    $form = $this->createForm(PatientSearchType::class);
    $form->handleRequest($request);

    $appointments = [];
    $message = '';

    if ($form->isSubmitted() && $form->isValid()) {
      $data = $form->getData();
      $searchType = $data['search_type'];
      $searchValue = $data['search_value'];

      // Input validation
      $validator = Validation::createValidator();
      $violations = $validator->validate($searchValue, [
        new NotBlank(),
        new Length(['max' => 255]),
        new Regex([
          'pattern' => '/^[a-zA-Z0-9@. ]+$/',
          'message' => 'Invalid characters in search value.'
        ]),
      ]);

      if (count($violations) > 0) {
        foreach ($violations as $violation) {
          $this->addFlash('error', $violation->getMessage());
        }
      } else {
        $patientRepository = $this->entityManager->getRepository(Patient::class);

        $patient = null;
        if ($searchType && $searchValue) {
          $patient = $patientRepository->findOneBy([$searchType => $searchValue]);
        }

        if ($patient) {
          $appointments = $this->entityManager->getRepository(Appointment::class)
            ->findBy(['patient' => $patient]);
        }

        if (empty($appointments)) {
          $message = 'No appointments found for the given search criteria.';
        }
      }
    }

    return $this->render('patient_appointment/index.html.twig', [
      'form' => $form->createView(),
      'appointments' => $appointments,
      'message' => $message,
    ]); 
  }
}
