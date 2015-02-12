<?php

class VideoRepo
{	
		

	/*
		Get All Videos
	*/
	public function getVideos()
	{
		$limit = 10;

		$rs = Video::get();
		$rs = Video::paginate($limit);

		if(!empty($rs))
		{
			return $rs;
		}		
		
		
	}

	/*
		Delete A Video
	*/
	public function delVideo($id)
	{
		$rec = Video::where('id','=',$id)->first();

		if(!empty($rec))
		{
			$rec->delete();
			return true;
		}
		else
			return false;
	}

	/*
		Get A User's Videos
	*/
	public function getUserVideo($user_id)
	{
		
		$rs = Video::where('user_id','=',$user_id)->get();
		if(!empty($data))
		{
			return $data;
		}
		else
		{
			return false;
		}
	}

	/*
		Get A Single Video
	*/
	public function getVideo($id)
	{
		$rs = Video::find($id);
		if(!empty($rs))
		{
			return array('id' 			=> $id,
			             'title'		=> $rs->title,
			             'link' 		=> $rs->link,
			             'description'  => $rs->description,
			             'category_id'  => $rs->category_id,
				         'user_id'      => $rs->user_id,
				         'date'         => $rs->date,
				         'status'       => $rs->status,
				         'view'         => $rs->view,
				         'share'        => $rs->share,
				         'like'         => $rs->like,
				         'dislike'      => $rs->dislike);
		}
		else
		{
			return false;
		}
	}

	/*
		Update A Video
	*/
	public function updateVideo($id,$title,$link,$description,$category_id,$user_id,$date_created,$status)
 	{
  		$video = Video::find($id);
 		if(!empty($video))
  		{
   			$video->title 		 = $title;
   			$video->link 		 = $link;
   			$video->description  = $description;
   			$video->category_id  = $category_id;
   			$video->user_id      = $user_id;
   			$video->date_created = $date_created;
   			$video->status       = $status;
   			$video->update();
   			return true;
  		}
  		else
  		{
   			return false;
  		}
 	}

	/*
		Add a Video	
	*/
	public function insertVideo($title,$link,$description,$category_id,$user_id,$date_created,$status)
 	{
 		$video 				= new Video;
  		$video->title 		= $title;
  		$video->link 		= $link;
  		$video->description = $description;
  		$video->category_id = $category_id;
  		$video->user_id     = $user_id;
   		$video->date_created= $date_created;
   		$video->status      = $status;

  		if($video->save())
  		{
   			return true;
  		}
  		else
  		{
   			return false;
  		}
 	}

 	/*
 		View count of a Video
 	*/
 	public function view_count($id)
 	{
 		$video = Video::where('id','=',$id)->first();
 		if(!empty($video))
 		{
 			$video->view = $video->view+1;
 			$video->save();
 			return $video->view;
 		}
 		else
 		{
 			return false;
 		}

 	}
	
	/*
 		Share count of a Video
 	*/
	public function share_count($id)
 	{
 		$video = Video::where('id','=',$id)->first();
 		if(!empty($video))
 		{
 			$video->share = $video->share+1;
 			$video->save();
 			return $video->share;
 		}
 		else
 		{
 			return false;
 		}

 	}

 	public function videoLog($video_id,$user_id,$action)
 	{
 		$count = ActivityLog::where('user_id','=',$user_id)->where('video_id','=',$video_id)->where('action','=',$action)->count('id');
 		if($count > 0)
 		{
 			return false;
 		}
 		else
 		{
 			return true;
 		}
 	}

 	/*
 		Vote count(vote up/vote down) of a Video
 	*/
 	public function vote_up($video_id,$user_id,$action)
 	{
 		$video = Video::where('id','=',$video_id)->first();
 		if(!empty($video))
 		{
 			$log = $this->videoLog($video_id,$user_id,$action);
 			if($log == true)
 			{
 				$log = new ActivityLog;
 				$log->user_id  = $user_id;
 				$log->video_id = $video_id;
 				$log->action   = $action;
 				$log->save();

 				$video->like = $video->like+1;
 				$video->save();

 				return $video->like;
 			}
 			else
 			{
 				return false;
 			}
 		}
 		else
 		{
 			return false;
 		}

 	}

 	public function vote_down($video_id,$user_id,$action)
 	{
 		$video = Video::where('id','=',$video_id)->first();
 		if(!empty($video))
 		{
 			if($video->like == 0 || $video->like == null)
 			{
 				return false;
 			}
 			else
 			{
 				$log = videoLog($video_id,$user_id,$action);
 				if($log)
 				{
		 			$log = new ActivityLog;
		 			$log->user_id  = $user_id;
	 				$log->video_id = $video_id;
	 				$log->action   = $action;
	 				$log->save();

	 				$video->dislike = $video->dislike+1;
		 			$video->save();

		 			return $video->dislike;
	 			}
	 			else
	 			{
	 				return false;
	 			}
 			}
 		}
 		else
 		{
 			return false;
 		}

 	}

}

?>





 