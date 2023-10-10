<?php
class ContactUsTitleParagraph {
	private $id;
	private $title;
	private $paragraph;

	public function __construct(array $ContactUsData) {
		$this->id = $ContactUsData['id'] ?? null; // Use null coalescing to set default value
		$this->title = $ContactUsData['title'];
		$this->paragraph = $ContactUsData['paragraph'];
	}

	// Getters
	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getParagraph() {
		return $this->paragraph;
	}

	// Setters
	public function setId($id) {
		$this->id = $id;
	}

	public function setTitle($title) {
		$this->title = $title;  // Added missing semicolon here
	}

	public function setParagraph($paragraph) {
		$this->paragraph = $paragraph;
	}
}
?>
