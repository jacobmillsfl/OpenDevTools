<?php
/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/15/2017
Description:	Creates the DAL class for  Blog table and respective stored procedures

*/



class Blog implements Serializable {

	// This is for local purposes only! In hosted environments the db_settings.php file should be outside of the webroot, such as: include("/outside-webroot/db_settings.php");
	protected static function getDbSettings() { return "DAL/db_localsettings.php"; }

	/******************************************************************/
	// Properties
	/******************************************************************/

	protected $id;
	protected $userId;
	protected $title;
	protected $content;
	protected $imgUrl;
	protected $createDate;
	protected $blogCategoryId;
	protected $views;


	/******************************************************************/
	// Constructors
	/******************************************************************/
	public function __construct() {
		$argv = func_get_args();
		switch( func_num_args() ) {
			case 0:
				self::__constructBase();
				break;
			case 1:
				self::__constructPK( $argv[0] );
				break;
			case 8:
				self::__constructFull( $argv[0], $argv[1], $argv[2], $argv[3], $argv[4], $argv[5], $argv[6], $argv[7] );
		}
	}


	public function __constructBase() {
		$this->id = 0;
		$this->userId = 0;
		$this->title = "";
		$this->content = "";
		$this->imgUrl = "";
		$this->createDate = "";
		$this->blogCategoryId = 0;
		$this->views = 0;
	}


	public function __constructPK($paramId) {
		$this->load($paramId);
	}


	public function __constructFull($paramId,$paramUserId,$paramTitle,$paramContent,$paramImgUrl,$paramCreateDate,$paramBlogCategoryId,$paramViews) {
		$this->id = $paramId;
		$this->userId = $paramUserId;
		$this->title = $paramTitle;
		$this->content = $paramContent;
		$this->imgUrl = $paramImgUrl;
		$this->createDate = $paramCreateDate;
		$this->blogCategoryId = $paramBlogCategoryId;
		$this->views = $paramViews;
	}


	/******************************************************************/
	// Accessors / Mutators
	/******************************************************************/

	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id = $value;
	}
	public function getUserId(){
		return $this->userId;
	}
	public function setUserId($value){
		$this->userId = $value;
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
	public function getImgUrl(){
		return $this->imgUrl;
	}
	public function setImgUrl($value){
		$this->imgUrl = $value;
	}
	public function getCreateDate(){
		return $this->createDate;
	}
	public function setCreateDate($value){
		$this->createDate = $value;
	}
	public function getBlogCategoryId(){
		return $this->blogCategoryId;
	}
	public function setBlogCategoryId($value){
		$this->blogCategoryId = $value;
	}
	public function getViews(){
		return $this->views;
	}
	public function setViews($value){
		$this->views = $value;
	}


	/******************************************************************/
	// Public Methods
	/******************************************************************/

    public function serialize() {
        return serialize($this);
    }
    public function unserialize($data) {
        return unserialize($data);
    }


	public function load($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_Blog_Load(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);

		while ($row = $result->fetch_assoc()) {
		 $this->setId($row['id']);
		 $this->setUserId($row['userId']);
		 $this->setTitle($row['title']);
		 $this->setContent($row['content']);
		 $this->setImgUrl($row['imgUrl']);
		 $this->setCreateDate($row['createDate']);
		 $this->setBlogCategoryId($row['blogCategoryId']);
		 $this->setViews($row['views']);
		}
	}


	public function save() {

	    // Default Blog image to site logo
	    if ($this->getImgUrl() == "")
        {
            $this->setImgUrl("/images/opendevtoolslogo.png");
        }


		if ($this->getId() == 0)
			$this->insert();
		else
			$this->update();
	}

	/******************************************************************/
	// Private Methods
	/******************************************************************/



	private function insert() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_Blog_Add(?,?,?,?,?,?,?)');
		$arg1 = $this->getUserId();
		$arg2 = $this->getTitle();
		$arg3 = $this->getContent();
		$arg4 = $this->getImgUrl();
		$arg5 = $this->getCreateDate();
		$arg6 = $this->getBlogCategoryId();
		$arg7 = $this->getViews();
		$stmt->bind_param('issssii',$arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		while ($row = $result->fetch_assoc()) {
			// By default, the DALGen generated INSERT procedure returns the scope identity as id
			$this->load($row['id']);
		}
	}


	private function update() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_Blog_Update(?,?,?,?,?,?,?,?)');
		$arg1 = $this->getId();
		$arg2 = $this->getUserId();
		$arg3 = $this->getTitle();
		$arg4 = $this->getContent();
		$arg5 = $this->getImgUrl();
		$arg6 = $this->getCreateDate();
		$arg7 = $this->getBlogCategoryId();
		$arg8 = $this->getViews();
		$stmt->bind_param('iissssii',$arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7,$arg8);
		$stmt->execute();
	}

	private static function setNullValue($value){
		if ($value == "")
			return null;
		else
			return $value;
	}

	/******************************************************************/
	// Static Methods
	/******************************************************************/



	public static function loadall() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_Blog_LoadAll()');
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
        $arr = array();
        if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$blog = new Blog($row['id'],$row['userId'],$row['title'],$row['content'],$row['imgUrl'],$row['createDate'],$row['blogCategoryId'],$row['views']);
				$arr[] = $blog;
			}
		}
		else {

			//die("The query yielded zero results.No rows found.");
		}

        return $arr;

    }


	public static function remove($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_Blog_Remove(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();
	}


	public static function search($paramId,$paramUserId,$paramTitle,$paramContent,$paramImgUrl,$paramCreateDate,$paramBlogCategoryId,$paramViews) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_Blog_Search(?,?,?,?,?,?,?,?)');
		$arg1 = Blog::setNullValue($paramId);
		$arg2 = Blog::setNullValue($paramUserId);
		$arg3 = Blog::setNullValue($paramTitle);
		$arg4 = Blog::setNullValue($paramContent);
		$arg5 = Blog::setNullValue($paramImgUrl);
		$arg6 = Blog::setNullValue($paramCreateDate);
		$arg7 = Blog::setNullValue($paramBlogCategoryId);
		$arg8 = Blog::setNullValue($paramViews);
		$stmt->bind_param('iissssii',$arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7,$arg8);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$blog = new Blog($row['id'],$row['userId'],$row['title'],$row['content'],$row['imgUrl'],$row['createDate'],$row['blogCategoryId'],$row['views']);
				$arr[] = $blog;
			}
			return $arr;
		}
		else {
			die("The query yielded zero results.No rows found.");
		}
	}

}
