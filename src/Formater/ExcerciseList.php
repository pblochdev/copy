<?php

namespace App\Formater;

class ExcerciseList extends FormaterAbstract
{
	public function format($data)
	{
		foreach ($data as &$item) {
			$item['remove_url'] = $this->getUrl('excercise_remove', $item['id'], 'excerciseId');
		}

		return $data;
	}
}