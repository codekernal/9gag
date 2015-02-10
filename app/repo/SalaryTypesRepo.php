<?php

class SalaryTypesRepo
{	
	public function getSalaryTypes($accountId)
	{
		$rs = SalaryTypes::where('account_id', $accountId)->get()->toArray();
		return $rs;
	}

	public function delSalaryType($account_id, $id)
	{
		$rec = SalaryTypes::where('account_id', $account_id)->where('id','=',$id)->first();

		if(!empty($rec))
		{
			$rec->delete();
			return true;
		}
		else
			return false;
	}

	public function getSalaryType($account_id, $id)
	{
		$rs = SalaryTypes::find($id);
		if(!empty($rs))
			return $rs->toArray();
		else
			return false;
	}

	public function addUpdateSalaryType($account_id, $input)
	{
		if(empty($input['id']))
		{
			$newCat = new SalaryTypes();
		}
		else
		{
			$newCat = SalaryTypes::find($input['id']);
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