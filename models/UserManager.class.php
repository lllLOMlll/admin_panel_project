<?php
class UserManager extends DbConnector {
	
	public function addUser(User $user) {
		try {
			$query = $this->db->prepare(
				"INSERT INTO users (first_name, last_name, username, email, password, avatar)
				VALUES (?, ?, ?, ?, ?, ?)"
			);

			return $query->execute([
				$user->getFirstName(),
				$user->getLastName(),
				$user->getUsername(),
				$user->getEmail(),
				password_hash($user->getPassword(), PASSWORD_DEFAULT),
				$user->getAvatar()
			]);
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function getAllUsers() {
		try {
			$query = $this->db->prepare("SELECT * FROM users ORDER BY last_name");
			$query->execute();
			$usersData = $query->fetchAll(PDO::FETCH_ASSOC);
			$users = [];

			foreach ($usersData as $userData) {
				$users[] = new User($userData);
			}
			return $users;
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function getUserByUsername(string $username) {
		$query = $this->db->prepare("SELECT * FROM users WHERE username = ?");
		$query->execute([$username]);
		$user = $query->fetch(PDO::FETCH_ASSOC);
		if ($user) {
			return new User($user);
		} else {
			return null;
		}
	}

	public function verifyExistence(string $column, string $value) {
		$query = $this->db->prepare("SELECT * FROM users WHERE $column = ?");
		$query->execute([$value]);
		return $query->fetchColumn() > 0;
	}

	public function isUsernameExists(string $username) {
		return $this->verifyExistence('username', $username);
	}
	
	public function isEmailExists(string $email) {
		return $this->verifyExistence('email', $email);
	}

	public function isUsernameAndPasswordMatch($username, $password) {
        // Prepare the SQL statement
		$query = $this->db->prepare("SELECT password FROM users WHERE username = :username");
		$query->bindParam(':username', $username, PDO::PARAM_STR);
        // Execute the SQL statement
		$query->execute();
        // Fetch the user's stored password
		$user = $query->fetch(PDO::FETCH_ASSOC);
		if ($user) {
			$hashedPassword = $user['password'];
            // Verify the provided password against the hashed password
			if (password_verify($password, $hashedPassword)) {
				return true;
			}
		}
		return false;
	}

	public function updateUserProfile($username, $newUsername, $newFirstName, $newLastName, $newEmail, $newAvatarPath) {
		try {
			$query = $this->db->prepare(
				"UPDATE users SET username = ?, first_name = ?, last_name = ?, email = ?, avatar = ? WHERE username = ?"
			);
			return $query->execute([
				$newUsername,
				$newFirstName,
				$newLastName,
				$newEmail,
				$newAvatarPath,
				$username
			]);
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function changePassword(string $username, string $newPassword) {
		try {
        // Hash the new password
			$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
			
        // Prepare the SQL statement
			$query = $this->db->prepare("UPDATE users SET password = ? WHERE username = ?");
			
        // Execute the query
			return $query->execute([$hashedPassword, $username]);
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}


	public function banUser(string $username) {
		try {
			$query = $this->db->prepare("UPDATE users SET status = 0 WHERE username = ?");
			$query->execute([$username]);
        return $query->rowCount() > 0; // Returns true if the update was successful, false otherwise
    } catch (PDOException $e) {
    	die('Database Error: ' . $e->getMessage());
    }
}

public function unbanUser(string $username) {
	try {
		$query = $this->db->prepare("UPDATE users SET status = 1 WHERE username = ?");
		$query->execute([$username]);
		        return $query->rowCount() > 0; // Returns true if the update was successful, false otherwise
		    } catch (PDOException $e) {
		    	die('Database Error: ' . $e->getMessage());
		    }
		}

		public function removeAdminPrivileges(string $username) {
			try {
				$query = $this->db->prepare("UPDATE users SET access_level = 0 WHERE username = ?");
				$query->execute([$username]);
		        return $query->rowCount() > 0; // Returns true if the update was successful, false otherwise
		    } catch (PDOException $e) {
		    	die('Database Error: ' . $e->getMessage());
		    }
		}

		public function giveAdminPrivileges(string $username) {
			try {
				$query = $this->db->prepare("UPDATE users SET access_level = 1 WHERE username = ?");
				$query->execute([$username]);
	        return $query->rowCount() > 0; // Returns true if the update was successful, false otherwise
	    } catch (PDOException $e) {
	    	die('Database Error: ' . $e->getMessage());
	    }
	}




}
?>
