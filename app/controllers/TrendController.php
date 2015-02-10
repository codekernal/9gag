<?php

class TrendController extends BaseController{
	
	public function addTrend()
	{
		$trend = Input::get('trend');
		$resp = new TrendRepo;
		$resp = $resp->insertTrend($trend);

	}

	public function getTrend()
	{
		$repo = new TrendRepo;
		$resp = $repo->getTheTrend();

	}

	public function DltTrend()
	{
		$trend = Input::get('id');
		$repo = new TrendRepo;
		$resp = $repo->deleteTrend($trend);
	}

	public function editTrend()
	{
		$id = Input::get('id');
		$trend = Input::get('trend');
		$repo = new TrendRepo;
		$resp = $repo->updateTrend($id,$trend);
	}
}

?>