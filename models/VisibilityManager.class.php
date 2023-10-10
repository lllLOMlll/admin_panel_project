<?php
class VisibilityManager extends DbConnector {

	public function getAllVisibilityObjects() {
		try{
			$query = $this->db->prepare("SELECT id, section, is_visible FROM visibility");
			$query->execute();

			$visibilities = [];
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$visibilities[] = new Visibility($row); 
			}
			return $visibilities;
		} catch (PDOException $e) {
			die('Database Error:' .$e->getMessage());
		}
	}

	public function getVisibilityBySection($section) {
		try {
			$query = $this->db->prepare("SELECT * FROM visibility WHERE section = :section");
			$query->bindParam(':section', $section, PDO::PARAM_STR);
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return new Visibility($row);
			}

			return null;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

public function changeVisibility($id) {
	try {
		// First, retrieve the current visibility for the given ID
		$query = $this->db->prepare("SELECT is_visible FROM visibility WHERE id = :id");
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_ASSOC);
		if (!$row) {
			return false; // ID not found
		}

		// Toggle the visibility
		$newVisibility = $row['is_visible'] == 1 ? 0 : 1;

		// Update the visibility in the database
		$query = $this->db->prepare("UPDATE visibility SET is_visible = :is_visible WHERE id = :id");
		$query->bindParam(':is_visible', $newVisibility, PDO::PARAM_INT);
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();

		return true; // Success
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}



}
?>