<?php

class VideoRepo
{	
		

	/*
		Get All Videos
	*/
	public function getVideos()
	{
		$rs = Video::get();

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
			             'category_id'  =>$rs->category_id);
		}
		else
		{
			return false;
		}
	}

	/*
		Update A Video
	*/
	public function updateVideo($id,$title,$link,$description,$category_id,$user_id,$date,$status)
 	{
  		$video = Video::find($id);
 		if(!empty($video))
  		{
   			$video->title 		 = $title;
   			$video->link 		 = $link;
   			$video->description  = $description;
   			$video->category_id  = $category_id;
   			$video->user_id      = $user_id;
   			$video->date         = $date;
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
	public function insertVideo($title,$link,$description,$category_id,$user_id,$date,$status)
 	{
 		$video 				= new Video;
  		$video->title 		= $title;
  		$video->link 		= $link;
  		$video->description = $description;
  		$video->category_id = $category_id;
  		$video->user_id     = $user_id;
   		$video->date        = $date;
   		$video->status       = $status;

  		if($video->save())
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