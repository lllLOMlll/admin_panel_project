<?php
include "../head.inc.php";

$UserManager = new UserManager();


$action = $_REQUEST['action'];


switch ($action) {

// ******************************************************** REGISTER ********************************************************
	case "register":

	$_SESSION['registrationInProgress'] = true;

	// Get the data from the registration form and creating variables
	$firstName = trim($_POST['firstNameRegistration']);
	$lastName = trim($_POST['lastNameRegistration']);
	$email = trim($_POST['emailRegistration']);
	$username = trim($_POST['usernameRegistration']);
	$password = trim($_POST['passwordRegistration']);
	$confirmPassword = trim($_POST['passwordConfirmationRegistration']);
	$avatar = $_FILES['avatarRegistration']; 
	
	// Creating SESSSION variables for display purpose
	$_SESSION['firstNameRegistration'] = $firstName;
	$_SESSION['lastNameRegistration'] = $lastName;
	$_SESSION['emailRegistration'] = $email;
	$_SESSION['usernameRegistration'] = $username;
	$_SESSION['passwordRegistration'] = $password;
	$_SESSION['passwordConfirmationRegistration'] = $confirmPassword;



	// VALIDATION
	$errorMessage = "";
	// Check if all fields are empty
	if (empty($firstName) && empty($lastName) && empty($email) && empty($username) && empty($password) && empty($confirmPassword)) {
		$errorMessage .= "All fields must not be empty.<br>";
		$_SESSION['errorMessage'] = $errorMessage;
	// Set all fields as invalid
		$_SESSION['fieldInputFeedbackFirstName'] = $_SESSION['fieldInputFeedbackLastName'] = $_SESSION['fieldInputFeedbackEmail'] = $_SESSION['fieldInputFeedbackUsername'] = $_SESSION['fieldInputFeedbackPassword'] = $_SESSION['fieldInputFeedbackConfirmPassword'] = 'is-invalid';
	} else {

		// First Name
		if (empty($firstName)) {
			$errorMessage .= "First name must not be empty.<br>";
		} elseif (!preg_match("/^[a-zA-Z-]+$/", $firstName)) {
			$errorMessage .= "First name must only contain letters and hyphens.<br>";
		} elseif (strlen($firstName) > 100) {
			$errorMessage .= "First name must be no longer than 100 characters.<br>";
		}
		$_SESSION['errorMessage'] = $errorMessage;
		$_SESSION['fieldInputFeedbackFirstName'] = empty($firstName) || !preg_match("/^[a-zA-Z-]+$/", $firstName) || strlen($firstName) > 100 ? 'is-invalid' : 'is-valid';


		// Last Name
		if (empty($lastName)) {
			$errorMessage .= "Last name must not be empty.<br>";
		} elseif (!preg_match("/^[a-zA-Z-]+$/", $lastName)) {
			$errorMessage .= "Last name must only contain letters and hyphens.<br>";
		} elseif (strlen($lastName) > 100) {
			$errorMessage .= "Last name must be no longer than 100 characters.<br>";
		}
		$_SESSION['errorMessage'] .= $errorMessage;
		$_SESSION['fieldInputFeedbackLastName'] = empty($lastName) || !preg_match("/^[a-zA-Z-]+$/", $lastName) || strlen($lastName) > 100 ? 'is-invalid' : 'is-valid';


		// Email
		if (empty($email)) {
			$errorMessage .= "Email address must not be empty.<br>";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorMessage .= "Invalid email address!<br>";
		} elseif ($UserManager->isEmailExists($email)) {
			$errorMessage .= "This email is already used by another user. Please choose a different email. <br>";
		}
		$_SESSION['errorMessage'] = $errorMessage;
		$_SESSION['fieldInputFeedbackEmail'] = empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ? 'is-invalid' : 'is-valid';

		// Username
		if (empty($username)) {
			$errorMessage .= "Username must not be empty.<br>";
		} elseif (strlen($username) < 4 || strlen($username) > 20) {
			$errorMessage .= "Invalid username! Username must be between 4 and 20 characters.<br>"; 
		} elseif ($UserManager->isUsernameExists($username)) {
			$errorMessage .= "This username already exists. Please choose another username. <br>";
		}
		$_SESSION['errorMessage'] = $errorMessage;
		$_SESSION['fieldInputFeedbackUsername'] = empty($username) || strlen($username) < 4 || strlen($username) > 20 ? 'is-invalid' : 'is-valid';

		// Password
		if (empty($password)) {
			$errorMessage .= "Password must not be empty.<br>";
		} elseif (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[!@#$%^&*]/", $password)) {
			$errorMessage .= "Invalid password! Password must be at least 8 characters long, with at least one uppercase letter and one special character.<br>";
		}
		$_SESSION['errorMessage'] = $errorMessage;
		$_SESSION['fieldInputFeedbackPassword'] = empty($password) || (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[!@#$%^&*]/", $password)) ? 'is-invalid' : 'is-valid';

		// Confirm password
		if (empty($confirmPassword)) {
			$errorMessage .= "Repeat password must not be empty. <br>";
			$_SESSION['fieldInputFeedbackConfirmPassword'] = 'is-invalid';
		} elseif ($password !== $confirmPassword) {
			$errorMessage .= "Passwords do not match!<br>";
			$_SESSION['errorMessage'] = $errorMessage;
			$_SESSION['fieldInputFeedbackConfirmPassword'] = 'is-invalid';
		} else {
			$_SESSION['fieldInputFeedbackConfirmPassword'] = 'is-valid';
		}

		// Existing Email and Username checks
		if ($UserManager->isEmailExists($email)) {
			$errorMessage .= "Email already exists! Please choose a different one.<br>";
			$_SESSION['errorMessage'] = $errorMessage;
			$_SESSION['fieldInputFeedbackEmail'] = 'is-invalid';
		}

		if ($UserManager->isUsernameExists($username)) {
			$errorMessage .= "Username already exists! Please choose a different one.<br>";
			$_SESSION['errorMessage'] = $errorMessage;
			$_SESSION['fieldInputFeedbackUsername'] = 'is-invalid';
		}

		// Avatar
		$uploadDir = '../avatars/';
		$newFilename = '';
		$avatarPath = '';

		if (isset($_FILES['avatarRegistration'])) {
			if ($_FILES['avatarRegistration']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['avatarRegistration']['error'] == UPLOAD_ERR_FORM_SIZE) {
        // Handle file size error
				$errorMessage .= "Avatar must be smaller than the server limit..<br>";
			} elseif ($_FILES['avatarRegistration']['error'] == 0) {
				if ($_FILES['avatarRegistration']['size'] > 1000 * 1024) {
					$errorMessage .= "Avatar must be smaller than 1000 KB.<br>";
				} else {
					$fileType = mime_content_type($_FILES['avatarRegistration']['tmp_name']);
					$allowedTypes = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

					if (in_array($fileType, $allowedTypes)) {
						$fileExtension = strtolower(pathinfo($_FILES['avatarRegistration']['name'], PATHINFO_EXTENSION));
						$newFilename = $username . "_" . time() . "." . $fileExtension;
						$uploadFile = $uploadDir . $newFilename;

						if (move_uploaded_file($_FILES['avatarRegistration']['tmp_name'], $uploadFile)) {
							$avatarPath = $uploadFile;
						} else {
							$errorMessage .= "Error uploading the avatar.<br>";
						}
					} else {
						$errorMessage .= "Avatar must be a jpg, jpeg, gif, or png file.<br>";
					}
				}
			} else {
        // Handle other upload errors
				$errorMessage .= "Avatar must not be empty.<br>";
			}

			if (!empty($errorMessage)) {
				$_SESSION['errorMessage'] = $errorMessage;
				$_SESSION['fieldInputFeedbackAvatar'] = 'is-invalid';
			}
		} else {
    // Handle missing avatar error
			$errorMessage .= "Avatar must not be empty.<br>";
			$_SESSION['errorMessage'] = $errorMessage;
			$_SESSION['fieldInputFeedbackAvatar'] = 'is-invalid';
		}



		// UPLOADING THE USER IN THE DATABASE
		if (empty($errorMessage)) {

  			// Create an associative array with the user data
			$userData = [
				'first_name' => $firstName,
				'last_name' => $lastName,
				'email' => $email,
				'username' => $username,
				// I'm hashing the password with the method addUser
				'password' => $password,
      	'avatar' => $avatarPath // Store the relative path to the uploaded avatar
      ];

    		// Create a new User object
      $user = new User($userData);

    		// Add the user to the database using the UserManager class
      if ($UserManager->addUser($user)) {
      	$_SESSION['successMessage'] = 'Congratulations! Your registration was successful. We send you an activation email.';
      			// $UserManager->sendActivationEmail($username, $email);
      	unset($_SESSION['registrationInProgress']);
  				// Unset $_SESSION variables for display purpose
      	unset($_SESSION['firstNameRegistration']);
      	unset($_SESSION['lastNameRegistration']);
      	unset($_SESSION['emailRegistration']);
      	unset($_SESSION['usernameRegistration']);
      	unset($_SESSION['passwordRegistration']);
      	unset($_SESSION['passwordConfirmationRegistration']);
    			// Unset $_SESSION variables for class 'is-valid' or 'is-invalid'
      	unset($_SESSION['fieldInputFeedbackFirstName']);
      	unset($_SESSION['fieldInputFeedbackLastName']);
      	unset($_SESSION['fieldInputFeedbackEmail']);
      	unset($_SESSION['fieldInputFeedbackUsername']);
      	unset($_SESSION['fieldInputFeedbackPassword']);
      	unset($_SESSION['fieldInputFeedbackConfirmPassword']);
      	unset($_SESSION['fieldInputFeedbackAvatar']);
    			// Unset error message
      	unset($_SESSION['errorMessage']);

      	// If Admin redirect add-user or if new user login.php
      	if (isset($_SESSION['access_level'])) {
      		$accessLevel = $_SESSION['access_level'];
      		if ($accessLevel == 1) {
      			$_SESSION['successMessage'] = "Congratulations! You've addes a new user";
      			header("Location: ../admin/add-user.php");
      			exit;
      		}
      	}
      	header("Location: ../admin/login.php");
      	exit;
      } 

    		// ERROR REGISTRATION
      else {
      	$_SESSION['errorMessage'] = $errorMessage;
      }
    }
  }

	// If Admin redirect add-user or if new user login.php
	if (isset($_SESSION['access_level'])) {
      		$accessLevel = $_SESSION['access_level'];
      		if ($accessLevel == 1) {
      			header("Location: ../admin/add-user.php");
      			exit;
      		}
      	}

  header("Location: ../admin/register.php");
  exit; 
  break;


// ******************************************************** LOGIN ********************************************************
  case "login":

  // Get the data from the login form
  $username = trim($_POST['usernameLogin']);
  $password = trim($_POST['passwordLogin']);
  $_SESSION['usernameLogin'] = $username;
  $_SESSION['passwordLogin'] = $password;

  // VALIDATION
  $errorMessage = "";

  // Check credentials using the UserManager class
  if ($UserManager->isUsernameAndPasswordMatch($username, $password)) {
    // Creating an instance of the User class
  	$user = $UserManager->getUserByUsername($username);

  	if ($user !== null) {
      // Check if the user status is 0
  		if ($user->getStatus() == 0) {
  			$errorMessage .= "Your account is not activated! Please activate your account first. We sent you an email about it., <br>";
  			unset($_SESSION['usernameLogin']);
  			unset($_SESSION['passwordLogin']);
  			$_SESSION['errorMessage'] = $errorMessage;
  			header("Location: ../admin/login.php");
  			exit;
  		}
      // SUCCESS
  		unset($_SESSION['usernameLogin']);
  		unset($_SESSION['passwordLogin']);

      // Save information about the user in the $_SESSION variables
  		$_SESSION['username'] = $username;
  		$_SESSION['userLogged'] = true;
  		$_SESSION['firstName'] = $user->getFirstName();
  		$_SESSION['lastName'] = $user->getLastName();
  		$_SESSION['email'] = $user->getEmail();
  		$_SESSION['avatar'] = $user->getAvatar();
  		$_SESSION['access_level'] = $user->getAccessLevel();


  		header("Location: ../admin/index.php");
  		exit;
  	} 
  } else {
  	$errorMessage .= "Invalid username or password! <br>";

  	$_SESSION['errorMessage'] = $errorMessage;
  	header("Location: ../admin/login.php");
  	exit;
  }

  break;



// ******************************************************** UPDATE PROFILE ********************************************************
  case "update_profile":

  $_SESSION['updateProfileInProgress'] = true;

			// Get the data from the registration form and creating variables
  $username = trim($_SESSION['username']);
  $newUsername = trim($_POST['usernameUpdatingProfile']);
  $newFirstName = trim($_POST['firstNameUpdatingProfile']);
  $newLastName = trim($_POST['lastNameUpdatingProfile']);
  $newEmail = trim($_POST['emailUpdatingProfile']); 
  $avatarPath = $_FILES['avatarUpdatingProfile'];

  $user = $UserManager->getUserByUsername($username);
  $email = $user->getEmail();


	// VALIDATION
  $errorMessage = "";
	// First Name
  if (empty($newFirstName)) {
  	$errorMessage .= "First name must not be empty.<br>";
  } elseif (!preg_match("/^[a-zA-Z-]+$/", $newFirstName)) {
  	$errorMessage .= "First name must only contain letters and hyphens.<br>";
  } elseif (strlen($newFirstName) > 100) {
  	$errorMessage .= "First name must be no longer than 100 characters.<br>";
  }
  $_SESSION['errorMessage'] = $errorMessage;
  $_SESSION['fieldInputFeedbackFirstName'] = empty($newFirstName) || !preg_match("/^[a-zA-Z-]+$/", $newFirstName) || strlen($newFirstName) > 100 ? 'is-invalid' : 'is-valid';

	// Last Name
  if (empty($newLastName)) {
  	$errorMessage .= "Last name must not be empty.<br>";
  } elseif (!preg_match("/^[a-zA-Z-]+$/", $newLastName)) {
  	$errorMessage .= "Last name must only contain letters and hyphens.<br>";
  } elseif (strlen($newLastName) > 100) {
  	$errorMessage .= "Last name must be no longer than 100 characters.<br>";
  }
  $_SESSION['errorMessage'] .= $errorMessage;
  $_SESSION['fieldInputFeedbackLastName'] = empty($newLastName) || !preg_match("/^[a-zA-Z-]+$/", $newLastName) || strlen($newLastName) > 100 ? 'is-invalid' : 'is-valid';

	// Username
  if (empty($newUsername)) {
  	$errorMessage .= "Username must not be empty.<br>";
  } elseif (strlen($newUsername) < 4 || strlen($newUsername) > 20) {
  	$errorMessage .= "Invalid username! Username must be between 4 and 20 characters.<br>"; 
  } elseif ($newUsername != $username && $UserManager->isUsernameExists($newUsername)) {
  // Only check if the username exists if it is different from the current username
  	$errorMessage .= "This username already exists. Please choose another username. <br>";
  }
  $_SESSION['errorMessage'] = $errorMessage;
  $_SESSION['fieldInputFeedbackUsername'] = empty($newUsername) || strlen($newUsername) < 4 || strlen($newUsername) > 20 || ($newUsername != $username && $UserManager->isUsernameExists($newUsername)) ? 'is-invalid' : 'is-valid';


	// Email
  if (empty($newEmail)) {
  	$errorMessage .= "Email address must not be empty.<br>";
  } elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
  	$errorMessage .= "Invalid email address!<br>";
  } elseif ($newEmail != $email && $UserManager->isEmailExists($newEmail)) {
  	$errorMessage .= "This email is already used by another user. Please choose a different email. <br>";
  }
  $_SESSION['errorMessage'] = $errorMessage;
  $_SESSION['fieldInputFeedbackEmail'] = empty($newEmail) || !filter_var($newEmail, FILTER_VALIDATE_EMAIL) || ($newEmail != $email && $UserManager->isEmailExists($newEmail)) ? 'is-invalid' : 'is-valid';

  // Avatar
  $uploadDir = '../avatars/';
  $newAvatarPath = '';

// Get the current user's avatar from the database
  $user = $UserManager->getUserByUsername($username);
  $currentAvatarPath = $user->getAvatar();

  if (isset($_FILES['avatarUpdatingProfile']) && $_FILES['avatarUpdatingProfile']['error'] != UPLOAD_ERR_NO_FILE) {
  	if ($_FILES['avatarUpdatingProfile']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['avatarUpdatingProfile']['error'] == UPLOAD_ERR_FORM_SIZE) {
		// Handle file size error
  		$errorMessage .= "Avatar must be smaller than the server limit..<br>";
  	} elseif ($_FILES['avatarUpdatingProfile']['size'] > 1000 * 1024) {
  		$errorMessage .= "Avatar must be smaller than 1000 KB.<br>";
  	} else {
  		$fileType = mime_content_type($_FILES['avatarUpdatingProfile']['tmp_name']);
  		$allowedTypes = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

  		if (in_array($fileType, $allowedTypes)) {
  			$fileExtension = strtolower(pathinfo($_FILES['avatarUpdatingProfile']['name'], PATHINFO_EXTENSION));
  			$newFilename = $username . "_" . time() . "." . $fileExtension;
  			$uploadFile = $uploadDir . $newFilename;

  			if (move_uploaded_file($_FILES['avatarUpdatingProfile']['tmp_name'], $uploadFile)) {
				$newAvatarPath = $uploadFile; // Update avatar path
			} else {
				$errorMessage .= "Error uploading the avatar.<br>";
			}
		} else {
			$errorMessage .= "Avatar must be a jpg, jpeg, gif, or png file.<br>";
		}
	}

	if (!empty($errorMessage)) {
		$_SESSION['errorMessage'] = $errorMessage;
		$_SESSION['fieldInputFeedbackAvatar'] = 'is-invalid';
	}
}

if (empty($newAvatarPath)) {
	$newAvatarPath = $currentAvatarPath; // Use old avatar if new one isn't uploaded
}

if (!empty($errorMessage)) {
	$_SESSION['errorMessage'] = $errorMessage;
	$_SESSION['fieldInputFeedbackAvatar'] = 'is-invalid';
}


if (empty($errorMessage)) {
	$UserManager->updateUserProfile($username,  $newUsername, $newFirstName, $newLastName, $newEmail, $newAvatarPath);
	$_SESSION['username'] = $newUsername;
	$_SESSION['successMessage'] = 'You updated your profile successfully.';
	unset($_SESSION['errorMessage']);
	unset($_SESSION['fieldInputFeedbackFirstName']);
	unset($_SESSION['fieldInputFeedbackLastName']);
	unset($_SESSION['fieldInputFeedbackUsername']);
	unset($_SESSION['fieldInputFeedbackEmail']);
	header("Location: ../admin/index.php");
	exit;
} 	else {
	$_SESSION['errorMessage'] = $errorMessage;

}

header("Location: ../admin/update-profile.php");

break;

// ******************************************************** CHANGE PASSWORD ********************************************************
case "change_password":

$oldPassword = trim($_POST['oldPassword']);
$newPassword = trim($_POST['newPassword']);
$repeatNewPassword = trim($_POST['repeatNewPassword']);
$username = $_SESSION['username'];
$user = $UserManager->getUserByUsername($username);

$_SESSION['oldPassword'] = $oldPassword;
$_SESSION['newPassword'] = $newPassword;
$_SESSION['repeatNewPassword'] = $repeatNewPassword;


$errorMessage = "";

    // VALIDATION
    // Old Password
if (!password_verify($oldPassword, $user->getPassword())) {
	$errorMessage .= "The old password is incorrect.<br>";
	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/change-password.php");
	exit();
}
    // New Password
if (empty($newPassword)) {
	$errorMessage .= "New password must not be empty.<br>";
} elseif (strlen($newPassword) < 8 || !preg_match("/[A-Z]/", $newPassword) || !preg_match("/[!@#$%^&*]/", $newPassword)) {
	$errorMessage .= "Invalid new password! Password must be at least 8 characters long, with at least one uppercase letter and one special character.<br>";
}
$_SESSION['errorMessage'] = $errorMessage;
$_SESSION['fieldInputFeedbackPassword'] = empty($newPassword) || (strlen($newPassword) < 8 || !preg_match("/[A-Z]/", $newPassword) || !preg_match("/[!@#$%^&*]/", $newPassword)) ? 'is-invalid' : 'is-valid';

    // Confirm password
if (empty($repeatNewPassword)) {
	$errorMessage .= "Repeat password must not be empty.<br>";
	$_SESSION['fieldInputFeedbackConfirmPassword'] = 'is-invalid';
} elseif ($newPassword !== $repeatNewPassword) {
	$errorMessage .= "Passwords do not match!<br>";
	$_SESSION['errorMessage'] = $errorMessage;
	$_SESSION['fieldInputFeedbackConfirmPassword'] = 'is-invalid';
} else {
	$_SESSION['fieldInputFeedbackConfirmPassword'] = 'is-valid';
}

if (empty($errorMessage)) {
	$UserManager->changePassword($username, $newPassword); 
	$_SESSION['successMessage'] = "Your password was successfully changed!";
	unset($_SESSION['errorMessage']);
	unset($_SESSION['oldPassword']);
	unset($_SESSION['newPassword']);
	unset($_SESSION['repeatNewPassword']);
	header("Location: ../admin/index.php");
	exit();
}

$_SESSION['errorMessage'] = $errorMessage;
header("Location: ../admin/change-password.php");
exit; 
break;

// ******************************************************** LOGOUT ********************************************************
case "logout":


session_unset();
session_destroy();
header("Location: ../admin/login.php");
exit();

break;


// ******************************************************** BAN USER - ADMIN ********************************************************
case "ban_user":
$usernameFromTheTable = $_POST['username']; 

$User = $UserManager->getUserByUsername($usernameFromTheTable);
$firstName = $User->getFirstName();
$lastName = $User->getLastName();


$UserManager->banUser($usernameFromTheTable);
$_SESSION['successMessage'] = "You've successfully banned " . $firstName . " " . $lastName . "! <br>(Username: "  . $usernameFromTheTable . ")";
header("Location: ../admin/table_users.php");
exit();


// ******************************************************** UBBAN USER - ADMIN ********************************************************
case "unban_user":
$usernameFromTheTable = $_POST['username']; 

$User = $UserManager->getUserByUsername($usernameFromTheTable);
$firstName = $User->getFirstName();
$lastName = $User->getLastName();


$UserManager->unbanUser($usernameFromTheTable);
$_SESSION['successMessage'] = "You've successfully unbanned " . $firstName . " " . $lastName . "! <br>(Username: "  . $usernameFromTheTable . ")";
header("Location: ../admin/table_users.php");
exit();


// ******************************************************** REMOVE ADMIN PRIVILEGES - ADMIN ********************************************************
case "remove_admin_privileges":
$usernameFromTheTable = $_POST['username']; 

$User = $UserManager->getUserByUsername($usernameFromTheTable);
$firstName = $User->getFirstName();
$lastName = $User->getLastName();


$UserManager->removeAdminPrivileges($usernameFromTheTable);
$_SESSION['successMessage'] = "You've successfully removed admin privileges from " . $firstName . " " . $lastName . "! <br>This user is now a moderator.<br>(Username: "  . $usernameFromTheTable . ")";
header("Location: ../admin/table_users.php");
exit();


// ******************************************************** GIVE ADMIN PRIVILEGES - ADMIN ********************************************************
case "give_admin_privileges":
$usernameFromTheTable = $_POST['username']; 

$User = $UserManager->getUserByUsername($usernameFromTheTable);
$firstName = $User->getFirstName();
$lastName = $User->getLastName();


$UserManager->giveAdminPrivileges($usernameFromTheTable);
$_SESSION['successMessage'] = "You've successfully give admin privileges from " . $firstName . " " . $lastName . "! <br>This user is now an admin<br>(Username: "  . $usernameFromTheTable . ")";
header("Location: ../admin/table_users.php");
exit();

// ******************************************************** UPDATE USER - ADMIN ********************************************************
case "update_user_profile_admin":

$_SESSION['updateProfileInProgress'] = true;

			// Get the data from the registration form and creating variables
$username = trim($_POST['oldUsername']);
$newUsername = trim($_POST['usernameUpdatingProfile']);
$newFirstName = trim($_POST['firstNameUpdatingProfile']);
$newLastName = trim($_POST['lastNameUpdatingProfile']);
$newEmail = trim($_POST['emailUpdatingProfile']); 
$avatarPath = $_FILES['avatarUpdatingProfile'];

$user = $UserManager->getUserByUsername($username);
$email = $user->getEmail();


	// VALIDATION
$errorMessage = "";
	// First Name
if (empty($newFirstName)) {
	$errorMessage .= "First name must not be empty.<br>";
} elseif (!preg_match("/^[a-zA-Z-]+$/", $newFirstName)) {
	$errorMessage .= "First name must only contain letters and hyphens.<br>";
} elseif (strlen($newFirstName) > 100) {
	$errorMessage .= "First name must be no longer than 100 characters.<br>";
}
$_SESSION['errorMessage'] = $errorMessage;
$_SESSION['fieldInputFeedbackFirstName'] = empty($newFirstName) || !preg_match("/^[a-zA-Z-]+$/", $newFirstName) || strlen($newFirstName) > 100 ? 'is-invalid' : 'is-valid';

	// Last Name
if (empty($newLastName)) {
	$errorMessage .= "Last name must not be empty.<br>";
} elseif (!preg_match("/^[a-zA-Z-]+$/", $newLastName)) {
	$errorMessage .= "Last name must only contain letters and hyphens.<br>";
} elseif (strlen($newLastName) > 100) {
	$errorMessage .= "Last name must be no longer than 100 characters.<br>";
}
$_SESSION['errorMessage'] .= $errorMessage;
$_SESSION['fieldInputFeedbackLastName'] = empty($newLastName) || !preg_match("/^[a-zA-Z-]+$/", $newLastName) || strlen($newLastName) > 100 ? 'is-invalid' : 'is-valid';

	// Username
if (empty($newUsername)) {
	$errorMessage .= "Username must not be empty.<br>";
} elseif (strlen($newUsername) < 4 || strlen($newUsername) > 20) {
	$errorMessage .= "Invalid username! Username must be between 4 and 20 characters.<br>"; 
} elseif ($newUsername != $username && $UserManager->isUsernameExists($newUsername)) {
  // Only check if the username exists if it is different from the current username
	$errorMessage .= "This username already exists. Please choose another username. <br>";
}
$_SESSION['errorMessage'] = $errorMessage;
$_SESSION['fieldInputFeedbackUsername'] = empty($newUsername) || strlen($newUsername) < 4 || strlen($newUsername) > 20 || ($newUsername != $username && $UserManager->isUsernameExists($newUsername)) ? 'is-invalid' : 'is-valid';


	// Email
if (empty($newEmail)) {
	$errorMessage .= "Email address must not be empty.<br>";
} elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
	$errorMessage .= "Invalid email address!<br>";
} elseif ($newEmail != $email && $UserManager->isEmailExists($newEmail)) {
	$errorMessage .= "This email is already used by another user. Please choose a different email. <br>";
}
$_SESSION['errorMessage'] = $errorMessage;
$_SESSION['fieldInputFeedbackEmail'] = empty($newEmail) || !filter_var($newEmail, FILTER_VALIDATE_EMAIL) || ($newEmail != $email && $UserManager->isEmailExists($newEmail)) ? 'is-invalid' : 'is-valid';

  // Avatar
$uploadDir = '../avatars/';
$newAvatarPath = '';

// Get the current user's avatar from the database
$user = $UserManager->getUserByUsername($username);
$currentAvatarPath = $user->getAvatar();

if (isset($_FILES['avatarUpdatingProfile']) && $_FILES['avatarUpdatingProfile']['error'] != UPLOAD_ERR_NO_FILE) {
	if ($_FILES['avatarUpdatingProfile']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['avatarUpdatingProfile']['error'] == UPLOAD_ERR_FORM_SIZE) {
		// Handle file size error
		$errorMessage .= "Avatar must be smaller than the server limit..<br>";
	} elseif ($_FILES['avatarUpdatingProfile']['size'] > 1000 * 1024) {
		$errorMessage .= "Avatar must be smaller than 1000 KB.<br>";
	} else {
		$fileType = mime_content_type($_FILES['avatarUpdatingProfile']['tmp_name']);
		$allowedTypes = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

		if (in_array($fileType, $allowedTypes)) {
			$fileExtension = strtolower(pathinfo($_FILES['avatarUpdatingProfile']['name'], PATHINFO_EXTENSION));
			$newFilename = $username . "_" . time() . "." . $fileExtension;
			$uploadFile = $uploadDir . $newFilename;

			if (move_uploaded_file($_FILES['avatarUpdatingProfile']['tmp_name'], $uploadFile)) {
				$newAvatarPath = $uploadFile; // Update avatar path
			} else {
				$errorMessage .= "Error uploading the avatar.<br>";
			}
		} else {
			$errorMessage .= "Avatar must be a jpg, jpeg, gif, or png file.<br>";
		}
	}

	if (!empty($errorMessage)) {
		$_SESSION['errorMessage'] = $errorMessage;
		$_SESSION['fieldInputFeedbackAvatar'] = 'is-invalid';
	}
}

if (empty($newAvatarPath)) {
	$newAvatarPath = $currentAvatarPath; // Use old avatar if new one isn't uploaded
}

if (!empty($errorMessage)) {
	$_SESSION['errorMessage'] = $errorMessage;
	$_SESSION['fieldInputFeedbackAvatar'] = 'is-invalid';
}


if (empty($errorMessage)) {
	$UserManager->updateUserProfile($username,  $newUsername, $newFirstName, $newLastName, $newEmail, $newAvatarPath);

	$_SESSION['successMessage'] = 'You updated your profile successfully.';
	unset($_SESSION['errorMessage']);
	unset($_SESSION['fieldInputFeedbackFirstName']);
	unset($_SESSION['fieldInputFeedbackLastName']);
	unset($_SESSION['fieldInputFeedbackUsername']);
	unset($_SESSION['fieldInputFeedbackEmail']);
	header("Location: ../admin/table_users.php");
	exit;
} 	else {
	$_SESSION['errorMessage'] = $errorMessage;

}



header("Location: ../admin/table_users.php");



break;





}
?>