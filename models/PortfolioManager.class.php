<?php
class PortfolioManager extends DbConnector {

	// MAIN TITLE
	public function getTitle() {
		try {
			$query = $this->db->prepare("SELECT id, title FROM portfolio_title LIMIT 1");
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				return new PortfolioTitle($row);
			}

            return null; // Return null if no title is found
        } catch (PDOException $e) {
        	die('Database Error:' . $e->getMessage());
        }
    }

    // Update Title
    public function updateTitle(PortfolioTitle $PortfolioTitle) {
    	try {
    		$query = $this->db->prepare("UPDATE portfolio_title SET title = :title WHERE id = :id");

    		return $query->execute([
    			'title' => $PortfolioTitle->getTitle(),
    			'id' => $PortfolioTitle->getId()
    		]);
    	} catch (PDOException $e) {
    		die('Database Error:' . $e->getMessage());
    	}
    }

    public function getAllPortfolio() {
    	try {
    		$query = $this->db->prepare("SELECT id, image_path, alt, description, order_number FROM portfolio ORDER BY order_number ");
    		$query->execute();

    		$portfolioObjects = []; 
    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    			$portfolioObjects[] = new Portfolio($row);
    		}
    		return $portfolioObjects;
    	} catch (PDOException $e) {
    		die('Database Error:' . $e->getMessage());
    	}
    }

    public function addPortfolio(Portfolio $portfolio) {
    	$query = $this->db->prepare("INSERT INTO `portfolio` (`id`, `image_path`, `alt`, `description`, `order_number`) VALUES (:id, :image_path, :alt, :description, :order_number);");
    	return $query->execute(array(
    		"id"          => $portfolio->getId(),
    		"image_path"  => $portfolio->getImagePath(),
    		"alt"         => $portfolio->getAlt(),
    		"description" => $portfolio->getDescription(),
    		"order_number"=> $portfolio->getOrderNumber()
    	));
    }

    public function getSinglePortfolio($id) {
    	$query = $this->db->prepare("SELECT * FROM `portfolio` WHERE `id` = ?;");
    	$query->execute([$id]);
    	$singlePortfolio = $query->fetch(PDO::FETCH_ASSOC);
    	return new Portfolio($singlePortfolio);
    }


    public function editPortfolio(Portfolio $portfolio) {
    	$query = $this->db->prepare("UPDATE `portfolio` SET `image_path` = :image_path, `alt` = :alt, `description` = :description, `order_number` = :order_number WHERE `id` = :id;");
    	return $query->execute(array(
    		"id"          => $portfolio->getId(),
    		"image_path"  => $portfolio->getImagePath(),
    		"alt"         => $portfolio->getAlt(),
    		"description" => $portfolio->getDescription(),
    		"order_number"=> $portfolio->getOrderNumber()
    	));
    }

    public function deletePortfolio($id) {
    	try {
    		$query = $this->db->prepare("DELETE FROM `portfolio` WHERE `id` = :id;");
    		return $query->execute(['id' => $id]);
    	} catch (PDOException $e) {
    		die('Database Error:' . $e->getMessage());
    	}
    }






}
?>