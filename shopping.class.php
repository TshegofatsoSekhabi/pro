<?php
require("scripts/mysql.class.php");
class cart extends mysqlData
{
	private $total;
	private $obj;
	public $output="";
	
	function the_phones($session)
	{
		$output="";
		$this->obj=new mysqlData();
		foreach($session as $name =>$value)
		{
			if($value>0)
			{
				if(substr($name,0,5)=="cart_")
				{
					$id=substr($name,5,(strlen($name)-5));
					$output.=$this->obj->my_cart($id)."<td>".$value."</td>
					<td><a href='cart.php?add=$id'>[+]</a> <a href='cart.php?sub=$id'>[-]</a>
					 <a href='cart.php?remov=$id'>[remove]</a></td></tr>";					
					$this->total+= $this->obj->total_cost($id,$value);
					
				


		
				}
				
			}
		
	
		}
		return $output;	
	}
	function order_show($session)
	{
		$cart_info="";
		$this->obj=new mysqlData();
		foreach($session as $name =>$value)
		{
			if($value>0)
			{
				if(substr($name,0,5)=="cart_")
				{
					$id=substr($name,5,(strlen($name)-5));
					$output.=$this->obj->my_cart($id)."<td>".$value."</td>";					
					$this->total+= $this->obj->total_cost($id,$value);
		
				}
				
			}
		
	
		}
		return $output;	
	}

	function total_cost_to_pay()
	{
		$t=$this->total;
		$vat=$t*0.14;
		return "<br/><br/>"."Overall Total: R".$this->total."<br/> VAT: R".$vat;	
	}

	function cost()
	{
		return $this->total;	
	}

	function order($id,$total_cost,$total)
	{
		return $this->obj->order_details($id,$total_cost,$total);
	}
	

	function order_item($id,$session)
	{
		$this->obj->order_item($id,$session);
	}
	
}

?>