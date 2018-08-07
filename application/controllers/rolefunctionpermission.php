<?php

/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Rolefunctionpermission extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('rolefunctionpermissionmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	  	   
       $data = array(
           'rows' => $this->db->get('rolefunctionpermission'),
       );
       $this->load->view('rolefunctionpermission/index', $data);
   }

   public function add($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   
	   $authorised = $this->rolefunctionpermissionmodel->authorised(getRole(),$this->router->fetch_class(),$permission='');
	   
	   if(!$authorised)
	   {
		   redirect('home','refresh');
	   }
	   
	   if(!is_numeric($id)) {
       	redirect('roles','refresh');
       }
       $row = $this->db->get_where('rolefunctionpermission', array('role_id' => $id))->row();
       
       $data = array(
           'row' => $row,
       );
	   
	   $data['tables'] = $this->rolefunctionpermissionmodel->get_tables();
	   $data['roles'] = $this->rolesmodel->get_list();
	   $data['permissions'] = $this->rolefunctionpermissionmodel->get_permissions();
	   $data['id'] = $id;
       $this->load->view('rolefunctionpermission/add',$data);
   }

   public function add_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('role', 'Role', 'trim|required');
       //$this->form_validation->set_rules('function', 'Function', 'trim|required');
       //$this->form_validation->set_rules('permission', 'Permission', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add($id);
       } else {
		   
		   $role_id = $this->input->post('role');
		   $role = $this->rolesmodel->get_by_id($role_id)->row();
		   
		   //$this->rolefunctionpermissionmodel->delete_by_role($role_id);
		   
		   $choices = '[{';
		   
		   $count = count($_POST['rolefunction']);
		   
		    $i = 0;
		   
		   if (!empty($_POST['rolefunction'])) {
                foreach ($_POST['rolefunction'] as $rrow => $rid) {
				   $i++;
				   
				   if($i==$count)
				   {
					   $comma = '';
				   }
				   else
				   {
					   $comma = ',';
				   }
				   $rolefunction = $rid;
				   
				   $choice_text = 'Function_'.$i;
                   $choice_value    = $rolefunction;
                   $choices .= '"'.$choice_text.'":"'.$choice_value.'"'.$comma;
				   
				  
				}
		   }
		   
		   $choices .= '}]';
		   
		   $rolepermission = '[{';
		   
		   $rolepermissioncount = count($_POST['permission']);
		   
		    $j = 0;
		   
		   if (!empty($_POST['permission'])) {
                foreach ($_POST['permission'] as $prow => $pid) {
				   $j++;
				   
				   if($j==$rolepermissioncount)
				   {
					   $permissioncomma = '';
				   }
				   else
				   {
					   $permissioncomma = ',';
				   }
				   $permission = $pid;
				   
				   $permission_text = 'Permission_'.$j;
                   $permission_value    = $permission;
                   $rolepermission .= '"'.$permission_text.'":"'.$permission_value.'"'.$permissioncomma;
				   
				  
				}
		   }
		   
		   $rolepermission .= '}]';
		   
		   		   
		    $row = $this->db->get_where('rolefunctionpermission', array('role_id' => $id))->row();
			if(empty($row))
			{
				 $data = array(
						   'role_id' => $role_id,
						   'role' => $role->name,
						   'rolefunction' => $choices,
						   'rolepermission' => $rolepermission,
					   );
					   $this->db->insert('rolefunctionpermission', $data);
				}
			else
			{
				 $data = array(
						   'role_id' => $role_id,
						   'role' => $role->name,
						   'rolefunction' => $choices,
						   'rolepermission' => $rolepermission,
				);
			   $this->db->where('role_id', $id);
			   $this->db->update('rolefunctionpermission', $data);
			}
		   
           redirect('rolefunctionpermission/add/'.$id,'refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rolefunctionpermission','refresh');
       }
       $row = $this->db->get_where('rolefunctionpermission', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('rolefunctionpermission','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   $data['roles'] = $this->rolesmodel->get_list();
	   
       $this->load->view('rolefunctionpermission/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('role', 'Role', 'trim|required');
       //$this->form_validation->set_rules('function', 'Function', 'trim|required');
       //$this->form_validation->set_rules('permission', 'Permission', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'role' => $this->input->post('role'),
               'function' => $this->input->post('function'),
           );
           $this->db->where('id', $id);
           $this->db->update('rolefunctionpermission', $data);
           redirect('rolefunctionpermission','refresh');
       }
   }
   
   
   public function generateauth()
   {
	   $tables = $this->rolefunctionpermissionmodel->get_tables();
	   
	   foreach($tables as $key=>$table)
	   {
		   //echo $table->table_name.'<br>';
		   
		   echo "$".$table->table_name."auth = $this->rolefunctionpermissionmodel->check_function($userrole->id,'".$table->table_name."'); <br>";
	   }
												
   }
   
   public function populatepermissions()
   {
	   $tables = $this->rolefunctionpermissionmodel->get_tables();
	   
	   foreach($tables as $key=>$table)
	   {
		   //echo $table->table_name.'<br>';
		   
		   $data = array(
               'table_name' => $table->table_name,
               'permission' => 'Add',
           );
           $this->db->insert('permissions', $data);
		   
		   $data = array(
               'table_name' => $table->table_name,
               'permission' => 'Edit',
           );
           $this->db->insert('permissions', $data);
		   
		   $data = array(
               'table_name' => $table->table_name,
               'permission' => 'Delete',
           );
           $this->db->insert('permissions', $data);
		   
		   $data = array(
               'table_name' => $table->table_name,
               'permission' => 'View',
           );
           $this->db->insert('permissions', $data);
		   
		   $data = array(
               'table_name' => $table->table_name,
               'permission' => 'Reports',
           );
           $this->db->insert('permissions', $data);
		   
	   }
												
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('rolefunctionpermission','refresh');
       }
       $this->db->delete('rolefunctionpermission', array('id' => $id));
       redirect('rolefunctionpermission','refresh');
   }

}
