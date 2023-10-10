<?php
class PortfolioTitle {
	private $id;
	private $title;

	public function __construct (array $PortfolioTitleData) {
		$this->id = $PortfolioTitleData['id'] ?? null;
		$this->title = $PortfolioTitleData['title']  ?? null;
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