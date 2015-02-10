<?php

class CategoryController extends BaseController{
	
//add a category
	public function addCategory()
	{
		$name    	= Input::get('name');
		$resp 		= new CategoryRepo;
		$resp 		= $resp->insertCategory($name);

	}

//get category detail. if id is given returns a particular category details else return all categories
	public function getCategory()
	{
		$id 		= Input::get('id');
		$repo 		= new CategoryRepo;
		if(!empty($id))
		{
			$resp 	= $repo->getCategory($id);
			echo json_encode($resp);
		}
		else
		{
			$resp 	= $repo->getCategories();
			echo json_encode($resp);
		}

	}

//delete a category
	public function dltCategory()
	{
		$id		 	= Input::get('id');
		$repo 		= new CategoryRepo;
		$resp 		= $repo->delCategory($id);
	}

//update category
	public function editCategory()
	{
		$id 		= Input::get('id');
		$name 		= Input::get('name');
		$repo 		= new CategoryRepo;
		$resp 		= $repo->updateCategory($id,$name);
	}
	
}

?>