<?php

class CategoryController extends BaseController{
	
	private $repo;
    public function __construct(CategoryRepo $categoryRepo){
    	$this->repo = $categoryRepo;
    }


	/*
		Add A Category
	*/
	public function addCategory()
	{
		$name    	= Input::get('name');
		$validator  = Validator::make(
					    array('name' => $name),
					    array('name' => 'required')
					);
		if($validator->fails())
		{
			return false;
		}
		else
		{
			$resp 	= $this->repo->insertCategory($name);
			if($resp)
			  {
				   $status = 200;
				   $data   = $resp;
			  }
			  else
			  {
			       $status = 401;
			       $data   = array('error'=>array('message'=>'hours status updated',
			                   'type'=>'Unauthorized',
			                   'code'=>401));
			  }
  
        	return Response::json($data,$status);
		}

	}

	/*
		Get Category Detail. If id is given, returns a particular category details else return all categories
	*/
	public function getCategory()
	{
		$id 		= Input::get('id');
		if(!empty($id))
		{
			$resp 	= $this->repo->getCategory($id);
			if($resp)
			  {
				   $status = 200;
				   $data   = $resp;
			  }
			  else
			  {
			       $status = 401;
			       $data   = array('error'=>array('message'=>'hours status updated',
			                   'type'=>'Unauthorized',
			                   'code'=>401));
			  }
  
        		return Response::json($data,$status);
		}
		else
		{
			$resp 	= $this->repo->getCategories();
			if($resp)
			  {
				   $status = 200;
				   $data   = $resp;
			  }
			  else
			  {
			       $status = 401;
			       $data   = array('error'=>array('message'=>'hours status updated',
			                   'type'=>'Unauthorized',
			                   'code'=>401));
			  }
  
        		return Response::json($data,$status);
		}

	}

	/*
		Delete A Category
	*/
	public function dltCategory()
	{
		$id		 	= Input::get('id');
		$validator  = Validator::make(
					    array('id' => $id),
					    array('id' => 'required')
					);
		if($validator->fails())
		{
			return false;
		}
		else
		{
			$resp 	= $this->repo->delCategory($id);
			if($resp)
			  {
				   $status = 200;
				   $data   = $resp;
			  }
			  else
			  {
			       $status = 401;
			       $data   = array('error'=>array('message'=>'hours status updated',
			                   'type'=>'Unauthorized',
			                   'code'=>401));
			  }
  
        		return Response::json($data,$status);
		}
	}

	/*
		Update Category
	*/
	public function editCategory()
	{
		$id 		= Input::get('id');
		$name 		= Input::get('name');
		$validator  = Validator::make(
					    array('id'   => $id,
					    	  'name' => $name,),
					    array('id'   => 'required',
					    	  'name' => 'required')
					);
		if($validator->fails())
		{
			return false;
		}
		else
		{
			$resp	= $this->repo->updateCategory($id,$name);
			if($resp)
			  {
				   $status = 200;
				   $data   = $resp;
			  }
			  else
			  {
			       $status = 401;
			       $data   = array('error'=>array('message'=>'hours status updated',
			                   'type'=>'Unauthorized',
			                   'code'=>401));
			  }
  
        		return Response::json($data,$status);
		}
	}
	
}

?>
