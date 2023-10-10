<?php
class ServicesTitle {
	private $id;
	private $title;

	public function __construct (array $ServicesTitleData) {
		$this->id = $ServicesTitleData['id'] ?? null;
		$this->title = $ServicesTitleData['title']  ?? null;
	}

	// Getter and setters
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
	}


}
?>