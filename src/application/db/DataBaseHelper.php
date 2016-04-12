<?php
namespace kioskon\application\db;

class DataBaseHelper{
    public $TABLE_USERS = 'users';
    public $USER_ID = '_id';
    public $USER_NAME = 'userName';
    public $PASSWORD = 'password';
    public $CREATION_TIME = 'creationTime';
    public $EMAIL = 'email';

    public $TABLE_MAGAZINES = 'magazines';
    public $MAGAZINE_ID = '_id';
    public $MAGAZINE_NAME = "magazineName";
    public $OWNER = "owner";
    public $PERIODICITY = "periodicity";

    public $TABLE_ISSUES = "issues";
    public $ISSUE_ID = '_id';
    public $FILE_NAME ="fileName";
    public $ISSUES_FK = "magazines__fk";
    public $ISSUE_NUMBER = "issueNumber";
    public $FILE_SIZE = "fileSize";
    public $PUBLICATION_DATE = "publicationDate";
    public $FILE_CONTENT = "fileContent";
    public $UNIT_COST = "unitCost";

    public $TABLE_PURCHASES = "purchases";
    public $PURCHASE_USER = '_idUser';
    public $PURCHASE_ISSUE= '_idIssue';
}