<?php

class TaskController extends BaseController {

	private $repo;
    public function __construct(TaskRepo $taskRepo){
    	$this->repo = $taskRepo;
    }

    public function addUpdateTask()
    {
    	$resp = false;
    	$all = Input::all();
    	$resp = $this->repo->addUpdateTask($all);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Task not successfuly',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

    public function deleteTask()
    {
    	$resp = false;
    	$task_id = Input::get('task_id');
    	$resp = $this->repo->deleteTask($task_id);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Task not deleted successfuly',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

    public function allTasks()
    {
    	$resp = false;
    	$project_id = Input::get('project_id');
    	$resp = $this->repo->allTasks($project_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Task not successfuly',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

    public function singleTask()
    {
    	$resp = false;
    	$task_id = Input::get('task_id');
    	$resp = $this->repo->singleTask($task_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Task not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

}
