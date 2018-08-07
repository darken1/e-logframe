<?php
/** This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Loginattemptsmodel extends CI_Model {
	
	private $tbl_roles= 'loginattempts';

   function __construct()
   {
       parent::__construct();
   }
   
   function get_list() {

		$data = array();

		$Q = $this->db->get('loginattempts');

		if ($Q->num_rows() > 0) {

			foreach ($Q->result_array() as $row){

		         	$data[] = $row;

		        }

		}	

		$Q->free_result();

		return $data;	

	}
	
	function checkbrute($username,$valid_attempts)
	{
		$sql = "SELECT time 
                FROM loginattempts 
                WHERE username = '".$username."' 
                AND time > '".$valid_attempts."'
				AND success='N'";
			
		$query = $this->db->query($sql);
        
        return $query->result();
	}
	
	function checkbrute_by_ip($ip_address,$valid_attempts)
	{
		$sql = "SELECT time 
                FROM loginattempts 
                WHERE ip_address = '".$ip_address."' 
                AND time > '".$valid_attempts."'
				AND success='N'";
			
		$query = $this->db->query($sql);
        
        return $query->result();
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
