<?php
class User {
	private $id;
	private $first_name;
	private $last_name;
	private $username;
	private $email;
	private $password;
	private $avatar;
	private $access_level;
	private $status;
	private $reactivationRandomNumber;


	public function __construct(array $userData) {
		$this->id = $userData['id'] ?? null;
		$this->first_name = $userData['first_name'];
		$this->last_name = $userData['last_name'];
		$this->username = $userData['username'];
		$this->email = $userData['email'];
		$this->password = $userData['password'];
		$this->avatar = $userData['avatar'];
		$this->access_level = $userData['access_level'] ?? null;
		$this->status = $userData['status'] ?? null;
		$this->reactivationRandomNumber = $userData['reactivationRandomNumber'] ?? null;
	}

	// GETTERS AND SETTERS
	public function getId() { 
		return $this->id; 
	}
	public function setId($id) { 
		$this->id = $id;
	}

	public function getFirstName() { 
		return $this->first_name; 
	}
	public function setFirstName($first_name) { 
		$this->first_name = $first_name; 
	}

	public function getLastName() { 
		return $this->last_name; 
	}
	public function setLastName($last_name) { 
		$this->last_name = $last_name; 
	}
	
	public function getUsername() { 
		return $this->username; 
	}
	public function setUsername($username) { 
		$this->username = $username; 
	}

	public function getEmail() { 
		return $this->email; 
	}
	public function setEmail($email) { 
		$this->email = $email; 
	}
	
	public function getPassword() { 
		return $this->password; 
	}
	public function setPassword($password) { 
		$this->password = $password; 
	}
	
	public function getAvatar() { 
		return $this->avatar; 
	}
	public function setAvatar($avatar) { 
		$this->avatar = $avatar; 
	}
	
	public function getAccessLevel() {
		return $this->access_level;
	}
	public function setAccessLevel($access_level) { 
		$this->access_level = $access_level; 
	}
	
	public function getStatus() { 
		return $this->status; 
	}
	public function setStatus($status) { 
		$this->status = $status; 
	}
	
	public function getReactivationRandomNumber() { 
		return $this->reactivationRandomNumber; 
	}
	public function setReactivationRandomNumber($reactivationRandomNumber) { 
		$this->reactivationRandomNumber = $reactivationRandomNumber; 
	}
		
	}

?>