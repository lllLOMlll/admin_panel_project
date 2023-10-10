<?php
class Visibility {
    private $id;
    private $section;
    private $is_visible;

    public function __construct(array $VisibilityData) {
        $this->id = $VisibilityData['id'] ?? null;
        $this->section = $VisibilityData['section'] ?? null;
        $this->is_visible = $VisibilityData['is_visible'] ?? null;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getSection() {
        return $this->section;
    }

    public function getIsVisible() {
        return $this->is_visible;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setSection($section) {
        $this->section = $section;
    }

    public function setIsVisible($is_visible) {
        $this->is_visible = $is_visible;
    }
}

?>