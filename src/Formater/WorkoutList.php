<?php

namespace App\Formater;

class WorkoutList extends FormaterAbstract
{
	public function format($data)
	{
		foreach ($data as &$item) {
			$item['remove_url'] = $this->getUrl('workout_remove', $item['id'], 'workoutId');
			$item['details_url'] =  $this->getUrl('workout_details', $item['id'], 'workoutId');
		}

		return $data;
	}
}