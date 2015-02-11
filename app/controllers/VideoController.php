<?php

class VideoController extends BaseController{
	
	private $repo;
    public function __construct(VideoRepo $videoRepo){
    	$this->repo = $videoRepo;
    }


	/*
		Add A Video
	*/
	public function addVideo()
	{
		$title    		= Input::get('title');
		$link    		= Input::get('link');
		$description    = Input::get('description');
		$category_id    = Input::get('category_id');
		$user_id        = Input::get('user_id');
		$date           = date("Y-m-d H:i:s");
		$status         = Input::get('status');

		$validator  = Validator::make(
					    array('title' 		=> $title,
					    	  'link'  		=> $link,
					    	  'category_id' => $category_id,
					    	  'user_id'     => $user_id),
					    array('title' 		=> 'required',
					    	  'link'  		=> 'required',
					    	  'category_id' => 'required',
					    	  'user_id'     => 'required'
					    	)
					);
		if($validator->fails())
		{
			return false;
		}
		else
		{
			$resp 	= $this->repo->insertVideo($title,$link,$description,$category_id,$user_id,$date,$status);
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
		Get Video Detail. If id is given, returns a particular video details else return all videos
	*/
	public function getVideo()
	{
		$id 		= Input::get('id');
		if(!empty($id))
		{
			$resp 	= $this->repo->getVideo($id);
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
			$resp 	= $this->repo->getVideos();
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
		Delete A Video
	*/
	public function dltVideo()
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
			$resp 	= $this->repo->delVideo($id);
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
		Update Video
	*/
	public function editVideo()
	{
		$id 			= Input::get('id');
		$title 			= Input::get('title');
		$link 			= Input::get('link');
		$description 	= Input::get('description');
		$category_id 	= Input::get('category_id');
		$user_id        = Input::get('user_id');
		$date           = date("Y-m-d H:i:s");
		$status         = Input::get('status');

		$validator  = Validator::make(
					    array('title' 		=> $title,
					    	  'link'  		=> $link,
					    	  'description' => $description,
					    	  'category_id' => $category_id,
					    	  'user_id'     => $user_id),
					    array('title' 		=> 'required',
					    	  'link'  		=> 'required',
					    	  'description' => 'sometimes|required',
					    	  'category_id' => 'required',
					    	  'user_id'     => 'required'
					    	)
					);
		if($validator->fails())
		{
			return false;
		}
		else
		{
			$resp	= $this->repo->updateVideo($id,$title,$link,$description,$category_id,$user_id,$date,$status);
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
		Video View Count	
	*/
	public function view_count()
	{
		$id 		= Input::get('id');
		if(!empty($id))
		{
			$resp 	= $this->repo->view_count($id);
			return Response::json($resp);
		}
		else
		{
			return false;
		}

	}

	/*
		Video Share Count	
	*/
	public function share_count()
	{
		$id 		= Input::get('id');
		if(!empty($id))
		{
			$resp 	= $this->repo->share_count($id);
			return Response::json($resp);
			
		}
		else
		{
			return false;
		}

	}

	/*
		Video Vote up/Vote down 	
	*/
	public function vote()
	{
		$id 		= Input::get('id');
		$user_id    = Input::get('user_id');
		$action     = Input::get('action');
		if($action == 'vote_up')
		{
			if(!empty($id))
			{
				$resp 	= $this->repo->vote_up($id,$user_id,$action);
				return Response::json($resp);
				
			}
			else
			{
				return false;
			}
		}
		else if($action == 'vote_down')
		{
			if(!empty($id))
			{
				$resp 	= $this->repo->vote_down($id,$user_id,$action);
				return Response::json($resp);
				
			}
			else
			{
				return false;
			}
		}
	}

	
}

?>
