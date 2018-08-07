<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Noncashdistribution extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('noncashdistributionmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('noncashdistribution'),
       );
       //$this->load->view('noncashdistribution/index', $data);
	   redirect('noncashdistribution/activity','refresh');
   }
   
   public function activity()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->projectsmodel->get_list();
	  
       $this->load->view('noncashdistribution/activity',$data);
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
	   
	   $data['project'] = $this->projectsmodel->get_by_id($project_id)->row();
	   $data['activity'] = $this->projectactivitiesmodel->get_by_id($projectaactivity_id)->row();
	   
	   
	   $activitybeneficiaries = $this->noncashdistributionmodel->get_by_project_activity($project_id,$projectaactivity_id);
	   
	   
	   $registrationrow = '<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
		<thead>
		<tr>
		<th>District </th>
		<th>Project </th>
		<th>Activity </th>
		<th>Settlement</th>
		<th>Date  </th>
		<th>S/N. </th>
		<th>Beneficiary </th>
		<th>Sex </th>
		<th>Tel </th>
		<th><5 F</th>
		<th><5 M</th>
		<th>5-17 F</th>
		<th>5-17 M</th>
		<th>18-59 F</th>
		<th>18-59 M</th>
		<th>60 > F</th>
		<th>60 > M</th>
		<th>Family size</th>
		<th>Family Head</th>
		<th>Diversity</th>
		<th>Selection</th>
		<th>ID.No</th>
		<th>Support Given</th>
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
		<td contenteditable="true" onBlur="saveToDatabase(this,\'settlement\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['settlement'].'  </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'date_added\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['date_added'].'</td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'sn\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['sn'].'</td>
		<td bgcolor="#f2eded">'.$activitybeneficiary['name_of_beneficiary'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'sex\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['sex'].' </td>
		<td>'.$activitybeneficiary['telephone_number'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'under_five_female\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['under_five_female'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'under_five_male\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['under_five_male'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_female\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['five_to_seventeen_female'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'five_to_seventeen_male\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['five_to_seventeen_male'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_female\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['eighteen_to_fifty_nine_female'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'eighteen_to_fifty_nine_male\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['eighteen_to_fifty_nine_male'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_female\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['sixty_above_female'].' </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,\'sixty_above_male\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['sixty_above_male'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'total_family_size\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['total_family_size'].' </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,\'familly_head\',\''.$activitybeneficiary['id'].'\')" onClick="showEdit(this);">'.$activitybeneficiary['familly_head'].' </td>
		
		
		<td bgcolor="#f2eded">'.$activitybeneficiary['diversity'].' </td>
		
		<td bgcolor="#f2eded">'.$activitybeneficiary['selection_criteria'].' </td>
		
			<td bgcolor="#f2eded">'.$activitybeneficiary['id_no'].' </td>
		
		<td bgcolor="#f2eded">'.$activitybeneficiary['support_given'].' </td>
		
			
		<td><a href="javascript:void(0)" onclick="deleteRecord('.$activitybeneficiary['id'].');">Delete</a></td>
			
			</tr>';

		}
		
		 $registrationrow .= '</tbody>
</table>';
	   
	   $data['registrationrow']= $registrationrow;
	   
	   $data['prjcts'] = $this->get_projects($project_id);
	   $data['activities'] = $this->get_activities($projectaactivity_id);
	   $data['dist'] = $this->get_districts();
	   $data['div'] = $this->get_diversities();
	   $data['supp'] = $this->get_support();
	   $data['prog'] = $this->get_programmeareas();
       $this->load->view('noncashdistribution/addbeneficiary',$data);
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
          $this->db->update('noncashdistribution', $data);
   }
   
   public function delete_record()
   {
	   $id = $_POST["id"];
	   $id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['id']))));
	   $this->db->delete('noncashdistribution', array('id' => $id));
   }
   
   
   public function addrecord()
   {
	  
               $district = mysql_real_escape_string(strip_tags($_POST['district']));
               $settlement = mysql_real_escape_string(strip_tags($_POST['settlement']));
               $date_added = mysql_real_escape_string(strip_tags($_POST['date_added']));
               $sn = mysql_real_escape_string(strip_tags($_POST['sn']));
               $name_of_beneficiary = mysql_real_escape_string(strip_tags($_POST['name_of_beneficiary']));
               $sex = mysql_real_escape_string(strip_tags($_POST['sex']));
               $telephone_number = mysql_real_escape_string(strip_tags($_POST['telephone_number']));
               $under_five_female = mysql_real_escape_string(strip_tags($_POST['under_five_female']));
               $under_five_male = mysql_real_escape_string(strip_tags($_POST['under_five_male']));
               $five_to_seventeen_female = mysql_real_escape_string(strip_tags($_POST['five_to_seventeen_female']));
               $five_to_seventeen_male = mysql_real_escape_string(strip_tags($_POST['five_to_seventeen_male']));
               $eighteen_to_fifty_nine_female = mysql_real_escape_string(strip_tags($_POST['eighteen_to_fifty_nine_female']));
               $eighteen_to_fifty_nine_male = mysql_real_escape_string(strip_tags($_POST['eighteen_to_fifty_nine_male']));
               $sixty_above_female = mysql_real_escape_string(strip_tags($_POST['sixty_above_female']));
               $sixty_above_male = mysql_real_escape_string(strip_tags($_POST['sixty_above_male']));
               $total_family_size = mysql_real_escape_string(strip_tags($_POST['total_family_size']));
               $familly_head = mysql_real_escape_string(strip_tags($_POST['familly_head']));
               $diversity = mysql_real_escape_string(strip_tags($_POST['diversity']));
               $selection_criteria = mysql_real_escape_string(strip_tags($_POST['selection_criteria']));
			   $id_no = mysql_real_escape_string(strip_tags($_POST['id_no']));
               $support_given = mysql_real_escape_string(strip_tags($_POST['support_given']));
	   $project_id = mysql_real_escape_string(strip_tags($_POST['project_id']));
	   $projectaactivity_id = mysql_real_escape_string(strip_tags($_POST['projectaactivity_id']));
	   
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   $activity = $this->projectactivitiesmodel->get_by_id($projectaactivity_id)->row();
	 	  
	   $data = array(
               'program_area' => $district,
               'district' => $district,
               'settlement' => $settlement,
               'date_added' => $date_added,
               'sn' => $sn,
               'name_of_beneficiary' => $name_of_beneficiary,
               'sex' => $sex,
               'telephone_number' => $telephone_number,
               'under_five_female' => $under_five_female,
               'under_five_male' => $under_five_male,
               'five_to_seventeen_female' => $five_to_seventeen_female,
               'five_to_seventeen_male' => $five_to_seventeen_male,
               'eighteen_to_fifty_nine_female' => $eighteen_to_fifty_nine_female,
               'eighteen_to_fifty_nine_male' => $eighteen_to_fifty_nine_male,
               'sixty_above_female' => $sixty_above_female,
               'sixty_above_male' => $sixty_above_male,
               'total_family_size' => $total_family_size,
               'familly_head' => $familly_head,
               'diversity' => $diversity,
               'selection_criteria' => $selection_criteria,
               'id_no' => $id_no,
               'support_given' => $support_given,
			   'project_id' => $project_id,
			   'projectactivity_id' => $projectaactivity_id,
			   'project_no' => $project->project_no,
			   'activity' => $activity->activity,
           );
		   
		  
          $this->db->insert('noncashdistribution', $data);
		   
		  $id = $this->db->insert_id();
		   
		  $row = $this->db->get_where('noncashdistribution', array('id' => $id))->row();
		   ?>
          
          <tr class="table-row" id="table-row-<?php echo $row->id;?>">
				<td contenteditable="true" onBlur="saveToDatabase(this,'district','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->district;?> </td>
				<td bgcolor="#f2eded"><?php echo $row->project_no;?> </td>
		<td bgcolor="#f2eded"><?php echo $row->activity;?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'settlement','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->settlement;?>  </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'date_added','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->date_added;?></td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'sn','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->sn;?></td>
		<td bgcolor="#f2eded"><?php echo $row->name_of_beneficiary;?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'sex','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->sex;?> </td>
		<td><?php echo $row->telephone_number;?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'under_five_female','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->under_five_female;?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'under_five_male','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->under_five_male;?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'five_to_seventeen_female','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->five_to_seventeen_female;?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'five_to_seventeen_male','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->five_to_seventeen_male;?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'eighteen_to_fifty_nine_female','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->eighteen_to_fifty_nine_female;?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'eighteen_to_fifty_nine_male','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->eighteen_to_fifty_nine_male;?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'sixty_above_female','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->sixty_above_female;?> </td>
		<td contenteditable="true" onBlur="saveToDatabase(this,'sixty_above_male','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->sixty_above_male;?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'total_family_size','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->total_family_size;?> </td>
		
		<td contenteditable="true" onBlur="saveToDatabase(this,'familly_head','<?php echo $row->id;?>')" onClick="showEdit(this);"><?php echo $row->familly_head;?> </td>
		
		
		<td bgcolor="#f2eded"><?php echo $row->diversity;?> </td>
		
		<td bgcolor="#f2eded"><?php echo $row->selection_criteria;?> </td>
		
			<td bgcolor="#f2eded"><?php echo $row->id_no;?> </td>
		
		<td bgcolor="#f2eded"><?php echo $row->support_given;?> </td>
		
			
		<td><a href="javascript:void(0)" onclick="deleteRecord(<?php echo $row->id;?>);">Delete</a></td>
			
			</tr>
           <?php
   }
   
   
   public function add_report($project_id,$projectaactivity_id)
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
	   $data['div'] = $this->get_diversities();
	   $data['supp'] = $this->get_support();
	   $data['prog'] = $this->get_programmeareas();
       $this->load->view('noncashdistribution/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('program_area', 'Program area', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('settlement', 'Settlement', 'trim|required');
       $this->form_validation->set_rules('date_added', 'Date added', 'trim|required');
       $this->form_validation->set_rules('sn', 'Sn', 'trim|required');
       $this->form_validation->set_rules('name_of_beneficiary', 'Name of beneficiary', 'trim|required');
       $this->form_validation->set_rules('sex', 'Sex', 'trim|required');
       $this->form_validation->set_rules('telephone_number', 'Telephone number', 'trim|required');
       $this->form_validation->set_rules('under_five_female', 'Under five female', 'trim|required');
       $this->form_validation->set_rules('under_five_male', 'Under five male', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_female', 'Five to seventeen female', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_male', 'Five to seventeen male', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_female', 'Eighteen to fifty nine female', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_male', 'Eighteen to fifty nine male', 'trim|required');
       $this->form_validation->set_rules('sixty_above_female', 'Sixty above female', 'trim|required');
       $this->form_validation->set_rules('sixty_above_male', 'Sixty above male', 'trim|required');
       $this->form_validation->set_rules('total_family_size', 'Total family size', 'trim|required');
       $this->form_validation->set_rules('familly_head', 'Familly head', 'trim|required');
       $this->form_validation->set_rules('diversity', 'Diversity', 'trim|required');
       $this->form_validation->set_rules('selection_criteria', 'Selection criteria', 'trim|required');
       $this->form_validation->set_rules('id_no', 'Id no', 'trim|required');
       $this->form_validation->set_rules('support_given', 'Support given', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'program_area' => $this->input->post('program_area'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'date_added' => $this->input->post('date_added'),
               'sn' => $this->input->post('sn'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'sex' => $this->input->post('sex'),
               'telephone_number' => $this->input->post('telephone_number'),
               'under_five_female' => $this->input->post('under_five_female'),
               'under_five_male' => $this->input->post('under_five_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
               'familly_head' => $this->input->post('familly_head'),
               'diversity' => $this->input->post('diversity'),
               'selection_criteria' => $this->input->post('selection_criteria'),
               'id_no' => $this->input->post('id_no'),
               'support_given' => $this->input->post('support_given'),
           );
           $this->db->insert('noncashdistribution', $data);
           redirect('noncashdistribution','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('noncashdistribution','refresh');
       }
       $row = $this->db->get_where('noncashdistribution', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('noncashdistribution','refresh');
       }
       $data = array(
           'row' => $row,
       );
       $this->load->view('noncashdistribution/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('program_area', 'Program area', 'trim|required');
       $this->form_validation->set_rules('district', 'District', 'trim|required');
       $this->form_validation->set_rules('settlement', 'Settlement', 'trim|required');
       $this->form_validation->set_rules('date_added', 'Date added', 'trim|required');
       $this->form_validation->set_rules('sn', 'Sn', 'trim|required');
       $this->form_validation->set_rules('name_of_beneficiary', 'Name of beneficiary', 'trim|required');
       $this->form_validation->set_rules('sex', 'Sex', 'trim|required');
       $this->form_validation->set_rules('telephone_number', 'Telephone number', 'trim|required');
       $this->form_validation->set_rules('under_five_female', 'Under five female', 'trim|required');
       $this->form_validation->set_rules('under_five_male', 'Under five male', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_female', 'Five to seventeen female', 'trim|required');
       $this->form_validation->set_rules('five_to_seventeen_male', 'Five to seventeen male', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_female', 'Eighteen to fifty nine female', 'trim|required');
       $this->form_validation->set_rules('eighteen_to_fifty_nine_male', 'Eighteen to fifty nine male', 'trim|required');
       $this->form_validation->set_rules('sixty_above_female', 'Sixty above female', 'trim|required');
       $this->form_validation->set_rules('sixty_above_male', 'Sixty above male', 'trim|required');
       $this->form_validation->set_rules('total_family_size', 'Total family size', 'trim|required');
       $this->form_validation->set_rules('familly_head', 'Familly head', 'trim|required');
       $this->form_validation->set_rules('diversity', 'Diversity', 'trim|required');
       $this->form_validation->set_rules('selection_criteria', 'Selection criteria', 'trim|required');
       $this->form_validation->set_rules('id_no', 'Id no', 'trim|required');
       $this->form_validation->set_rules('support_given', 'Support given', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'program_area' => $this->input->post('program_area'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'date_added' => $this->input->post('date_added'),
               'sn' => $this->input->post('sn'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'sex' => $this->input->post('sex'),
               'telephone_number' => $this->input->post('telephone_number'),
               'under_five_female' => $this->input->post('under_five_female'),
               'under_five_male' => $this->input->post('under_five_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
               'familly_head' => $this->input->post('familly_head'),
               'diversity' => $this->input->post('diversity'),
               'selection_criteria' => $this->input->post('selection_criteria'),
               'id_no' => $this->input->post('id_no'),
               'support_given' => $this->input->post('support_given'),
           );
           $this->db->where('id', $id);
           $this->db->update('noncashdistribution', $data);
           redirect('noncashdistribution','refresh');
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
	   
	  $program_area =$this->input->post('program_area');
               $district = $this->input->post('district');
               $settlement = $this->input->post('settlement');
               $date_added = $this->input->post('date_added');
               $sn = $this->input->post('sn');
               $name_of_beneficiary = $this->input->post('name_of_beneficiary');
               $sex = $this->input->post('sex');
               $telephone_number = $this->input->post('telephone_number');
               $under_five_female = $this->input->post('under_five_female');
               $under_five_male = $this->input->post('under_five_male');
               $five_to_seventeen_female = $this->input->post('five_to_seventeen_female');
               $five_to_seventeen_male = $this->input->post('five_to_seventeen_male');
               $eighteen_to_fifty_nine_female = $this->input->post('eighteen_to_fifty_nine_female');
               $eighteen_to_fifty_nine_male = $this->input->post('eighteen_to_fifty_nine_male');
               $sixty_above_female = $this->input->post('sixty_above_female');
               $sixty_above_male = $this->input->post('sixty_above_male');
               $total_family_size = $this->input->post('total_family_size');
               $familly_head = $this->input->post('familly_head');
               $diversity = $this->input->post('diversity');
               $selection_criteria = $this->input->post('selection_criteria');
               $id_no = $this->input->post('id_no');
               $support_given = $this->input->post('support_given');
			   $project_no = $this->input->post('project_no');
			   $activity_title = $this->input->post('activity');
			   
			   $project = $this->projectsmodel->get_by_no($project_no)->row();
			   
			   $activity = $this->projectactivitiesmodel->get_by_title($activity_title)->row();
			   
		
			  $data = array(
               'program_area' => $this->input->post('program_area'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'date_added' => $this->input->post('date_added'),
               'sn' => $this->input->post('sn'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'sex' => $this->input->post('sex'),
               'telephone_number' => $this->input->post('telephone_number'),
               'under_five_female' => $this->input->post('under_five_female'),
               'under_five_male' => $this->input->post('under_five_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
               'familly_head' => $this->input->post('familly_head'),
               'diversity' => $this->input->post('diversity'),
               'selection_criteria' => $this->input->post('selection_criteria'),
               'id_no' => $this->input->post('id_no'),
               'support_given' => $this->input->post('support_given'),
			   'project_id' => $project->id,
			   'projectactivity_id' => $activity->id,
			   'project_no' => $this->input->post('project_no'),
               'activity' => $this->input->post('activity'),
           );
           $this->db->insert('noncashdistribution', $data);
		   
		   $id = $this->db->insert_id();
		
		echo json_encode(array(
			'id' => $id,
			'program_area' => $program_area,
               'district' => $district,
               'settlement' => $settlement,
               'date_added' => $date_added,
               'sn' => $sn,
               'name_of_beneficiary' => $name_of_beneficiary,
               'sex' => $sex,
               'telephone_number' => $telephone_number,
               'under_five_female' => $under_five_female,
               'under_five_male' => $under_five_male,
               'five_to_seventeen_female' => $five_to_seventeen_female,
               'five_to_seventeen_male' => $five_to_seventeen_male,
               'eighteen_to_fifty_nine_female' => $eighteen_to_fifty_nine_female,
               'eighteen_to_fifty_nine_male' => $eighteen_to_fifty_nine_male,
               'sixty_above_female' => $sixty_above_female,
               'sixty_above_male' => $sixty_above_male,
               'total_family_size' => $total_family_size,
               'familly_head' => $familly_head,
               'diversity' => $diversity,
               'selection_criteria' => $selection_criteria,
               'id_no' => $id_no,
               'support_given' => $support_given,
		));
   }
   
   
    public function edit_beneficiary()
   {
	   
	  $id =$this->input->post('id');
	  $program_area =$this->input->post('program_area');
               $district = $this->input->post('district');
               $settlement = $this->input->post('settlement');
               $date_added = $this->input->post('date_added');
               $sn = $this->input->post('sn');
               $name_of_beneficiary = $this->input->post('name_of_beneficiary');
               $sex = $this->input->post('sex');
               $telephone_number = $this->input->post('telephone_number');
               $under_five_female = $this->input->post('under_five_female');
               $under_five_male = $this->input->post('under_five_male');
               $five_to_seventeen_female = $this->input->post('five_to_seventeen_female');
               $five_to_seventeen_male = $this->input->post('five_to_seventeen_male');
               $eighteen_to_fifty_nine_female = $this->input->post('eighteen_to_fifty_nine_female');
               $eighteen_to_fifty_nine_male = $this->input->post('eighteen_to_fifty_nine_male');
               $sixty_above_female = $this->input->post('sixty_above_female');
               $sixty_above_male = $this->input->post('sixty_above_male');
               $total_family_size = $this->input->post('total_family_size');
               $familly_head = $this->input->post('familly_head');
               $diversity = $this->input->post('diversity');
               $selection_criteria = $this->input->post('selection_criteria');
               $id_no = $this->input->post('id_no');
               $support_given = $this->input->post('support_given');
			   $project_no = $this->input->post('project_no');
			   $activity_title = $this->input->post('activity');
			   
			   $project = $this->projectsmodel->get_by_no($project_no)->row();
			   
			   $activity = $this->projectactivitiesmodel->get_by_title($activity_title)->row();
		
			  $data = array(
               'program_area' => $this->input->post('program_area'),
               'district' => $this->input->post('district'),
               'settlement' => $this->input->post('settlement'),
               'date_added' => $this->input->post('date_added'),
               'sn' => $this->input->post('sn'),
               'name_of_beneficiary' => $this->input->post('name_of_beneficiary'),
               'sex' => $this->input->post('sex'),
               'telephone_number' => $this->input->post('telephone_number'),
               'under_five_female' => $this->input->post('under_five_female'),
               'under_five_male' => $this->input->post('under_five_male'),
               'five_to_seventeen_female' => $this->input->post('five_to_seventeen_female'),
               'five_to_seventeen_male' => $this->input->post('five_to_seventeen_male'),
               'eighteen_to_fifty_nine_female' => $this->input->post('eighteen_to_fifty_nine_female'),
               'eighteen_to_fifty_nine_male' => $this->input->post('eighteen_to_fifty_nine_male'),
               'sixty_above_female' => $this->input->post('sixty_above_female'),
               'sixty_above_male' => $this->input->post('sixty_above_male'),
               'total_family_size' => $this->input->post('total_family_size'),
               'familly_head' => $this->input->post('familly_head'),
               'diversity' => $this->input->post('diversity'),
               'selection_criteria' => $this->input->post('selection_criteria'),
               'id_no' => $this->input->post('id_no'),
               'support_given' => $this->input->post('support_given'),
			   'project_id' => $project->id,
			   'projectactivity_id' => $activity->id,
			   'project_no' => $this->input->post('project_no'),
               'activity' => $this->input->post('activity'),
           );
          
		  $this->db->where('id', $id);
          $this->db->update('noncashdistribution', $data);
		   
		
		echo json_encode(array(
			'id' => $id,
			'program_area' => $program_area,
               'district' => $district,
               'settlement' => $settlement,
               'date_added' => $date_added,
               'sn' => $sn,
               'name_of_beneficiary' => $name_of_beneficiary,
               'sex' => $sex,
               'telephone_number' => $telephone_number,
               'under_five_female' => $under_five_female,
               'under_five_male' => $under_five_male,
               'five_to_seventeen_female' => $five_to_seventeen_female,
               'five_to_seventeen_male' => $five_to_seventeen_male,
               'eighteen_to_fifty_nine_female' => $eighteen_to_fifty_nine_female,
               'eighteen_to_fifty_nine_male' => $eighteen_to_fifty_nine_male,
               'sixty_above_female' => $sixty_above_female,
               'sixty_above_male' => $sixty_above_male,
               'total_family_size' => $total_family_size,
               'familly_head' => $familly_head,
               'diversity' => $diversity,
               'selection_criteria' => $selection_criteria,
               'id_no' => $id_no,
               'support_given' => $support_given,
		));
   }
   
   
    public function destroy_beneficiary()
   {
	   $id = $this->input->post('id');
	   $this->db->delete('noncashdistribution', array('id' => $id));
	   echo json_encode(array('success'=>true));
   }
   
   
   public function get_beneficiaries($project_id,$projectactivity_id)
   {
	   $sql = 'select * from noncashdistribution where project_id='.$project_id.' AND projectactivity_id='.$projectactivity_id;
	   $query = $this->db->query($sql);
		
		$result = array();
		foreach ( $query->result() as $row ){
			array_push($result, $row);
		}
		
		echo json_encode($result);
   }
   /**
    public function get_beneficiaries()
   {
	   $sql = 'select * from noncashdistribution';
	   $query = $this->db->query($sql);
		
		$result = array();
		foreach ( $query->result() as $row ){
			array_push($result, $row);
		}
		
		echo json_encode($result);
   }
   **/
   
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
   
    public function get_programmeareas()
   {
	   $sql = 'SELECT id,programmearea FROM programmeareas';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{areaID:\''.$row->id.'\',Programmearea:\''.$row->programmearea.'\'},';
		}
		
		$choices .= ']';

		return $choices;
		
	   
   }
   
    public function get_support()
   {
	   $sql = 'SELECT id,support FROM typesofsupport';
	   $query = $this->db->query($sql);
	   
	   $choices = '[';
	   
	    foreach ( $query->result() as $row ){
			$choices .= '{supportID:\''.$row->id.'\',Support:\''.$row->support.'\'},';
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
       	redirect('noncashdistribution','refresh');
       }
       $this->db->delete('noncashdistribution', array('id' => $id));
       redirect('noncashdistribution','refresh');
   }

}
