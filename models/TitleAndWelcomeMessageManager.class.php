<?php
class TitleAndWelcomeMessageManager extends DbConnector {

	public function getTitleAndWelcomeText() {
		try {
		// Selecting the title and paragraph from title_and_welcome_text
			$query = $this->db->prepare("SELECT id, title, paragraph FROM title_and_welcome_text");
			$query->execute();

			$titleAndWelcomeTexts = [];
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$titleAndWelcomeTexts[] = new TitleAndWelcomeMessage($row);
			}
			return $titleAndWelcomeTexts;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function updateTitle($id, $newTitle) {
		try {
			$query = $this->db->prepare("UPDATE title_and_welcome_text SET title = :title WHERE id = :id");
			$query->bindParam(':title', $newTitle, PDO::PARAM_STR);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function updateParagraph($id, $newParagraph) {
		try {
			$query = $this->db->prepare("UPDATE title_and_welcome_text SET paragraph =:paragraph WHERE id = :id");
			$query->bindParam(':paragraph', $newParagraph, PDO::PARAM_STR);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}



}
?>