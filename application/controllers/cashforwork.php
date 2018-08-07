<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Cashforwork extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('cashforworkmodel');
   }
   
   public function addreport($project_id,$projectaactivity_id)
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
	   
	      
	   $data['dnrs'] = $this->get_donors();
	   $data['dist'] = $this->get_districts();
	   $data['ben'] = $this->get_the_beneficiaries();
	   
       $this->load->view('cashforwork/add',$data);;
   }


   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   /**
       $data = array(
           'rows' => $this->db->get('cashforwork'),
       );
       $this->load->view('cashforwork/index', $data);
	   **/
	   redirect('cashforwork/activityreport','refresh');
   }
   
    public function activityreport()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
	  
       $this->load->view('cashforwork/activityreport',$data);
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
	   
	   $data['dnrs'] = $this->get_donors();
	   $data['dist'] = $this->get_districts();
	   $data['ben'] = $this->get_the_beneficiaries();
	   
	   $data['project'] = $this->projectsmodel->get_by_id($project_id)->row();
	   $data['activity'] = $this->projectactivitiesmodel->get_by_id($projectaactivity_id)->row();
	   
	   $registrations = $this->db->get('beneficiaryregistration');
	   
	   $beneficiary_select = '<select name="beneficiaryregistration_id" id="beneficiaryregistration_id">';
	   
	   foreach ($registrations->result() as $registration):
	   	$beneficiary_select .= '<option value="'.$registration->id.'">('.$registration->id_no.') - '.$registration->name_of_beneficiary.'</option>';
	   endforeach;
	   
	   $beneficiary_select .= '</select>';
	   
	   $data['beneficiary_select'] = $beneficiary_select;
	   $data['registrations'] = $registrations;
	   
	   $activitybeneficiaries = $this->cashforworkmodel->get_by_project_activity($project_id,$projectaactivity_id);
	   
	   
	   $registrationrow = '<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
		<thead>
		<tr>
		<th>Project </th>
		<th>Activity </th>
		<th>Date  </th>
		<th>Funded By </th>
		<th>District</th>
		<th>S/N. </th>
		<th>Location </th>
		<th>Beneficiary </th>
		<th>Mobile </th>
		<th>Amount </th>
		<th>Action </th>
		</tr>
		</thead>
		<tbody id="table-body">
		';
		
		foreach($activitybeneficiaries as $key=>$activitybeneficiary)
		{
			$registrationrow .= '<tr class="table-row" id="table-row-'.$activitybeneficiary['id'].'">
		<td>'.$activitybeneficiary['project_no'].' </td>
		<td>'.$activitybeneficiary['activity'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'payment_date\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['payment_date'].'  </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'funded_by\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['funded_by'].'</td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'district\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['district'].'</td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'sn\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['sn'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'location\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['location'].' </td>
		<td>'.$activitybeneficiary['beneficiary_name'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'mobile_cash_transfer\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['mobile_cash_transfer'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'amount\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['amount'].' </td>
		<td><a href="javascript:void(0)" onclick="deleteRecord('.$activitybeneficiary['id'].');">Delete</a></td>
			</tr>';
		}
		
		 $registrationrow .= '</tbody>
</table>';
	   
	   $data['registrationrow']= $registrationrow;
       $this->load->view('cashforwork/addbeneficiary',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('payment_date', 'Payment date', 'trim|required');
       $this->form_validation->set_rules('funded_by', 'Funded by', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('sn', 'Sn', 'trim|required');
       $this->form_validation->set_rules('location', 'Location', 'trim|required');
       $this->form_validation->set_rules('beneficiary_name', 'Beneficiary name', 'trim|required');
       $this->form_validation->set_rules('mothers_name', 'Mothers name', 'trim|required');
       $this->form_validation->set_rules('next_of_keen', 'Next of keen', 'trim|required');
       $this->form_validation->set_rules('mobile_cash_transfer', 'Mobile cash transfer', 'trim|required');
       $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'payment_date' => $this->input->post('payment_date'),
               'funded_by' => $this->input->post('funded_by'),
               'district' => $this->input->post('district'),
               'sn' => $this->input->post('sn'),
               'location' => $this->input->post('location'),
               'beneficiary_name' => $this->input->post('beneficiary_name'),
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_keen' => $this->input->post('next_of_keen'),
               'mobile_cash_transfer' => $this->input->post('mobile_cash_transfer'),
               'amount' => $this->input->post('amount'),
           );
           $this->db->insert('cashforwork', $data);
           redirect('cashforwork','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('cashforwork','refresh');
       }
       $row = $this->db->get_where('cashforwork', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('cashforwork','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('cashforwork/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('payment_date', 'Payment date', 'trim|required');
       $this->form_validation->set_rules('funded_by', 'Funded by', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('sn', 'Sn', 'trim|required');
       $this->form_validation->set_rules('location', 'Location', 'trim|required');
       $this->form_validation->set_rules('beneficiary_name', 'Beneficiary name', 'trim|required');
       $this->form_validation->set_rules('mothers_name', 'Mothers name', 'trim|required');
       $this->form_validation->set_rules('next_of_keen', 'Next of keen', 'trim|required');
       $this->form_validation->set_rules('mobile_cash_transfer', 'Mobile cash transfer', 'trim|required');
       $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'payment_date' => $this->input->post('payment_date'),
               'funded_by' => $this->input->post('funded_by'),
               'district' => $this->input->post('district'),
               'sn' => $this->input->post('sn'),
               'location' => $this->input->post('location'),
               'beneficiary_name' => $this->input->post('beneficiary_name'),
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_keen' => $this->input->post('next_of_keen'),
               'mobile_cash_transfer' => $this->input->post('mobile_cash_transfer'),
               'amount' => $this->input->post('amount'),
           );
           $this->db->where('id', $id);
           $this->db->update('cashforwork', $data);
           redirect('cashforwork','refresh');
       }
   }
   
   /**
   public function get_beneficiaries()
   {
	   $sql = 'select * from cashforwork';
	   $query = $this->db->query($sql);
		
		$result = array();
		foreach ( $query->result() as $row ){
			array_push($result, $row);
		}
		
		echo json_encode($result);
   }
   **/
    public function get_beneficiaries($project_id,$projectaactivity_id)
   {
	   $sql = 'select * from cashforwork WHERE project_id='.$project_id.' AND projectaactivity_id='.$projectaactivity_id;
	   $query = $this->db->query($sql);
		
		$result = array();
		foreach ( $query->result() as $row ){
			array_push($result, $row);
		}
		
		echo json_encode($result);
   }
   
   
    public function save_beneficiary()
   {
	   
	   $payment_date= $this->input->post('payment_date');
               $funded_by= $this->input->post('funded_by');
               $district= $this->input->post('district');
               $sn= $this->input->post('sn');
               $location= $this->input->post('location');
               $beneficiary_name= $this->input->post('beneficiary_name');
               $mothers_name= $this->input->post('mothers_name');
               $next_of_keen= $this->input->post('next_of_keen');
               $mobile_cash_transfer= $this->input->post('mobile_cash_transfer');
               $amount= $this->input->post('amount');
			   
			   $beneficiary = $this->beneficiaryregistrationmodel->get_by_name($beneficiary_name)->row();
			   $beneficiaryregistration_id = $beneficiary->id;
			   
			   $project_no = $this->input->post('project_no');
			   $activity_title = $this->input->post('activity');
			   
			   $project = $this->projectsmodel->get_by_no($project_no)->row();
			   
			   $activity = $this->projectactivitiesmodel->get_by_title($activity_title)->row();
		
			 $data = array(
               'payment_date' => $this->input->post('payment_date'),
               'funded_by' => $this->input->post('funded_by'),
               'district' => $this->input->post('district'),
               'sn' => $this->input->post('sn'),
               'location' => $this->input->post('location'),
			   'beneficiaryregistration_id' => $beneficiaryregistration_id,
               'beneficiary_name' => $this->input->post('beneficiary_name'),
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_keen' => $this->input->post('next_of_keen'),
               'mobile_cash_transfer' => $this->input->post('mobile_cash_transfer'),
			   'amount' => $this->input->post('amount'),
			   'project_id' => $project->id,
			   'project_no' => $this->input->post('project_no'),
			   'projectaactivity_id' => $activity->id,
			   'activity' => $this->input->post('activity'),
           );
           $this->db->insert('cashforwork', $data);
		   
		   $id = $this->db->insert_id();
		
		echo json_encode(array(
			'id' => $id,
			'payment_date' => $payment_date,
               'funded_by' => $funded_by,
               'district' => $district,
               'sn' => $sn,
               'location' => $location,
               'beneficiary_name' => $beneficiary_name,
               'mothers_name' => $mothers_name,
               'next_of_keen' => $next_of_keen,
               'mobile_cash_transfer' => $mobile_cash_transfer,
               'amount' => $amount,
		));
   }
   
   
    public function edit_beneficiary()
   {
	   
	   $payment_date= $this->input->post('payment_date');
               $funded_by= $this->input->post('funded_by');
               $district= $this->input->post('district');
               $sn= $this->input->post('sn');
               $location= $this->input->post('location');
               $beneficiary_name = $this->input->post('beneficiary_name');
               $mothers_name= $this->input->post('mothers_name');
               $next_of_keen= $this->input->post('next_of_keen');
               $mobile_cash_transfer= $this->input->post('mobile_cash_transfer');
               $amount= $this->input->post('amount');
			  
			  $beneficiary = $this->beneficiaryregistrationmodel->get_by_name($beneficiary_name)->row();	
			  
			  
			   $project_no = $this->input->post('project_no');
			   $activity_title = $this->input->post('activity');
			   
			   $project = $this->projectsmodel->get_by_no($project_no)->row();
			   
			   $activity = $this->projectactivitiesmodel->get_by_title($activity_title)->row();		   
			   
			     $id = $this->input->post('id');
		
			 $data = array(
               'funded_by' => $this->input->post('funded_by'),
               'district' => $this->input->post('district'),
               'sn' => $this->input->post('sn'),
               'location' => $this->input->post('location'),
			   'beneficiaryregistration_id' => $beneficiary->id,
               'beneficiary_name' => $beneficiary_name,
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_keen' => $this->input->post('next_of_keen'),
               'mobile_cash_transfer' => $this->input->post('mobile_cash_transfer'),
               'amount' => $this->input->post('amount'),
			   'payment_date' => $this->input->post('payment_date'),
			   'project_id' => $project->id,
			   'project_no' => $this->input->post('project_no'),
			   'projectaactivity_id' => $activity->id,
			   'activity' => $this->input->post('activity'),
           );
           $this->db->where('id', $id);
           $this->db->update('cashforwork', $data);   
		   
		 
		
		echo json_encode(array(
			'id' => $id,
			'payment_date' => $payment_date,
               'funded_by' => $funded_by,
               'district' => $district,
               'sn' => $sn,
               'location' => $location,
               'beneficiary_name' => $beneficiary_name,
               'mothers_name' => $mothers_name,
               'next_of_keen' => $next_of_keen,
               'mobile_cash_transfer' => $mobile_cash_transfer,
               'amount' => $amount,
		));
   }
   
   
   public function destroy_beneficiary()
   {
	   $id = $this->input->post('id');
	   $this->db->delete('cashforwork', array('id' => $id));
	   echo json_encode(array('success'=>true));
   }
   
   
    public function get_donors()
   {
	   $sql = 'SELECT id,donor_name FROM donors';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{DonorID:\''.$row->id.'\',DonorName:\''.$row->donor_name.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
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
   
   
    public function get_the_beneficiaries()
   {
	   $sql = 'SELECT id,name_of_beneficiary FROM beneficiaryregistration';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{beneficiaryID:\''.$row->id.'\',Beneficiary:\''.$row->name_of_beneficiary.'\'},';
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
   
   public function editcolumn()
   {
	   $column = $_POST["column"];
	   $editval = trim(addslashes(htmlspecialchars(rawurldecode($_POST['editval']))));
	   $id = $_POST["id"];
	   
	   $data = array(
               ''.$column.'' => $editval,
           );
          $this->db->where('id', $id);
          $this->db->update('cashforwork', $data);
   }
   
   public function delete_record()
   {
	   $id = $_POST["id"];
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   $this->db->delete('cashforwork', array('id' => $id));
   }
   
   public function addrecord()
   {
	  $payment_date = mysql_real_escape_string(strip_tags($_POST['payment_date']));
       $funded_by = mysql_real_escape_string(strip_tags($_POST['funded_by']));
       $district = mysql_real_escape_string(strip_tags($_POST['district']));
       $sn = mysql_real_escape_string(strip_tags($_POST['sn']));
       $location = mysql_real_escape_string(strip_tags($_POST['location']));
	   $beneficiaryregistration_id = mysql_real_escape_string(strip_tags($_POST['beneficiaryregistration_id']));
	   $mobile_cash_transfer = mysql_real_escape_string(strip_tags($_POST['mobile_cash_transfer']));
	   $amount = mysql_real_escape_string(strip_tags($_POST['amount']));
	   $project_id = mysql_real_escape_string(strip_tags($_POST['project_id']));
	   $projectaactivity_id = mysql_real_escape_string(strip_tags($_POST['projectaactivity_id']));
	   
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   $activity = $this->projectactivitiesmodel->get_by_id($projectaactivity_id)->row();
	   $beneficiary = $this->beneficiaryregistrationmodel->get_by_id($beneficiaryregistration_id)->row();
	 	  
	   $data = array(
               'payment_date' => $payment_date,
               'funded_by' => $funded_by,
               'district' => $district,
               'sn' => $sn,
               'location' => $location,
			   'beneficiaryregistration_id' => $beneficiaryregistration_id,
               'beneficiary_name' => $beneficiary->name_of_beneficiary,
               'mothers_name' => $beneficiary->name_of_beneficiary,
               'next_of_keen' => $beneficiary->next_of_kin,
               'mobile_cash_transfer' => $mobile_cash_transfer,
               'amount' => $amount,
			   'project_id' => $project_id,
			   'project_no' => $project->project_no,
			   'projectaactivity_id' => $projectaactivity_id,
			   'activity' => $activity->activity,
           );
		   
		  
          $this->db->insert('cashforwork', $data);
		   
		  $id = $this->db->insert_id();
		   
		  $row = $this->db->get_where('cashforwork', array('id' => $id))->row();
		   ?>
          <tr class="table-row" id="table-row-<?php $row->id; ?>">
		<td><?php $row->project_no; ?> </td>
		<td><?php $row->activity; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'payment_date','<?php $row->id; ?>')" onClick="showEdit(this);"><?php $row->payment_date; ?>  </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'funded_by','<?php $row->id; ?>')" onClick="showEdit(this);"><?php $row->funded_by; ?></td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'district','<?php $row->id; ?>')" onClick="showEdit(this);"><?php $row->district; ?></td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'sn','<?php $row->id; ?>')" onClick="showEdit(this);"><?php $row->sn; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'location','<?php $row->id; ?>')" onClick="showEdit(this);"><?php $row->location; ?> </td>
		<td><?php $row->beneficiary_name; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'mobile_cash_transfer','<?php $row->id; ?>')" onClick="showEdit(this);"><?php $row->mobile_cash_transfer; ?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'amount','<?php $row->id; ?>')" onClick="showEdit(this);"><?php $row->amount; ?> </td>
		<td><a href="javascript:void(0)" onclick="deleteRecord(<?php echo $row->id; ?>);">Delete</a></td>
			</tr>
           <?php
   }
   
     
   

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('cashforwork','refresh');
       }
       $this->db->delete('cashforwork', array('id' => $id));
       redirect('cashforwork','refresh');
   }

}
