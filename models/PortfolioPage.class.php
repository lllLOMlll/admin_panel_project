<?php
class PortfolioPage {
	private ?int $id;
	private string $title;
	private string $paragraph;

	public function __construct(array $PortfolioPageData) {
		$this->id = $PortfolioPageData['id'] ?? null; 
		$this->title = $PortfolioPageData['title'];
		$this->paragraph = $PortfolioPageData['paragraph'];
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