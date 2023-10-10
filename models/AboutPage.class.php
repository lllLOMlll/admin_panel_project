<?php
class AboutPage {
	private ?int $id;
	private string $title;
	private string $paragraph;

	public function __construct(array $AboutPageData) {
		$this->id = $AboutPageData['id'] ?? null; 
		$this->title = $AboutPageData['title'];
		$this->paragraph = $AboutPageData['paragraph'];
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getParagraph() {
		return $this->paragraph;
	}
}
?>
