<?php

class TrendRepo{

	public function insertTrend($trend)
	{
		$insert = Trend::insert(array('trend'=>$trend));
		if($insert)
		{
			echo ' inserted';
		}
		else
		{
			echo 'error';
		}
	}

	public function getTheTrend()
	{
		$data = Trend::get();
		$data = json_encode($data);
		echo $data;
	}

	public function deleteTrend($trend)
	{
		$delete = Trend::where('id','=',$trend)->delete();
		if($delete)
		{
			echo ' deleted';
		}
		else
		{
			echo 'error';
		}
	}

	public function updateTrend($id,$trend)
	{
		$count = Trend::where('id','=',$id)->count();
		if($count == 0)
		{
			echo 'record doesnt exist';
		}
		else
		{
			$update = Trend::where('id', $id)
            ->update(array('trend' => $trend));
            echo 'updated';
		}
	}
}

?>