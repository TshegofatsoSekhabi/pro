<?php
require("mysql.class.php");
class Admin  extends mysqlData
{
	function check($username,$password,$staff)
	{
		$output="";
		if(isset($username)&&isset($password)&&isset($staff))
		{
			$output= mysqlData::login($username,$password,$staff);
		}
		return $output;
	}
}
?>