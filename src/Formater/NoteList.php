<?php

namespace App\Formater;

class NoteList extends FormaterAbstract {

	public function format($data) {
		foreach ($data as &$item) {
			$item['remove_url'] = $this->getUrl('note_remove', $item['id'], 'noteId');
			$item['done_url'] = $this->getUrl('note_done', $item['id'], 'noteId');
		}

		return $data;
	}

}