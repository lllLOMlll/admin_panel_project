<?php
class Portfolio {
	private $id;
	private $image_path;
	private $alt;
	private $description;
	private $order_number;

	public function __construct(array $PortfolioData) {
		$this->id = $PortfolioData['id'] ?? null;
		$this->image_path = $PortfolioData['image_path'];
		$this->alt = $PortfolioData['alt'];
		$this->description = $PortfolioData['description'];
		$this->order_number = $PortfolioData['order_number'];
	}

	// Getters
	public function getId() {
		return $this->id;
	}

	public function getImagePath() {
		return $this->image_path;
	}

	public function getAlt() {
		return $this->alt;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getOrderNumber() {
		return $this->order_number;
	}

	// Setters
	public function setImagePath($image_path) {
		$this->image_path = $image_path;
	}

	public function setAlt($alt) {
		$this->alt = $alt;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setOrderNumber($order_number) {
		$this->order_number = $order_number;
	}
}
?>
