<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Attendancelist extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('attendancelistmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('attendancelist'),
       );
       //$this->load->view('attendancelist/index', $data);
	   
	   redirect('attendancelist/activity','refresh');
   }
   
   public function activity()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
	  
       $this->load->view('attendancelist/activity',$data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $projectaactivity_id = $this->input->post('projectaactivity_id');
	   $project_id = $this->input->post('project_id');
	   
	   if(empty($projectaactivity_id) || empty($project_id))
	   {
		   redirect('home','refresh');
	   }
	   $data['project_id'] = $project_id;
	   $data['projectaactivity_id'] = $projectaactivity_id;
	   
	   $data['prjcts'] = $this->get_projects($project_id);
	   $data['activities'] = $this->get_activities($projectaactivity_id);
	   $data['dist'] = $this->get_districts();
	   
	   
	   $data['project'] = $this->projectsmodel->get_by_id($project_id)->row();
	   $data['activity'] = $this->projectactivitiesmodel->get_by_id($projectaactivity_id)->row();
	   
	   
	   $activitybeneficiaries = $this->attendancelistmodel->get_by_project_activity($project_id,$projectaactivity_id);
	   
	   $registrationrow = '<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
		<thead>
		<tr>
		<th>District</th>
		<th>Project </th>
		<th>Activity </th>
		<th>Date  </th>
		<th>Name </th>
		<th>Sex </th>
		<th>Age</th>
		<th>Contact </th>
		<th>Area of Settlement</th>
		<th>Organization</th>
		<th>Occupation</th>
		<th>Comments</th>
		<th>Action </th>
		</tr>
		</thead>
		<tbody id="table-body">
		';
		
		foreach($activitybeneficiaries as $key=>$activitybeneficiary)
		{
			$registrationrow .= '<tr class="table-row" id="table-row-'.$activitybeneficiary['id'].'">
				<td contenteditable="true" onBlur="saveToDatabase(this,\'district\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['district'].' </td>
				<td bgcolor="#f2eded">'.$activitybeneficiary['project_no'].' </td>
		<td bgcolor="#f2eded">'.$activitybeneficiary['activity'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'training_date\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['training_date'].'  </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'name\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['name'].'</td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'sex\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['sex'].'</td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'age\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['age'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'contact\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['contact'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'area_of_settlement\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['area_of_settlement'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'organization\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['organization'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'occupation\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['occupation'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'comments\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['comments'].' </td>		
			
		<td><a href="javascript:void(0)" onclick="deleteRecord('.$activitybeneficiary['id'].');">Delete</a></td>
			
			</tr>';

		}
		
		 $registrationrow .= '</tbody>
</table>';
	   
	   $data['registrationrow']= $registrationrow;
	   
	   
       $this->load->view('attendancelist/addtrainee',$data);
   }
   
   public function editcolumn()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('attendancelist', $data);
   }
   
   public function delete_record()
   {
	   $id = $_POST["id"];
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   $this->db->delete('attendancelist', array('id' => $id));
   }
   
   public function addrecord()
   {
	  
               $district = mysql_real_escape_string(strip_tags($_POST['district']));
               $training_date = mysql_real_escape_string(strip_tags($_POST['training_date']));
               $name = mysql_real_escape_string(strip_tags($_POST['name']));
               $sex = mysql_real_escape_string(strip_tags($_POST['sex']));
               $contact = mysql_real_escape_string(strip_tags($_POST['contact']));
               $area_of_settlement = mysql_real_escape_string(strip_tags($_POST['area_of_settlement']));
               $organization = mysql_real_escape_string(strip_tags($_POST['organization']));
               $occupation = mysql_real_escape_string(strip_tags($_POST['occupation']));
               $comments = mysql_real_escape_string(strip_tags($_POST['comments']));
               
			   
	   $project_id = mysql_real_escape_string(strip_tags($_POST['project_id']));
	   $projectaactivity_id = mysql_real_escape_string(strip_tags($_POST['projectaactivity_id']));
	   
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   $activity = $this->projectactivitiesmodel->get_by_id($projectaactivity_id)->row();
	 	  
	   $data = array(
	           'project_id' => $project_id,
	           'project_no' => $project->project_no,
               'projectactivity_id' => $projectaactivity_id,
			   'activity' => $activity->activity,
               'training_date' => $training_date,
               'name' => $name,
               'sex' => $sex,
               'contact' => $contact,
               'district' => $district,
               'area_of_settlement' => $area_of_settlement,
               'organization' => $organization,
               'occupation' => $occupation,
               'comments' => $comments,
           );  
		  
          $this->db->insert('attendancelist', $data);
		   
		  $id = $this->db->insert_id();
		   
		  $row = $this->db->get_where('attendancelist', array('id' => $id))->row();
		   ?>
          <tr class="table-row" id="table-row-<?php echo $row->id; ?>">
				<td contenteditable="true" onBlur="saveToDatabase(this,'district',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->district; ?> </td>
				<td bgcolor="#f2eded"><?php echo $row->project_no; ?> </td>
		<td bgcolor="#f2eded"><?php echo $row->activity; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'training_date',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->training_date; ?>  </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'name',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->name; ?></td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'sex',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->sex; ?></td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'age',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->age; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'contact',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->contact; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'area_of_settlement',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->area_of_settlement; ?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'organization',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->organization; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'occupation',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->occupation; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'comments',<?php echo $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->comments; ?> </td>		
			
		<td><a href="javascript:void(0)" onclick="deleteRecord(<?php echo $row->id; ?>);">Delete</a></td>
			
			</tr>
       
           <?php
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('projectactivity_id', 'Projectactivity id', 'trim|required');
       $this->form_validation->set_rules('training_date', 'Training date', 'trim|required');
       $this->form_validation->set_rules('name', 'Name', 'trim|required');
       $this->form_validation->set_rules('sex', 'Sex', 'trim|required');
       $this->form_validation->set_rules('contact', 'Contact', 'trim|required');
       $this->form_validation->set_rules('district_id', 'District id', 'trim|required');
       $this->form_validation->set_rules('area_of_settlement', 'Area of settlement', 'trim|required');
       $this->form_validation->set_rules('organization', 'Organization', 'trim|required');
       $this->form_validation->set_rules('occupation', 'Occupation', 'trim|required');
       $this->form_validation->set_rules('comments', 'Comments', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'projectactivity_id' => $this->input->post('projectactivity_id'),
               'training_date' => $this->input->post('training_date'),
               'name' => $this->input->post('name'),
               'sex' => $this->input->post('sex'),
               'contact' => $this->input->post('contact'),
               'district_id' => $this->input->post('district_id'),
               'area_of_settlement' => $this->input->post('area_of_settlement'),
               'organization' => $this->input->post('organization'),
               'occupation' => $this->input->post('occupation'),
               'comments' => $this->input->post('comments'),
           );
           $this->db->insert('attendancelist', $data);
           redirect('attendancelist','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('attendancelist','refresh');
       }
       $row = $this->db->get_where('attendancelist', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('attendancelist','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('attendancelist/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('projectactivity_id', 'Projectactivity id', 'trim|required');
       $this->form_validation->set_rules('training_date', 'Training date', 'trim|required');
       $this->form_validation->set_rules('name', 'Name', 'trim|required');
       $this->form_validation->set_rules('sex', 'Sex', 'trim|required');
       $this->form_validation->set_rules('contact', 'Contact', 'trim|required');
       $this->form_validation->set_rules('district_id', 'District id', 'trim|required');
       $this->form_validation->set_rules('area_of_settlement', 'Area of settlement', 'trim|required');
       $this->form_validation->set_rules('organization', 'Organization', 'trim|required');
       $this->form_validation->set_rules('occupation', 'Occupation', 'trim|required');
       $this->form_validation->set_rules('comments', 'Comments', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'projectactivity_id' => $this->input->post('projectactivity_id'),
               'training_date' => $this->input->post('training_date'),
               'name' => $this->input->post('name'),
               'sex' => $this->input->post('sex'),
               'contact' => $this->input->post('contact'),
               'district_id' => $this->input->post('district_id'),
               'area_of_settlement' => $this->input->post('area_of_settlement'),
               'organization' => $this->input->post('organization'),
               'occupation' => $this->input->post('occupation'),
               'comments' => $this->input->post('comments'),
           );
           $this->db->where('id', $id);
           $this->db->update('attendancelist', $data);
           redirect('attendancelist','refresh');
       }
   }
   
   
    public function save_beneficiary()
   {
	   
	   /**
	   SEARCHING BASED ON DATE
	   ------------------------
	   SELECT * , DATE_FORMAT( registration_date,  '%m/%d/%Y' ) AS niceDate
FROM beneficiaryregistration
ORDER BY registration_date DESC 
)

	   **/
	   
	           $project_no = $this->input->post('project_no');
			   $activity_title = $this->input->post('activity');
			   $training_date = $this->input->post('training_date');
			   $name = $this->input->post('name');
               $sex = $this->input->post('sex');   
			   $age = $this->input->post('age');             
               $contact = $this->input->post('contact');
               $district = $this->input->post('district');
               $area_of_settlement = $this->input->post('area_of_settlement');
               $organization = $this->input->post('organization');
               $occupation = $this->input->post('occupation');
               $comments = $this->input->post('comments');
               
			  
			   
			   $project = $this->projectsmodel->get_by_no($project_no)->row();
			   
			   $activity = $this->projectactivitiesmodel->get_by_title($activity_title)->row();
			   
		
			  $data = array(
			  'project_id' => $project->id,
			  'project_no' => $this->input->post('project_no'),
               'projectactivity_id' => $activity->id,
			   'activity' => $this->input->post('activity'),
               'training_date' => $this->input->post('training_date'),
               'name' => $this->input->post('name'),
               'sex' => $this->input->post('sex'),
			   'age' => $this->input->post('age'),
               'contact' => $this->input->post('contact'),
               'district' => $this->input->post('district'),
               'area_of_settlement' => $this->input->post('area_of_settlement'),
               'organization' => $this->input->post('organization'),
               'occupation' => $this->input->post('occupation'),
               'comments' => $this->input->post('comments'),
           );
           $this->db->insert('attendancelist', $data);
		   
		   $id = $this->db->insert_id();
		
		echo json_encode(array(
			'id' => $id,
			'project_no' => $project_no,
               'activity' => $activity_title,
               'training_date' => $training_date,
               'name' => $name,
               'sex' => $sex,
			   'age' => $age,
               'contact' => $contact,
               'district' => $district,
               'area_of_settlement' => $area_of_settlement,
               'organization' => $organization,
               'occupation' => $occupation,
               'comments' => $comments,
		));
   }
   
   
   public function edit_beneficiary()
   {
	   
	  $id =$this->input->post('id');
	 
	 $project_no = $this->input->post('project_no');
			   $activity_title = $this->input->post('activity');
			   $training_date = $this->input->post('training_date');
			   $name = $this->input->post('name');
               $sex = $this->input->post('sex'); 
			    $age = $this->input->post('age');             
               $contact = $this->input->post('contact');
               $district = $this->input->post('district');
               $area_of_settlement = $this->input->post('area_of_settlement');
               $organization = $this->input->post('organization');
               $occupation = $this->input->post('occupation');
               $comments = $this->input->post('comments');
			   
			   $project = $this->projectsmodel->get_by_no($project_no)->row();
			   
			   $activity = $this->projectactivitiesmodel->get_by_title($activity_title)->row();
		
			 $data = array(
			  'project_id' => $project->id,
			  'project_no' => $this->input->post('project_no'),
               'projectactivity_id' => $activity->id,
			   'activity' => $this->input->post('activity'),
               'training_date' => $this->input->post('training_date'),
               'name' => $this->input->post('name'),
               'sex' => $this->input->post('sex'),
			   'age' => $this->input->post('age'),
               'contact' => $this->input->post('contact'),
               'district' => $this->input->post('district'),
               'area_of_settlement' => $this->input->post('area_of_settlement'),
               'organization' => $this->input->post('organization'),
               'occupation' => $this->input->post('occupation'),
               'comments' => $this->input->post('comments'),
           );
          
		  $this->db->where('id', $id);
          $this->db->update('attendancelist', $data);
		   
		
		echo json_encode(array(
			'id' => $id,
			'project_no' => $project_no,
               'activity' => $activity_title,
               'training_date' => $training_date,
               'name' => $name,
               'sex' => $sex,
			   'age' => $age,
               'contact' => $contact,
               'district' => $district,
               'area_of_settlement' => $area_of_settlement,
               'organization' => $organization,
               'occupation' => $occupation,
               'comments' => $comments,
		));
   }
   
   
    public function destroy_beneficiary()
   {
	   $id = $this->input->post('id');
	   $this->db->delete('attendancelist', array('id' => $id));
	   echo json_encode(array('success'=>true));
   }
   
    public function get_beneficiaries($project_id,$projectactivity_id)
   {
	   $sql = 'select * from attendancelist where project_id='.$project_id.' AND projectactivity_id='.$projectactivity_id;
	   $query = $this->db->query($sql);
		
		$result = array();
		foreach ( $query->result() as $row ){
			array_push($result, $row);
		}
		
		echo json_encode($result);
   }
   
    public function get_districts()
   {
	   $sql = 'SELECT id,district FROM districts';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{countyID:\''.$row->id.'\',County:\''.$row->district.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
   }
   
    public function get_diversities()
   {
	   $sql = 'SELECT id,beneficiary_type FROM beneficiarytypes';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{beneficiaryID:\''.$row->id.'\',Beneficiary:\''.$row->beneficiary_type.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
   }
   
      public function get_projects($project_id)
   {
	   $sql = 'SELECT id,project_no FROM projects WHERE id='.$project_id;
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{projectID:\''.$row->id.'\',Project:\''.$row->project_no.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
   }
   
   public function get_activities($id)
   {
	   $sql = 'SELECT id,activity FROM projectactivities WHERE id='.$id;
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{activityID:\''.$row->id.'\',Activity:\''.$row->activity.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
   }


   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('attendancelist','refresh');
       }
       $this->db->delete('attendancelist', array('id' => $id));
       redirect('attendancelist','refresh');
   }

}
