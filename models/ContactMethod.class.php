<?php
class ContactMethod {
	private $id;
	private $icon;
	private $title;
	private $line1;
	private $line2;
	private $order_number;

	public function __construct($ContactMethodData){
		$this->id = $ContactMethodData['id'] ??  null;
		$this->icon = $ContactMethodData['icon'];
		$this->title = $ContactMethodData['title'];
		$this->line1 = $ContactMethodData['line1'];
		$this->line2 = $ContactMethodData['line2'];
		$this->order_number = $ContactMethodData['order_number'];
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

	public function getLine1() {
		return $this->line1;
	}

	public function getLine2() {
		return $this->line2;
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

	public function setLine1($line1) {
		$this->line1 = $line1;
	}

	public function setLine2($line2) {
		$this->line2 = $line2;
	}

	public function setOrderNumber($order_number) {
		$this->order_number = $order_number;
	}
}
?>
