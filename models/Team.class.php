<?php
class Team {
	private $id;
	private $name;
	private $title;
	private $bio;
	private $picture_path;
	private $alt;
	private $order_number;

	public function __construct(array $TeamData) {
		$this->id = $TeamData['id'] ?? null;
		$this->name = $TeamData['name'];
		$this->title = $TeamData['title'];
		$this->bio = $TeamData['bio'];
		$this->picture_path = $TeamData['picture_path'];
		$this->alt = $TeamData['alt'];
		$this->order_number = $TeamData['order_number'];

	}

 // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getBio() {
        return $this->bio;
    }

    public function getPicturePath() {
        return $this->picture_path;
    }

    public function getAlt() {
        return $this->alt;
    }

    public function getOrderNumber() {
        return $this->order_number;
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    public function setPicturePath($picture_path) {
        $this->picture_path = $picture_path;
    }

    public function setAlt($alt) {
        $this->alt = $alt;
    }

    public function setOrderNumber($order_number) {
        $this->order_number = $order_number;
    }


}
?>