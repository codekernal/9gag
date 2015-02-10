<?php

class PlannerController extends BaseController {

    public function __construct(){

    }	

    public function accessCheck($role_id)
    {
        $access = array('can_update' => false);
        if($role_id != 0 && $role_id != 1)
        {
            if($role_id != 4)
            {
                $access['can_update'] = true;
            }
            return $access;
        }
        else
        {
         ?>
              <script>window.location = 'login'</script>
            
         <?php   
            die();
        }                    
    }

    public function showSettings()
    {
        $account_id = Session::get('user')['account_id'];
        $newobj = new AccountsRepo();
        $data = $newobj->getAccount($account_id);
        return View::make('settings', array('account' => $data));        
    }

    public function showLogin()
    {
		return View::make('login');
    }

    public function accessDenied()
    {
        return View::make('access_denied');
    }

    public function showSignup()
    {
		return View::make('signup');
    }

    public function showDashboard()
    {
        $projectRepo = new ProjectRepo();
        $projects = $projectRepo->getDashboardProjects();
        $stats = $projectRepo->getDashboardStats();
		return View::make('dashboard', array('projects' => $projects, 'stats' => $stats));    	
    }

    public function showServices()
    {
        $rs = $this->accessCheck($_GET['person_account_data']['role_id']);
        return View::make('services', array('can_update' => $rs['can_update']));     
    }

    public function showProfile()
    {
        return View::make('profile');     
    }

    public function showClients()
    {
        $rs = $this->accessCheck($_GET['person_account_data']['role_id']);
        return View::make('clients', array('can_update' => $rs['can_update']));     
    }

    public function showResources()
    {
        if(!isset(Session::get('user')['account_id']))
        {
         ?>
              <script>window.location = 'login'</script>
            
         <?php   
            die();
        }

        $rs = $this->accessCheck($_GET['person_account_data']['role_id']);        
        $account_id = Session::get('user')['account_id'];        
        $repo = new CategoryRepo();
        $cats = $repo->getCategories($account_id);
        $servicerepo = new ServiceRepo();
        $services = $servicerepo->allServices($account_id);

        $educationrepo = new EducationRepo();
        $educations = $educationrepo->getEducations($account_id);

        $salaryrepo = new SalaryTypesRepo();
        $salaryTypes = $salaryrepo->getSalaryTypes($account_id);

        return View::make('resources', array('educations' => $educations, 'salary_types' => $salaryTypes, 'cats' => $cats, 'services' => $services, 'can_update' => $rs['can_update']));
    }
    
    public function showConfirm($code)
    {
        $repo = new PersonsRepo();
        $id = $repo->verifyAccount($code);
        if(empty($id))
            $msg = Lang::get('auth.VERIFIED_ERROR');
        else 
            $msg = Lang::get('auth.VERIFIED');

        return View::make('confirm' , array('msg' => $msg, 'can_update' => $rs['can_update']));
    }

    public function showProject()
    {
        $rs = $this->accessCheck($_GET['person_account_data']['role_id']);        
        return View::make('project', array('can_update' => $rs['can_update']));
    }

    public function showCategories()
    {
        $rs = $this->accessCheck($_GET['person_account_data']['role_id']);        
        return View::make('categories', array('can_update' => $rs['can_update']));
    }

    public function showForgot($code)
    {
        if(Input::has('id'))
        {
            $id = Input::get('id');
            ResourceRepo::responseinvitation($id, 'accepted');
        }
        $repo = new PersonsRepo();
        $id = $repo->verifyForgot($code);
        return View::make('forgot' , array('status' => $id, 'code' => $code));
    }

    public function showLaunchpad()
    {
        $resource_id = Session::get('user')['id'];
        $accounts = array();
        $accountsData = PersonAccounts::where('resource_id', $resource_id)->whereNotIn('invite_status', array('decline', 'not_invited'))->get()->toArray();
        if(!empty($accountsData))
        {
            foreach ($accountsData as $key => $accountData) {
                $account = Accounts::find($accountData['account_id']);
                if(!empty($account))
                    $accounts[]  = array('account_id' => $accountData['account_id'], 'name' => ucfirst($account['name']));
            }
        }

        return View::make('launchpad', array('accounts' => $accounts));        
    }

    public function acceptInvitation()
    {
        if(Input::has('id'))
        {
            $id = Input::get('id');
            ResourceRepo::responseinvitation($id, 'accepted');
        }

        return View::make('accept');        
    }

    public function declineInvitation()
    {
        if(Input::has('id'))
        {
            $id = Input::get('id');
            ResourceRepo::responseinvitation($id, 'declined');
        }

        return View::make('decline');        
    }

}
