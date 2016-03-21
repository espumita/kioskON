<?php

namespace kioskon\model;


class IssueFilter {

    private $IssueFormData;

    public function __construct($IssueFormData) {
        $this->IssueFormData = $IssueFormData;
    }

    public function checkNumber() {
        return !filter_var($this->IssueFormData,FILTER_VALIDATE_INT) === false;
    }

    public function checkCost() {
        return !filter_var($this->IssueFormData,FILTER_VALIDATE_FLOAT) === false;
    }
}