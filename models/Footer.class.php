<?php

class Footer {
    private $copyright;
    private $design_company;
    private $legal_message;

    public function __construct(array $footerData) {
        $this->copyright = $footerData['copyright'] ?? null;
        $this->design_company = $footerData['design_company'] ?? null;
        $this->legal_message = $footerData['legal_message'] ?? null;
    }

    // Getter and Setter for Copyright
    public function getCopyright() {
        return $this->copyright;
    }

    public function setCopyright($copyright) {
        $this->copyright = $copyright;
    }

    // Getter and Setter for Design Company
    public function getDesignCompany() {
        return $this->design_company;
    }

    public function setDesignCompany($design_company) {
        $this->design_company = $design_company;
    }

    // Getter and Setter for Legal Message
    public function getLegalMessage() {
        return $this->legal_message;
    }

    public function setLegalMessage($legal_message) {
        $this->legal_message = $legal_message;
    }
}


// // Example on how to user the class
// $footerData = [
//     'copyright' => 'Copyright 2023',
//     'design_company' => 'Vision Design - graphic zoo',
//     'legal_message' => 'All images have been purchased from Bigstock. Do not use the images in your website.',
// ];

// $footer = new Footer($footerData);

// echo $footer->getCopyright(); // Outputs: Copyright 2023


?>