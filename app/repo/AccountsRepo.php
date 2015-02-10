<?php

class AccountsRepo
{	
	public function insert($companyName)
	{
		$account = new Accounts();
		$account->name = $companyName;
		$account->save();
		return $account->id;
	}

	public function upload($pic)
	{
		$destinationPath = public_path().'/data/company/';
		$extension = $pic->getClientOriginalExtension();
		$fileName = time().'.'.$extension;
		$pic->move($destinationPath, $fileName);
		return $fileName;
	}

	public function updateCompanyProfile($account_id, $company_name, $timezone, $logo)
	{
		$resp = false;
		if(!empty($account_id))
		{
			$accountData = Accounts::find($account_id);
			if(!empty($accountData))
			{
				$accountData->name = $company_name;
				$accountData->timezone = $timezone;
				$accountData->logo = $logo;
				$accountData->update();
				$resp = true;
			}
		}
		return $resp;
	}
	public function addPersonAccount($personId, $accountId, $mode, $first_name, $last_name)
	{
		$newAccountPerson = new PersonAccounts();
		$newAccountPerson->account_id = $accountId;
		$newAccountPerson->resource_id = $personId;
		$newAccountPerson->first_name = $first_name;
		$newAccountPerson->last_name = $last_name;
		$newAccountPerson->mode = 'admin';		
		$newAccountPerson->role_id = 3;		
		$newAccountPerson->invite_status = 'accepted';				
		$newAccountPerson->save();
	}

	public function getAccount($id)
	{
		$resp  =array('id' => '0', 'logo' => '', 'name' => '', 'timezone' => '');
		if(!empty($id))
		{
			$account = Accounts::find($id);
			if(!empty($account))
			{
				$resp  =array('id' => $id, 'logo' => $account->logo, 'name' => $account->name, 'timezone' => $account->timezone);
			}
		}
		return $resp;
	}
}