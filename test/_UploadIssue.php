<?php
use kioskon\model\IssueFilter;

require_once __DIR__.'/../vendor/autoload.php';

class _UploadIssue extends PHPUnit_Framework_TestCase{
    public function test_issue_num_upload_filter(){
        $this->assertFalse((new IssueFilter("A"))->checkNumber());
        $this->assertTrue((new IssueFilter("2"))->checkNumber());
        $this->assertFalse((new IssueFilter(""))->checkNumber());
    }
    public function test_issue_cost_upload_filter(){
        $this->assertTrue((new IssueFilter("2.99"))->checkCost());
        $this->assertFalse((new IssueFilter("1,99"))->checkCost());
        $this->assertTrue((new IssueFilter("3"))->checkCost());
        $this->assertFalse((new IssueFilter("A"))->checkCost());
        $this->assertFalse((new IssueFilter(""))->checkCost());
    }
}