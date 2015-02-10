<?php

class ServiceRepo
{	
	public $sortBy = '';
	public $sortOrder = 'asc';

	public function insertService($accountId, $name, $employee_price, $client_price, $desc, $client_id)
	{
		$service = new Services();
		$service->account_id = $accountId;
		$service->name = $name;		
		$service->employee_price = $employee_price;		
		$service->client_id = $client_id;		
		$service->desc = $desc;	
		$service->client_price = $client_price;	
		if($service->save())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function updateService($id, $name, $employee_price, $client_price,  $desc, $client_id)
	{
		$service = Services::find($id);
		$service->name = $name;		
		$service->employee_price = $employee_price;		
		$service->client_id = $client_id;				
		$service->client_price = $client_price;
		$service->desc = $desc;		
		if($service->update())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function allServices($accountId, $client_id = 0)
	{
		if(!empty($client_id))
		{
			$arr = array($client_id, 0);
			$service = Services::where('account_id',$accountId)->whereIn('client_id', $arr);
		}
		else				
		{
			$service = Services::where('account_id',$accountId);
		}

		if(!empty($this->sortBy) && !empty($this->sortOrder))
		{
			$service = $service->orderBy($this->sortBy, strtoupper($this->sortOrder));
		}

		$service = $service->get()->toArray();

		return $service;
	}

	public function deleteService($id)
	{
		$service = Services::find($id);
		if($service)
		{
			if($service->delete())
			{
				ProjectServices::where('service_id', $id)->delete();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
			return false;

	}


	public function getService($id)
	{
		$service = Services::where('id',$id);
		if($service->count() > 0)
			return $service->first()->toArray();
		else 
			return false;
	}	
}