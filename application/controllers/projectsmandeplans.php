<?php

/** DO NOT REMOVE THIS NOTICE FROM THE CODE**/
/**
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projectsmandeplans extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectsmandeplansmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projectsmandeplans'),
       );
       $this->load->view('projectsmandeplans/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['projects'] = $this->db->get('projects');
       $this->load->view('projectsmandeplans/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project', 'trim|required|callback_check_plan');
	   $this->form_validation->set_rules('background', 'Introduction', 'trim|required');
       $this->form_validation->set_rules('purpose_of_plan', 'Purpose of plan', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
		   $project_id = $this->input->post('project_id');
		   $project = $this->projectsmodel->get_by_id($project_id)->row();
		   $partners = $this->partnersmodel->get_list();
		   $thepartners = '';
		   foreach($partners as $key=>$partner)
		   {
				$projectpartner = $this->projectpartnersmodel->get_by_project_partner($project->id,$partner['id'])->row();
														
				if(empty($projectpartner))
				{
					//nothing
				}
				else
				{
					$thepartners .= $partner['partner'].', ';
				}
			}
			
			$donors = $this->donorsmodel->get_list();
			
			$thedonors = '';
			
			foreach($donors as $key=>$donor)
			{
				$projectdonor = $this->projectdonorsmodel->get_by_project_donor($project->id,$donor['id'])->row();
														
				if(empty($projectdonor))
				{
					//nothing
				}
				else
				{
					$thedonors .= $donor['donor_name'].', ';
				}
			}
			
			$counties = $this->countiesmodel->get_list();
			
			$thecounties = '';
			
			foreach($counties as $key=>$county)
			{
				$projectcounty = $this->projectscountiesmodel->get_by_project_county($project->id,$county['id'])->row();
														
				if(empty($projectcounty))
				{
					//nothing
				}
				else
				{
					$thecounties .= $county['county'].', ';
				}
						
			}
			
		   $beneficiaries = $this->projectbeneficiariesmodel->get_by_project_list($project->id);
		   $beneficiarydata = '';
		   foreach($beneficiaries as $bkey=>$beneficiary)
		   {
			   $beneficiarytype = $this->beneficiarytypesmodel->get_by_id($beneficiary['beneficiary_id'])->row();
			   $beneficiarydata .= $beneficiarytype->beneficiary_type.', ';
		   }
		   
		   $project_summary = '
		   <style type="text/css">
			table.gridtable {
				font-family: verdana,arial,sans-serif;
				font-size:11px;
				color:#333333;
				border-width: 1px;
				border-color: #666666;
				border-collapse: collapse;
			}
			table.gridtable th {
				border-width: 1px;
				padding: 8px;
				border-style: solid;
				border-color: #666666;
				background-color: #dedede;
			}
			table.gridtable td {
				border-width: 1px;
				padding: 8px;
				border-style: solid;
				border-color: #666666;
				background-color: #ffffff;
			}</style>
		   <table border="1" width="100%" class="gridtable">
		   <tr><th><strong>Title</strong></th><td>'.$project->project_title.'</td></tr>
		   <tr><th><strong>End Date</strong></th><td>'.$project->project_start_date.'</td></tr>
		   <tr><th><strong>End Date</strong></th><td>'.$project->project_end_date.'</td></tr>
		   <tr><th><strong>Partners</strong></th><td>'.$thepartners.'</td></tr>
		   <tr><th><strong>Target Areas</strong></th><td>'.$thecounties.'</td></tr>
		   <tr><th><strong>Beneficiaries</strong></th><td>'.$beneficiarydata.'</td></tr>
		   <tr><th><strong>Budget</strong></th><td>'.$project->project_budget.' '.$project->currency.'</td></tr>
		   <tr><th><strong>Donors</strong></th><td>'.$thedonors.'</td></tr>
		   <tr><th><strong>Goal/Objective</strong></th><td>'.$project->project_objective.'</td></tr>
		   </table>
		   ';
		   
		   $roles_and_responsibilities = '
		   <style type="text/css">
			table.gridtable {
				font-family: verdana,arial,sans-serif;
				font-size:11px;
				color:#333333;
				border-width: 1px;
				border-color: #666666;
				border-collapse: collapse;
			}
			table.gridtable th {
				border-width: 1px;
				padding: 8px;
				border-style: solid;
				border-color: #666666;
				background-color: #dedede;
			}
			table.gridtable td {
				border-width: 1px;
				padding: 8px;
				border-style: solid;
				border-color: #666666;
				background-color: #ffffff;
			}</style>
		   <table border="1" width="100%" width="100%" class="gridtable">
		   <thead>
		   <tr><th>Role</th><th>Responsibilities</th></tr>
		   </thead>
		   <tbody>
		   <tr><td>&lt;insert&gt;</td><td>&lt;insert&gt;</td></tr>
		   <tr><td>&lt;insert&gt;</td><td>&lt;insert&gt;</td></tr>
		   <tr><td>&lt;insert&gt;</td><td>&lt;insert&gt;</td></tr>
		   <tr><td>&lt;insert&gt;</td><td>&lt;insert&gt;</td></tr>
		   <tr><td>&lt;insert&gt;</td><td>&lt;insert&gt;</td></tr>
		   </tbody>
		   </table>';
		   
		   $logframe = '
		   <style type="text/css">
			table.gridtable {
				font-family: verdana,arial,sans-serif;
				font-size:11px;
				color:#333333;
				border-width: 1px;
				border-color: #666666;
				border-collapse: collapse;
			}
			table.gridtable th {
				border-width: 1px;
				padding: 8px;
				border-style: solid;
				border-color: #666666;
				background-color: #dedede;
			}
			table.gridtable td {
				border-width: 1px;
				padding: 8px;
				border-style: solid;
				border-color: #666666;
				background-color: #ffffff;
			}</style>
		   <table width="100%" class="gridtable">';
		   $logframe .= '<thead>';
		   $logframe .= '<tr>';
		   $logframe .= '<th>OBJECTIVES</th><th>INDICATORS</th><th>MEANS OF VERIFICATION</th><th>RISKS/ASSUMPTIONS</th></tr>';
		   $logframe .= '</tr>';
		   $logframe .= '</thead>';
		   
		   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($project->id);
		   $logframe .= '</tbody>';
		    foreach($projectobjectives as $key=>$projectobjective)
		   {
			   $indicators = $this->projectobjectiveindicatorsmodel->get_list_by_objective($projectobjective['id']);
			   $logframe .= '<tr><td>'.$projectobjective['objective'].'</td>';
			   $logframe .= '<td>';
			   $logframe .= '<ul>';
			   foreach($indicators as $key=>$indicator):
				$logframe .= '<li>'.$indicator['indicator'].'<br> <strong>Target:</strong> '.$indicator['target'].'</li>';
			   endforeach;
			   $logframe .= '</ul>';
			   $logframe .= '</td>';
			   $logframe .= '<td>';
			   $logframe .= '<ul>';
			   foreach($indicators as $key=>$indicator):
				$logframe .= '<li>'.$indicator['means'].'</li>';
			   endforeach;
			   $logframe .= '</ul>';
			   $logframe .= '</td>';
			   $logframe .= '<td>';
			   $logframe .= '<ul>';
			   foreach($indicators as $key=>$indicator):
				$logframe .= '<li>'.$indicator['assumptions'].'</li>';
			   endforeach;
			   $logframe .= '</ul>';
			   $logframe .= '</td>';
	
			   $logframe .= '</tr>';
			   
			   //$logframe .= '<tr><th colspan="4">OUTCOMES</th></tr>';
			   
			   //get the outcomes
			   $objectiveoutcomes = $this->projectoutcomesmodel->get_by_objective_list($projectobjective['id']);
		   
			   if(!empty($objectiveoutcomes))
			   {
				  foreach($objectiveoutcomes as $key=>$objectiveoutcome)
				   {
					   $indicators = $this->projectoutcomeindicatorsmodel->get_list_by_outcome($objectiveoutcome['id']);
					   $logframe .= '<tr><th><strong>Outcome:</strong>'.$objectiveoutcome['outcome'].'</th>';
					   $logframe .= '<td>';
					   $logframe .= '<ul>';
					   foreach($indicators as $key=>$indicator):
						$logframe .= '<li>'.$indicator['outcomeindicator'].'</li>';
					   endforeach;
					   $logframe .= '</ul>';
					   $logframe .= '</td>';
					   $logframe .= '<td>';
					   $logframe .= '<ul>';
					   foreach($indicators as $key=>$indicator):
						$logframe .= '<li>'.$indicator['outcomemeans'].'</li>';
					   endforeach;
					   $logframe .= '</ul>';
					   $logframe .= '</td>';
					   $logframe .= '<td>';
					   $logframe .= '<ul>';
					   foreach($indicators as $key=>$indicator):			   
						$logframe .= '<li>'.$indicator['outcomeassumptions'].'</li>';
						endforeach;
					   $logframe .= '</ul>';
					   $logframe .= '</td>';
			
					   $logframe .= '</tr>';
					   
					  // $logframe .= '<tr><th colspan="4">OUTPUTS</th></tr>';
					   //get the outputs
					   $outcomeoutputs = $this->projectoutputsmodel->get_by_outcome_list($objectiveoutcome['id']);
		   
					   if(!empty($outcomeoutputs))
					   {
						   foreach($outcomeoutputs as $key=>$outcomeoutput)
						   {
							   $indicators = $this->projectoutputindicatorsmodel->get_list_by_output($outcomeoutput['id']);
							   $logframe .= '<tr><td>'.$outcomeoutput['output'].'</td>';
							   $logframe .= '<td>';
							   $logframe .= '<ul>';
							   foreach($indicators as $key=>$indicator):
								$logframe .= '<li>'.$indicator['outputindicator'].'</li>';
							   endforeach;
							   $logframe .= '</ul>';
							   $logframe .= '</td>';
							   $logframe .= '<td>';
							   $logframe .= '<ul>';
							   foreach($indicators as $key=>$indicator):
								$logframe .= '<li>'.$indicator['outputmeans'].'</li>';
							   endforeach;
							   $logframe .= '</ul>';
							   $logframe .= '</td>';
							   $logframe .= '<td>';
							   $logframe .= '<ul>';
							   foreach($indicators as $key=>$indicator):
								$logframe .= '<li>'.$indicator['outputassumptions'].'</li>';
							   endforeach;
							   $logframe .= '</ul>';
							   $logframe .= '</td>';
					
							   $logframe .= '</tr>';
						   }
					   }
					   //end outputs
				   }//end outcomes
			   }//end objectives
			   
			   $logframe .= '<tr><th colspan="4">&nbsp;</th></tr>';
		   }
	   
		   
		   $logframe .= '</tbody>';
		   $logframe .= '</table>';
		   
		   $indicatortables = '';
		   
		  foreach($projectobjectives as $key=>$projectobjective)
	   	  {
		    $indicators = $this->projectobjectiveindicatorsmodel->get_list_by_objective($projectobjective['id']);
		    foreach($indicators as $key=>$indicator):
			
				$indicatortables .= '
				<style type="text/css">
					table.gridtable {
						font-family: verdana,arial,sans-serif;
						font-size:11px;
						color:#333333;
						border-width: 1px;
						border-color: #666666;
						border-collapse: collapse;
					}
					table.gridtable th {
						border-width: 1px;
						padding: 8px;
						border-style: solid;
						border-color: #666666;
						background-color: #dedede;
					}
					table.gridtable td {
						border-width: 1px;
						padding: 8px;
						border-style: solid;
						border-color: #666666;
						background-color: #ffffff;
					}</style>

				<table border="1" width="100%" class="gridtable">
					<thead>
						<tr><th colspan="2">'.$projectobjective['objective'].'</th></tr>
					</thead>
					<tbody>
						<tr><th valign="top"><strong>Indicator</strong></th><td>'.$indicator['indicator'].'</td></tr>
						<tr><th valign="top"><strong>Definition</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Purpose</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Target</strong></th><td>'.$indicator['target'].'</td></tr>
						<tr><th valign="top"><strong>Data Collection</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Tool</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Frequency/Timing</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Responsible</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Audience</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Reporting</strong></th><td>&nbsp;</td></tr>
						<tr><th valign="top"><strong>Quality Control</strong></th><td>&nbsp;</td></tr>
					</tbody>
				</table>';
				$indicatortables .= '<br>';
			 endforeach;
			 
			 			 
		   
		  }
		  
		  $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($project->id);
		  if(!empty($projectoutcomes))
		  {
			  foreach($projectoutcomes as $key=>$projectoutcome)
			  {
						   $outcomeindicators = $this->projectoutcomeindicatorsmodel->get_list_by_outcome($projectoutcome['id']);
						   
						   foreach($outcomeindicators as $key=>$outcomeindicator):
							   $indicatortables .= '
							   <style type="text/css">
								table.gridtable {
									font-family: verdana,arial,sans-serif;
									font-size:11px;
									color:#333333;
									border-width: 1px;
									border-color: #666666;
									border-collapse: collapse;
								}
								table.gridtable th {
									border-width: 1px;
									padding: 8px;
									border-style: solid;
									border-color: #666666;
									background-color: #dedede;
								}
								table.gridtable td {
									border-width: 1px;
									padding: 8px;
									border-style: solid;
									border-color: #666666;
									background-color: #ffffff;
								}</style>
								<table border="1" width="100%" class="gridtable">
									<thead>
										<tr><th colspan="2">'.$projectoutcome['outcome'].'</th></tr>
									</thead>
									<tbody>
										<tr><th valign="top"><strong>Indicator</strong></td><td>'.$outcomeindicator['outcomeindicator'].'</td></tr>
										<tr><th valign="top"><strong>Definition</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Purpose</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Target</strong></th><td>'.$outcomeindicator['outcometarget'].'</td></tr>
										<tr><th valign="top"><strong>Data Collection</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Tool</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Frequency/Timing</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Responsible</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Audience</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Reporting</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Quality Control</strong></th><td>&nbsp;</td></tr>
									</tbody>
								</table>';
							$indicatortables .= '<br>';
						   endforeach;
					
				 }
	   		}
			
		  $projectoutputs = $this->projectoutputsmodel->get_by_project_list($project->id);
		  if(!empty($projectoutputs))
		  {
			   foreach($projectoutputs as $key=>$projectoutput)
			   {
				   $outputindicators = $this->projectoutputindicatorsmodel->get_list_by_output($projectoutput['id']);
				   foreach($outputindicators as $key=>$outputindicator):
					$indicatortables .= ' <style type="text/css">
								table.gridtable {
									font-family: verdana,arial,sans-serif;
									font-size:11px;
									color:#333333;
									border-width: 1px;
									border-color: #666666;
									border-collapse: collapse;
								}
								table.gridtable th {
									border-width: 1px;
									padding: 8px;
									border-style: solid;
									border-color: #666666;
									background-color: #dedede;
								}
								table.gridtable td {
									border-width: 1px;
									padding: 8px;
									border-style: solid;
									border-color: #666666;
									background-color: #ffffff;
								}</style>
								<table border="1" width="100%" class="gridtable">
									<thead>
										<tr><th colspan="2">'.$projectoutput['output'].'</th></tr>
									</thead>
									<tbody>
										<tr><th valign="top"><strong>Indicator</strong></td><td>'.$outputindicator['outputindicator'].'</td></tr>
										<tr><th valign="top"><strong>Definition</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Purpose</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Target</strong></th><td>'.$outputindicator['outputtarget'].'</td></tr>
										<tr><th valign="top"><strong>Data Collection</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Tool</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Frequency/Timing</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Responsible</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Audience</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Reporting</strong></th><td>&nbsp;</td></tr>
										<tr><th valign="top"><strong>Quality Control</strong></th><td>&nbsp;</td></tr>
									</tbody>
								</table>';
								$indicatortables .= '<br>';
					
				   endforeach;
			   }
		  }
		  
		  $appendices = '<style type="text/css">
								table.gridtable {
									font-family: verdana,arial,sans-serif;
									font-size:11px;
									color:#333333;
									border-width: 1px;
									border-color: #666666;
									border-collapse: collapse;
								}
								table.gridtable th {
									border-width: 1px;
									padding: 8px;
									border-style: solid;
									border-color: #666666;
									background-color: #dedede;
								}
								table.gridtable td {
									border-width: 1px;
									padding: 8px;
									border-style: solid;
									border-color: #666666;
									background-color: #ffffff;
								}</style>
								<table border="1" width="100%" class="gridtable">
								<tr><th>&lt;Tool Title &gt;</th></tr>
								<tr><td>&lt;Insert Tool &gt;</td></tr>
								<tr><th>&lt;Tool Title &gt;</th></tr>
								<tr><td>&lt;Insert Tool &gt;</td></tr>
								<tr><th>&lt;Tool Title &gt;</th></tr>
								<tr><td>&lt;Insert Tool &gt;</td></tr>
								</table>';
		   
		   
           $data = array(
               'project_id' => $this->input->post('project_id'),
			   'background' => $this->input->post('background'),
               'purpose_of_plan' => $this->input->post('purpose_of_plan'),
               'project_summary' => $project_summary,
               'logical_framework' => $logframe,
               'indicators' => $indicatortables,
               'roles_and_responsibilities' => $roles_and_responsibilities,
               'data_flow' => '',
               'storage' => '',
               'analysis' => '',
               'privacy' => '',
			   'appendices' => $appendices,
			   'date_added' => date('Y-m-d'),
           );
           $this->db->insert('projectsmandeplans', $data);
		   $projectplan_id = $this->db->insert_id();
           redirect('projectsmandeplans/edit/'.$projectplan_id,'refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectsmandeplans','refresh');
       }
       $row = $this->db->get_where('projectsmandeplans', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projectsmandeplans','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   $data['projects'] = $this->db->get('projects');
       $this->load->view('projectsmandeplans/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_id', 'Project id', 'trim|required');
	   $this->form_validation->set_rules('background', 'Introduction', 'trim|required');
       $this->form_validation->set_rules('purpose_of_plan', 'Purpose of plan', 'trim|required');
       $this->form_validation->set_rules('project_summary', 'Project summary', 'trim|required');
       $this->form_validation->set_rules('logical_framework', 'Logical framework', 'trim|required');
       $this->form_validation->set_rules('indicators', 'Indicators', 'trim|required');
       $this->form_validation->set_rules('roles_and_responsibilities', 'Roles and responsibilities', 'trim|required');
       $this->form_validation->set_rules('data_flow', 'Data flow', 'trim|required');
       $this->form_validation->set_rules('storage', 'Storage', 'trim|required');
       $this->form_validation->set_rules('analysis', 'Analysis', 'trim|required');
       $this->form_validation->set_rules('privacy', 'Privacy', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_id' => $this->input->post('project_id'),
			   'background' => $this->input->post('background'),
               'purpose_of_plan' => $this->input->post('purpose_of_plan'),
               'project_summary' => $this->input->post('project_summary'),
               'logical_framework' => $this->input->post('logical_framework'),
               'indicators' => $this->input->post('indicators'),
               'roles_and_responsibilities' => $this->input->post('roles_and_responsibilities'),
               'data_flow' => $this->input->post('data_flow'),
               'storage' => $this->input->post('storage'),
               'analysis' => $this->input->post('analysis'),
               'privacy' => $this->input->post('privacy'),
			   'appendices' => $this->input->post('appendices'),
           );
           $this->db->where('id', $id);
           $this->db->update('projectsmandeplans', $data);
           redirect('projectsmandeplans','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectsmandeplans','refresh');
       }
       $this->db->delete('projectsmandeplans', array('id' => $id));
       redirect('projectsmandeplans','refresh');
   }
   public function downloadword($id)
   {
	   
	   $filename = "PM&EPlan".date('dmY-his').".doc";
		
		//$this->output->set_header("Content-Type: application/xml; charset=UTF-8");
		$this->output->set_header("Content-Type: application/vnd.ms-word");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=$filename");
		
	   
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projectsmandeplans','refresh');
       }
       $row = $this->db->get_where('projectsmandeplans', array('id' => $id))->row();
	   if(empty($row)) {
       	redirect('projectsmandeplans','refresh');
       }
	   
	   $today = date('Y-m-d');
       
	   $project = $this->projectsmodel->get_by_id($row->project_id)->row();
	   $html = '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>'.strtoupper($project->project_no).':'.strtoupper($project->project_title).'</strong></font></td></tr></table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   
	   
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>MONITORING AND EVALUATION PLAN</strong></font></td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif">'. date("d F Y",strtotime($today)).'</font></td></tr>
	   </table>';
	   
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>1. Intoduction</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif">'.$row->background.'</font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>1.1. Purpose of this Plan</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif">'.$row->purpose_of_plan.'</font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	    $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>1.2. Project Summary</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
       $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->project_summary.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>2. Logical Framework</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->logical_framework.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>3. Indicators</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->indicators.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>4. Roles & Responsibilities</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->roles_and_responsibilities.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>5. Data Flow</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->data_flow.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>6. Data Management</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>6.1 Storage</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->storage.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>6.2 Analysis</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->analysis.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>6.3 Privacy</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">';
	   $html .= '<tr><td>'.$row->privacy.'</td></tr>';
	   $html .= '</table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td><font face="Verdana, Geneva, sans-serif"><strong>Appendices</strong></font></td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>&nbsp;</td></tr>
	   </table>';
	   $html .= '<table border="0" cellpadding="0" cellspacing="3" width="100%">
	   <tr><td>'.$row->appendices.'</td></tr>
	   </table>';
	   
	   $this->output->append_output($html);
   }
   
   function check_plan($project_id)
	{
		$plan = $this->projectsmandeplansmodel->get_by_project_id($project_id)->row();
		if(empty($plan->id))
		{
			return TRUE;
		}
	   else {
		 	
			$this->form_validation->set_message('check_plan', 'The selected project already has an M&E plan added');
			 return false;
		}
	}

}
