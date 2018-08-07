<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Trainingreports extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('trainingreportsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('trainingreports'),
       );
       $this->load->view('trainingreports/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   $projectactivities = $this->projectactivitiesmodel->get_list_by_category(1);
	   $data['projectactivities'] = $projectactivities;
       $this->load->view('trainingreports/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('projectactivity_id', 'Training title', 'trim|required');
       $this->form_validation->set_rules('introduction', 'Introduction', 'trim|required');
       $this->form_validation->set_rules('training_induction', 'Training induction', 'trim|required');
       $this->form_validation->set_rules('overal_objective_of_training', 'Overal objective of training', 'trim|required');
       $this->form_validation->set_rules('specific_objectives', 'Specific objectives', 'trim|required');
       $this->form_validation->set_rules('methodology', 'Methodology', 'trim|required');
       $this->form_validation->set_rules('expectations', 'Expectations', 'trim|required');
       $this->form_validation->set_rules('work_shop_norms', 'Work shop norms', 'trim|required');
       $this->form_validation->set_rules('pre_assessment_results', 'Pre assessment results', 'trim|required');
       $this->form_validation->set_rules('all_topics_covered', 'All topics covered', 'trim|required');
       $this->form_validation->set_rules('key_challenges', 'Key challenges', 'trim|required');
       $this->form_validation->set_rules('recommendations_from_participants', 'Recommendations from participants', 'trim|required');
       $this->form_validation->set_rules('post_assessment_results', 'Post assessment results', 'trim|required');
       //$this->form_validation->set_rules('training_appendix', 'Training appendix', 'trim|required');
       //$this->form_validation->set_rules('participant_list', 'Participant list', 'trim|required');
       //$this->form_validation->set_rules('pre_post_assessment_questionnaire', 'Pre post assessment questionnaire', 'trim|required');
       //$this->form_validation->set_rules('training_itinerary', 'Training itinerary', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
		   
		   
		      $config['upload_path'] = './documents/';
			   $config['overwrite'] = 'TRUE';
			   $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|xls|docx|xlxs';
			   $this->load->library('upload', $config);
							
			   $file_element_name = 'participant_list';
				if (!$this->upload->do_upload($file_element_name))
				{
					$participant_list = '';
				}
				else
				{
					
					$filedata = $this->upload->data();
					$participant_list = $filedata['file_name'];
					
				}
				
				$file_name = 'pre_post_assessment_questionnaire';
				if (!$this->upload->do_upload($file_name))
				{
					$pre_post_assessment_questionnaire = '';
				}
				else
				{
					
					$file_data = $this->upload->data();
					$pre_post_assessment_questionnaire = $file_data['file_name'];
					
				}
				
				$attached_file_name = 'training_itinerary';
				if (!$this->upload->do_upload($attached_file_name))
				{
					$training_itinerary = '';
				}
				else
				{
					
					$attached_file_data = $this->upload->data();
					$training_itinerary = $attached_file_data['file_name'];
					
				}
				
				
           $data = array(
               'projectactivity_id' => $this->input->post('projectactivity_id'),
               'introduction' => $this->input->post('introduction'),
               'training_induction' => $this->input->post('training_induction'),
               'overal_objective_of_training' => $this->input->post('overal_objective_of_training'),
               'specific_objectives' => $this->input->post('specific_objectives'),
               'methodology' => $this->input->post('methodology'),
               'expectations' => $this->input->post('expectations'),
               'work_shop_norms' => $this->input->post('work_shop_norms'),
               'pre_assessment_results' => $this->input->post('pre_assessment_results'),
               'all_topics_covered' => $this->input->post('all_topics_covered'),
               'key_challenges' => $this->input->post('key_challenges'),
               'recommendations_from_participants' => $this->input->post('recommendations_from_participants'),
               'post_assessment_results' => $this->input->post('post_assessment_results'),
               'training_appendix' => $this->input->post('training_appendix'),
               'participant_list' => $participant_list,
               'pre_post_assessment_questionnaire' => $pre_post_assessment_questionnaire,
               'training_itinerary' => $this->input->post('training_itinerary'),
           );
           $this->db->insert('trainingreports', $data);
           redirect('trainingreports','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('trainingreports','refresh');
       }
       $row = $this->db->get_where('trainingreports', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('trainingreports','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   $projectactivities = $this->projectactivitiesmodel->get_list_by_category(1);
	   $data['projectactivities'] = $projectactivities;
	   
	   $this->load->view('trainingreports/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       //$this->form_validation->set_rules('training_title', 'Training title', 'trim|required');
       $this->form_validation->set_rules('introduction', 'Introduction', 'trim|required');
       $this->form_validation->set_rules('training_induction', 'Training induction', 'trim|required');
       $this->form_validation->set_rules('overal_objective_of_training', 'Overal objective of training', 'trim|required');
       $this->form_validation->set_rules('specific_objectives', 'Specific objectives', 'trim|required');
       $this->form_validation->set_rules('methodology', 'Methodology', 'trim|required');
       $this->form_validation->set_rules('expectations', 'Expectations', 'trim|required');
       $this->form_validation->set_rules('work_shop_norms', 'Work shop norms', 'trim|required');
       $this->form_validation->set_rules('pre_assessment_results', 'Pre assessment results', 'trim|required');
       $this->form_validation->set_rules('all_topics_covered', 'All topics covered', 'trim|required');
       $this->form_validation->set_rules('key_challenges', 'Key challenges', 'trim|required');
       $this->form_validation->set_rules('recommendations_from_participants', 'Recommendations from participants', 'trim|required');
       $this->form_validation->set_rules('post_assessment_results', 'Post assessment results', 'trim|required');
       //$this->form_validation->set_rules('training_appendix', 'Training appendix', 'trim|required');
       //$this->form_validation->set_rules('participant_list', 'Participant list', 'trim|required');
       //$this->form_validation->set_rules('pre_post_assessment_questionnaire', 'Pre post assessment questionnaire', 'trim|required');
      // $this->form_validation->set_rules('training_itinerary', 'Training itinerary', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'introduction' => $this->input->post('introduction'),
               'training_induction' => $this->input->post('training_induction'),
               'overal_objective_of_training' => $this->input->post('overal_objective_of_training'),
               'specific_objectives' => $this->input->post('specific_objectives'),
               'methodology' => $this->input->post('methodology'),
               'expectations' => $this->input->post('expectations'),
               'work_shop_norms' => $this->input->post('work_shop_norms'),
               'pre_assessment_results' => $this->input->post('pre_assessment_results'),
               'all_topics_covered' => $this->input->post('all_topics_covered'),
               'key_challenges' => $this->input->post('key_challenges'),
               'recommendations_from_participants' => $this->input->post('recommendations_from_participants'),
               'post_assessment_results' => $this->input->post('post_assessment_results'),
               'training_appendix' => $this->input->post('training_appendix'),
               'participant_list' => $this->input->post('participant_list'),
               'pre_post_assessment_questionnaire' => $this->input->post('pre_post_assessment_questionnaire'),
               
           );
           $this->db->where('id', $id);
           $this->db->update('trainingreports', $data);
           redirect('trainingreports','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('trainingreports','refresh');
       }
       $this->db->delete('trainingreports', array('id' => $id));
       redirect('trainingreports','refresh');
   }

}
