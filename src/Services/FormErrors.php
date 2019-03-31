<?php 

namespace App\Services;

class FormErrors
{
	public function getErrors($form)
	{
		$errors = [];
		foreach ($form as $child) {
			if (!$child->isValid()) {
				foreach ($child->getErrors() as $error) {
					$errors[$form->getConfig()->getName() . "[" . $child->getName() . "]"][] = $error->getMessage();
				}
			}
		}
		
		return $errors;
	}
}
