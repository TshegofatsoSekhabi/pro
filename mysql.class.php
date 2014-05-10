<?php
require("connection.class.php");
class mysqlData extends connection
{
	private $connect1;
	public $output="";
	
	function login($username,$password,$admin_type)		
	{
		$output1="";
		$this->connect1=connection::connect();
		
		$query="select * from admin where USERNAME='".$username."' 
		and PASSWORD='".$password."' and STAFF='".$admin_type."'";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		if($num_row==1)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				
				if($rows['STAFF']!= "superadmin")
				{
					$output="user does not exist";
				}
				elseif($rows['STAFF']!= "admin")
				{
					$output="user does not exist";
				}
			}
		}
		return $output1;
	}
	
	
	function add_stock($name,$price,$descrip,$category)
	{
		$this->connect1=connection::connect();
			
		$query="insert into product values(null,'$name','$price','$descrip','$category')";
		$result=$this->connect1->query($query);
		$output=mysqli_insert_id($this->connect);	
	
	
	return $output;
	}
	
	
	function all_stock()
	{
		$this->connect1=connection::connect();
		$query="select id, product_name from product";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$id=$rows['id'];
				$pro=$rows['product_name'];
				
				$output.=$id." ".$pro." "."<a href='edit.php?edit=$id'>edit</a> <a href='Inventory.php?delete=$id'>Delete</a>"."<br/>";
			}
		}
		return $output;
	}
	
	function delete_product($id)
	{
		$this->connect1=connection::connect();
		$query="delete from product where id='$id'";
		$result=$this->connect1->query($query);		
	}
	
	function editing_products($id)
	{
	
		$this->connect1=connection::connect();
		$query="select * from product where id='$id'";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		$data="";
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$data[0]=$rows['product_name'];
				$data[1]=$rows['price'];
				$data[2]=$rows['details_text'];
				$data[3]=$rows['category'];
				$data[4]=$rows['id'];
				
				       
				
			}
		}
		return $data;
	}
	
	
	function edit_rec($name,$price,$descrip,$category,$id)
	{
	
		$this->connect1=connection::connect();
		$query="update product set product_name='$name',price='$price',details_text='$descrip',category='$category' where id='$id'";
		$result=$this->connect1->query($query);	
		
	}
	
	function samsung_select()
	{
		
		$id="";
		$prod="";
		$price="";
		
	$this->connect1=connection::connect();
		$query="select * from product";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$samsung=$rows['category'];
				if($samsung=="samsung")
				{
					$id=$rows['product_id'];
					$prod=$rows['product_name'];
					$price=$rows['price'];
			$output='<table border="0" cellspacing="0" cellpadding="6">
	<tr>			
		<td width="8%" valign="top">
		<a href="product.php?id='.$id.'">
		<img style="border:#666 1px solid;" src="images/phone/'.$id.'.jpg" height="50" border="1" /></a></td>
		<td valign="top">'.$prod.'<br/> R'.$price.'<br/>
		<a href="viewCart.php?id='.$id.'">ADD TO CART </a>
		</tr> 		
				</table>';     
				}
			}
		}
		return $output;
	}
	
	function nokia_select()
	{
		
		
		$this->connect1=connection::connect();
		$query="select * from product";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
	
		$id="";
		$prod="";
		$price="";
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$nokia=$rows['category'];
				if($nokia=="nokia")
				{
					$id=$rows['product_id'];
					$prod=$rows['product_name'];
					$price=$rows['price'];
		$output='<table border="0" cellspacing="0" cellpadding="6">
	<tr>			
		<td width="8%" valign="top">
		<a href="product.php?id='.$id.'">
		<img style="border:#666 1px solid;" src="images/phone/'.$id.'.jpg" height="50" border="1" /></a></td>
		<td valign="top">'.$prod.'<br/> R'.$price.'<br/>
		<a href="viewCart.php?id='.$id.'">ADD TO CART </a>
		</tr> 		
				</table>';    
				}
			
  
				
			}
		}
		return $output;
	}
	
	function other_phones()
	{
		$id="";
		$prod="";
		$price="";
		$output="";
		
		$this->connect1=connection::connect();
		$query="select * from product";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$other=$rows['category'];
				if($other=="other")
				{
					$id=$rows['product_id'];
					$prod=$rows['product_name'];
					$price=$rows['price'];
		$output='<table border="0" cellspacing="0" cellpadding="6">
	<tr>			
		<td width="8%" valign="top">
		<a href="product.php?id='.$id.'">
		<img style="border:#666 1px solid;" src="images/phone/'.$id.'.jpg" height="150" border="1" /></a></td>
		<td valign="top">'.$prod.'<br/> R'.$price.'<br/>
		<a href="viewCart.php?id='.$id.'">ADD TO CART </a>
		</tr> 		
				</table>';     
				}
			}
		}
		return $output;
	}

	function view_specific_product($id)
	{
		$this->connect1=connection::connect();
		$display="";
		$query="select * from product where product_id='$id'";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$product=$rows['product_name'];
				$price=$rows['price'];
				$details=$rows['details_text'];
				$category=$rows['category'];  
				$output=$product."<br/></br/> R".$price."<br/></br/>".$details."<br/></br/>".$category;  
				
			}
		}
		return $output;	
	}
	
	
	function my_cart($id)
	{
		$output="";
		$this->connect1=connection::connect();
		$query="select * from product where product_id=3";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$id=$rows['product_id']; 
				$product=$rows['product_name'];
				$price=$rows['price'];
				$details=$rows['details_text'];
				$category=$rows['category'];
				$output.="<tr>";
				$output.="<td><a href=./newPhone.php?product_id=$id>$product</a><br/><img src=\"images/phone/$id.jpg\" alt=\"$product\" width=\"50\" height=\"60\" border=\"1\" </td>";
				$output.="<td>".$details."</td>";
				$output.="<td>".$price."</td>";
				$output.="<td>".$category."</td>";
				//$output.="<td>".$subcategory."</td>";	
				
			}
		}
		return $output;
	}
	
	function total_cost($id,$value)
	{
		$this->connect1=connection::connect();
		$subtotal="";
		$total="";
		$query="select * from product where product_id=$id";
		$result=$this->connect1->query($query);	
		$num_row=$result->num_rows;
		
		if($num_row>0)
		{
			for($a=0; $a<$num_row; $a++)
			{
				$rows=$result->fetch_assoc();
				$price=$rows['price'];
				$subtotal=$value*$price;
			}
		}
		return $subtotal;
	}
	function search($search)
	{
		$this->connect1=connection::connect();
		$search_result=0;
		$query="select * from product where product_name='$search'";
		$result=$this->connect->query($query);
		$numRows=$result->num_rows;
		
		for($a=0;$a<$numRows;$a++)
		{
			$rows=$result->fetch_assoc();
			$search_result=$rows['id'];
				
		}
		
		return $search_result;
		
	}
	function user_login($email,$password)
	{
		$id=0;
		$this->connect1=connection::connect();
		$query="select * from user where EMAIL='$email' and PASSWORD='$password'";
		$result=$this->connect1->query($query);
		$num_row=$result->num_rows;	
		if($num_row==1)
		{
			$row=$result->fetch_assoc();
			$id=$row['USER_NUM'];
		}
		return $id;

	}
	function order_details($id,$total_cost,$total)
	{
		$this->connect1=connection::connect();
		
		$date=date('jS - F - Y / H:i,');
		$query="insert into order values(null,'".$id."','".$total_cost."','".$total."','".$date."')";
		$result=$this->connect1->query($query);	
		$current_id=mysqli_insert_id($this->connect);
		return $current_id;
	
	}
		

	function getStatus($id_num)
		{
			$status="";
			$name="";
			$surname="";
			$id_number="";
			$total_payed="";
			$date="";
			$this->connect1=connection::connect();
			$query="select id_number from user where id_number='$id_num'";
			$result=$this->connect1->query($query);
			$numRows=$result->num_rows;
			
			if($numRows >0)
			{
				$query="select u.name, surname, id_number,o.order_id,amout_payed,item_name, date from users u, orders o, items i  where u.user_id=o.user_id and o.order_id=i.order_id and id_number='$id_num'";	
				$result=$this->connect1->query($query);
				$numRows=$result->num_rows;
				
				for($x=0; $x<$numRows; $x++)
				{
					$rows=$result->fetch_assoc();
					$name=$rows['name'];
					$surname=$rows['surname'];
					$id_number=$rows['id_number'];	
					$order_id=$rows['order_id'];
					$amout_payed=$rows['amout_payed'];
					$item_name=$rows['item_name'];
					$date=$rows['date'];
					$total_payed+=$amout_payed;
	$status.="Order_id: ".$order_id."<br/ >"."Amount_payed: ".$amout_payed."<br/ >"."Items_Name: ".$item_name."<br/ >".$date."<br/ ><br />";

				}
			}
			$output = "<br/>Name: ".$name."<br/ >"."Surname: ".$surname."<br/ >"."id_number: ".$id_number."<br/ >"."<br/> <br/>".$status."<br/ ><br />"."Total Amount Payed: R".$total_payed;
			
			return $output;
		}
	
	function getAllAdmin()
	{
		$id="";
		$this->connect1=connection::connect();
		$query="Select id, username, privilages from admin where privilages='admin'"	;
		$result=$this->connect1->query($query);
		$numRows=$result->num_rows;
		
		if($numRows>0)
		{
			for($x=0; $x<$numRows; $x++)
			{
				$row=$result->fetch_assoc();
				$id=$row['id'];
				$username=$row['username'];
				$privilages=$row['privilages'];
				
				$output.=$username." ".$privilages."  "."<a href=customer_list.php?delAdmin=$id>Remove Admin</a>"."<br/><br/>";    
			}
		}
		return $output;
	}
	
	function getAllCustomers()
	{
		$id="";
		$this->connect1=connection::connect();
		$query="Select user_id, name, surname, address,email from users"	;
		$result=$this->connect1->query($query);
		$numRows=$result->num_rows;
		
		if($numRows>0)
		{
			for($x=0; $x<$numRows; $x++)
			{
				$row=$result->fetch_assoc();
				$id=$row['user_id'];
				$name=$row['name'];
				$surname=$row['surname'];
				$address=$row['address'];
				$email=$row['email'];
				
				$output.=$name." ".$surname."  ".$address."  ".$email."  "."<a href=customer_list.php?del=$id>Remove User</a> - <a href=mail.php?mail_id=$id>Send Mail</a>"."<br/><br/>";    
			}
		}
		return $output;
	}
	
	function order_item($order_id,$session)
	{
		$product_name="";
		foreach($session as $name =>$value)
		{
			if($value>0)
			{
				if(substr($name,0,5)=="cart_")
				{
					$id=substr($name,5,(strlen($name)-5));
					$query="select * from product where id=$id";
					$result=$this->connect1->query($query);
					$rows=$result->fetch_assoc();
					$product_name=$rows['product_name'];
					
					$insertQuery="insert into stock values('".$order_id."','"."null"."','".$product_name."')";
					$insertResult=$this->connect->query($insertQuery);
				}
				
				
			}
		
	
		}
		
	}
	
	function getEmail($id)
	{
		$this->connect1=connection::connect();
		$query="select email from user where user_id='$id'";
		$result=$this->connect1->query($query);
		$num_row=$result->num_rows;	
		
		if($num_row>0)
		{
			$row=$result->fetch_assoc();
			$email=$row['email'];
		}
		return $output;

			
	}
	function deleteUser($id)
	{
		$this->connect1=connection::connect();
		$query="delete from user where user_id='$id'";
		$result=$this->connect1->query($query);	
	}
	

	function deleteAdmin($id)
	{
		$this->connect1=connection::connect();
		$query="delete from admin where id='$id'";
		$result=$this->connect1->query($query);	
	}

	function register($username, $password,$admin_type)
	{
		$this->connect1=connection::connect();
		$query="Insert into admin values(null,'".$username."','".$password."','".$admin_type."')";
		$result=$this->connect1->query($query);			
	}

	function register_user($name,$lastname,$address,$email,$password,$id_num)
	{
		$this->connect1=connection::connect();
		$msg=0;
		$query="select * from user where EMAIL='$email'";
		$result=$this->connect1->query($query);
		$numRows=$result->num_rows;
		
		if($numRows >0)
		{
			$output=$numRows;
		}
		
			$query="insert into user values(null,'".$name."','".$lastname."','".$address."','".$email."','".$id_num."','".$password."')";
			
			$result=$this->connect1->query($query);	
			$output = "registered";
		
		return $output;
	}
	
	

}

?>