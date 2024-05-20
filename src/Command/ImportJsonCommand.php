<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Patient;
use App\Entity\Doctor;
use App\Entity\Appointment;

class ImportJsonCommand extends Command
{
    private $entityManager;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    protected function configure()
    {
        $this->setName('app:import-json')
            ->setDescription('Import JSON data into the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->importJsonData('data/Patient.json', Patient::class, $output);
        $this->importJsonData('data/Doctor.json', Doctor::class, $output);
        $this->importAppointments('data/Appointment.json', $output);

        $output->writeln('All JSON data imported successfully.');

        return Command::SUCCESS;
    }
}