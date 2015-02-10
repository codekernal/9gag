<?php

class EducationRepo
{	
	public $sortBy = '';
	public $sortOrder = 'asc';
	
	public function getEducations($accountId)
	{
		$rs = Education::where('account_id', $accountId);

		if(!empty($this->sortBy) && !empty($this->sortOrder))
		{
			$rs = $rs->orderBy($this->sortBy, strtoupper($this->sortOrder));
		}		

		$rs = $rs->get()->toArray();
		return $rs;
	}

	public function delEducation($account_id, $id)
	{
		$rec = Education::where('account_id', $account_id)->where('id','=',$id)->first();

		if(!empty($rec))
		{
			$rec->delete();
			return true;
		}
		else
			return false;
	}

	public function getEducation($account_id, $id)
	{
		$rs = Education::find($id);
		if(!empty($rs))
			return $rs->toArray();
		else
			return false;
	}

	public function addUpdateEducation($account_id, $input)
	{
		if(empty($input['id']))
		{
			$newCat = new Education();
		}
		else
		{
			$newCat = Education::find($input['id']);
		}

		$newCat->account_id = $account_id;
		$newCat->name = $input['name'];
		$newCat->desc = $input['desc'];
		$newCat->raise = $input['raise'];

		if(empty($input['id']))
			$newCat->save();
		else
			$newCat->update();

		return true;
	}
}