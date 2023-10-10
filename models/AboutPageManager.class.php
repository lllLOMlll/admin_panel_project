<?php
class AboutPageManager extends DbConnector {
  
  public function getAboutPageTitleAndParagraph() {
    try {
      $query = $this->db->prepare("SELECT id, title, paragraph FROM about_page_title_and_paragraph");
      $query->execute();

      $aboutPageItems = [];
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $aboutPageItems[] = new AboutPage($row);
      }
      return $aboutPageItems;
    } catch (PDOException $e) {
      die('Database Error:' . $e->getMessage());
    }
  }

  public function getSingleAboutPageTitleAndParagraph($id) {
    try {
      $query = $this->db->prepare("SELECT id, title, paragraph FROM about_page_title_and_paragraph WHERE id = :id");
      $query->bindParam(':id', $id, PDO::PARAM_INT);
      $query->execute();

      $row = $query->fetch(PDO::FETCH_ASSOC);

      if ($row) {
        return new AboutPage($row);
      } else {
        return null;
      }
    } catch (PDOException $e) {
      die('Database Error:' . $e->getMessage());
    }
  }

  public function editAboutPageTitleAndParagraph(AboutPage $AboutPage) {
    try {
      $query = $this->db->prepare("UPDATE about_page_title_and_paragraph SET title = :title, paragraph = :paragraph WHERE id = :id");

      return $query->execute([
        'id' => $AboutPage->getId(),
        'title' => $AboutPage->getTitle(),
        'paragraph' => $AboutPage->getParagraph()
      ]);
    } catch (PDOException $e) {
      die('Database Error:' . $e->getMessage());
    }
  }
}
?>
