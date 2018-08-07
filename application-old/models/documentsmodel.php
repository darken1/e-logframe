<?php

/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Documentsmodel extends CI_Model {

  private $tbl_roles= 'documents';

   function __construct()
   {
       parent::__construct();
   }
   
   function get_list() {

		$data = array();

		$Q = $this->db->get('documents');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
	
	function get_list_by_project($project_id) {

		$data = array();
		$this->db->where('project_id',$project_id);
		$Q = $this->db->get('documents');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
	
	function get_list_by_category($documentcategory_id) {

		$data = array();
		$this->db->where('documentcategory_id',$documentcategory_id);
		$Q = $this->db->get('documents');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
	
	
	function search($documentcategory_id,$user_id,$year_published,$project_id)
	 {
		$sql = 'SELECT t1.*,t1.id AS document_id,t2.*,t3.* FROM documents AS t1, documentcategories AS t2,users AS t3
				WHERE t1.documentcategory_id='.$documentcategory_id.' AND t1.user_id='.$user_id.'
				AND t1.documentcategory_id = t2.id AND t1.user_id = t3.id';
		
		if($year_published !=0)
		{
			$sql .=' AND year_published='.$year_published;
		}
		
		if($project_id !=0)
		{
			$sql .=' AND project_id='.$project_id;
		}
		
		$sql .= ' ORDER BY document_title ASC';
	  
		
		$query = $this->db->query($sql);
					  
		return $query->result();
	 }
	 
	function searchdocuments($terms)
    {
      
        $sql = "SELECT documents.*
                    FROM documents
                    WHERE MATCH (tags) AGAINST (?) > 0";
        $query = $this->db->query($sql, array($terms, $terms));
        return $query->result();
   }
	
	function get_forum_list($county_id,$public)
	 {
	 	$array='array';
		$data = array();
		$this->db->select('t1.*')
          ->from('documents AS t1')
		  ->where('t1.county_id',$county_id)
		  ->where('t1.public',$public)
		  ->order_by('t1.id DESC');
		  
		return $this->db->get();
	 }
	
	function get_combined_list()
	 {
	 	$array='array';
		$data = array();
		$this->db->select('t1.*,t1.id AS document_id, t2.*,t3.*')
          ->from('documents AS t1, documentcategories AS t2, users AS t3')
		  ->where('t1.documentcategory_id = t2.id')
		  ->where('t1.user_id = t3.id')
		  ->order_by('t1.id DESC');
		  
		return $this->db->get();
	 }
	 
	 function get_combined_list_by_user($user_id)
	 {
	 	$array='array';
		$data = array();
		$this->db->select('t1.*,t1.id AS document_id, t2.*,t3.*')
          ->from('documents AS t1, documentcategories AS t2, users AS t3')
		  ->where('t1.documentcategory_id = t2.id')
		  ->where('t1.user_id = t3.id')
		  ->where('t1.user_id',$user_id)
		  ->order_by('t1.id DESC');
		  
		return $this->db->get();
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
