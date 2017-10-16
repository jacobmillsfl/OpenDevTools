<?php
/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/15/2017
Description:	Creates the DAL class for  RoleToPermission table and respective stored procedures

*/



class RoleToPermission {

	// This is for local purposes only! In hosted environments the db_settings.php file should be outside of the webroot, such as: include("/outside-webroot/db_settings.php");
	protected static function getDbSettings() { return "DAL/db_localsettings.php"; }

	/******************************************************************/
	// Properties
	/******************************************************************/

	protected $Id;
	protected $UserRoleId;
	protected $PermissionId;


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
			case 3:
				self::__constructFull( $argv[0], $argv[1], $argv[2] );
		}
	}


	public function __constructBase() {
		$this->Id = 0;
		$this->UserRoleId = 0;
		$this->PermissionId = 0;
	}


	public function __constructPK($paramId) {
		$this->load($paramId);
	}


	public function __constructFull($paramId,$paramUserRoleId,$paramPermissionId) {
		$this->Id = $paramId;
		$this->UserRoleId = $paramUserRoleId;
		$this->PermissionId = $paramPermissionId;
	}


	/******************************************************************/
	// Accessors / Mutators
	/******************************************************************/

	public function getId(){
		return $this->Id;
	}
	public function setId($value){
		$this->Id = $value;
	}
	public function getUserRoleId(){
		return $this->UserRoleId;
	}
	public function setUserRoleId($value){
		$this->UserRoleId = $value;
	}
	public function getPermissionId(){
		return $this->PermissionId;
	}
	public function setPermissionId($value){
		$this->PermissionId = $value;
	}


	/******************************************************************/
	// Public Methods
	/******************************************************************/


	public function load($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_RoleToPermission_Load(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);

		while ($row = $result->fetch_assoc()) {
		 $this->setId($row['Id']);
		 $this->setUserRoleId($row['UserRoleId']);
		 $this->setPermissionId($row['PermissionId']);
		}
	}


	public function save() {
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
		$stmt = $conn->prepare('CALL usp_RoleToPermission_Add(?,?)');
		$arg1 = $this->getUserRoleId();
		$arg2 = $this->getPermissionId();
		$stmt->bind_param('ii',$arg1,$arg2);
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
		$stmt = $conn->prepare('CALL usp_RoleToPermission_Update(?,?,?)');
		$arg1 = $this->getId();
		$arg2 = $this->getUserRoleId();
		$arg3 = $this->getPermissionId();
		$stmt->bind_param('iii',$arg1,$arg2,$arg3);
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
		$stmt = $conn->prepare('CALL usp_RoleToPermission_LoadAll()');
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$roleToPermission = new RoleToPermission($row['Id'],$row['UserRoleId'],$row['PermissionId']);
				$arr[] = $roleToPermission;
			}
			return $arr;
		}
		else {
			die("The query yielded zero results.No rows found.");
		}
	}


	public static function remove($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_RoleToPermission_Remove(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();
	}


	public static function search($paramId,$paramUserRoleId,$paramPermissionId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_RoleToPermission_Search(?,?,?)');
		$arg1 = RoleToPermission::setNullValue($paramId);
		$arg2 = RoleToPermission::setNullValue($paramUserRoleId);
		$arg3 = RoleToPermission::setNullValue($paramPermissionId);
		$stmt->bind_param('iii',$arg1,$arg2,$arg3);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$roleToPermission = new RoleToPermission($row['Id'],$row['UserRoleId'],$row['PermissionId']);
				$arr[] = $roleToPermission;
			}
			return $arr;
		}
		else {
			die("The query yielded zero results.No rows found.");
		}
	}
}
