<?php
require("scripts/mysql.class.php");
class products extends mysqlData
{
	
	function add_product($name,$price,$descrip,$category,$subcategory)
	{
		$obj=new mysqlData();
		$id=0;
		if(isset($name)&&isset($price)&&isset($descrip)&&isset($category))
		{
			$id=$obj->add_stock($name,$price,$descrip,$category);	
		}
		else
		{
			$id= "All fields are required <a href='../Inventory.php'>Click Here</a>";	
			exit;
		}
		return $id;
	} 
	
	function all_pro()
	{
		$obj=new mysqlData();
		$data =  $obj->all_stock();
		return $data;
	}
	function return_for_edit($id)
	{
		$obj=new mysqlData();
		$data=$obj->editing_products($id);
		return $data;
	}
	
	function edit($name,$price,$descrip,$category,$id)
	{
		$obj=new mysqlData();
		$obj->edit_rec($name,$price,$descrip,$category,$id);
	}
	function del($id)
	{
		$obj=new mysqlData();
		$obj->delete_product($id);
		$pic_del=("images/$id.jpg");		
		
		if(file_exists($pic_del))
		{
			unlink($pic_del);	
		}
	}
}


?>