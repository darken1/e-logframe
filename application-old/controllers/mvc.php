<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVC extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->library('erkanaauth');
   $this->load->database();
 
 }

 	public function gen($table = '')
	{
	    if (strlen($table) == 0) {
	        echo 'No table has been specified.';
	        die();
	    }
	    $query = $this->column_names($table);
	    if ($query->num_rows == 0) {
	        echo 'The specified table is not in the database.';
	        die();
	    }
	    //$this->gen_css_file($table);
	    //$this->gen_js_file($table);
	    $this->gen_model_file($table);
	    $this->gen_controller_file($table);
	    $this->gen_index_view_file($table);
	    $this->gen_add_view_file($table);
	    $this->gen_edit_view_file($table);
	}
	
	private function column_names($table)
	{
	    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS ";
	    $sql .= "WHERE TABLE_SCHEMA = '".SITE."' ";
	    $sql .= "AND TABLE_NAME = '".$table."'";
	    return $this->db->query($sql);
	}
	
	private function is_auto_increment($table, $column)
	{
	    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE ";
	    $sql .= "TABLE_SCHEMA = '".SITE."' AND TABLE_NAME = '".$table."' ";
	    $sql .= "AND EXTRA LIKE '%AUTO_INCREMENT%'";
	    $query = $this->db->query($sql);
	    foreach ($query->result() as $row) {
	        if ($column == $row->COLUMN_NAME) {
	            return TRUE;
	        }
	    }
	    return FALSE;
	}
	
	private function id($table)
	{
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            return $row->COLUMN_NAME;
	        }
	    }
	    return '';
	}
	
	private function gen_css_file($table)
	{
	    @mkdir('css');
	    $filename = 'css/'.$table.'.css';
	    $fp = fopen($filename, 'w');
	    fwrite($fp, "* { margin:0; }\n");
	    fwrite($fp, "table { margin-left:20px; }\n");
	    fwrite($fp, "h3, h4, h5 { font-family:sans-serif; margin-left:20px; }\n");
	    fwrite($fp, "table th, td { font-family:sans-serif; border:1px solid black; padding:5px; }\n");
	    fwrite($fp, ".error { font-family:sans-serif; font-style:italic; margin-left:20px; }\n");
	    fwrite($fp, "\n");
	    fclose($fp);
	    echo 'Built '.$table.' css file.<br>';
	}
	
	private function gen_js_file($table)
	{
	    @mkdir('js');
	    $filename = 'js/'.$table.'.js';
	    $fp = fopen($filename, 'w');
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            continue;
	        }
	        fwrite($fp, "document.getElementById('".$row->COLUMN_NAME."').focus();\n");
	        break;
	    }
	    fwrite($fp, "\n");
	    fclose($fp);
	    echo 'Built '.$table.' js file.<br>';
	}
	
	private function gen_model_file($table)
	{
	    $filename = 'application/models/'.$table.'model.php';
	    $fp = fopen($filename, 'w');
	    fwrite($fp, "<?php\n");
	    fwrite($fp, "\n");
		fwrite($fp, "/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/");
		fwrite($fp, "\n");
		fwrite($fp, "/** This code belongs to Joash Gomba (The developer).");
		fwrite($fp, "\n");
		fwrite($fp, "The code cannot be reproduced without the express written permission of the developer.");
		fwrite($fp, "\n");
		fwrite($fp, "The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.");
		fwrite($fp, "\n");
		fwrite($fp, "Contravention of any of the above stated rules will constitute a violation of copyright laws.");
		fwrite($fp, "\n");
		fwrite($fp, "**/");
		fwrite($fp, "\n");
		fwrite($fp, "class ".ucfirst($table)."model extends CI_Model {\n");
	    fwrite($fp, "\n");
		fwrite($fp, "	private \$tbl_roles= '".$table."';");
		fwrite($fp, "\n");
	    fwrite($fp, "   function __construct()\n");
	    fwrite($fp, "   {\n");
	    fwrite($fp, "       parent::__construct();\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
		$this->gen_list_model($fp, $table);
		$this->gen_count_model($fp, $table);
		$this->gen_get_by_id_model($fp, $table);
		$this->gen_save_model($fp, $table);
		$this->gen_update_model($fp, $table);
		$this->gen_delete_model($fp, $table);
	    fwrite($fp, "}\n");
	    fclose($fp);
	    echo 'Built '.$table.' model file.<br>';
	}
	
	private function gen_list_model($fp,$table)
	{
		fwrite($fp, "   public function get_list()\n");
	    fwrite($fp, "   {\n");
	    fwrite($fp, "       \$data = array();\n");
		fwrite($fp, "       \$Q = \$this->db->get('".$table."');\n");
		fwrite($fp, "       if (\$Q->num_rows() > 0) {\n");
		fwrite($fp, "       	foreach (\$Q->result_array() as \$row){\n");
		fwrite($fp, "       		\$data[] = \$row;\n");
		fwrite($fp, "       	}\n");
		fwrite($fp, "       }\n");
		fwrite($fp, "       \$Q->free_result();\n");
		fwrite($fp, "       return \$data;\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}
	
	private function gen_count_model($fp,$table)
	{
		fwrite($fp, "   public function count_all()\n");
	    fwrite($fp, "   {\n");
	    fwrite($fp, "       return \$this->db->count_all(\$this->tbl_roles);\n");
		fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}
	
	private function gen_get_by_id_model($fp,$table)
	{
		fwrite($fp, "   public function get_by_id(\$id)\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       \$this->db->where('id', \$id);\n");
	    fwrite($fp, "       return \$this->db->get(\$this->tbl_roles);\n");
		fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}
	
	private function gen_save_model($fp,$table)
	{
		fwrite($fp, "   public function save(\$role)\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       \$this->db->insert(\$this->tbl_roles, \$role);\n");
	    fwrite($fp, "       return \$this->db->insert_id();\n");
		fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}
	
	private function gen_update_model($fp,$table)
	{
		fwrite($fp, "   public function update(\$id,\$role)\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       \$this->db->where('id', \$id);\n");
	    fwrite($fp, "       \$this->db->update(\$this->tbl_roles, \$role);\n");
		fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}
	
	
	private function gen_delete_model($fp,$table)
	{
		fwrite($fp, "   public function delete(\$id)\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       \$this->db->where('id', \$id);\n");
	    fwrite($fp, "       \$this->db->delete(\$this->tbl_roles);\n");
		fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}
	
	private function gen_controller_file($table)
	{
	    $filename = 'application/controllers/'.$table.'.php';
	    $fp = fopen($filename, 'w');
	    fwrite($fp, "<?php\n");
	    fwrite($fp, "\n");
		fwrite($fp, "/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/");
		fwrite($fp, "\n");
		fwrite($fp, "/**\n This code belongs to Joash Gomba (The developer).");
		fwrite($fp, "\n");
		fwrite($fp, "The code cannot be reproduced without the express written permission of the developer.");
		fwrite($fp, "\n");
		fwrite($fp, "The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.");
		fwrite($fp, "\n");
		fwrite($fp, "Contravention of any of the above stated rules will constitute a violation of copyright laws.");
		fwrite($fp, "\n");
		fwrite($fp, "**/");
		fwrite($fp, "\n");
	    fwrite($fp, "class ".ucfirst($table)." extends CI_Controller {\n");
	    fwrite($fp, "\n");
	    fwrite($fp, "   function __construct()\n");
	    fwrite($fp, "   {\n");
	    fwrite($fp, "       parent::__construct();\n");
	    fwrite($fp, "       \$this->load->model('".$table."model');\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	    fwrite($fp, "   public function index()\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       if (!\$this->erkanaauth->try_session_login()) {\n");
		fwrite($fp, "       	redirect('login','refresh');\n");
		fwrite($fp, "       }\n");
	    fwrite($fp, "       \$data = array(\n");
	    fwrite($fp, "           'rows' => \$this->db->get('".$table."'),\n");
	    fwrite($fp, "       );\n");
	    fwrite($fp, "       \$this->load->view('".$table."/index', \$data);\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	    $this->gen_add_controller($fp, $table);
	    $this->gen_edit_controller($fp, $table);
	    $this->gen_delete_controller($fp, $table);
	    fwrite($fp, "}\n");
	    fclose($fp);
	    echo 'Built '.$table.' controller file.<br>';
	}
	
	private function gen_add_controller($fp, $table)
	{
	    fwrite($fp, "   public function add()\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       if (!\$this->erkanaauth->try_session_login()) {\n");
		fwrite($fp, "       	redirect('login','refresh');\n");
		fwrite($fp, "       }\n");
		fwrite($fp, "       \$data = array();\n");
	    fwrite($fp, "       \$this->load->view('".$table."/add',\$data);\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	    fwrite($fp, "   public function add_validate()\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       if (!\$this->erkanaauth->try_session_login()) {\n");
		fwrite($fp, "       	redirect('login','refresh');\n");
		fwrite($fp, "       }\n");
	    fwrite($fp, "       \$this->load->library('form_validation');\n");
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            continue;
	        }
	        $ucname = str_replace('_', ' ', ucfirst($row->COLUMN_NAME));
	        fwrite($fp, "       \$this->form_validation->set_rules('".$row->COLUMN_NAME."', '".$ucname."', 'trim|required');\n");
	    }
	    fwrite($fp, "       if (\$this->form_validation->run() == false) {\n");
	    fwrite($fp, "           \$this->add();\n");
	    fwrite($fp, "       } else {\n");
	    fwrite($fp, "           \$data = array(\n");
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            continue;
	        }
	        fwrite($fp, "               '".$row->COLUMN_NAME."' => \$this->input->post('".$row->COLUMN_NAME."'),\n");
	    }
	    fwrite($fp, "           );\n");
	    fwrite($fp, "           \$this->db->insert('".$table."', \$data);\n");
	    fwrite($fp, "           redirect('".$table."','refresh');\n");
	    fwrite($fp, "       }\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}

	private function gen_edit_controller($fp, $table)
	{
	    $id = $this->id($table);
	    fwrite($fp, "   public function edit(\$".$id.")\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       if (!\$this->erkanaauth->try_session_login()) {\n");
		fwrite($fp, "       	redirect('login','refresh');\n");
		fwrite($fp, "       }\n");
		fwrite($fp, "       if(!is_numeric(\$id)) {\n");
		fwrite($fp, "       	redirect('".$table."','refresh');\n");
		fwrite($fp, "       }\n");
	    fwrite($fp, "       \$row = \$this->db->get_where('".$table."', array('".$id."' => \$".$id."))->row();\n");
		fwrite($fp, "       if(empty(\$row)) {\n");
		fwrite($fp, "       	redirect('".$table."','refresh');\n");
		fwrite($fp, "       }\n");
	    fwrite($fp, "       \$data = array(\n");
	    fwrite($fp, "           'row' => \$row,\n");
	    fwrite($fp, "       );\n");
	    fwrite($fp, "       \$this->load->view('".$table."/edit', \$data);\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	    fwrite($fp, "   public function edit_validate(\$".$id.")\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       if (!\$this->erkanaauth->try_session_login()) {\n");
		fwrite($fp, "       	redirect('login','refresh');\n");
		fwrite($fp, "       }\n");
	    fwrite($fp, "       \$this->load->library('form_validation');\n");
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            continue;
	        }
	        $ucname = str_replace('_', ' ', ucfirst($row->COLUMN_NAME));
	        fwrite($fp, "       \$this->form_validation->set_rules('".$row->COLUMN_NAME."', '".$ucname."', 'trim|required');\n");
	    }
	    fwrite($fp, "       if (\$this->form_validation->run() == false) {\n");
	    fwrite($fp, "           \$this->edit(\$".$id.");\n");
	    fwrite($fp, "       } else {\n");
	    fwrite($fp, "           \$data = array(\n");
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            continue;
	        }
	        fwrite($fp, "               '".$row->COLUMN_NAME."' => \$this->input->post('".$row->COLUMN_NAME."'),\n");
	    }
	    fwrite($fp, "           );\n");
	    fwrite($fp, "           \$this->db->where('".$id."', \$".$id.");\n");
	    fwrite($fp, "           \$this->db->update('".$table."', \$data);\n");
	    fwrite($fp, "           redirect('".$table."','refresh');\n");
	    fwrite($fp, "       }\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}

	private function gen_delete_controller($fp, $table)
	{
	    $id = $this->id($table);
	    fwrite($fp, "   public function delete(\$".$id.")\n");
	    fwrite($fp, "   {\n");
		fwrite($fp, "       if (!\$this->erkanaauth->try_session_login()) {\n");
		fwrite($fp, "       	redirect('login','refresh');\n");
		fwrite($fp, "       }\n");
		fwrite($fp, "       if(!is_numeric(\$id)) {\n");
		fwrite($fp, "       	redirect('".$table."','refresh');\n");
		fwrite($fp, "       }\n");
	    fwrite($fp, "       \$this->db->delete('".$table."', array('".$id."' => \$".$id."));\n");
	    fwrite($fp, "       redirect('".$table."','refresh');\n");
	    fwrite($fp, "   }\n");
	    fwrite($fp, "\n");
	}
	
	private function gen_index_view_file($table)
	{
	    @mkdir('application/views/'.$table);
	    $filename = 'application/views/'.$table.'/index.php';
	    $fp = fopen($filename, 'w');
	    fwrite($fp, "<?php include(APPPATH . 'views/common/head.php'); ?>\n");
		fwrite($fp, "		<body>\n");
		fwrite($fp, "			<?php include(APPPATH . 'views/common/navigation.php'); ?>\n");
		fwrite($fp, "				<div class=\"container-fluid\" id=\"content\">\n");
		fwrite($fp, "				<?php include(APPPATH . 'views/common/left.php'); ?>\n");
		fwrite($fp, "				<div id=\"main\">\n");
		fwrite($fp, "				<div class=\"container-fluid\">\n");
		fwrite($fp, "				<?php include(APPPATH . 'views/common/pageheader.php'); ?>\n");
		fwrite($fp, "				<div class=\"breadcrumbs\">\n");
		fwrite($fp, "					<ul>\n");
		fwrite($fp, "						<li>\n");
		fwrite($fp, "							<a href=\"<?php echo site_url('home')?>\">Home</a>\n");
		fwrite($fp, "							<i class=\"fa fa-angle-right\"></i>\n");
		fwrite($fp, "						</li>\n");
		fwrite($fp, "						<li>\n");
		fwrite($fp, "							<a href=\"<?php echo base_url() ?>".$table."\">".$table."</a>\n");
		fwrite($fp, "						</li>\n");
		fwrite($fp, "					</ul>\n");
		fwrite($fp, "				<div class=\"close-bread\">\n");
		fwrite($fp, "					<a href=\"#\">\n");
		fwrite($fp, "						<i class=\"fa fa-times\"></i>\n");
		fwrite($fp, "					</a>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				<div class=\"row\">\n");
		fwrite($fp, "				<div class=\"col-sm-3\">\n");
		fwrite($fp, "					<p>&nbsp;</p>\n");
		fwrite($fp, "					<p>\n");
		fwrite($fp, "						<a href=\"<?php echo base_url() ?>index.php/".$table."/add\" class=\"btn btn-primary btn--icon\"><i class=\"fa fa-plus\"></i>Add</a>\n");
		fwrite($fp, "					</p>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				<div class=\"row\">\n");
		fwrite($fp, "				<div class=\"col-sm-12\">\n");
		fwrite($fp, "				<div class=\"box box-color box-bordered\">\n");
		fwrite($fp, "				<div class=\"box-title\">\n");
		fwrite($fp, "					<h3>\n");
		fwrite($fp, "						".$table."\n");
		fwrite($fp, "					</h3>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				<div class=\"box-content nopadding\">\n");
		
		fwrite($fp, "<table class=\"table table-hover table-nomargin table-bordered dataTable dataTable-column_filter\" data-column_filter_types=\"\" data-column_filter_dateformat=\"yy-mm-dd\"  data-nosort=\"0\" data-checkall=\"all\">\n");
		fwrite($fp, "<thead>\n");
		fwrite($fp, "<tr>\n");
		fwrite($fp, "<th class='with-checkbox'>\n");
		fwrite($fp, "<input type=\"checkbox\" name=\"check_all\" class=\"dataTable-checkall\">\n");
		fwrite($fp, "</th>\n");
		
		$query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        $ucname = str_replace('_', ' ', ucfirst($row->COLUMN_NAME));
	        fwrite($fp, "<th>".$ucname."</th>\n");
	    }
		fwrite($fp, "<th>Actions</th>\n");
	    fwrite($fp, "</tr>\n");
		fwrite($fp, "</thead>\n");
		fwrite($fp, "<tbody>\n");    
	 	$id = $this->id($table);
	    		
	    fwrite($fp, "<?php foreach (\$rows->result() as \$row): ?>\n");
	    fwrite($fp, "<tr>\n");
		fwrite($fp, "<td class=\"with-checkbox\">\n");
		fwrite($fp, "<input type=\"checkbox\" name=\"check\" value=\"".$id."\">\n");
		fwrite($fp, "</td>\n");
		
	    foreach ($query->result() as $row) {
	        fwrite($fp, "<td><?php echo \$row->".$row->COLUMN_NAME."; ?></td>\n");
	    }
	    
	    $s = "<td><a href=\"<?php echo base_url() ?>".$table."/edit/<?php echo \$row->".$id."; ?>\" class=\"btn\" rel=\"tooltip\" title=\"Edit\">\n
			<i class=\"fa fa-edit\"></i>\n</a>\n";
	    $s .= "<a href=\"<?php echo base_url() ?>".$table."/delete/<?php echo \$row->".$id."; ?>\" class=\"btn\" rel=\"tooltip\" title=\"Delete\" onClick=\"return confirm('Are you sure you want to delete? This action is not reversable')\">\n
			<i class=\"fa fa-times\"></i>\n</a>\n</td>\n";
	    fwrite($fp, $s);
	    fwrite($fp, "</tr>\n");
	    fwrite($fp, "<?php endforeach; ?>\n");
		fwrite($fp, "</tbody>\n");
	    fwrite($fp, "</table>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");		
		fwrite($fp, "	</body>\n");
		fwrite($fp, "</html>\n");
	    fclose($fp);
	    echo 'Built '.$table.' index view file.<br>';
	}

	private function gen_add_view_file($table)
	{
	    $filename = 'application/views/'.$table.'/add.php';
	    $fp = fopen($filename, 'w');
	    fwrite($fp, "<?php include(APPPATH . 'views/common/head.php'); ?>\n");
		fwrite($fp, "		<body>\n");
		fwrite($fp, "			<?php include(APPPATH . 'views/common/navigation.php'); ?>\n");
		fwrite($fp, "				<div class=\"container-fluid\" id=\"content\">\n");
		fwrite($fp, "				<?php include(APPPATH . 'views/common/left.php'); ?>\n");
		fwrite($fp, "				<div id=\"main\">\n");
		fwrite($fp, "				<div class=\"container-fluid\">\n");
		fwrite($fp, "				<?php include(APPPATH . 'views/common/pageheader.php'); ?>\n");
		fwrite($fp, "				<div class=\"breadcrumbs\">\n");
		fwrite($fp, "					<ul>\n");
		fwrite($fp, "						<li>\n");
		fwrite($fp, "							<a href=\"<?php echo site_url('home')?>\">Home</a>\n");
		fwrite($fp, "							<i class=\"fa fa-angle-right\"></i>\n");
		fwrite($fp, "						</li>\n");
		fwrite($fp, "						<li>\n");
		fwrite($fp, "							<a href=\"<?php echo base_url() ?>".$table."\">".$table."</a>\n");
		fwrite($fp, "						</li>\n");
		fwrite($fp, "					</ul>\n");
		fwrite($fp, "				<div class=\"close-bread\">\n");
		fwrite($fp, "					<a href=\"#\">\n");
		fwrite($fp, "						<i class=\"fa fa-times\"></i>\n");
		fwrite($fp, "					</a>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				<div class=\"row\">\n");
		fwrite($fp, "				<div class=\"col-sm-12\">\n");
		fwrite($fp, "				<div class=\"box box-bordered\">\n");
		fwrite($fp, "				<div class=\"box-title\">\n");
		fwrite($fp, "					<h3>\n");
		fwrite($fp, "						<i class=\"fa fa-th-list\"></i>Add Form\n");
		fwrite($fp, "					</h3>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				<div class=\"box-content nopadding\">\n");
		fwrite($fp, "					<?php if(validation_errors()){?>\n");
		fwrite($fp, "						<p><div class=\"alert alert-danger alert-dismissable\">\n");
		fwrite($fp, "							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n");
		fwrite($fp, "							<strong>Note!</strong><?php echo validation_errors(); ?>\n");
		fwrite($fp, "							</div>\n");
		fwrite($fp, "						</p>\n");
		fwrite($fp, "					<?php } ?>\n");
		fwrite($fp, "					<?php \$attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>\n");
	    fwrite($fp, "					<?php echo form_open('".$table."/add_validate',\$attributes); ?>\n");
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            continue;
	        }
	        $type = '';
	        $name = $row->COLUMN_NAME;
	        $ucname = str_replace('_', ' ', ucfirst($row->COLUMN_NAME));
	        $query = $this->db->query("SHOW FIELDS FROM ".$table." WHERE Field = '".$name."'");
	        foreach ($query->result() as $row) {
	            $a = explode('(', $row->Type);
	            $type = $a[0];
	            break;
	        }
	        switch ($type) {
	            case 'text':
	                $s = '			<div class="form-group">'."\n" .'';
					$s .= '				<label for="textfield" class="control-label col-sm-2">'.$ucname.'</label>'."\n" .'';
					$s .= '				<div class="col-sm-10">'."\n" .'';
					$s .= '					<?php '."\n" .'';
					$s .= "					\$data = array('id' => '".$name."', 'name' => '".$name."','class'=>'form-control','required'=>'required');\n ";
					$s .= "					echo form_textarea(\$data, set_value('".$name."'));\n";
					$s .= "					?>\n";
					$s .= '				</div>'."\n" .'';
					$s .= '			</div>'."\n" .'';
	            break;
				case 'date':
	                $s = '			<div class="form-group">'."\n" .'';
					$s .= '				<label for="textfield" class="control-label col-sm-2">'.$ucname.' <small>yyyy-mm-dd</small></label>'."\n" .'';
					$s .= '				<div class="col-sm-10">'."\n" .'';
					$s .= '					<?php '."\n" .'';
					$s .= "					\$data = array('id' => '".$name."', 'name' => '".$name."','class'=>'form-control datepick','data-inputmask'=>\"'mask': '9999-99-99'\",'data-date-format'=>'yyyy-mm-dd','required'=>'required');\n ";
					$s .= "					echo form_input(\$data, set_value('".$name."'));\n";
					$s .= "					?>\n";
					$s .= '				</div>'."\n" .'';
					$s .= '			</div>'."\n" .'';
	            break;
	            default:
					$s = '			<div class="form-group">'."\n" .'';
					$s .= '				<label for="textfield" class="control-label col-sm-2">'.$ucname.'</label>'."\n" .'';
					$s .= '				<div class="col-sm-10">'."\n" .'';
					$s .= '					<?php '."\n" .'';
					$s .= "					\$data = array('id' => '".$name."', 'name' => '".$name."','class'=>'form-control','required'=>'required');\n ";
					$s .= "					echo form_input(\$data, set_value('".$name."'));\n";
					$s .= "					?>\n";
					$s .= '				</div>'."\n" .'';
					$s .= '			</div>'."\n\n" .'';
					
	            break;
	        }
	        fwrite($fp, $s);
	    }
	    fwrite($fp, "					<div class=\"form-actions col-sm-offset-2 col-sm-10\">\n");
		fwrite($fp, "						<button type=\"submit\" class=\"btn btn-primary\">SAVE ENTRY</button>\n");
		fwrite($fp, "					</div>\n");
		fwrite($fp, "				<?php echo form_close(); ?>\n");
		fwrite($fp, " 			</div>\n");
		fwrite($fp, "		</div>\n");
		fwrite($fp, "	</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "\n");
		fwrite($fp, "</body>\n");
		fwrite($fp, "</html>\n");
	    fclose($fp);
	    echo 'Built '.$table.' add view file.<br>';
	}
	
	private function gen_edit_view_file($table)
	{
	    $id = $this->id($table);
	    $filename = 'application/views/'.$table.'/edit.php';
	    $fp = fopen($filename, 'w');
	    fwrite($fp, "<?php include(APPPATH . 'views/common/head.php'); ?>\n");
		fwrite($fp, "		<body>\n");
		fwrite($fp, "			<?php include(APPPATH . 'views/common/navigation.php'); ?>\n");
		fwrite($fp, "				<div class=\"container-fluid\" id=\"content\">\n");
		fwrite($fp, "				<?php include(APPPATH . 'views/common/left.php'); ?>\n");
		fwrite($fp, "				<div id=\"main\">\n");
		fwrite($fp, "				<div class=\"container-fluid\">\n");
		fwrite($fp, "				<?php include(APPPATH . 'views/common/pageheader.php'); ?>\n");
		fwrite($fp, "				<div class=\"breadcrumbs\">\n");
		fwrite($fp, "					<ul>\n");
		fwrite($fp, "						<li>\n");
		fwrite($fp, "							<a href=\"<?php echo site_url('home')?>\">Home</a>\n");
		fwrite($fp, "							<i class=\"fa fa-angle-right\"></i>\n");
		fwrite($fp, "						</li>\n");
		fwrite($fp, "						<li>\n");
		fwrite($fp, "							<a href=\"<?php echo base_url() ?>".$table."\">".$table."</a>\n");
		fwrite($fp, "						</li>\n");
		fwrite($fp, "					</ul>\n");
		fwrite($fp, "				<div class=\"close-bread\">\n");
		fwrite($fp, "					<a href=\"#\">\n");
		fwrite($fp, "						<i class=\"fa fa-times\"></i>\n");
		fwrite($fp, "					</a>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				<div class=\"row\">\n");
		fwrite($fp, "				<div class=\"col-sm-12\">\n");
		fwrite($fp, "				<div class=\"box box-bordered\">\n");
		fwrite($fp, "				<div class=\"box-title\">\n");
		fwrite($fp, "					<h3>\n");
		fwrite($fp, "						<i class=\"fa fa-th-list\"></i>Edit Form\n");
		fwrite($fp, "					</h3>\n");
		fwrite($fp, "				</div>\n");
		fwrite($fp, "				<div class=\"box-content nopadding\">\n");
		fwrite($fp, "					<?php if(validation_errors()){?>\n");
		fwrite($fp, "						<p><div class=\"alert alert-danger alert-dismissable\">\n");
		fwrite($fp, "							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n");
		fwrite($fp, "							<strong>Note!</strong><?php echo validation_errors(); ?>\n");
		fwrite($fp, "							</div>\n");
		fwrite($fp, "						</p>\n");
		fwrite($fp, "					<?php } ?>\n");
		fwrite($fp, "					<?php \$attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>\n");
	     fwrite($fp, "					<?php echo form_open('".$table."/edit_validate/'.\$row->".$id.",\$attributes); ?>\n");
	    $query = $this->column_names($table);
	    foreach ($query->result() as $row) {
	        if ($this->is_auto_increment($table, $row->COLUMN_NAME)) {
	            continue;
	        }
	        $type = '';
	        $value = '';
	        $name = $row->COLUMN_NAME;
	        $ucname = str_replace('_', ' ', ucfirst($row->COLUMN_NAME));
	        $query = $this->db->query("SHOW FIELDS FROM ".$table." WHERE Field = '".$name."'");
	        foreach ($query->result() as $row) {
	            $a = explode('(', $row->Type);
	            $type = $a[0];
	            break;
	        }
	        switch ($type) {
	            case 'text':
	               	$s = '			<div class="form-group">'."\n" .'';
					$s .= '				<label for="textfield" class="control-label col-sm-2">'.$ucname.'</label>'."\n" .'';
					$s .= '				<div class="col-sm-10">'."\n" .'';
					$s .= '					<?php '."\n" .'';
					$s .= "					\$data = array('id' => '".$name."', 'name' => '".$name."', 'value' => \$row->".$row->Field.", 'class'=>'form-control','required'=>'required');\n ";
					$s .= "					echo form_textarea(\$data, set_value('".$name."'));\n";
					$s .= "					?>\n";
					$s .= '				</div>'."\n" .'';
					$s .= '			</div>'."\n" .'';
					
	            break;
				case 'date':
	                $s = '			<div class="form-group">'."\n" .'';
					$s .= '				<label for="textfield" class="control-label col-sm-2">'.$ucname.' <small>yyyy-mm-dd</small></label>'."\n" .'';
					$s .= '				<div class="col-sm-10">'."\n" .'';
					$s .= '					<?php '."\n" .'';
					$s .= "					\$data = array('id' => '".$name."', 'name' => '".$name."', 'value' => \$row->".$row->Field.", 'class'=>'form-control datepick','data-inputmask'=>\"'mask': '9999-99-99'\",'data-date-format'=>'yyyy-mm-dd','required'=>'required');\n ";
					$s .= "					echo form_input(\$data, set_value('".$name."'));\n";
					$s .= "					?>\n";
					$s .= '				</div>'."\n" .'';
					$s .= '			</div>'."\n" .'';
	            break;
	            default:
	                $s = '			<div class="form-group">'."\n" .'';
					$s .= '				<label for="textfield" class="control-label col-sm-2">'.$ucname.'</label>'."\n" .'';
					$s .= '				<div class="col-sm-10">'."\n" .'';
					$s .= '					<?php '."\n" .'';
					$s .= "					\$data = array('id' => '".$name."', 'name' => '".$name."', 'value' => \$row->".$row->Field.", 'class'=>'form-control','required'=>'required');\n ";
					$s .= "					echo form_input(\$data, set_value('".$name."'));\n";
					$s .= "					?>\n";
					$s .= '				</div>'."\n" .'';
					$s .= '			</div>'."\n\n" .'';
										
	            break;
	        }
	        fwrite($fp, $s);
	    }
		fwrite($fp, "					<div class=\"form-actions col-sm-offset-2 col-sm-10\">\n");
		fwrite($fp, "						<button type=\"submit\" class=\"btn btn-primary\">UPDATE CHANGES</button>\n");
		fwrite($fp, "					</div>\n");
		fwrite($fp, "				<?php echo form_close(); ?>\n");
		fwrite($fp, " 			</div>\n");
		fwrite($fp, "		</div>\n");
		fwrite($fp, "	</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "</div>\n");
		fwrite($fp, "\n");
		fwrite($fp, "</body>\n");
		fwrite($fp, "</html>\n");
	    fclose($fp);
	    echo 'Built '.$table.' edit view file.<br>';
	}
}
?>