<?php 
class Databases{
	public function dbconnect()
	{
		$GLOBALS['servername'] = "localhost";
$GLOBALS['username'] = "root";
$GLOBALS['password'] = "";
//$GLOBALS['dbname ']= "projecttest";
$GLOBALS['$db']=mysqli_connect($GLOBALS['servername'],$GLOBALS['username'], $GLOBALS['password']);
		if(!$GLOBALS['$db'])
		{
			echo"db not available";
			
		}
		else{
			//echo"we have this available";
			
		
			
		}
		
	}
	public function create_database()
	{
		$getdbconnect=$this->dbconnect();
		$sql="create database  projecttest";
		$GLOBALS['result']=mysqli_query($GLOBALS['$db'],$sql);
		
		$this->tablecreate();
	}
	
	
	public function connect()
	{
		
		$getdbconnect=$this->dbconnect();
		/*$GLOBALS['servername'] = "localhost";
        $GLOBALS['username'] = "root";
        $GLOBALS['password'] = "";*/
		$GLOBALS['dbname']= "projecttest";
		$GLOBALS['con']=mysqli_connect($GLOBALS['servername'],$GLOBALS['username'], $GLOBALS['password'],$GLOBALS['dbname']);
		
		
	}
	public function checktable_exist()
	{
		//This to check table
		$table=$this->connect();
		$sql="select 1 from `projecttables` LIMIT 1";
		$GLOBALS['table_exist']=mysqli_multi_query($GLOBALS['con'],$sql);
		
	}
	public function checkdatabase_exist()
	{
		//this function is important but i did not use it on this project
		$this->dbconnect();
		$sql="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='projecttest'";
		$GLOBALS['database_exist']=mysqli_query($GLOBALS['$db'],$sql);
		if(mysqli_num_rows($GLOBALS['database_exist'])>0)
		{
			echo"database available";
		}
		else{
			
			echo"database is not available";
		}
	}
	public function tablecreate()
	{
		$table=$this->connect();
		include("connect.php");
				$sql = "CREATE TABLE `projecttables` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `projecttables`
  ADD PRIMARY KEY (`id`);
  ALTER TABLE `projecttables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
 
  ";
		$result=mysqli_multi_query($GLOBALS['con'],$sql);
if($result)
{
		header('LOCATION:http://localhost:8000/');
}
		else{
			echo"table exist then navigate to,";
			
		}

	}
	
	public function main()
	{
		//THIS IS TO CHECK IF TABLE OR DATABASE AVAILABLE
		
		
		$table=$this->create_database();
		$table=$this->checktable_exist();
		
		if($GLOBALS['result'])
		{
			
			$this->create_database();
			
		}
		else{
			echo"database is available";
			//DATABASE IS AVAILABLE
			//CHECK IF TABLE IS AVAILABLE
			if($GLOBALS['table_exist'])
		{
			echo"table is available";
			//TABLE IS AVAILABLE
			//NAVIGATE TO THIS LINK
			header('LOCATION:http://localhost:8000/');
		}
		else{
			echo"table is not available";
			//TABLE IS NOT AVAILABLE
			//CREATE A TABLE
			$this->tablecreate();
		}
		}
		
		
		
	}
	
}
$database=new Databases;

$database->main();
//$database->checkdatabase_exist();


?>