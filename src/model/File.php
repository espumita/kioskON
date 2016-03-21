<?php

namespace kioskon\model;

class File {

    private $inputFile;

    public function __construct($inputFile) {
        $this->inputFile = $inputFile;
    }

    public function content() {
        $file = fopen($_FILES[$this->inputFile]['tmp_name'], 'r');
        $fileContent = addslashes(fread($file, filesize($_FILES[$this->inputFile]['tmp_name'])));
        fclose($file);
        return $fileContent;
    }

}