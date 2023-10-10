<?php
class PortfolioPageManager extends DbConnector {
  
  public function getPortfolioPageTitleAndParagraph() {
    try {
      $query = $this->db->prepare("SELECT id, title, paragraph FROM portfolio_page_title_and_paragraph");
      $query->execute();

      $portfolioPageItems = [];
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $portfolioPageItems[] = new PortfolioPage($row);
      }
      return $portfolioPageItems;
    } catch (PDOException $e) {
      die('Database Error:' . $e->getMessage());
    }
  }

  public function getSinglePortfolioPageTitleAndParagraph($id) {
    try {
      $query = $this->db->prepare("SELECT id, title, paragraph FROM portfolio_page_title_and_paragraph WHERE id = :id");
      $query->bindParam(':id', $id, PDO::PARAM_INT);
      $query->execute();

      $row = $query->fetch(PDO::FETCH_ASSOC);

      if ($row) {
        return new PortfolioPage($row);
      } else {
        return null;
      }
    } catch (PDOException $e) {
      die('Database Error:' . $e->getMessage());
    }
  }

  public function editPortfolioPageTitleAndParagraph(PortfolioPage $PortfolioPage) {
    try {
      $query = $this->db->prepare("UPDATE portfolio_page_title_and_paragraph SET title = :title, paragraph = :paragraph WHERE id = :id");

      return $query->execute([
        'id' => $PortfolioPage->getId(),
        'title' => $PortfolioPage->getTitle(),
        'paragraph' => $PortfolioPage->getParagraph()
      ]);
    } catch (PDOException $e) {
      die('Database Error:' . $e->getMessage());
    }
  }
}
?>
