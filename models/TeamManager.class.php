<?php
class TeamManager extends DbConnector {

	// TITLE AND TEXT
public function getAllTeamTitle() {
	try {
		$query = $this->db->prepare("SELECT id, title, paragraph FROM team_title"); // Make sure 'text' is the correct column name
		$query->execute();

		$allTitleAndParagraph = [];
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
			$allTitleAndParagraph[] = new TeamTitle($row);
		}
		return $allTitleAndParagraph;
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function getSingleTitle($id) {
	try {
		$query = $this->db->prepare("SELECT * FROM team_title WHERE id = ?");
		$query->execute([$id]);
		$singleTitle = $query->fetch(PDO::FETCH_ASSOC);
		return new TeamTitle($singleTitle); 
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}


public function updateTitle(TeamTitle $TeamTitleData) {
	try {
		$query = $this->db->prepare("UPDATE team_title SET title = :newTitle, paragraph = :newParagraph WHERE id = :id");
		return $query->execute(array(
			'id' => $TeamTitleData->getId(),
			'newTitle' => $TeamTitleData->getTitle(),
			'newParagraph' => $TeamTitleData->getParagraph()
		));
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage()); 
	}
}




	// TEAM

	public function getAllTeam() {
		try {
			$query = $this->db->prepare("SELECT id, name, title, bio, picture_path, alt, order_number FROM team ORDER BY order_number");
		$query->execute(); 

		$allTeam = [];
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$allTeam[] = new Team($row);
		}
		return $allTeam;
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function addTeam(Team $TeamData) {
	try{
		$query = $this->db->prepare("INSERT INTO team (name, title, bio, picture_path, alt, order_number) VALUES (:name, :title, :bio, :picture_path, :alt, :order_number)");
		return $query->execute(array(
			'name' => $TeamData->getName(),
			'title' => $TeamData->getTitle(),
			'bio' => $TeamData->getBio(),
			'picture_path' => $TeamData->getPicturePath(),
			'alt' => $TeamData->getAlt(),
			'order_number' => $TeamData->getOrderNumber()
		));	
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}


public function getSingleTeam($id) {
	try {
		$query = $this->db->prepare("SELECT * FROM team WHERE id = ?");
		$query->execute([$id]);
		$singleTeamMember = $query->fetch(PDO::FETCH_ASSOC);
		return new Team($singleTeamMember);
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}

}

public function updateTeam(Team $TeamData) {
	try{
		$query = $this->db->prepare("UPDATE team SET name = :newName, title = :newTitle, bio = :newBio, picture_path = :newPicture_path, alt = :newAlt, order_number = :newOrder_number WHERE id = :id");
		return $query->execute(array(
			'id' => $TeamData->getId(),
			'newName' => $TeamData->getName(),
			'newTitle' => $TeamData->getTitle(),
			'newBio' => $TeamData->getBio(),
			'newPicture_path' => $TeamData->getPicturePath(),
			'newAlt' => $TeamData->getAlt(),
			'newOrder_number' => $TeamData->getOrderNumber()
		));
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}

public function deleteTeam($id) {
	try {
		$query = $this->db->prepare("DELETE FROM team WHERE id = :id");
		return $query->execute(['id' => $id]);
	} catch (PDOException $e) {
		die('Database Error:' . $e->getMessage());
	}
}



}
?>