<?php
class Services {
	private $id;
	private $icon;
	private $title;
	private $description;
	private $button_text;
	private $order_number;

	public function __construct(array $ServicesData) {
		$this->id = $ServicesData['id'] ?? null;
		$this->icon = $ServicesData['icon'] ?? null;
		$this->title = $ServicesData['title'] ?? null;
		$this->description = $ServicesData['description'] ?? null;
		$this->button_text = $ServicesData['button_text'] ?? null;
		$this->order_number = $ServicesData['order_number'] ?? null;
	}

	// Getters
	public function getId() {
		return $this->id;
	}

	public function getIcon() {
		return $this->icon;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getButtonText() {
		return $this->button_text;
	}

	public function getOrderNumber() {
		return $this->order_number;
	}

	// Setters
	public function setId($id) {
		$this->id = $id;
	}

	public function setIcon($icon) {
		$this->icon = $icon;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setButtonText($button_text) {
		$this->button_text = $button_text;
	}

	public function setOrderNumber($order_number) {
		$this->order_number = $order_number;
	}
}
?>
