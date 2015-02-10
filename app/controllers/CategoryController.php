<?php

class CategoryController extends BaseController{
	
	private $repo;
    public function __construct(CategoryRepo $categoryRepo){
    	$this->repo = $categoryRepo;
    }


	/*
		add a category
	*/
	public function addCategory()
	{
		$name    	= Input::get('name');
		$resp 		= $this->repo->insertCategory($name);

	}

	/*
		get category detail. if id is given returns a particular category details else return all categories
	*/
	public function getCategory()
	{
		$id 		= Input::get('id');
		if(!empty($id))
		{
			$resp 	= $this->repo->getCategory($id);
			echo json_encode($resp);
		}
		else
		{
			$resp 	= $this->repo->getCategories();
			echo json_encode($resp);
		}

	}

	/*
		delete a category
	*/
	public function dltCategory()
	{
		$id		 	= Input::get('id');
		$resp 		= $this->repo->delCategory($id);
	}

	/*
		update category
	*/
	public function editCategory()
	{
		$id 		= Input::get('id');
		$name 		= Input::get('name');
		$resp 		= $this->repo->updateCategory($id,$name);
	}
	
}

?>