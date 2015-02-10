<?php
class ClientRepo
{	
	public $sortBy = '';
	public $sortOrder = 'asc';

	public function insertClient($params)
	{
		$client = new Clients();
		$client->account_id = $params['account_id'];
		$client->first_name = $params['first_name'];
		$client->last_name = $params['last_name'];
		$client->phone = $params['phone'];
		$client->company_name = $params['company_name'];
		$client->mobile = $params['mobile'];
		$client->fax = $params['fax'];
		$client->email = $params['email'];
		$client->street_address = $params['street_address'];
		$client->zip = $params['zip'];
		$client->city = $params['city'];
		$client->country = $params['country'];
		$client->invoice_city = $params['invoice_city'];
		$client->invoice_zip = $params['invoice_zip'];
		$client->invoice_country = $params['invoice_country'];
		$client->express_price = $params['express_price'];
		$client->invoice_street_address = $params['invoice_street_address'];

		if($client->save())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function updateClient($params)
	{
		$client = Clients::find($params['id']);
		$client->first_name = $params['first_name'];
		$client->last_name = $params['last_name'];
		$client->phone = $params['phone'];
		$client->mobile = $params['mobile'];
		$client->fax = $params['fax'];
		$client->company_name = $params['company_name'];		
		$client->email = $params['email'];
		$client->street_address = $params['street_address'];
		$client->zip = $params['zip'];
		$client->city = $params['city'];
		$client->country = $params['country'];
		$client->invoice_city = $params['invoice_city'];
		$client->invoice_zip = $params['invoice_zip'];
		$client->invoice_country = $params['invoice_country'];
		$client->express_price = $params['express_price'];
		$client->invoice_street_address = $params['invoice_street_address'];

		if($client->update())
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function allClients($accountId, $searchKey = '') 
	{
		if(empty($searchKey))
			$client = Clients::where('account_id',$accountId);
		else
		{
			$searchKey = '%'.$searchKey.'%';
			$client = Clients::where('account_id',$accountId)
		 	->Where(function($query) use ($searchKey)
            {
                $query->orWhere('first_name', 'like', $searchKey)
                      ->orWhere('last_name', 'like', $searchKey)
                      ->orWhere('company_name', 'like', $searchKey)
                      ->orWhere('phone', 'like', $searchKey) 
                      ->orWhere('mobile', 'like', $searchKey) 
                      ->orWhere('email', 'like', $searchKey) 
                      ->orWhere('street_address', 'like', $searchKey)                       
                      ->orWhere('zip', 'like', $searchKey)
                      ->orWhere('city', 'like', $searchKey)
                      ->orWhere('country', 'like', $searchKey)
                      ->orWhere('fax', 'like', $searchKey);
            });
		}

		if(!empty($this->sortBy) && !empty($this->sortOrder))
		{
			$client =$client->orderBy($this->sortBy, strtoupper($this->sortOrder));
		}

		$client = $client->get()->toArray();

		return $client;
	}


	public function getClient($id) 
	{
		$client = Clients::where('id',$id);
		if($client->count() > 0)
		{
			$client = $client->first()->toArray();
			return $client;
		}
		else
			return false;
	}

	public function deleteClient($id)
	{
		$client = Clients::find($id);
		if($client)
		{
			if($client->delete())
			{
				Projects::where('client_id', $id)->update(array('client_id' => 0));
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
}