<?php

class CategoryRepo
{	
		

	/*
		get all categories
	*/
	public function getCategories()
	{
		$rs = Category::get();

		if(!empty($rs))
		{
			return $rs;
		}		
		
		
	}

	/*
		delete a category
	*/
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

	/*
		get a single category
	*/
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

	/*
		update a categorypublic function updateCategory($id,$name)
	*/
	public function updateCategory($id,$name)
 	{
  		$cat = Category::find($id);
 		if(!empty($cat))
  		{
   			$cat->name = $name;
   			$cat->update();
   			return true;
  		}
  		else
  		{
   			return false;
  		}
 	}

	/*
		add a category	
	*/
	public function insertCategory($name)
 	{
 		$cat = new Category;
  		$cat->name = $name;
  		if($cat->save())
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