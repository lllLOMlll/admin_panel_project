<?php
class TeamTitle {
    private $id;
    private $title;
    private $paragraph;

    public function __construct(array $TeamTitleData) {
        $this->id = $TeamTitleData['id'] ?? null;
        $this->title = $TeamTitleData['title'];
        $this->paragraph = $TeamTitleData['paragraph'];
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getParagraph() {
        return $this->paragraph;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setParagraph($paragraph) {
        $this->paragraph = $paragraph;
    }
}
?>
