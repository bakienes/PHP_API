<?php 
	class Database
	{
		public $db;

		function __construct()
		{
			try {
    			 $db = new PDO("mysql:host=localhost;dbname=api", "root", "");
				} catch ( PDOException $e )
				{
     				print $e->getMessage();
				}
		}
	}
?>
