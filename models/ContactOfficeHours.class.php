<?php
class ContactOfficeHours {
	private $id;
	private $monday;
	private $tuesday;
	private $wednesday;
	private $thursday;
	private $friday;
	private $saturday;
	private $sunday;

	public function __construct($ContactOfficeHoursData) {
		$this->id = $ContactOfficeHoursData['id'] ?? null;
		$this->monday = $ContactOfficeHoursData['monday'] ?? null;
		$this->tuesday = $ContactOfficeHoursData['tuesday'] ?? null;
		$this->wednesday = $ContactOfficeHoursData['wednesday'] ?? null;
		$this->thursday = $ContactOfficeHoursData['thursday'] ?? null;
		$this->friday = $ContactOfficeHoursData['friday'] ?? null;
		$this->saturday = $ContactOfficeHoursData['saturday'] ?? null;
		$this->sunday = $ContactOfficeHoursData['sunday'] ?? null;
	}

	// Getters
	public function getId() {
		return $this->id;
	}

	public function getMonday() {
		return $this->monday;
	}

	public function getTuesday() {
		return $this->tuesday;
	}

	public function getWednesday() {
		return $this->wednesday;
	}

	public function getThursday() {
		return $this->thursday;
	}

	public function getFriday() {
		return $this->friday;
	}

	public function getSaturday() {
		return $this->saturday;
	}

	public function getSunday() {
		return $this->sunday;
	}

	// Setters
	public function setId($id) {
		$this->id = $id;
	}

	public function setMonday($monday) {
		$this->monday = $monday;
	}

	public function setTuesday($tuesday) {
		$this->tuesday = $tuesday;
	}

	public function setWednesday($wednesday) {
		$this->wednesday = $wednesday;
	}

	public function setThursday($thursday) {
		$this->thursday = $thursday;
	}

	public function setFriday($friday) {
		$this->friday = $friday;
	}

	public function setSaturday($saturday) {
		$this->saturday = $saturday;
	}

	public function setSunday($sunday) {
		$this->sunday = $sunday;
	}
}
?>
