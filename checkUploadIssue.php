<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseInsert;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;
use kioskon\model\File;
use kioskon\model\Issue;
use kioskon\model\IssueFilter;

session_start();
if(!Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

if(!Check::post('number') || !Check::post('cost') || !Check::post('magazines'))(new Redirection())->to("index.php?BadForm=badForm");

if(!Check::files('userFile'))(new Redirection())->to("index.php?BadFile=noFile");

if(!(new IssueFilter($_POST['number']))->checkNumber() || !(new IssueFilter($_POST['cost']))->checkCost())(new Redirection())->to("index.php?BadForm=DataError");

if(!Check::fileSize('userFile'))(new Redirection())->to("index.php?BadFile=badFileSize");

if(!Check::fileExtension('userFile',['pdf']))(new Redirection())->to("index.php?BadFile=badFileExtension");

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");

if((new DataBaseInsert($dbConnection->connection()))->inTableIssues(new Issue(
    $_FILES['userFile']['name'],
    $_POST['magazines'],
    $_POST["number"],
    $_FILES['userFile']['size'],
    date("Y-m-d H:i:s"),
    (new File("userFile"))->content(),
    $_POST["cost"])))(new Redirection())->to("index.php?issueInsert=Ok");

$dbConnection->quit();
(new Redirection())->to("index.php?BadIssueInsert=wrongFormInfo");
