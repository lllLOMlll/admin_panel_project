<?php
class FooterManager extends DbConnector {

	public function updateFooter($copyright, $design_company, $legal_message) {
		try {
			$query = $this->db->prepare(
				"UPDATE footer SET copyright = ?, design_company = ?, legal_message = ?"
			);

			return $query->execute([
				$copyright,
				$design_company,
				$legal_message
			]);
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

	public function getFooter() {
		try {
			$query = $this->db->prepare("SELECT copyright, design_company, legal_message FROM footer");
			$query->execute();

			$footerData = $query->fetch(PDO::FETCH_ASSOC);

			if ($footerData) {
				return new Footer($footerData);
			} else {
				return null; // Return null if no footer data is found
			}
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

}

?>