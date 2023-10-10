<?php
class SliderTitle {
	private $id;
	private $title;

	public function __construct (array $SliderTitleData) {
		$this->id = $SliderTitleData['id'] ?? null;
		$this->title = $SliderTitleData['title']  ?? null;
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