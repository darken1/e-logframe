<?php

class Usersmodel extends CI_Model {

  private $tbl_roles= 'users';
   function __construct()
   {
       parent::__construct();
   }
   
    //get all the roles

	 function get_list() {

		$data = array();

		$Q = $this->db->get('users');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
	
		
	function get_combined_list()
	 {
	 	$array='array';
		$data = array();
		$this->db->select('t1.*,t1.id AS user_id,t1.email AS user_email')
          ->from('users AS t1')
		  ->order_by('t1.id DESC');
		  
		return $this->db->get();
	 }
	 
	function get_by_department($department_id) {

		$data = array();
		$this->db->where('department_id', $department_id);
		$Q = $this->db->get('users');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}

	// get number of roles in database

	function count_all(){

		return $this->db->count_all($this->tbl_roles);

	}

	// get roles with paging

	function get_paged_list($limit = 10, $offset = 0){

		$this->db->order_by('id','asc');

		return $this->db->get($this->tbl_roles, $limit, $offset);

	}
	
	function get_by_username($email){

		$this->db->where('username', $email);

		return $this->db->get($this->tbl_roles);

	}
	
	function get_by_email($email){

		$this->db->where('email', $email);

		return $this->db->get($this->tbl_roles);

	}
	
	function get_by_role($role_id){

		$this->db->where('role_id', $role_id);

		return $this->db->get($this->tbl_roles);

	}

	// get role by id
	

	function get_by_id($id){

		$this->db->where('id', $id);

		return $this->db->get($this->tbl_roles);

	}

	// add new role

	function save($role){

		$this->db->insert($this->tbl_roles, $role);

		return $this->db->insert_id();

	}

	// update role by id

	function update($id, $role){

		$this->db->where('id', $id);

		$this->db->update($this->tbl_roles, $role);

	}

	// delete role by id

	function delete($id){

		$this->db->where('id', $id);

		$this->db->delete($this->tbl_roles);

	}

}
