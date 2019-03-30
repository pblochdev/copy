<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Workout as WorkoutEntity;
use Symfony\Component\Security\Core\Security;


class Workout
{
	protected $workout;
	protected $entityManager;
	protected $repository;
	protected $security;

	public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
		$this->entityManager = $entityManager;
		$this->repository = $entityManager->getRepository(WorkoutEntity::class);
		$this->security = $security;
    }


	public function getWorkout()
	{
		if (empty($this->workout)) {
			$this->workout = $this->repository->getTodayWorkouts();
		}
		
		return $this->workout;
	}


	public function checkCanAdd()
	{
		return empty($this->getWorkout());
	}
}