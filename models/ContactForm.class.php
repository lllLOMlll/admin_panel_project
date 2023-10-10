<?php
class ContactForm {
    private ?int $id;
    private string $input_type;
    private string $input_name;
    private string $place_holder;
    private bool $mandatory;
    private int $order_number;

    public function __construct(array $ContactFormData) {
        $this->id = $ContactFormData['id'] ?? null;
        $this->input_type = $ContactFormData['input_type'];
        $this->input_name = $ContactFormData['input_name'];
        $this->place_holder = $ContactFormData['place_holder'];
        $this->mandatory = $ContactFormData['mandatory'];
        $this->order_number = $ContactFormData['order_number'];
    }

    // GETTERS AND SETTERS
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getInputType() : string {
    	return $this->input_type;
    }

    public function setInputType($input_type) {
    	$this->input_type = $input_type;
    }

    public function getInputName(): string {
        return $this->input_name;
    }

    public function setInputName(string $input_name): void {
        $this->input_name = $input_name;
    }

    public function getPlaceHolder(): string {
        return $this->place_holder;
    }

    public function setPlaceHolder(string $place_holder): void {
        $this->place_holder = $place_holder;
    }

    public function getMandatory(): bool {
        return $this->mandatory;
    }

    public function setMandatory(bool $mandatory): void {
        $this->mandatory = $mandatory;
    }

    public function getOrderNumber(): int {
        return $this->order_number;
    }

    public function setOrderNumber(int $order_number): void {
        $this->order_number = $order_number;
    }
}

?>