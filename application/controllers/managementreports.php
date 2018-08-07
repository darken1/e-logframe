<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Managementreports extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('managementreportsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('managementreports'),
       );
       $this->load->view('managementreports/index', $data);
   }
   
    public function addpage()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	 
       $data = array();
	   $data['programmeareas'] =  $this->programmeareasmodel->get_list();
	   $data['counties'] =  $this->countiesmodel->get_list();
       $this->load->view('managementreports/addpage',$data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   
	   $projects = $this->projectsmodel->get_list();
	   
	   $programarea_id = $this->input->post('programarea_id');
	   $start_date = $this->input->post('start_date');
	   $end_date = $this->input->post('end_date');
	   
	   
	   $table = '<table width="100%" border="1">';
	   $table .= '<tr><td><strong>Closed projects (please include project code)</strong></td><td><strong>New projects (please include project code)</strong></td><tr>';
	   $table .= '<tr><td>&nbsp;</td><td>';
	   foreach($projects as $key=>$project)
	   {
		   $table .= $project['project_no'].' - '.$project['project_title'].'<br>';
	   }
	   $table .= '</td></tr>';
	   $table .= '</table>';
	   
	    $data['programarea_id'] = $this->input->post('programarea_id');
	   $data['table'] = $table;
	   $data['programmeareas'] =  $this->programmeareasmodel->get_list();
	   $data['counties'] =  $this->countiesmodel->get_list();
	   
	   
       $this->load->view('managementreports/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('programarea_id', 'Programarea', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('describe_security_issues', 'Describe security issues', 'trim|required');
       $this->form_validation->set_rules('describe_other_developments', 'Describe other developments', 'trim|required');
       $this->form_validation->set_rules('three_main_issues', 'Three main issues', 'trim|required');
       $this->form_validation->set_rules('findings_through_tc', 'Findings through tc', 'trim|required');
       $this->form_validation->set_rules('which_projects_where_closed', 'Which projects where closed', 'trim|required');
       $this->form_validation->set_rules('proposals', 'Proposals', 'trim|required');
       $this->form_validation->set_rules('issues_related_to_hr', 'Issues related to hr', 'trim|required');
       $this->form_validation->set_rules('issues_to_be_addressed_by_smt', 'Issues to be addressed by smt', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'programarea_id' => $this->input->post('programarea_id'),
               'start_date' => $this->input->post('start_date'),
               'end_date' => $this->input->post('end_date'),
               'describe_security_issues' => $this->input->post('describe_security_issues'),
               'describe_other_developments' => $this->input->post('describe_other_developments'),
               'three_main_issues' => $this->input->post('three_main_issues'),
               'findings_through_tc' => $this->input->post('findings_through_tc'),
               'which_projects_where_closed' => $this->input->post('which_projects_where_closed'),
               'proposals' => $this->input->post('proposals'),
               'issues_related_to_hr' => $this->input->post('issues_related_to_hr'),
               'issues_to_be_addressed_by_smt' => $this->input->post('issues_to_be_addressed_by_smt'),
           );
           $this->db->insert('managementreports', $data);
           redirect('managementreports','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('managementreports','refresh');
       }
       $row = $this->db->get_where('managementreports', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('managementreports','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   $data['programmeareas'] =  $this->programmeareasmodel->get_list();
	   $data['counties'] =  $this->countiesmodel->get_list();
       $this->load->view('managementreports/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('programarea_id', 'Program area', 'trim|required');
       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
       $this->form_validation->set_rules('describe_security_issues', 'Describe security issues', 'trim|required');
       $this->form_validation->set_rules('describe_other_developments', 'Describe other developments', 'trim|required');
       $this->form_validation->set_rules('three_main_issues', 'Three main issues', 'trim|required');
       $this->form_validation->set_rules('findings_through_tc', 'Findings through tc', 'trim|required');
       $this->form_validation->set_rules('which_projects_where_closed', 'Which projects where closed', 'trim|required');
       $this->form_validation->set_rules('proposals', 'Proposals', 'trim|required');
       $this->form_validation->set_rules('issues_related_to_hr', 'Issues related to hr', 'trim|required');
       $this->form_validation->set_rules('issues_to_be_addressed_by_smt', 'Issues to be addressed by smt', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'programarea_id' => $this->input->post('programarea_id'),
               'start_date' => $this->input->post('start_date'),
               'end_date' => $this->input->post('end_date'),
               'describe_security_issues' => $this->input->post('describe_security_issues'),
               'describe_other_developments' => $this->input->post('describe_other_developments'),
               'three_main_issues' => $this->input->post('three_main_issues'),
               'findings_through_tc' => $this->input->post('findings_through_tc'),
               'which_projects_where_closed' => $this->input->post('which_projects_where_closed'),
               'proposals' => $this->input->post('proposals'),
               'issues_related_to_hr' => $this->input->post('issues_related_to_hr'),
               'issues_to_be_addressed_by_smt' => $this->input->post('issues_to_be_addressed_by_smt'),
           );
           $this->db->where('id', $id);
           $this->db->update('managementreports', $data);
           redirect('managementreports','refresh');
       }
   }
   
    public function download($id)
   {
	   $filename = "ManagementReport".date('dmY-his').".doc";
		
		//$this->output->set_header("Content-Type: application/xml; charset=UTF-8");
		$this->output->set_header("Content-Type: application/vnd.ms-word");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=$filename");
	   
	   $row = $this->db->get_where('managementreports', array('id' => $id))->row();
	   
	   $programarea_id = $row->programarea_id;
	   $start_date = $row->start_date;
	   $end_date = $row->end_date;
	   
	   $programarea = $this->countiesmodel->get_by_id($programarea_id)->row();
	   
	   $table = '<table width="100%" border="1">';
	   $table .= '<tr><td><strong>Program location:</strong></td><td>'.$programarea->county.'</td><td><strong>Reporting period:</strong></td><td>'.date("d F Y",strtotime($start_date)).' to '.date("d F Y",strtotime($end_date)).'</td></tr>';
	   
	   $table .= '<tr><td colspan="4"><strong>Please describe below security issues in your area during the reporting period:</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->describe_security_issues.'</td></tr>';
	   $table .= '<tr><td colspan="4"><strong>Please describe other developments in the month e.g. political developments, IDP movements, etc.</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->describe_other_developments.'</td></tr>';
	   $table .= '<tr><td colspan="4"><strong>Please highlight 3 main issues related to the implementation of current projects:</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->three_main_issues.'</td></tr>';
	   $table .= '<tr><td colspan="4"><strong>Findings/issues discovered though TCs field monitoring visits:</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->findings_through_tc.'</td></tr>';
	   $table .= '<tr><td colspan="4"><strong>Which project were closed during the last month and which new projects were started:</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->which_projects_where_closed.'</td></tr>';
	   $table .= '<tr><td colspan="4"><strong>Which proposals are in process currently and planned for the nearer future (max 3 month from now):</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->proposals.'</td></tr>';
	   $table .= '<tr><td colspan="4"><strong>Please highlight 3 main issues related to admin/finance/HR:</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->issues_related_to_hr.'</td></tr>';
	   $table .= '<tr><td colspan="4"><strong>What issues would you like to address to SMT/RO and to HQ that would support your programming?</strong></td></tr>';
	   $table .= '<tr><td colspan="4">'.$row->issues_to_be_addressed_by_smt.'</td></tr>';
	   $table .= '</table>';
	   
	   $this->output->append_output($table);
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('managementreports','refresh');
       }
       $this->db->delete('managementreports', array('id' => $id));
       redirect('managementreports','refresh');
   }

}
