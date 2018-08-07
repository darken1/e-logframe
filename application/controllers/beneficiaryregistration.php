<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Beneficiaryregistration extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('beneficiaryregistrationmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   /**
       $data = array(
           'rows' => $this->db->get('beneficiaryregistration'),
       );
       $this->load->view('beneficiaryregistration/index', $data);
	   
	   **/
	   redirect('beneficiaryregistration/cashregistration','refresh');
   }
   
   public function fetch_single()
   {
	  
     $rows = $this->db->get('myusers');
	 
	 foreach ($rows->result() as $row):
	 
	 
	 
	 endforeach;
   }
   
   
   public function form()
   {
	   
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('beneficiaryregistration'),
       );
       $this->load->view('beneficiaryregistration/form', $data);
   }
   
   
   


   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   $data['prj'] = $this->get_projects();
	   $data['dist'] = $this->get_districts();
       $this->load->view('beneficiaryregistration/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('id_no', 'Id no', 'trim|required');
       $this->form_validation->set_rules('name_of_beneficiary', 'Name of beneficiary', 'trim|required');
       $this->form_validation->set_rules('mothers_name', 'Mothers name', 'trim|required');
       $this->form_validation->set_rules('next_of_kin', 'Next of kin', 'trim|required');
       $this->form_validation->set_rules('sex', 'Sex', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('settlement', 'Settlement', 'trim|required');
       $this->form_validation->set_rules('telephone_number', 'Telephone number', 'trim|required');
       $this->form_validation->set_rules('zero_to_four_female', 'Zero to four female', 'trim|required');
       $this->form_validation->set_rules('zero_to_four_male', 'Zero to four male', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_female', 'Five to seventeen female', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_male', 'Five to seventeen male', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_female', 'Eighteen to fifty nine female', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_male', 'Eighteen to fifty nine male', 'trim|required');
       $this->form_validation->set_rules('sixty_above_female', 'Sixty above female', 'trim|required');
       $this->form_validation->set_rules('sixty_above_male', 'Sixty above male', 'trim|required');
       $this->form_validation->set_rules('total_family_size', 'Total family size', 'trim|required');
       $this->form_validation->set_rules('programme_area', 'Programme area', 'trim|required');
       $this->form_validation->set_rules('donor', 'Donor', 'trim|required');
       $this->form_validation->set_rules('registration_month', 'Registration month', 'trim|required');
       $this->form_validation->set_rules('registration_date', 'Registration date', 'trim|required');
       $this->form_validation->set_rules('project_number', 'Project number', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'id_no' => $this->input->post('id_no'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_kin' => $this->input->post('next_of_kin'),
               'sex' => $this->input->post('sex'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'telephone_number' => $this->input->post('telephone_number'),
               'zero_to_four_female' => $this->input->post('zero_to_four_female'),
               'zero_to_four_male' => $this->input->post('zero_to_four_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
               'programme_area' => $this->input->post('programme_area'),
               'donor' => $this->input->post('donor'),
               'registration_month' => $this->input->post('registration_month'),
               'registration_date' => $this->input->post('registration_date'),
               'project_number' => $this->input->post('project_number'),
           );
           $this->db->insert('beneficiaryregistration', $data);
           redirect('beneficiaryregistration','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('beneficiaryregistration','refresh');
       }
       $row = $this->db->get_where('beneficiaryregistration', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('beneficiaryregistration','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('beneficiaryregistration/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('id_no', 'Id no', 'trim|required');
       $this->form_validation->set_rules('name_of_beneficiary', 'Name of beneficiary', 'trim|required');
       $this->form_validation->set_rules('mothers_name', 'Mothers name', 'trim|required');
       $this->form_validation->set_rules('next_of_kin', 'Next of kin', 'trim|required');
       $this->form_validation->set_rules('sex', 'Sex', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('settlement', 'Settlement', 'trim|required');
       $this->form_validation->set_rules('telephone_number', 'Telephone number', 'trim|required');
       $this->form_validation->set_rules('zero_to_four_female', 'Zero to four female', 'trim|required');
       $this->form_validation->set_rules('zero_to_four_male', 'Zero to four male', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_female', 'Five to seventeen female', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_male', 'Five to seventeen male', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_female', 'Eighteen to fifty nine female', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_male', 'Eighteen to fifty nine male', 'trim|required');
       $this->form_validation->set_rules('sixty_above_female', 'Sixty above female', 'trim|required');
       $this->form_validation->set_rules('sixty_above_male', 'Sixty above male', 'trim|required');
       $this->form_validation->set_rules('total_family_size', 'Total family size', 'trim|required');
       $this->form_validation->set_rules('programme_area', 'Programme area', 'trim|required');
       $this->form_validation->set_rules('donor', 'Donor', 'trim|required');
       $this->form_validation->set_rules('registration_month', 'Registration month', 'trim|required');
       $this->form_validation->set_rules('registration_date', 'Registration date', 'trim|required');
       $this->form_validation->set_rules('project_number', 'Project number', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'id_no' => $this->input->post('id_no'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_kin' => $this->input->post('next_of_kin'),
               'sex' => $this->input->post('sex'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'telephone_number' => $this->input->post('telephone_number'),
               'zero_to_four_female' => $this->input->post('zero_to_four_female'),
               'zero_to_four_male' => $this->input->post('zero_to_four_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
               'programme_area' => $this->input->post('programme_area'),
               'donor' => $this->input->post('donor'),
               'registration_month' => $this->input->post('registration_month'),
               'registration_date' => $this->input->post('registration_date'),
               'project_number' => $this->input->post('project_number'),
           );
           $this->db->where('id', $id);
           $this->db->update('beneficiaryregistration', $data);
           redirect('beneficiaryregistration','refresh');
       }
   }
   
   
   public function save_beneficiary()
   {
	   
	   $id_no = $_POST['id_no'];
		$name_of_beneficiary = $_POST['name_of_beneficiary'];
		$mothers_name = $_POST['mothers_name'];
		$next_of_kin = $_POST['next_of_kin'];
		$sex = $_POST['sex'];
		$district = $_POST['district'];
		$settlement = $_POST['settlement'];
		$telephone_number = $_POST['telephone_number'];
		$zero_to_four_female = $_POST['zero_to_four_female'];
		$zero_to_four_male = $_POST['zero_to_four_male'];
		$five_to_seventeen_female = $_POST['five_to_seventeen_female'];
		$five_to_seventeen_male = $_POST['five_to_seventeen_male'];
		$eighteen_to_fifty_nine_female = $_POST['eighteen_to_fifty_nine_female'];
		$eighteen_to_fifty_nine_male = $_POST['eighteen_to_fifty_nine_male'];
		$sixty_above_female = $_POST['sixty_above_female'];
		$sixty_above_male = $_POST['sixty_above_male'];
		$total_family_size = $_POST['total_family_size'];
		$programme_area = $_POST['programme_area'];
		$donor = $_POST['donor'];
		$registration_month = date('M');
		//$registration_date = date('Y-m-d');
		$registration_date = $_POST['registration_date'];
		$project_number = $_POST['project_number'];
		
			  $data = array(
               'id_no' => $this->input->post('id_no'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_kin' => $this->input->post('next_of_kin'),
               'sex' => $this->input->post('sex'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'telephone_number' => $this->input->post('telephone_number'),
               'zero_to_four_female' => $this->input->post('zero_to_four_female'),
               'zero_to_four_male' => $this->input->post('zero_to_four_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
               'programme_area' => $this->input->post('programme_area'),
               'donor' => $this->input->post('donor'),
               'registration_month' => date('M'),
               'registration_date' => $this->input->post('registration_date'),
               'project_number' => $this->input->post('project_number'),
           );
           $this->db->insert('beneficiaryregistration', $data);
		   
		   $id = $this->db->insert_id();
		
		echo json_encode(array(
			'id' => $id,
			'id_no' => $id_no,
			'name_of_beneficiary' => $name_of_beneficiary,
			'mothers_name' => $mothers_name,
			'next_of_kin' => $next_of_kin,
			'sex' => $sex,
			'district' => $district,
			'settlement' => $settlement,
			'telephone_number' => $telephone_number,
			'zero_to_four_female' => $zero_to_four_female,
			'zero_to_four_male' => $zero_to_four_male,
			'five_to_seventeen_female' => $five_to_seventeen_female,
			'five_to_seventeen_male' => $five_to_seventeen_male,
			'eighteen_to_fifty_nine_female' => $eighteen_to_fifty_nine_female,
			'eighteen_to_fifty_nine_male' => $eighteen_to_fifty_nine_male,
			'sixty_above_female' => $sixty_above_female,
			'sixty_above_male' => $sixty_above_male,
			'total_family_size' => $total_family_size,
			'programme_area' => $programme_area,
			'donor' => $donor,
			'registration_month' => $registration_month,
			'registration_date' => $registration_date,
			'project_number' => $project_number,
		));
   }
   
   
   public function edit_beneficiary()
   {
	   
	   $id_no = $_POST['id_no'];
		$name_of_beneficiary = $_POST['name_of_beneficiary'];
		$mothers_name = $_POST['mothers_name'];
		$next_of_kin = $_POST['next_of_kin'];
		$sex = $_POST['sex'];
		$district = $_POST['district'];
		$settlement = $_POST['settlement'];
		$telephone_number = $_POST['telephone_number'];
		$zero_to_four_female = $_POST['zero_to_four_female'];
		$zero_to_four_male = $_POST['zero_to_four_male'];
		$five_to_seventeen_female = $_POST['five_to_seventeen_female'];
		$five_to_seventeen_male = $_POST['five_to_seventeen_male'];
		$eighteen_to_fifty_nine_female = $_POST['eighteen_to_fifty_nine_female'];
		$eighteen_to_fifty_nine_male = $_POST['eighteen_to_fifty_nine_male'];
		$sixty_above_female = $_POST['sixty_above_female'];
		$sixty_above_male = $_POST['sixty_above_male'];
		$total_family_size = $_POST['total_family_size'];
		$programme_area = $_POST['programme_area'];
		$donor = $_POST['donor'];
		$registration_month = date('M');
		$registration_date = $this->input->post('registration_date');
		$project_number = $_POST['project_number'];
		
		 $id = $this->input->post('id');
		 
			  $data = array(
               'id_no' => $this->input->post('id_no'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'mothers_name' => $this->input->post('mothers_name'),
               'next_of_kin' => $this->input->post('next_of_kin'),
               'sex' => $this->input->post('sex'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'telephone_number' => $this->input->post('telephone_number'),
               'zero_to_four_female' => $this->input->post('zero_to_four_female'),
               'zero_to_four_male' => $this->input->post('zero_to_four_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
			   'registration_date' => $this->input->post('registration_date'),
               'project_number' => $this->input->post('project_number'),
           );
           $this->db->where('id', $id);
           $this->db->update('beneficiaryregistration', $data);
		
		echo json_encode(array(
			'id' => $id,
			'id_no' => $id_no,
			'name_of_beneficiary' => $name_of_beneficiary,
			'mothers_name' => $mothers_name,
			'next_of_kin' => $next_of_kin,
			'sex' => $sex,
			'district' => $district,
			'settlement' => $settlement,
			'telephone_number' => $telephone_number,
			'zero_to_four_female' => $zero_to_four_female,
			'zero_to_four_male' => $zero_to_four_male,
			'five_to_seventeen_female' => $five_to_seventeen_female,
			'five_to_seventeen_male' => $five_to_seventeen_male,
			'eighteen_to_fifty_nine_female' => $eighteen_to_fifty_nine_female,
			'eighteen_to_fifty_nine_male' => $eighteen_to_fifty_nine_male,
			'sixty_above_female' => $sixty_above_female,
			'sixty_above_male' => $sixty_above_male,
			'total_family_size' => $total_family_size,
			'programme_area' => $programme_area,
			'donor' => $donor,
			'registration_month' => $registration_month,
			'registration_date' => $registration_date,
			'project_number' => $project_number,
		));
   }
   
   public function destroy_beneficiary()
   {
	   $id = $this->input->post('id');
	   $this->db->delete('beneficiaryregistration', array('id' => $id));
	   echo json_encode(array('success'=>true));
   }
   
   
   public function get_beneficiaries()
   {
	   $sql = 'SELECT * FROM beneficiaryregistration ORDER BY id DESC';
	   $query = $this->db->query($sql);
		
		$result = array();
		foreach ( $query->result() as $row ){
			array_push($result, $row);
		}
		
		echo json_encode($result);
   }
   
   public function get_projects()
   {
	   $sql = 'SELECT id,project_no FROM projects';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{ProjectID:\''.$row->id.'\',ProjectCode:\''.$row->project_no.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
   }
   
   public function get_districts()
   {
	   $sql = 'SELECT id,county FROM counties';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{countyID:\''.$row->id.'\',County:\''.$row->county.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
   }
   
   
   public function cashregistration()
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('beneficiaryregistration'),
       );
	   
	   $registrations = $this->db->get('beneficiaryregistration');
	   
		$registrationrow = '<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
		<thead>
		<tr>
		
		<th>Id no</th>
		<th>Name of beneficiary</th>
		<th>Mothers name</th>
		<th>Next of kin</th>
		<th>Sex</th>
		<th>District</th>
		<th>Settlement</th>
		<th>Telephone number</th>
		<th>0-4 F</th>
		<th>0-4 M</th>
		<th>5-17 F</th>
		<th>5-17 M</th>
		<th>18-59 F</th>
		<th>18-59 M</th>
		<th>60 > F</th>
		<th>60 > M</th>
		<th>Total family size</th>
		<th>Programme area</th>
		<th>Donor</th>
		<th>Registration month</th>
		<th>Registration date</th>
		<th>Project number</th>
		<th>Actions</th>
		</tr>
		
		</thead>
		<tbody id="table-body">
		';
	   
	   foreach ($registrations->result() as $registration):
	   
	   	$registrationrow .= '<tr class="table-row" id="table-row-'.$registration->id.'">
			<td contenteditable="true" onBlur="saveToDatabase(this,\'id_no\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->id_no.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'name_of_beneficiary\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->name_of_beneficiary.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'mothers_name\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->mothers_name.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'next_of_kin\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->next_of_kin.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sex\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->sex.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'district\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->district.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'settlement\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->settlement.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'telephone_number\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->telephone_number.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'zero_to_four_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->zero_to_four_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'zero_to_four_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->zero_to_four_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->five_to_seventeen_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->five_to_seventeen_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->eighteen_to_fifty_nine_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->eighteen_to_fifty_nine_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->sixty_above_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->sixty_above_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'total_family_size\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->total_family_size.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'programme_area\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->programme_area.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'donor\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->donor.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'registration_month\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->registration_month.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'registration_date\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->registration_date.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'project_number\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->project_number.'</td>
			<td><a href="javascript:void(0)" onclick="deleteRecord('.$registration->id.');">Delete</a></td></tr>';
	   //<td><a href="javascript:void(0)" onclick="deleteObject('.$registration->id.')">Delete</a></td></tr>
	   endforeach;
	   
	   $registrationrow .= '</tbody>
</table>';
	   
	   $data['registrationrow']= $registrationrow;
	   
       $this->load->view('beneficiaryregistration/cashregistration', $data);
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
          $this->db->update('beneficiaryregistration', $data);
   }
   
    public function delete_record()
   {
	   $id = $_POST["id"];
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   $this->db->delete('beneficiaryregistration', array('id' => $id));
   }
   
   
   public function addrecord()
   {
	    $id_no = mysql_real_escape_string(strip_tags($_POST['id_no']));
               $name_of_beneficiary = mysql_real_escape_string(strip_tags($_POST['name_of_beneficiary']));
               $mothers_name = mysql_real_escape_string(strip_tags($_POST['mothers_name']));
               $next_of_kin = mysql_real_escape_string(strip_tags($_POST['next_of_kin']));
               $sex = mysql_real_escape_string(strip_tags($_POST['sex']));
               $district = mysql_real_escape_string(strip_tags($_POST['district']));
               $settlement = mysql_real_escape_string(strip_tags($_POST['settlement']));
               $telephone_number = mysql_real_escape_string(strip_tags($_POST['telephone_number']));
               $zero_to_four_female = mysql_real_escape_string(strip_tags($_POST['zero_to_four_female']));
               $zero_to_four_male = mysql_real_escape_string(strip_tags($_POST['zero_to_four_male']));
               $five_to_seventeen_female = mysql_real_escape_string(strip_tags($_POST['five_to_seventeen_female']));
               $five_to_seventeen_male = mysql_real_escape_string(strip_tags($_POST['five_to_seventeen_male']));
               $eighteen_to_fifty_nine_female = mysql_real_escape_string(strip_tags($_POST['eighteen_to_fifty_nine_female']));
               $eighteen_to_fifty_nine_male = mysql_real_escape_string(strip_tags($_POST['eighteen_to_fifty_nine_male']));
               $sixty_above_female = mysql_real_escape_string(strip_tags($_POST['sixty_above_female']));
               $sixty_above_male = mysql_real_escape_string(strip_tags($_POST['sixty_above_male']));
               $total_family_size = mysql_real_escape_string(strip_tags($_POST['total_family_size']));
               $programme_area = mysql_real_escape_string(strip_tags($_POST['programme_area']));
               $donor = mysql_real_escape_string(strip_tags($_POST['donor']));
               $registration_month = mysql_real_escape_string(strip_tags($_POST['registration_month']));
               $registration_date = mysql_real_escape_string(strip_tags($_POST['registration_date']));
               $project_number = mysql_real_escape_string(strip_tags($_POST['project_number']));
			   
	    $data = array(
              'id_no' => $id_no,
               'name_of_beneficiary' => $name_of_beneficiary,
               'mothers_name' => $mothers_name,
               'next_of_kin' => $next_of_kin,
               'sex' => $sex,
               'district' => $district,
               'settlement' => $settlement,
               'telephone_number' => $telephone_number,
               'zero_to_four_female' => $zero_to_four_female,
               'zero_to_four_male' => $zero_to_four_male,
               'five_to_seventeen_female' => $five_to_seventeen_female,
               'five_to_seventeen_male' => $five_to_seventeen_male,
               'eighteen_to_fifty_nine_female' => $eighteen_to_fifty_nine_female,
               'eighteen_to_fifty_nine_male' => $eighteen_to_fifty_nine_male,
               'sixty_above_female' => $sixty_above_female,
               'sixty_above_male' => $sixty_above_male,
               'total_family_size' => $total_family_size,
               'programme_area' => $programme_area,
               'donor' => $donor,
               'registration_month' => $registration_month,
               'registration_date' => $registration_date,
               'project_number' => $project_number,
           );
           $this->db->insert('beneficiaryregistration', $data);
		   $id = $this->db->insert_id();
		   
		   $row = $this->db->get_where('beneficiaryregistration', array('id' => $id))->row();
		   
		   $registrationrow = '<tr class="table-row" id="table-row-'.$row->id.'">
			<td contenteditable="true" onBlur="saveToDatabase(this,\'id_no\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->id_no.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'name_of_beneficiary\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->name_of_beneficiary.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'mothers_name\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->mothers_name.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'next_of_kin\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->next_of_kin.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sex\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->sex.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'district\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->district.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'settlement\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->settlement.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'telephone_number\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->telephone_number.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'zero_to_four_female\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->zero_to_four_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'zero_to_four_male\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->zero_to_four_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_female\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->five_to_seventeen_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_male\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->five_to_seventeen_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_female\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->eighteen_to_fifty_nine_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_male\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->eighteen_to_fifty_nine_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_female\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->sixty_above_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_male\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->sixty_above_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'total_family_size\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->total_family_size.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'programme_area\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->programme_area.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'donor\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->donor.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'registration_month\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->registration_month.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'registration_date\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->registration_date.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'project_number\',\''.$row->id.'\')" onClick="showEdit(this);">'.$row->project_number.'</td>
			<td><a href="javascript:void(0)" onclick="deleteRecord('.$row->id.');">Delete</a></td></tr>';
			
			
		//echo $registrationrow;
		
		?>
        <tr class="table-row" id="table-row-<?php echo $row->id; ?>">
			<td contenteditable="true" onBlur="saveToDatabase(this,'id_no','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->id_no; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'name_of_beneficiary','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->name_of_beneficiary; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'mothers_name','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->mothers_name; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'next_of_kin','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->next_of_kin; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'sex','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->sex; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'district','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->district; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'settlement','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->settlement; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'telephone_number','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->telephone_number; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'zero_to_four_female','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->zero_to_four_female; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'zero_to_four_male','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->zero_to_four_male; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'five_to_seventeen_female','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->five_to_seventeen_female; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'five_to_seventeen_male','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->five_to_seventeen_male; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'eighteen_to_fifty_nine_female','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->eighteen_to_fifty_nine_female; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'eighteen_to_fifty_nine_male','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->eighteen_to_fifty_nine_male; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'sixty_above_female','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->sixty_above_female; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'sixty_above_male','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->sixty_above_male; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'total_family_size','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->total_family_size; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'programme_area','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->programme_area; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'donor','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->donor; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'registration_month','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->registration_month; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'registration_date','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->registration_date; ?></td>
			<td contenteditable="true" onBlur="saveToDatabase(this,'project_number','<?php $row->id; ?>')" onClick="showEdit(this);"><?php echo $row->project_number; ?></td>
			<td><a href="javascript:void(0)" onclick="deleteRecord(<?php echo $row->id; ?>);">Delete</a></td></tr>
        
        <?php
   }
   
   public function deleterecord()
   {
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   
	   //$this->db->delete('beneficiaryregistration', array('id' => $id));
	   
	   $registrations = $this->db->get('beneficiaryregistration');
	   
	   $registrationrow = '<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
		<thead>
		<tr>
		
		<th>Id no</th>
		<th>Name of beneficiary</th>
		<th>Mothers name</th>
		<th>Next of kin</th>
		<th>Sex</th>
		<th>District</th>
		<th>Settlement</th>
		<th>Telephone number</th>
		<th>Zero to four female</th>
		<th>Zero to four male</th>
		<th>Five to seventeen female</th>
		<th>Five to seventeen male</th>
		<th>Eighteen to fifty nine female</th>
		<th>Eighteen to fifty nine male</th>
		<th>Sixty above female</th>
		<th>Sixty above male</th>
		<th>Total family size</th>
		<th>Programme area</th>
		<th>Donor</th>
		<th>Registration month</th>
		<th>Registration date</th>
		<th>Project number</th>
		<th>Actions</th>
		</tr>
		
		</thead>
		<tbody>
		<tr>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><input type="text" name="" id=""></td>
		<td><a href="">Save</a></td>
		</tr>';
	   
	   foreach ($registrations->result() as $registration):
	   
	   	$registrationrow .= '<tr>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'id_no\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->id_no.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'name_of_beneficiary\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->name_of_beneficiary.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'mothers_name\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->mothers_name.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'next_of_kin\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->next_of_kin.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sex\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->sex.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'district\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->district.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'settlement\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->settlement.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'telephone_number\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->telephone_number.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'zero_to_four_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->zero_to_four_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'zero_to_four_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->zero_to_four_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->five_to_seventeen_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->five_to_seventeen_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->eighteen_to_fifty_nine_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->eighteen_to_fifty_nine_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_female\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->sixty_above_female.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_male\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->sixty_above_male.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'total_family_size\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->total_family_size.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'programme_area\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->programme_area.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'donor\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->donor.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'registration_month\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->registration_month.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'registration_date\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->registration_date.'</td>
			<td contenteditable="true" onBlur="saveToDatabase(this,\'project_number\',\''.$registration->id.'\')" onClick="showEdit(this);">'.$registration->project_number.'</td>
			<td><a href="javascript:void(0)" onclick="deleteObject('.$registration->id.')">Delete</a></td></tr>';
	   
	   endforeach;
	   
	   $registrationrow .= '</tbody>
</table>';
	   
	   echo $registrationrow;
	   
	   
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('beneficiaryregistration','refresh');
       }
       $this->db->delete('beneficiaryregistration', array('id' => $id));
       redirect('beneficiaryregistration','refresh');
   }

}
