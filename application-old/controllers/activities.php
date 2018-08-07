<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Activities extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('activitiesmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('activities'),
       );
       $this->load->view('activities/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['sectors'] = $this->sectorsmodel->get_list();
       $this->load->view('activities/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
       $this->form_validation->set_rules('subsector_id', 'Subsector id', 'trim|required');
       $this->form_validation->set_rules('sector_id', 'Sector id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'activity' => $this->input->post('activity'),
               'subsector_id' => $this->input->post('subsector_id'),
               'sector_id' => $this->input->post('sector_id'),
           );
           $this->db->insert('activities', $data);
           redirect('activities','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('activities','refresh');
       }
       $row = $this->db->get_where('activities', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('activities','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['sectors'] = $this->sectorsmodel->get_list();
	   $data['subsectors'] = $this->subsectorsmodel->get_list_by_sector($row->sector_id);
       $this->load->view('activities/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
       $this->form_validation->set_rules('subsector_id', 'Subsector id', 'trim|required');
       $this->form_validation->set_rules('sector_id', 'Sector id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'activity' => $this->input->post('activity'),
               'subsector_id' => $this->input->post('subsector_id'),
               'sector_id' => $this->input->post('sector_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('activities', $data);
           redirect('activities','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('activities','refresh');
       }
       $this->db->delete('activities', array('id' => $id));
       redirect('activities','refresh');
   }
   
    function getsubsectors()
   {
	   $sector_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['sector_id']))));
	   
	   $subsectors = $this->subsectorsmodel->get_list_by_sector($sector_id);
	   
	   
	   $subsectorselect = '<select name="subsector_id" id="subsector_id" class="form-control" required="required">';
	    $subsectorselect .= '<option value="0">Select Sub Sector</option>';  
		if(empty($subsectors))
		 {
			 
			   $subsectorselect .= '<option value="0">No Sub Sector Added</option>';
		   
		 }
		 else
		 { 
		   foreach($subsectors as $key => $subsector)
		   {
			   $subsectorselect .= '<option value="'.$subsector['id'].'">'.$subsector['sub_sector'].'</option>';
		   }
		 }
	   
	   $subsectorselect .= '</select>';
	   
	   echo $subsectorselect;
   }

}
