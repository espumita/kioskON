<?php
require_once __DIR__.'/../vendor/autoload.php';
use kioskon\model\RegisterFilter;

class _Register extends PHPUnit_Framework_TestCase {

   public function test_user_name_filter() {
       $this->assertTrue((new RegisterFilter("admin"))->check());
       $this->assertFalse((new RegisterFilter("admi"))->check());
       $this->assertTrue((new RegisterFilter("admi1"))->check());
       $this->assertFalse((new RegisterFilter(""))->check());
   }

   public function test_password_filter() {
       $this->assertTrue((new RegisterFilter("admin"))->check());
       $this->assertFalse((new RegisterFilter("admi"))->check());
       $this->assertTrue((new RegisterFilter("admi1"))->check());
       $this->assertFalse((new RegisterFilter(""))->check());
   }

  public function test_email_filter() {
      $this->assertTrue((new RegisterFilter("test@test.test"))->checkEmail());
      $this->assertFalse((new RegisterFilter("@test.test"))->checkEmail());
      $this->assertFalse((new RegisterFilter("test@testtest"))->checkEmail());
      $this->assertFalse((new RegisterFilter("te@st@tes.ttest"))->checkEmail());
      $this->assertFalse((new RegisterFilter(""))->checkEmail());
  }
}