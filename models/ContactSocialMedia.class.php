<?php
class ContactSocialMedia {
    private ?int $id;
    private string $title;
    private string $icon;
    private string $hyperlink;
    private int $order_number;

    public function __construct(array $ContactSocialMediaData) {
        $this->id = $ContactSocialMediaData['id'] ?? null;
        $this->title = $ContactSocialMediaData['title'];
        $this->icon = $ContactSocialMediaData['icon'];
        $this->hyperlink = $ContactSocialMediaData['hyperlink'];
        $this->order_number = $ContactSocialMediaData['order_number'];
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getIcon(): string {
        return $this->icon;
    }

    public function getHyperlink(): string {
        return $this->hyperlink;
    }

    public function getOrderNumber(): int {
        return $this->order_number;
    }

    // Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setIcon(string $icon): void {
        $this->icon = $icon;
    }

    public function setHyperlink(string $hyperlink): void {
        $this->hyperlink = $hyperlink;
    }

    public function setOrderNumber(int $order_number): void {
        $this->order_number = $order_number;
    }
}
?>
