<?php

class CategoryRepo
{	
		

//get all categories
	public function getCategories()
	{
		$rs = Category::get();

		if(!empty($rs))
		{
			return $rs;
		}		
		
		
	}

//delete a category
	public function delCategory($id)
	{
		$rec = Category::where('id','=',$id)->first();

		if(!empty($rec))
		{
			$rec->delete();
			return true;
		}
		else
			return false;
	}

//get a single category
	public function getCategory($id)
	{
		$rs = Category::find($id);
		if(!empty($rs))
		{
			return array('id' => $id, 'name'=> $rs->name);
		}
		else
		{
			return false;
		}
	}

//update a category
	public function updateCategory($id,$name)
	{
		$count = Category::where('id','=',$id)->count();
		if($count == 0)
		{
			return false;
		}
		else
		{
			$update = Category::where('id', $id)->update(array('name' => $name));
            return true;
		}
	}

//add a category	
	public function insertCategory($name)
	{
		$insert = Category::insert(array('name'=>$name));
		if($insert)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	
}

?>