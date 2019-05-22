<?php
/*
Author:			This code was generated by DALGen version 1.1.0.0 available at https://github.com/H0r53/DALGen
Date:			11/30/2017
Description:	This is a viewmodel for forum home. It does not represent a database table, but rather a composite type
*/



class Forumhome {

    // This is for local purposes only! In hosted environments the db_settings.php file should be outside of the webroot, such as: include("/outside-webroot/db_settings.php");
    protected static function getDbSettings() { return "DAL/db_localsettings.php"; }

    /******************************************************************/
    // Properties
    /******************************************************************/

    protected $forumId;
    protected $username;
    protected $title;
    protected $content;
    protected $createDate;
    protected $forumCategoryId;


    /******************************************************************/
    // Constructors
    /******************************************************************/
    public function __construct() {
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 0:
                self::__constructBase();
                break;
            case 6:
                self::__constructFull( $argv[0], $argv[1], $argv[2], $argv[3], $argv[4], $argv[5] );
        }
    }


    public function __constructBase() {
        $this->forumId = 0;
        $this->username = "";
        $this->title = "";
        $this->content = "";
        $this->createDate = "";
        $this->forumCategoryId = 0;
    }

    public function __constructFull($paramForumId,$paramUsername,$paramTitle,$paramContent,$paramCreateDate,$paramForumCategoryId) {
        $this->forumId = $paramForumId;
        $this->username = $paramUsername;
        $this->title = $paramTitle;
        $this->content = $paramContent;
        $this->createDate = $paramCreateDate;
        $this->forumCategoryId = $paramForumCategoryId;
    }


    /******************************************************************/
    // Accessors / Mutators
    /******************************************************************/

    public function getForumId(){
        return $this->forumId;
    }
    public function setForumId($value){
        $this->forumId = $value;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($value){
        $this->username = $value;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($value){
        $this->title = $value;
    }
    public function getContent(){
        return $this->content;
    }
    public function setContent($value){
        $this->content = $value;
    }
    public function getCreateDate(){
        return $this->createDate;
    }
    public function setCreateDate($value){
        $this->createDate = $value;
    }
    public function getForumCategoryId(){
        return $this->forumCategoryId;
    }
    public function setForumCategoryId($value){
        $this->forumCategoryId = $value;
    }

    // Static functions

    private static function setNullValue($value){
        if ($value == "")
            return null;
        else
            return $value;
    }

    public static function loadForumHome($paramContent,$paramForumCategoryId,$paramOffset) {
        include(self::getDbSettings());
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('CALL usp_Forum_LoadForumHome(?,?,?)');
        $arg1 = Forumhome::setNullValue($paramContent);
        $arg2 = Forumhome::setNullValue($paramForumCategoryId);
        $arg3 = Forumhome::setNullValue($paramOffset);
        $stmt->bind_param('sii',$arg1,$arg2,$arg3);
        $stmt->execute();

        $result = $stmt->get_result();
        if (!$result) die($conn->error);
        if ($result->num_rows > 0) {
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                $forumhome = new Forumhome($row['id'],$row['username'],$row['title'],$row['content'],$row['createDate'],$row['forumCategoryId']);
                $arr[] = $forumhome;
            }
            return $arr;
        }
        else {
            $arr = array();
            return $arr;
        }
    }
}