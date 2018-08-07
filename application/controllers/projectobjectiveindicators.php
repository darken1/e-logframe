<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectobjectiveindicators extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectobjectiveindicatorsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projectobjectiveindicators'),
       );
       $this->load->view('projectobjectiveindicators/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
       $this->load->view('projectobjectiveindicators/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('indicator', 'Indicator', 'trim|required');
       $this->form_validation->set_rules('target', 'Target', 'trim|required');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       $this->form_validation->set_rules('means', 'Means', 'trim|required');
       $this->form_validation->set_rules('assumptions', 'Assumptions', 'trim|required');
       $this->form_validation->set_rules('objective_id', 'Objective id', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'indicator' => $this->input->post('indicator'),
               'target' => $this->input->post('target'),
               'type' => $this->input->post('type'),
               'means' => $this->input->post('means'),
               'assumptions' => $this->input->post('assumptions'),
               'objective_id' => $this->input->post('objective_id'),
               'project_id' => $this->input->post('project_id'),
           );
           $this->db->insert('projectobjectiveindicators', $data);
           redirect('projectobjectiveindicators','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectobjectiveindicators','refresh');
       }
       $row = $this->db->get_where('projectobjectiveindicators', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projectobjectiveindicators','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('projectobjectiveindicators/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('indicator', 'Indicator', 'trim|required');
       $this->form_validation->set_rules('target', 'Target', 'trim|required');
       $this->form_validation->set_rules('type', 'Type', 'trim|required');
       $this->form_validation->set_rules('means', 'Means', 'trim|required');
       $this->form_validation->set_rules('assumptions', 'Assumptions', 'trim|required');
       $this->form_validation->set_rules('objective_id', 'Objective id', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'indicator' => $this->input->post('indicator'),
               'target' => $this->input->post('target'),
               'type' => $this->input->post('type'),
               'means' => $this->input->post('means'),
               'assumptions' => $this->input->post('assumptions'),
               'objective_id' => $this->input->post('objective_id'),
               'project_id' => $this->input->post('project_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectobjectiveindicators', $data);
           redirect('projectobjectiveindicators','refresh');
       }
   }
   
   public function editobjective()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               'objective' => $editval,
           );
          $this->db->where('id', $id);
           $this->db->update('projectobjectives', $data);
		   
		    //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$projectobjective = $this->projectobjectivessmodel->get_by_id($id)->row();
			$project = $this->projectsmodel->get_by_id($projectobjective->project_id)->row();			
			
			$content = 'Edited the objective '.$editval.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectobjectives',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   public function editindicator()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('projectobjectiveindicators', $data);
		  
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$projectobjectiveindicator = $this->projectobjectiveindicatorsmodel->get_by_id($id)->row();
			
			$projectobjective = $this->projectobjectivessmodel->get_by_id($projectobjectiveindicator->objective_id)->row();
			$project = $this->projectsmodel->get_by_id($projectobjective->project_id)->row();			
			
			$content = 'Edited the indicator '.$editval.' for objective '.$projectobjective->objective.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectobjectiveindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   
   public function editoutcome()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('projectoutcomes', $data);
		  
		   //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
					
			$projectoutcome = $this->projectoutcomesmodel->get_by_id($id)->row();
			$project = $this->projectsmodel->get_by_id($projectoutcome->project_id)->row();			
			
			$content = 'Edited the outcome '.$editval.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutcomes',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   public function updateoutcomeindicator()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('projectoutcomeindicators', $data);
		  
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$projectoutcomeindicator = $this->projectoutcomeindicatorsmodel->get_by_id($id)->row();
			
			$projectoutcome = $this->projectoutcomesmodel->get_by_id($projectoutcomeindicator->outcome_id)->row();
			$project = $this->projectsmodel->get_by_id($projectoutcome->project_id)->row();			
			
			$content = 'Edited the indicator '.$editval.' for outcome '.$projectoutcome->outcome.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutcomeindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   
   public function editoutput()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('projectoutputs', $data);
		  
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
						
			$projectoutput = $this->projectoutcomesmodel->get_by_id($id)->row();
			$project = $this->projectsmodel->get_by_id($projectoutput->project_id)->row();			
			
			$content = 'Edited the output '.$editval.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutputs',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   public function saveoutputindicator()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('projectoutputindicators', $data);
		  
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
			$projectoutputindicator = $this->projectoutputindicatorsmodel->get_by_id($id)->row();
						
			$projectoutput = $this->projectoutcomesmodel->get_by_id($projectoutputindicator->output_id)->row();
			$project = $this->projectsmodel->get_by_id($projectoutput->project_id)->row();			
			
			$content = 'Edited the output indicator '.$editval.' for the output '.$projectoutput->output.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutputindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   public function saveplannedactivity()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('projectplannedactivities', $data);
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$projectplannedactivity = $this->projectplannedactivitiesmodel->get_by_id($id)->row();
			$project = $this->projectsmodel->get_by_id($projectplannedactivity->project_id)->row();			
			
			$content = 'Edited the activity '.$editval.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectplannedactivities',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   public function savebeneficiary()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('projectbeneficiaries', $data);
		  
		//audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$projectbeneficiary = $this->projectbeneficiariesmodel->get_by_id($id)->row();
			$project = $this->projectsmodel->get_by_id($projectbeneficiary->project_id)->row();	
			$beneficiarytype = $this->beneficiarytypesmodel->get_by_id($projectbeneficiary->beneficiary_id)->row();			
			
			$content = 'Edited the beneficiary '.$beneficiarytype->beneficiary_type.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectbeneficiaries',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
   }
   
   
   public function deleteindicator()
   {
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   
	   $row = $this->db->get_where('projectobjectiveindicators', array('id' => $id))->row();
	   
	   $project_id = $row->project_id;
	   $indicator = $row->indicator;
	   
	   $objective = $this->db->get_where('projectobjectives', array('id' => $indicator->objective_id))->row();
	   	   
	   $this->db->delete('projectobjectiveindicators', array('id' => $id));
	   
	   
	   
	   //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$project = $this->projectsmodel->get_by_id($project_id)->row();		
			
			$content = 'Deleted the indicator '.$indicator.' for objective '.$objective->objective.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectobjectiveindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   
	   
	   //project objectives section
	   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($project_id);
	   
	   $objectives = count($projectobjectives);
	   
	   if($objectives >0)
	   {
		   $totalobjectives = $objectives;
	   }
	   else
	   {
		   $totalobjectives = '';
	   }
	   
	   /**
	   PROJECT OBJECTIVES TABLE
	   **/
	   $table = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_objectives" id="number_of_objectives" title="You must add objectives" data-rule-required="true">
             <option value="'.$totalobjectives.'">'.$totalobjectives.'</option>
             </select> Objective(s)
		    </td>
        </tr>
       <tr>
         <th>Objective</th>
         <th>Indicators</th>
        </tr>
        </thead>
       <tbody>';
	   
	   foreach($projectobjectives as $key=>$projectobjective)
	   {
		   $indicators = $this->projectobjectiveindicatorsmodel->get_list_by_objective($projectobjective['id']);
		   $table .= '<tr><td contenteditable="true" onBlur="saveToDatabase(this,\'question\',\''.$projectobjective['id'].'\')" onClick="showEdit(this);">'.$projectobjective['objective'].'</td>';
		   $table .= '<td>';
		   
		   $table .= '<table>';
		   $i=0;
		   foreach($indicators as $key=>$indicator):
			   $i++;
			   if($i==1)
			   {
			   
			   	$table .= '<tr><th>&nbsp;</th><th>Target</th><th>Implementation Time (Months)</th><th>Means</th><th>Assumptions</th><th>&nbsp;</th></tr>';
			   }
		   	$table .= '<tr><td contenteditable="true" onBlur="saveToTheDatabase(this,\'indicator\',\''.$indicator['id'].'\')" onClick="showTheEdit(this);">'.$indicator['indicator'].'</td><td contenteditable="true" onBlur="saveToTheDatabase(this,\'target\',\''.$indicator['id'].'\')" onClick="showTheEdit(this);">'.$indicator['target'].'</td><td contenteditable="true" onBlur="saveToTheDatabase(this,\'implementation_time\',\''.$indicator['id'].'\')" onClick="showTheEdit(this);">'.$indicator['implementation_time'].'</td><td contenteditable="true" onBlur="saveToTheDatabase(this,\'means\',\''.$indicator['id'].'\')" onClick="showTheEdit(this);">'.$indicator['means'].'</td><td contenteditable="true" onBlur="saveToTheDatabase(this,\'assumptions\',\''.$indicator['id'].'\')" onClick="showTheEdit(this);">'.$indicator['assumptions'].'</td><td><a href="javascript:void(0)" onclick="deleteObjectiveIndicator('.$indicator['id'].')">Delete</a></td></tr>';
		   endforeach;
		   $table .= '</table>';
		   
		   
		   
		  
		   $table .= '</td>';

		   $table .= '</tr>';
	   }
	   
	   $table .= '
	   </tbody>
	   </table>';
	   
	   
	   echo $table;
   }
   
   
   public function deleteoutcomeindicator()
   {
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   
	   $row = $this->db->get_where('projectoutcomeindicators', array('id' => $id))->row();
	   
	   $project_id = $row->project_id;
	   
	   $trackings = $this->outcomeindicatortrackingmodel->get_list_by_indicator($id);
	   
	   $count = count($trackings);
	   
	   if($count>0)
	   {
		    echo '<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Warning!</strong> The indicator you want to delete is already being tracked.
		   </div>
		  ';
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$project = $this->projectsmodel->get_by_id($project_id)->row();	
			$outcome = $this->db->get_where('projectoutcomes', array('id' => $row->outcome_id))->row();	
			
			$content = 'Attempted to delete the indicator '.$row->outcomeindicator.' for outcome '.$outcome->outcome.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutcomeindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   }
	   else
	   {
	   	   
	   		$this->db->delete('projectoutcomeindicators', array('id' => $id));
			
			//audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$project = $this->projectsmodel->get_by_id($project_id)->row();	
			$outcome = $this->db->get_where('projectoutcomes', array('id' => $row->outcome_id))->row();	
			
			$content = 'Deleted the indicator '.$row->outcomeindicator.' for outcome '.$outcome->outcome.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutcomeindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   }
	   
	   
	   /***
		PROJECT OUTCOME TABLE
		
		**/
		
	   $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($project_id);
	   
	   $outcomes = count($projectoutcomes);
	   
	   if($outcomes >0)
	   {
		   $totaloutcomes = $outcomes;
	   }
	   else
	   {
		   $totaloutcomes = '';
	   }
	   
	   $outcometable = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_outcomes" id="number_of_outcomes" title="You must add outcomes" data-rule-required="true">
             <option value="'.$totaloutcomes.'">'.$outcomes.'</option>
             </select> Outcome(s)
		    </td>
        </tr>
       
        </thead>
       <tbody>';
	   
	   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($project_id);
	   
	   foreach($projectobjectives as $key=>$projectobjective)
	   {
		   $objectiveoutcomes = $this->projectoutcomesmodel->get_by_objective_list($projectobjective['id']);
		   
		   if(!empty($objectiveoutcomes))
		   {
			   $outcometable .= '<tr><th colspan="2">'.$projectobjective['objective'].'</th>';
			   $outcometable .= '<tr>
         <th>Outcome</th>
         <th>&nbsp;</th>
        </tr>';
			   
				
		   
			   foreach($objectiveoutcomes as $key=>$objectiveoutcome)
			   {
				   $indicators = $this->projectoutcomeindicatorsmodel->get_list_by_outcome($objectiveoutcome['id']);
				   $outcometable .= '<tr><td contenteditable="true" onBlur="saveRecord(this,\'outcome\',\''.$objectiveoutcome['id'].'\')" onClick="editRecord(this);">'.$objectiveoutcome['outcome'].'</td>';
				   $outcometable .= '<td>';
				   
				   $outcometable .= '<table>';
				   $j=0;
				   foreach($indicators as $key=>$indicator):
				   
				   $j++;
			   if($j==1)
			   {
			   
			   	$outcometable .= '<tr><th>Indicators</th><th>Target</th><th>Implementation Time (Months)</th><th>Means</th><th>Assumptions</th><th>&nbsp;</th></tr>';
			   }
					
					$outcometable .= '<tr><td contenteditable="true" onBlur="saveIndicatorRecord(this,\'outcomeindicator\',\''.$indicator['id'].'\')" onClick="editIndicatorRecord(this);">'.$indicator['outcomeindicator'].'</td><td contenteditable="true" onBlur="saveIndicatorRecord(this,\'outcometarget\',\''.$indicator['id'].'\')" onClick="editIndicatorRecord(this);">'.$indicator['outcometarget'].'</td><td contenteditable="true" onBlur="saveIndicatorRecord(this,\'outcomeimplementation_time\',\''.$indicator['id'].'\')" onClick="editIndicatorRecord(this);">'.$indicator['outcomeimplementation_time'].'</td><td contenteditable="true" onBlur="saveIndicatorRecord(this,\'outcomemeans\',\''.$indicator['id'].'\')" onClick="editIndicatorRecord(this);">'.$indicator['outcomemeans'].'</td><td contenteditable="true" onBlur="saveIndicatorRecord(this,\'outcomeassumptions\',\''.$indicator['id'].'\')" onClick="editIndicatorRecord(this);">'.$indicator['outcomeassumptions'].'</td><td><a href="javascript:void(0)" onclick="deleteOutcomeIndicator('.$indicator['id'].')">Delete</a></td></tr>';
				   endforeach;
				   
				   
				   
				   $outcometable .= '</table>';
				   
				     
				   $outcometable .= '</td>';
				   
				   		
				   $outcometable .= '</tr>';
			   }
		   }
	   }
	   
	   $outcometable .= '
	   </tbody>
	   </table>';
	   
	   
	   echo $outcometable;
	   
	   
   }
   
   public function deleteoutputindicator()
   {
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   
	   $row = $this->db->get_where('projectoutputindicators', array('id' => $id))->row();
	   
	   $project_id = $row->project_id;
	   
	   $trackings = $this->indicatorstrackingmodel->get_list_by_indicator($id);
	   
	   $count = count($trackings);
	   
	   if($count>0)
	   {
		    echo '<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Warning!</strong> The indicator you want to delete is already being tracked.
		   </div>
		  ';
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$project = $this->projectsmodel->get_by_id($project_id)->row();	
			$output = $this->db->get_where('projectoutputs', array('id' => $row->output_id))->row();	
			
			$content = 'Attempted to delete the indicator '.$row->outputindicator.' for output '.$output->output.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutputindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   }
	   else
	   {
	   	   
	   		$this->db->delete('projectoutputindicators', array('id' => $id));
			
			//audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$project = $this->projectsmodel->get_by_id($project_id)->row();	
			$output = $this->db->get_where('projectoutputs', array('id' => $row->output_id))->row();	
			
			$content = 'Deleted the indicator '.$row->outputindicator.' for output '.$output->output.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectoutputindicators',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   }
	   
	   
	   //output table
		 $projectoutputs = $this->projectoutputsmodel->get_by_project_list($project_id);
	   
	   $outputs = count($projectoutputs);
	   if($outputs >0)
	   {
		   $totaloutputs = $outputs;
	   }
	   else
	   {
		   $totaloutputs = '';
	   }
	   
	   /**
	   PROJECT OUTPUTS TABLE
	   **/
	   
	   $outputtable = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_outcomes" id="number_of_outcomes" title="You must add outcomes" data-rule-required="true">
             <option value="'.$totaloutputs.'">'.$outputs.'</option>
             </select> Output(s)
		    </td>
        </tr>
      
        </thead>
       <tbody>';
	   
	   $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($project_id);
	   
	   foreach($projectoutcomes as $key=>$projectoutcome)
	   {
		   $outcomeoutputs = $this->projectoutputsmodel->get_by_outcome_list($projectoutcome['id']);
		   
		   if(!empty($outcomeoutputs))
		   {
			   $outputtable .= '<tr><th colspan="2">'.$projectoutcome['outcome'].'</th></tr>';
			   	$outputtable .= '<tr><th>Output</th><th>&nbsp;</th></tr>';
				  
			   foreach($outcomeoutputs as $key=>$outcomeoutput)
			   {
				   
				  
				   $indicators = $this->projectoutputindicatorsmodel->get_list_by_output($outcomeoutput['id']);
				   $outputtable .= '<tr><td contenteditable="true" onBlur="saveOutputRecord(this,\'output\',\''.$outcomeoutput['id'].'\')" onClick="editOutputRecord(this);">'.$outcomeoutput['output'].'</td>';
				   $outputtable .= '<td>';
				   $outputtable .= '<table>';
				   
				   $k=0;
				   foreach($indicators as $key=>$indicator):
				   
				    $k++;
				   if($k==1)
				   {
				   
					$outputtable .= '<tr><th>Indicators</th><th>Target</th><th>Implementation Time (Months)</th><th>Means</th><th>Assumptions</th><th>&nbsp;</th></tr>';
				   }
				   
				   $outputtable .= '<tr><td contenteditable="true" onBlur="saveOutputIndicator(this,\'outputindicator\',\''.$indicator['id'].'\')" onClick="editOutputIndicator(this);">'.$indicator['outputindicator'].'</td><td contenteditable="true" onBlur="saveOutputIndicator(this,\'outputtarget\',\''.$indicator['id'].'\')" onClick="editOutputIndicator(this);">'.$indicator['outputtarget'].'</td><td contenteditable="true" onBlur="saveOutputIndicator(this,\'outputimplementation_time\',\''.$indicator['id'].'\')" onClick="editOutputIndicator(this);">'.$indicator['outputimplementation_time'].'</td><td contenteditable="true" onBlur="saveOutputIndicator(this,\'outputmeans\',\''.$indicator['id'].'\')" onClick="editOutputIndicator(this);">'.$indicator['outputmeans'].'</td><td contenteditable="true" onBlur="saveOutputIndicator(this,\'outputassumptions\',\''.$indicator['id'].'\')" onClick="editOutputIndicator(this);">'.$indicator['outputassumptions'].'</td><td><a href="javascript:void(0)" onclick="deleteOutputIndicator('.$indicator['id'].')">Delete</a></td></tr>';
				   
				   
				   endforeach;
				   $outputtable .= '</table>';
				  
				   $outputtable .= '</td>';
				   		
				   $outputtable .= '</tr>';
			   }
		   }
	   }
	   
	   $outputtable .= '
	   </tbody>
	   </table>';
	   
	   echo $outputtable;
	   
	   
	   	   
   }
   
   
   
    public function deleteoutputactivity()
   {
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   
	   $row = $this->db->get_where('projectplannedactivities', array('id' => $id))->row();
	   
	   $project_id = $row->project_id;
	   
	   $trackings = $this->rollingactionplansmodel->get_list_by_activity($id);
	   
	   $count = count($trackings);
	   
	   if($count>0)
	   {
		    echo '<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Warning!</strong> The activity you want to delete is already being tracked.
		   </div>
		  ';
		  
		  //audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$project = $this->projectsmodel->get_by_id($project_id)->row();	
			
			$content = 'Attempted to delete the planned activity '.$row->activity.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectplannedactivities',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   }
	   else
	   {
	   	   
	   		$this->db->delete('projectplannedactivities', array('id' => $id));
			
			//audit trail
			$active_class = $this->router->fetch_class();
			$active_method =  $this->router->fetch_method();	
			$visited_page = $active_class.'/'.$active_method;
			
			$username = $this->erkanaauth->getField('username');
			$user_db_id = $this->erkanaauth->getField('id');
			$ip_address = $this->getIp();
			
									
			$project = $this->projectsmodel->get_by_id($project_id)->row();	
			
			$content = 'Deleted the planned activity '.$row->activity.' under the project '.$project->project_title.'.';
			
			
			 $auditdata = array(
					   'username' => $username,
					   'ip_address' => $ip_address,
					   'date_time' => date("Y-m-d H:i:s"),
					   'content' => $content,
					   'visited_page' => $visited_page,
					   'user_db_id' => $user_db_id,
					   'controller' => 'projectplannedactivities',
					   'item_db_id' => $id,
				   );
			  
			$this->db->insert('audittrail', $auditdata);
	   }
	   
	   
	   	/**
		PLANNED ACTIVITIES TABLE
		**/
	   $plannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	   $activities = count($plannedactivities);
	   if($activities >0)
	   {
		   $totalactivities = $activities;
	   }
	   else
	   {
		   $totalactivities = '';
	   }
		
		$activitytable = '<table class="table table-hover table-nomargin">
		   <thead>
			<tr>
			   <td colspan="5">
				<select name="number_of_activities" id="number_of_activities" title="You must add activities" data-rule-required="true">
				 <option value="'.$totalactivities.'">'.$activities.'</option>
				 </select> Activities
				</td>
			</tr>
		   <tr>
			  <th>Activity</th>
			 <th>Target Beneficiary</th>
			 <th>Start Date</th>
			 <th>End Date</th>
			 <th>&nbsp;</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($plannedactivities as $plankey=>$plannedactivity):
		   
		   $activitytable .= '<tr><td contenteditable="true" onBlur="saveActivity(this,\'activity\',\''.$plannedactivity['id'].'\')" onClick="editActivity(this);">'.$plannedactivity['activity'].'</td><td contenteditable="true" onBlur="saveActivity(this,\'total_beneficiary_target\',\''.$plannedactivity['id'].'\')" onClick="editActivity(this);">'.$plannedactivity['total_beneficiary_target'].'</td><td contenteditable="true" onBlur="saveActivity(this,\'activity_start_date\',\''.$plannedactivity['id'].'\')" onClick="editActivity(this);">'.$plannedactivity['activity_start_date'].'</td><td contenteditable="true" onBlur="saveActivity(this,\'activity_end_date\',\''.$plannedactivity['id'].'\')" onClick="editActivity(this);">'.$plannedactivity['activity_end_date'].'</td><td><a href="javascript:void(0)" onclick="deleteOutputActivity('.$plannedactivity['id'].')">Delete</a></td></tr>';
		   
		   endforeach;
		   
		 $activitytable .= '
		   </tbody>
		   </table>';
		   
		  echo $activitytable;
	   
		   	   
   }
   

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectobjectiveindicators','refresh');
       }
       $this->db->delete('projectobjectiveindicators', array('id' => $id));
       redirect('projectobjectiveindicators','refresh');
   }
   
   
   
    function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
  }

}
