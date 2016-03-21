<?php

namespace kioskon\model;


class Issue {
    private $fileName;

    private $magazines__fk;
    private $issueNumber;
    private $fileSize;
    private $publicationDate;
    private $fileContent;
    private $unitCost;
    public function __construct($fileName, $magazines__fk, $issueNumber, $fileSize, $publicationDate, $fileContent, $unitCost) {
        $this->fileName = $fileName;
        $this->magazines__fk = $magazines__fk;
        $this->issueNumber = $issueNumber;
        $this->fileSize = $fileSize;
        $this->publicationDate = $publicationDate;
        $this->fileContent = $fileContent;
        $this->unitCost = $unitCost;
    }
    
    public function fileName() {
        return $this->fileName;
    }

    public function magazinesFk() {
        return $this->magazines__fk;
    }
    
    public function issueNumber() {
        return $this->issueNumber;
    }

    public function fileSize() {
        return $this->fileSize;
    }
    
    public function publicationDate() {
        return $this->publicationDate;
    }
    
    public function fileContent() {
        return $this->fileContent;
    }
    
    public function unitCost() {
        return $this->unitCost;
    }
}