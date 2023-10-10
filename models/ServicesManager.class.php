<?php
class ServicesManager extends DbConnector {

// MAIN TITLE
	public function getTitle() {
		try {
			$query = $this->db->prepare("SELECT id, title FROM services_title LIMIT 1");
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return new ServicesTitle($row);
			}

		return null; // Return null if no title is found
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}



public function updateTitle(ServicesTitle $ServicesTitle) {
	try {
		$query = $this->db->prepare("UPDATE services_title SET title = :title WHERE id = :id");

		return $query->execute([
			'title' => $ServicesTitle->getTitle(),
			'id' => $ServicesTitle->getId()
		]);
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}




// SERVICES
public function getAllServices() {
	try {
		$query = $this->db->prepare("SELECT id, icon, title, description, button_text, order_number FROM services ORDER BY order_number");
		$query->execute();

		$services = [];
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$services[] = new Services($row);
		}
		return $services;
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}


public function getSelectedService($id) {
    try {
        $query = $this->db->prepare("SELECT id, icon, title, description, button_text, order_number FROM services WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Services($row);
        } else {
            return null;
        }
    } catch (PDOException $e) {
        die('Database Error:' . $e->getMessage());
    }
}


public function editService(Services $Service) {
	try {
		$query = $this->db->prepare("UPDATE services SET icon = :icon, title = :title, description = :description, button_text = :button_text, order_number = :order_number WHERE id = :id");

		return $query->execute([
			'id' => $Service->getId(),
			'icon' => $Service->getIcon(),
			'title' => $Service->getTitle(),
			'description' => $Service->getDescription(),
			'button_text' => $Service->getButtonText(),
			'order_number' => $Service->getOrderNumber()
		]);
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function addService(Services $Service) {
	try {
		$query = $this->db->prepare("INSERT INTO services (icon, title, description, button_text, order_number) VALUES (:icon, :title, :description, :button_text, :order_number)");

		return $query->execute([
			'icon' => $Service->getIcon(),
			'title' => $Service->getTitle(),
			'description' => $Service->getDescription(),
			'button_text' => $Service->getButtonText(),
			'order_number' => $Service->getOrderNumber()
		]);
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}


public function deleteService($id) {
	try {
		$query = $this->db->prepare("DELETE FROM services WHERE id = :id");
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}


}
?>