<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Forms extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('formsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('forms'),
       );
       $this->load->view('forms/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->db->get('projects');
	   $data['formcategories'] = $this->db->get('formcategories');
       $this->load->view('forms/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('form_name', 'Form name', 'trim|required');
       $this->form_validation->set_rules('form_type', 'Form type', 'trim|required');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'form_name' => $this->input->post('form_name'),
               'form_type' => $this->input->post('form_type'),
               'status' => $this->input->post('status'),
               'project_id' => $this->input->post('project_id'),
               'activity_id' => $this->input->post('plannedactivity_id'),
			   'form_elements' => '',
           );
           $this->db->insert('forms', $data);
           redirect('forms','refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('forms','refresh');
       }
       $row = $this->db->get_where('forms', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('forms','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   $data['projects'] = $this->db->get('projects');
	   $data['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->project_id);
	   $data['formcategories'] = $this->db->get('formcategories');
	   
       $this->load->view('forms/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('form_name', 'Form name', 'trim|required');
       $this->form_validation->set_rules('form_type', 'Form type', 'trim|required');
       $this->form_validation->set_rules('status', 'Status', 'trim|required');
       $this->form_validation->set_rules('project_id', 'Project', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'form_name' => $this->input->post('form_name'),
               'form_type' => $this->input->post('form_type'),
               'status' => $this->input->post('status'),
               'project_id' => $this->input->post('project_id'),
               'activity_id' => $this->input->post('plannedactivity_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('forms', $data);
           redirect('forms','refresh');
       }
   }
   
   
   public function builder($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('forms','refresh');
       }
       $row = $this->db->get_where('forms', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('forms','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   $data['projects'] = $this->db->get('projects');
	   $data['plannedactivities'] = $this->projectplannedactivitiesmodel->get_by_project_list($row->project_id);
	   $data['formcategories'] = $this->db->get('formcategories');
	   
       $this->load->view('forms/builder', $data);
   }
   
   public function saveJSON()
   {
	   $form_elements = $_POST["content"];
	   $id = $_POST["formid"];
	   
	   $data = array(
               'form_elements' => $form_elements,
           );
      $this->db->where('id', $id);
      $this->db->update('forms', $data);
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('forms','refresh');
       }
       $this->db->delete('forms', array('id' => $id));
       redirect('forms','refresh');
   }
   
   public function formelements($id)
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('forms','refresh');
       }
	   
	   $data = array();
	   $data['form'] = $this->formsmodel->get_by_id($id)->row();
	   $data['formelements'] = $this->formelementsmodel->get_list_by_form($id);
	   
	    $this->load->view('forms/formelements', $data);
   }
   
   public function addelement()
   {
	  $element = trim($_POST['element']);
	  $formid = trim($_POST['formid']);
	  
	  $formelement = $this->formelementsmodel->get_by_form_id_desc($formid)->row();
	  $count = count($formelement);
	  if($count==0)
	  {
			$listorder = 1;
	  }
	  else
	  {
		$listorder = ($formelement->listorder+1);
		
	  }
	  
	
	  if($element=='Radio Button' || $element=='Checkbox' || $element=='Selectable List')
	  {
		
			$options = '[{"option one":1,"option two":2}]';
	   }
	   else
	   {
			$options = '';
	   }
	   
	   if($element=='Input Text')
	   {
		
			$input_type = '';
	   }
		else
		{
			$input_type = 'alphanumeric';
		}
		
		$label = 'Untitled '.$element;
		
		$data = array(
               'form_id' => $formid,
               'type' => $element,
               'label' => $label,
               'default_value' => '',
               'tool_tip' => '',
               'size' => '',
               'max_length' => '',
               'rows' => '',
               'cols' => '',
               'custom_display_format' => '',
               'folder_path' => '',
               'folder_url' => '',
               'permitted_file_types' => '',
               'max_file_size' => '',
               'options' => $options,
               'input_type' => $input_type,
               'required' => 0,
               'date_time_created' => date("Y-m-d H:i:s"),
               'date_time_modified' => date("Y-m-d H:i:s"),
               'listorder' => $listorder,
           );
        $this->db->insert('formelements', $data);
		
		$theformelements = $this->formelementsmodel->get_list_by_form($formid);
		
		$mydata = array();
		$mydata['formelements'] = $theformelements;
		
				
		//$this->load->view('forms/view', $mydata);
		
		$elementtable = '<table class="table table-nomargin">
			<tr><td>
			
			<div id="container">
			  <div id="list">
			 <ul>';
		foreach($theformelements as $key=>$row)
		{
			$id = stripslashes($row['id']);
			$elementtable .= '<li id="arrayorder_'.$id.'">'.$row['label'].'<br /><br />';
			if(trim($row['type'])=='Input Text')
	   		{
			   if($row['required']==1)
			   {
				   $required = 'required';
			   }
			   else
			   {
				   $required = '';
			   }
			   
			   $elementtable .= ' <input type="text" name="element_'.$id.'" id="element_'.$id.'"  value="'.$row['default_value'].'" size="'.$row['size'].'" maxlength="'.$row['max_length'].'" '.$required.' class=\'form-control\'/> <br /><br />
        <div id=\'basic-modal\'>
        
        <a href=\'#\' title="'.$id.'" class=\'basic\'><img src="'.base_url().'img/edit.png"></a> <a href="delete.php?id='.$id.'" onClick="return confirm(\'Are you sure you want to delete? This action is not reversable\')"><img src="'.base_url().'img/cross.png"></a>
        </div>';
		
		
		   }
		   
		   if(trim($row['type'])=='Text Area')
		   {
			   if($row['required']==1)
			   {
				   $required = 'required';
			   }
			   else
			   {
				   $required = '';
			   }
			   
			   $elementtable .= '<textarea cols="'.$row['cols'].'" rows="'.$row['rows'].'" name="element_'.$id.'" id="element_'.$id.'" '.$required.' class=\'form-control\'> '.$row['default_value'].'</textarea>
      <br /><br />
        <div id=\'basic-modal\'>
        <a href=\'#\' title="'.$id.'" class=\'basic\'><img src="'.base_url().'img/edit.png"></a> <a href="delete.php?id='.$id.'" onClick="return confirm(\'Are you sure you want to delete? This action is not reversable\')"><img src="'.base_url().'img/cross.png"></a>
        </div>';
			   
		   }
		   
		   if(trim($row['type'])=='Radio Button')
		   {
			   if($row['required']==1)
			   {
				   $required = 'required';
			   }
			   else
			   {
				   $required = '';
			   }
			   
			   $json = $row['options'];
			
				$myarray=json_decode($json,true);
				$values = $myarray[0];
				
				foreach($values as $key=>$value)
				{
					$elementtable .= '<input type="radio" name="element_'.$id.'" id="element_'.$id.'" value="'.$value.'" '.$required.' /> '.$key;
				}
				
				$elementtable .= ' <br /><br />
        <div id=\'basic-modal\'>
        <a href=\'#\' title="'.$id.'" class=\'basic\'><img src="'.base_url().'img/edit.png"></a> <a href="delete.php?id='.$id.'" onClick="return confirm(\'Are you sure you want to delete? This action is not reversable\')"><img src="'.base_url().'img/cross.png"></a>
        </div> ';
		   }
		   
		    if(trim($row['type'])=='Checkbox')
		   {
			   if($row['required']==1)
			   {
				   $required = 'required';
			   }
			   else
			   {
				   $required = '';
			   }
			  
				$json = $row['options'];
				
				$myarray=json_decode($json,true);
				$values = $myarray[0];
				
				foreach($values as $key=>$value)
				{
					$elementtable .= '<input type="checkbox" name="element_'.$id.'" id="element_'.$id.'" value="'.$value.'" '.$required.' /> '.$key;
				}
				
				$elementtable .= ' <br /><br />
        <div id=\'basic-modal\'>
        <a href=\'#\' title="'.$id.'" class=\'basic\'><img src="'.base_url().'img/edit.png"></a> <a href="delete.php?id='.$id.'" onClick="return confirm(\'Are you sure you want to delete? This action is not reversable\')"><img src="'.base_url().'img/cross.png"></a>
        </div> ';
			
		   }
		   
		   if(trim($row['type'])=='Selectable List')
		   {
			  if($row['required']==1)
			   {
				   $required = 'required';
			   }
			   else
			   {
				   $required = '';
			   }
				
				$json = $row['options'];
				
				$myarray=json_decode($json,true);
				$values = $myarray[0];
				
				$elementtable .= '<select name="element_'.$id.'" id="element_'.$id.'" '.$required.' class=\'form-control\'>';
				foreach($values as $key=>$value)
				{
					
					$elementtable .= '<option value="'.$value.'">'.$key.'</option>';
					
				}
				$elementtable .= '</select>';
				
				$elementtable .= ' <br /><br />
				<div id=\'basic-modal\'>
				<a href=\'#\' title="'.$id.'" class=\'basic\'><img src="'.base_url().'img/edit.png"></a> <a href="delete.php?id='.$id.'" onClick="return confirm(\'Are you sure you want to delete? This action is not reversable\')"><img src="'.base_url().'img/cross.png"></a>
				</div> ';
			
		   }
			
			 if(trim($row['type'])=='File')
			 {
				   if($row['required']==1)
				   {
					   $required = 'required';
				   }
				   else
				   {
					   $required = '';
				   }
				   
				 $elementtable .= '<div class="col-sm-10">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="input-group">
													<div class="form-control" data-trigger="fileinput">
														<i class="glyphicon glyphicon-file fileinput-exists"></i>
														<span class="fileinput-filename"></span>
													</div>
													<span class="input-group-addon btn btn-default btn-file">
														<span class="fileinput-new">Select file</span>
													<span class="fileinput-exists">Change</span>
													<input type="file"  name="element_'.$id.'" id="element_'.$id.'" '.$required.' />
													</span>
													<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												</div>
											</div>
										</div>';  
				   
				 $elementtable .= ' <br /><br />
				<div id=\'basic-modal\'>
				<a href=\'#\' title="'.$id.'" class=\'basic\'><img src="'.base_url().'img/edit.png"></a> <a href="delete.php?id='.$id.'" onClick="return confirm(\'Are you sure you want to delete? This action is not reversable\')"><img src="'.base_url().'img/cross.png"></a>
				</div> ';
			   }
			
			 if(trim($row['type'])=='DatePicker')
			 {
				   if($row['required']==1)
				   {
					   $required = 'required';
				   }
				   else
				   {
					   $required = '';
				   }
				   
				   $elementtable .= ' <input type="text" name="element_'.$id.'" class="form-control datepick" data-date-format="<?php echo '.$row['default_value'].'" value="" /> ';
				   
				    $elementtable .= ' <br /><br />
				<div id=\'basic-modal\'>
				<a href=\'#\' title="'.$id.'" class=\'basic\'><img src="'.base_url().'img/edit.png"></a> <a href="delete.php?id='.$id.'" onClick="return confirm(\'Are you sure you want to delete? This action is not reversable\')"><img src="'.base_url().'img/cross.png"></a>
				</div> ';
				   
			   }
			
			
			$elementtable .= ' <div class="clear"></div>
      </li>';
			
			
			
		}
	 	
		$elementtable .= ' </ul>
 </div>
 </div>
</td></tr>

</table>';
			
		echo $elementtable;
   }
   
   public function updatelist()
   {
	   $form_id = $_POST['form_id'];
	   
	   $array	= $_POST['arrayorder'];

		if ($_POST['update'] == "update"){
			
			$count = 1;
			foreach ($array as $idval) {
				$data = array(
					'listorder' => $count,
				 );
				$this->db->where('id', $idval)
						 ->where('form_id', $form_id);
				$this->db->update('formelements', $data);
				$count ++;	
			}
			echo 'All saved! refresh the page to see the changes';
		}
    }
	
	public function previewform($form_id)
	{
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($form_id)) {
       	redirect('forms','refresh');
       }
	   
	   $data = array();
	   $data['form'] = $this->formsmodel->get_by_id($form_id)->row();
	   $data['formelements'] = $this->formelementsmodel->get_list_by_form($form_id);
	   
	   
	   $this->load->view('forms/preview', $data);
	}
	
	public function preview($id)
	{
		
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('forms','refresh');
       }
	   
	   $row = $this->db->get_where('forms', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('forms','refresh');
       }
	   
       $data = array(
           'row' => $row,
       );
	   
	   
	   $this->load->view('forms/previewform', $data);
	}

}
