<?php

class CategoryRepo
{	
		

	/*
		Get All Categories
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
		Delete A Category
	*/
	public function delCategory($id)
	{
		$rec = Category::where('id','=',$id)->first();

		if(!empty($rec))
		{
			$rec->delete();
			$video = Video::where('category_id','=',$id)->update('category_id','=','0');
			return true;
		}
		else
			return false;
	}

	/*
		Get A Single Category
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
		Update A Category
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
		Add A Category	
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