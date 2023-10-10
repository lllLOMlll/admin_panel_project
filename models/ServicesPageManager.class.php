<?php
class ServicesPageManager extends DbConnector {

	public function getServicesTitleandParagraph() {
		try {
			$query = $this->db->prepare("SELECT id, title, paragraph FROM services_page_title_and_paragraph");
			$query->execute();

			$servicesPageItems = [];
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$servicesPageItems[] = new ServicesPage($row);
			}
			return $servicesPageItems;
		} catch (PDOException $e) {
			die('Database Error:' . $e->getMessage());
		}
	}

  public function getSingleServicesTitleandParagraph($id) {
        try {
            $query = $this->db->prepare("SELECT id, title, paragraph FROM services_page_title_and_paragraph WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new ServicesPage($row);
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            die('Database Error:' . $e->getMessage());
        }
    }

public function editServicesTitleAndParagraph(ServicesPage $ServicesPage) {
    try {
        $query = $this->db->prepare("UPDATE services_page_title_and_paragraph SET title = :title, paragraph = :paragraph WHERE id = :id");
        
        return $query->execute([
            'title' => $ServicesPage->getTitle(),
            'paragraph' => $ServicesPage->getParagraph(),
            'id' => $ServicesPage->getId()
        ]);
    } catch (PDOException $e) {
        die('Database Error:' . $e->getMessage());
    }
}







}