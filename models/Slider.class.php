<?php
class Slider {
	private $id;
	private $title;
	private $slide_path;
	private $alt;
	private $order_number;

	public function __construct(array $SliderData) {
		$this->id = $SliderData['id'] ?? null;
		$this->title = $SliderData['title'] ?? null;
		$this->slide_path = $SliderData['slide_path'] ?? null;
		$this->alt = $SliderData['alt'] ?? null;
		$this->order_number = $SliderData['order_number'] ?? null;
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getSlidePath() {
		return $this->slide_path;
	}

	public function getAlt() {
		return $this->alt;
	}

	public function getOrderNumber() {
		return $this->order_number;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setSlidePath($slide_path) {
		$this->slide_path = $slide_path;
	}

	public function setAlt($alt) {
		$this->alt = $alt;
	}

	public function setOrderNumber($order_number) {
		$this->order_number = $order_number;
	}
}
?>
