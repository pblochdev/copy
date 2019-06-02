<?php

namespace App\Formater;

class Calendar
{
	public function getEvents($data)
	{
		$events = [];
		foreach ($data as &$item) {
			$events[] = [
				'id' => $item['id'],
				'start' => $item['date'],
				'title' => 'Siłownia'
			];
		}

		return $events;
	}
}