<?php
class Category extends Database
{
	function __construct()
	{
		parent::__construct();
	}
	function category_parentid($parentid=0)
	{
		$sql="SELECT * FROM latnt_category WHERE status='1' AND parentid='$parentid' ORDER BY orders ASC";
		return $this->QueryAll($sql);
	}

function category_rowslug($slug)
	{
		$sql="SELECT * FROM latnt_category WHERE status='1' AND slug='$slug'";
		return $this->QueryOne($sql);
	}
function category_listid($parentid)
	{
		$arr=array();
		$arr[]=$parentid;
		$list1=$this->category_parentid($parentid);
		if(count($list1))
		{
			foreach($list1 as $row1)
			{
				$arr[]= $row1['id'];
				$list2=$this->category_parentid($row1['id']);
				if(count($list2))
				{
					foreach($list2 as $row2)
					{
						$arr[]= $row2['id'];
						$list3=$this->category_parentid($row2['id']);
						if(count($list3))
						{
							foreach($list3 as $row3)
							{
								$arr[]= $row3['id'];
							}
						}
					}
				}
			}
		}
		return $arr;
	}
}
  ?>