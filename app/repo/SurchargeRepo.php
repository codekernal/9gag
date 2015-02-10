<?php

class SurchargeRepo
{	

	public function getNightShift($account_id)
	{
		$resp = array('start_time' => '', 'end_time' => '', 'night_shift_raise' => 0);
		$data = NightShift::where('account_id', $account_id)->first();

		if(!empty($data))
			$resp = array('start_time' => date('H:i', strtotime($data->start_time)), 'end_time' => date('H:i', strtotime($data->end_time)), 'night_shift_raise' => $data->raise);

		return $resp;
	}

	public function updateNightShift($account_id, $start_time, $end_time, $raise)
	{
		$data = NightShift::where('account_id', $account_id)->first();

		if(!empty($data))
		{
			$data = NightShift::find($data->id);
			$data->start_time = $start_time;
			$data->end_time = $end_time;
			$data->raise = $raise;
			$data->update();
		}
		else
		{
			$data = new NightShift();
			$data->account_id = $account_id;
			$data->start_time = $start_time;
			$data->end_time = $end_time;
			$data->raise = $raise;
			$data->save();
		}

		return true;
	}

	public function getHolidays($account_id)
	{
		$rs = PublicHolidays::where('account_id', $account_id)->get()->toArray();
		if(!empty($rs))
		{
			foreach ($rs as $key => $value) {
				$value['holiday'] = date('m/d/Y', strtotime($value['holiday']));
			}
		}
		return $rs;
	}
	public function addHolidays($account_id, $input)
	{
		PublicHolidays::where('account_id', $account_id)->delete();
		if(!empty($input['holidays']))
		{
			foreach($input['holidays'] as $holiday)
			{
				if(!empty($holiday['holiday']))
				{
					$holiday['holiday'] = date('Y-m-d', strtotime($holiday['holiday']));
					$new = new PublicHolidays();
					$new->account_id = $account_id;
					$new->holiday = $holiday['holiday'];
					$new->name = $holiday['name'];
					$new->raise = $holiday['raise'];
					$new->save();
				}
			}
		}
		return true;
	}

}