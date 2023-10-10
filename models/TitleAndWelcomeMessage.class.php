<?php
class TitleAndWelcomeMessage {
	private $id;
	private $title;
	private $paragraph;

	public function __construct (array $TitleAndWelcomeMessageData) {
		$this->id = $TitleAndWelcomeMessageData['id'] ?? null;
		$this->title = $TitleAndWelcomeMessageData['title']  ?? null;
		$this->paragraph = $TitleAndWelcomeMessageData['paragraph'] ?? null;
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

	public function getParagraph() {
		return $this->paragraph;
	}
	public function setParagraph($paragraph) {
		$this->paragraph = $paragraph;
	}


}

?>