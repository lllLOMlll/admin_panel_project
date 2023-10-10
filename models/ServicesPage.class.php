<?php
class ServicesPage {
	private ?int $id;
	private string $title;
	private string $paragraph;

	public function __construct(array $ServicePageData) {
		$this->id = $ServicePageData['id'] ?? null; 
		$this->title = $ServicePageData['title'];
		$this->paragraph = $ServicePageData['paragraph'];
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
