<?php
class WelcomeMessageManager extends DbConnector {

	public function getAllWelcomeMessages() {
		try {
			// Sorting the messages by order_number
			$query = $this->db->prepare("SELECT id, order_number, paragraph FROM welcome_messages ORDER BY order_number");
			$query->execute();

			$welcomeMessages = [];
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$welcomeMessages[] = new WelcomeMessage($row);
			}

			return $welcomeMessages;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}



	public function updateWelcomeMessage($id, $newOrderNumber, $newParagraph) {
		try {
			$query = $this->db->prepare("UPDATE welcome_messages SET order_number = :order_number, paragraph = :paragraph WHERE id = :id");
			$query->bindParam(':order_number', $newOrderNumber, PDO::PARAM_INT);
			$query->bindParam(':paragraph', $newParagraph, PDO::PARAM_STR);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function addMessage($orderNumber, $paragraph) {
		try {
			$query = $this->db->prepare("INSERT INTO welcome_messages (order_number, paragraph) VALUES (:order_number, :paragraph)");
			$query->bindParam(':order_number', $orderNumber, PDO::PARAM_INT);
			$query->bindParam(':paragraph', $paragraph, PDO::PARAM_STR);
			$query->execute();
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function deleteWelcomeMessage($messageId) {
		try {
			$query = $this->db->prepare("DELETE FROM welcome_messages WHERE id = :id");
			$query->bindParam(':id', $messageId, PDO::PARAM_INT);
			$query->execute();
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function sortByOrderNumber() {
		try {
			$query = $this->db->prepare("SELECT id, order_number, paragraph FROM welcome_messages ORDER BY order_number");
			$query->execute();

			$welcomeMessages = [];
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$welcomeMessages[] = new WelcomeMessage($row);
			}

			return $welcomeMessages;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}


}
?>