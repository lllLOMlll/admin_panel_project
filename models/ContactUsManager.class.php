<?php
class ContactUsManager extends DbConnector {

    // MAIN TITLE
	public function getTitleParagraph() {
		try {
			$query = $this->db->prepare("SELECT id, title, paragraph FROM contact_us_title_paragraph LIMIT 1");
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return new ContactUsTitleParagraph($row);
			}

			return null; 
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function getTitleParagraphById($id) {
		try {
			$query = $this->db->prepare("SELECT id, title, paragraph FROM contact_us_title_paragraph WHERE id = :id LIMIT 1");
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return new ContactUsTitleParagraph($row);
			}

			return null; 
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function updateTitleParagraph(ContactUsTitleParagraph $contactUsData) {
		try {
			$query = $this->db->prepare("UPDATE contact_us_title_paragraph SET title = :title WHERE id = :id");

			$id = $contactUsData->getId();
			$title = $contactUsData->getTitle();
			$paragraph = $contactUsData->getParagraph();

			$query->bindParam(':title', $title, PDO::PARAM_STR);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	// CONTACT METHODS
	public function getAllContactMethods() {
		try {
			$query = $this->db->prepare("SELECT id, icon, title, line1, line2, order_number FROM contact_method ORDER BY order_number");
			$query->execute();

			$allContactMethods = [];
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$allContactMethods[] = new ContactMethod($row);  
			}
			return $allContactMethods;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function addContactMethod(ContactMethod $ContactMethodData) {
		try {
			$query = $this->db->prepare("INSERT INTO contact_method (icon, title, line1, line2, order_number) VALUES (:icon, :title, :line1, :line2, :order_number)");
			return $query->execute(array(
				'icon' => $ContactMethodData->getIcon(),
				'title' => $ContactMethodData->getTitle(),
				'line1' => $ContactMethodData->getLine1(),
				'line2' => $ContactMethodData->getLine2(),
				'order_number' => $ContactMethodData->getOrderNumber() 
			));
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function getSingleContactMethod(int $id) {
		try {
			$query = $this->db->prepare("SELECT * FROM contact_method WHERE id = ?");
			$query->execute([$id]);
			$selectedContactMethod = $query->fetch(PDO::FETCH_ASSOC);
			return new ContactMethod($selectedContactMethod);
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function editContactMethod(ContactMethod $ContactMethodData) {
		try {
			$query = $this->db->prepare("UPDATE contact_method SET icon = :icon, title = :title, line1 = :line1, line2 = :line2, order_number = :order_number WHERE id = :id");
			return $query->execute(array(
				'id' => $ContactMethodData->getId(),
				'icon' => $ContactMethodData->getIcon(),
				'title' => $ContactMethodData->getTitle(),
				'line1' => $ContactMethodData->getLine1(),
				'line2' => $ContactMethodData->getLine2(),
	            'order_number' => $ContactMethodData->getOrderNumber()  // Assuming you have a getOrderNumber method
	        ));
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function deleteContactMethod(int $id) {
		try {
			$query = $this->db->prepare("DELETE FROM contact_method WHERE id = :id");
			return $query->execute(['id' => $id]);
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}


	// OPENING HOURS	
	public function getOfficeHours() {
		try {
			$query = $this->db->prepare("SELECT id, monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM contact_office_hours LIMIT 1");
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return new ContactOfficeHours($row);
			}

			return null;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function getOfficeHoursById($id) {
		try {
			$query = $this->db->prepare("SELECT id, monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM contact_office_hours WHERE id = :id LIMIT 1");
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return new ContactOfficeHours($row);
			}

			return null;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function updateOfficeHours(ContactOfficeHours $ContactOfficeHoursData) {
		try {
			$query = $this->db->prepare("UPDATE contact_office_hours SET monday = :monday, tuesday = :tuesday, wednesday = :wednesday, thursday = :thursday, friday = :friday, saturday = :saturday, sunday = :sunday WHERE id = :id");

			$id = $ContactOfficeHoursData->getId();
			$monday = $ContactOfficeHoursData->getMonday();
			$tuesday = $ContactOfficeHoursData->getTuesday();
			$wednesday = $ContactOfficeHoursData->getWednesday();
			$thursday = $ContactOfficeHoursData->getThursday();
			$friday = $ContactOfficeHoursData->getFriday();
			$saturday = $ContactOfficeHoursData->getSaturday();
			$sunday = $ContactOfficeHoursData->getSunday();

			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->bindParam(':monday', $monday, PDO::PARAM_STR);
			$query->bindParam(':tuesday', $tuesday, PDO::PARAM_STR);
			$query->bindParam(':wednesday', $wednesday, PDO::PARAM_STR);
			$query->bindParam(':thursday', $thursday, PDO::PARAM_STR);
			$query->bindParam(':friday', $friday, PDO::PARAM_STR);
			$query->bindParam(':saturday', $saturday, PDO::PARAM_STR);
			$query->bindParam(':sunday', $sunday, PDO::PARAM_STR);

			$query->execute();
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	// SOCIAL MEDIA
	public function getAllSocialMedia() {
		try {
			$query = $this->db->prepare("SELECT * FROM contact_social_media ORDER BY order_number");
			$query->execute();

			$allSocialMedia = [];
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$allSocialMedia[] = new ContactSocialMedia($row);
			}
			return $allSocialMedia;
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function addSocialMedia(ContactSocialMedia $ContactSocialMediaData) {
		try {
			$query = $this->db->prepare("INSERT INTO contact_social_media (title, icon, hyperlink, order_number) VALUES (:title, :icon, :hyperlink, :order_number)");
			return $query->execute([
				'title' => $ContactSocialMediaData->getTitle(),
				'icon' => $ContactSocialMediaData->getIcon(),
				'hyperlink' => $ContactSocialMediaData->getHyperlink(),
				'order_number' => $ContactSocialMediaData->getOrderNumber()
			]);
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function getSingleSocialMedia(int $id) {
		try {
			$query = $this->db->prepare("SELECT * FROM contact_social_media WHERE id = ?");
			$query->execute([$id]);
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return new ContactSocialMedia($row);
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function editSocialMedia(ContactSocialMedia $ContactSocialMediaData) {
		try {
			$query = $this->db->prepare("UPDATE contact_social_media SET title = :title, icon = :icon, hyperlink = :hyperlink, order_number = :order_number WHERE id = :id");
			return $query->execute([
				'id' => $ContactSocialMediaData->getId(),
				'title' => $ContactSocialMediaData->getTitle(),
				'icon' => $ContactSocialMediaData->getIcon(),
				'hyperlink' => $ContactSocialMediaData->getHyperlink(),
				'order_number' => $ContactSocialMediaData->getOrderNumber()
			]);
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

	public function deleteSocialMedia(int $id) {
		try {
			$query = $this->db->prepare("DELETE FROM contact_social_media WHERE id = :id");
			return $query->execute(['id' => $id]);
		} catch (PDOException $e) {
			die('Database Error: ' . $e->getMessage());
		}
	}

// CONTACT FORMS
public function getAllContactForms() {
    try {
        $query = $this->db->prepare("SELECT * FROM contact_form ORDER BY order_number");
        $query->execute();

        $allContactForms = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $allContactForms[] = new ContactForm($row);
        }
        return $allContactForms;
    } catch (PDOException $e) {
        die('Database Error: ' . $e->getMessage());
    }
}

public function addContactForm(ContactForm $ContactFormData) {
    try {
        $query = $this->db->prepare("INSERT INTO contact_form (input_type, input_name, place_holder, mandatory, order_number) VALUES (:input_type, :input_name, :place_holder, :mandatory, :order_number)");
        return $query->execute([
            'input_type' => $ContactFormData->getInputType(),
            'input_name' => $ContactFormData->getInputName(),
            'place_holder' => $ContactFormData->getPlaceHolder(),
            'mandatory' => $ContactFormData->getMandatory(),
            'order_number' => $ContactFormData->getOrderNumber()
        ]);
    } catch (PDOException $e) {
        die('Database Error: ' . $e->getMessage());
    }
}

public function getSingleContactForm(int $id) {
    try {
        $query = $this->db->prepare("SELECT * FROM contact_form WHERE id = ?");
        $query->execute([$id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return new ContactForm($row);
    } catch (PDOException $e) {
        die('Database Error: ' . $e->getMessage());
    }
}

public function editContactForm(ContactForm $ContactFormData) {
    try {
        $query = $this->db->prepare("UPDATE contact_form SET input_type = :input_type, input_name = :input_name, place_holder = :place_holder, mandatory = :mandatory, order_number = :order_number WHERE id = :id");
        return $query->execute([
            'id' => $ContactFormData->getId(),
            'input_type' => $ContactFormData->getInputType(),
            'input_name' => $ContactFormData->getInputName(),
            'place_holder' => $ContactFormData->getPlaceHolder(),
            'mandatory' => $ContactFormData->getMandatory(),
            'order_number' => $ContactFormData->getOrderNumber()
        ]);
    } catch (PDOException $e) {
        die('Database Error: ' . $e->getMessage());
    }
}

public function deleteContactForm(int $id) {
    try {
        $query = $this->db->prepare("DELETE FROM contact_form WHERE id = :id");
        return $query->execute(['id' => $id]);
    } catch (PDOException $e) {
        die('Database Error: ' . $e->getMessage());
    }
}



}
?>
