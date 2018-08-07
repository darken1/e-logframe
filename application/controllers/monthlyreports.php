<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Monthlyreports extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('monthlyreportsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('monthlyreports'),
       );
       $this->load->view('monthlyreports/index', $data);
   }
   
   public function addpage()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	 
       $data = array();
	   $data['programmeareas'] =  $this->programmeareasmodel->get_list();
	   $data['counties'] =  $this->countiesmodel->get_list();
       $this->load->view('monthlyreports/addpage',$data);
   }
   

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   $programarea_id = $this->input->post('programarea_id');
	   $start_date = $this->input->post('start_date');
	   $end_date = $this->input->post('end_date');
	   
	   $programarea = $this->countiesmodel->get_by_id($programarea_id)->row();
	   
	   $table = '<table width="100%" border="1">';
	   $table .= '<tr><td><strong>Program location:</strong></td><td colspan="3">'.$programarea->county.'</td><td><strong>Reporting period:</strong></td><td colspan="4">'.date("d F Y",strtotime($start_date)).' to '.date("d F Y",strtotime($end_date)).'</td></tr>';
	    $table .= '<tr><td><strong>Project Code</strong></td><td><strong>Sector</strong></td><td><strong>Activity</strong></td><td><strong>Describe what was done</strong></td><td><strong>status</strong></td><td><strong>Challenges</strong></td><td colspan="3"><strong>Beneficiaries</strong></td></tr>';
		
		$table .= '<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td><strong>Male</strong></td>
		  <td><strong>Female</strong></td>
		  <td><strong>Total</strong></td>
	  </tr>';
	   
	   //$projectactivities = $this->projectactivitiesmodel->get_list_by_county($programarea_id);
	   
	   $projectactivities = $this->projectactivitiesmodel->get_by_county_date($programarea_id,$start_date,$end_date);
	   
	   
	   $total_male = 0;
	   $total_female = 0;
	   $total_reached  = 0;
	   
	   foreach($projectactivities as $key=>$projectactivity)
	   {
		   
		   $male = $this->projectactivitiesbeneficiarycategoriesmodel->get_by_beneficiary_project($projectactivity->project_id,$projectactivity->id,25)->row();
		   $female = $this->projectactivitiesbeneficiarycategoriesmodel->get_by_beneficiary_project($projectactivity->project_id,$projectactivity->id,26)->row();
		   
		   $total_male = $total_male+$male->number_reached;
		   $total_female = $total_female + $female->number_reached;
		   $total_reached = $total_reached+$projectactivity->total_beneficiaries;
		   
		   
		   $status = $this->projectactivitystatusmodel->get_by_id($projectactivity->projectactivitystatus_id)->row();
		   
		   $project = $this->projectsmodel->get_by_id($projectactivity->project_id)->row();
		   $sector = $this->sectorsmodel->get_by_id($projectactivity->sector_id)->row();
		   
		   $table .= '<tr><td>'.$project->project_no.'</td><td>'.$sector->sector.'</td><td>'.$projectactivity->activity.'</td><td>'.$projectactivity->activity_description.'</td><td>'.$status->status.'</td><td>&nbsp;</td><td>'.$male->number_reached.'</td><td>'.$female->number_reached.'</td><td>'.$projectactivity->total_beneficiaries.'</td></tr>';
	   }
	   
	   $table .= '<tr>
		  <td colspan="6">TOTAL BENEFICIARIES TARGETED DURING THE MONTH</td>
		  <td><strong>'.$total_male.'</strong></td>
		  <td><strong>'.$total_female.'</strong></td>
		  <td><strong>'.$total_reached.'</strong></td>
	  </tr>';
	  
	   
	   
	   $table .= '</table>';
	   
	   
	   $data['programarea_id'] = $this->input->post('programarea_id');
	   $data['table'] = $table;
	   $data['programmeareas'] =  $this->programmeareasmodel->get_list();
	   $data['counties'] =  $this->countiesmodel->get_list();
	   $data['start_date'] = $this->input->post('start_date');
	   $data['end_date'] = $this->input->post('end_date');
       $this->load->view('monthlyreports/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('programarea_id', 'Programarea id', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('projects_and_beneficiaries', 'Projects and beneficiaries', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'programarea_id' => $this->input->post('programarea_id'),
               'start_date' => $this->input->post('start_date'),
               'end_date' => $this->input->post('end_date'),
               'projects_and_beneficiaries' => $this->input->post('projects_and_beneficiaries'),
           );
           $this->db->insert('monthlyreports', $data);
           redirect('monthlyreports','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('monthlyreports','refresh');
       }
       $row = $this->db->get_where('monthlyreports', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('monthlyreports','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   $data['programmeareas'] =  $this->programmeareasmodel->get_list();
	   $data['counties'] =  $this->countiesmodel->get_list();
       $this->load->view('monthlyreports/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('programarea_id', 'Programarea id', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('projects_and_beneficiaries', 'Projects and beneficiaries', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'programarea_id' => $this->input->post('programarea_id'),
               'start_date' => $this->input->post('start_date'),
               'end_date' => $this->input->post('end_date'),
               'projects_and_beneficiaries' => $this->input->post('projects_and_beneficiaries'),
           );
           $this->db->where('id', $id);
           $this->db->update('monthlyreports', $data);
           redirect('monthlyreports','refresh');
       }
   }
   
   
   public function download($id)
   {
	   $filename = "MonthlyReport".date('dmY-his').".doc";
		
		//$this->output->set_header("Content-Type: application/xml; charset=UTF-8");
		$this->output->set_header("Content-Type: application/vnd.ms-word");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=$filename");
	   
	   $row = $this->db->get_where('monthlyreports', array('id' => $id))->row();
	   
	   $content = $row->projects_and_beneficiaries;
	   
	   $this->output->append_output($content);
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('monthlyreports','refresh');
       }
       $this->db->delete('monthlyreports', array('id' => $id));
       redirect('monthlyreports','refresh');
   }

}
