<?php
class SliderManager extends DbConnector {

// MAIN TITLE
public function getTitle() {
	try {
		$query = $this->db->prepare("SELECT id, title FROM slider_title LIMIT 1");
		$query->execute();

		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row) {
			return new SliderTitle($row);
		}
		return null;
	} catch(PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function updateTitle(SliderTitle $SliderTitle) {
    try {
        $query = $this->db->prepare("UPDATE slider_title SET title = :title WHERE id = :id");

        return $query->execute([
            'title' => $SliderTitle->getTitle(),
            'id' => $SliderTitle->getId()
        ]);
    } catch (PDOException $e) {
        die('Database Error:' . $e->getMessage());
    }
}

// SLIDES
public function getAllSlides() {
	try {
		$query = $this->db->prepare("SELECT id, title, alt, order_number, slide_path FROM slider ORDER BY order_number");
		$query->execute();

		$slides = [];
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$slides[] = new Slider($row);
		}
		return $slides;
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function getSlideByID($id) {
    try {
        $query = $this->db->prepare("SELECT id, title, alt, order_number, slide_path FROM slider WHERE id = :id LIMIT 1");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Slider($row);
        }
        return null;
    } catch (PDOException $e) {
        die('Database Error: ' . $e->getMessage());
    }
}

public function addSlide($title, $alt, $order_number, $slidePath) {
	try {
		$query = $this->db->prepare("INSERT INTO slider (title, alt, order_number, slide_path) VALUES (:title, :alt, :order_number, :slide_path)");
		$query->bindParam(':title', $title, PDO::PARAM_STR);
		$query->bindParam(':alt', $alt, PDO::PARAM_STR);
		$query->bindParam(':order_number', $order_number, PDO::PARAM_INT);
		$query->bindParam(':slide_path', $slidePath, PDO::PARAM_STR);
		$query->execute();
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function updateSlide($id, $title, $alt, $order_number, $slidePath) {
	try {
		$query = $this->db->prepare("UPDATE slider SET title = :title, alt = :alt, order_number = :order_number, slide_path = :slide_path WHERE id = :id");
		$query->bindParam(':title', $title, PDO::PARAM_STR);
		$query->bindParam(':alt', $alt, PDO::PARAM_STR);
		$query->bindParam(':order_number', $order_number, PDO::PARAM_INT); // Fixed constant
		$query->bindParam(':slide_path', $slidePath, PDO::PARAM_STR); // Fixed constant
		$query->bindParam(':id', $id, PDO::PARAM_INT); // Fixed constant
		$query->execute();
	} catch (PDOException $e) {
		die('Database Error: ' . $e->getMessage()); // Fixed error handling
	}
}

public function deleteSlide($id) {
	try {
		$query = $this->db->prepare("DELETE FROM slider WHERE id = :id");
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function updateOrderNumber($id, $newOrderNumber) {
	try {
		$query = $this->db->prepare("UPDATE slider SET order_number = :order_number WHERE id = :id");
		$query->bindParam(':order_number', $newOrderNumber, PDO::PARAM_INT); 
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}





}