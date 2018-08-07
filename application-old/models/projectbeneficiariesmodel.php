<?php

class Projectbeneficiariesmodel extends CI_Model {

 private $tbl_roles= 'projectbeneficiaries';

   function __construct()
   {
       parent::__construct();
   }
   
   function get_list() {

		$data = array();

		$Q = $this->db->get('projectbeneficiaries');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
	
   public function get_by_project_list($project_id)
   {
       $data = array();
	   $this->db->where('project_id',$project_id);
       $Q = $this->db->get('projectbeneficiaries');
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
	
	function get_by_beneficiary_project($project_id,$beneficiary_id){

		$this->db->where('project_id', $project_id)
				 ->where('beneficiary_id', $beneficiary_id);

		return $this->db->get($this->tbl_roles);

	}
	
	function delete_project_beneficiary($project_id,$beneficiary_id){

		$this->db->where('project_id', $project_id)
				 ->where('beneficiary_id', $beneficiary_id);

		$this->db->delete($this->tbl_roles);

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
