<?php

/**
DO NOT REMOVE THIS NOTICE FROM THE CODE
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Projects extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       $this->load->model('projectsmodel');
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array(
           'rows' => $this->db->get('projects'),
       );
       $this->load->view('projects/index', $data);
   }

   public function add()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $data = array();
	   $data['donors'] = $this->donorsmodel->get_list();
	   $data['counties'] = $this->countiesmodel->get_list();
	   $data['currencies'] = $this->currenciesmodel->get_list();
	   $data['sectors'] = $this->sectorsmodel->get_list();
	   $data['partners'] = $this->partnersmodel->get_list();
	   $data['status'] = $this->projectactivitystatusmodel->get_list();
	    
       $this->load->view('projects/add',$data);
   }

   public function add_validate()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_no', 'Project no', 'trim|required');
       $this->form_validation->set_rules('project_title', 'Project title', 'trim|required');
       $this->form_validation->set_rules('project_agreement_number', 'Project agreement number', 'trim|required');
       //$this->form_validation->set_rules('date_of_fund_eligibility', 'Date of fund eligibility', 'trim|required');
       //$this->form_validation->set_rules('date_of_agreement', 'Date of agreement', 'trim|required');
       $this->form_validation->set_rules('project_objective', 'Project objective', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('project_start_date', 'Project start date', 'trim|required');
       $this->form_validation->set_rules('project_end_date', 'Project end date', 'trim|required');
       //$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
      // $this->form_validation->set_rules('project_budget', 'Project budget', 'trim|required');
       $this->form_validation->set_rules('projectactivitystatus_id', 'Status', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->add();
       } else {
           $data = array(
               'project_no' => $this->input->post('project_no'),
               'project_title' => $this->input->post('project_title'),
               'project_agreement_number' => $this->input->post('project_agreement_number'),
               'date_of_fund_eligibility' => $this->input->post('date_of_fund_eligibility'),
               'date_of_agreement' => $this->input->post('date_of_agreement'),
               'project_objective' => $this->input->post('project_objective'),
               'description' => $this->input->post('description'),
               'project_start_date' => $this->input->post('project_start_date'),
               'project_end_date' => $this->input->post('project_end_date'),
               'currency' => $this->input->post('currency'),
               'project_budget' => $this->input->post('project_budget'),
               'projectactivitystatus_id' => $this->input->post('projectactivitystatus_id'),
           );
           $this->db->insert('projects', $data);
		   $project_id = $this->db->insert_id();
		   
		   
		   if (!empty($_POST['county_id'])) {
                foreach ($_POST['county_id'] as $rrow => $rid) {
                    
                    $county_id = $rid;
					
					 $projectscountiesdata = array(
					   'project_id' => $project_id,
					   'county_id' => $county_id,
				   );
				   $this->db->insert('projectscounties', $projectscountiesdata);
					
				}
		   }
		   
		   if (!empty($_POST['sector_id'])) {
                foreach ($_POST['sector_id'] as $srow => $sid) {
                    
                    $sector_id = $sid;
										
					$data = array(
					   'project_id' => $project_id,
					   'sector_id' => $sector_id,
				   );
				   $this->db->insert('projectsectors', $data);
					
				}
		   }
		   
		   if (!empty($_POST['donor_id'])) {
                foreach ($_POST['donor_id'] as $drow => $did) {
                    
                    $donor_id = $did;
										
					$data = array(
					   'project_id' => $project_id,
					   'donor_id' => $donor_id,
				   );
				   $this->db->insert('projectdonors', $data);
					
				}
		   }
		   
		   if (!empty($_POST['partner_id'])) {
                foreach ($_POST['partner_id'] as $ptdrow => $ptid) {
                    
                    $partner_id = $ptid;
										
					$data = array(
					   'project_id' => $project_id,
					   'partner_id' => $partner_id,
				   );
				   $this->db->insert('projectpartners', $data);
					
				}
		   }
		   
           redirect('projects/edit/'.$project_id,'refresh');
       }
   }

   public function edit($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projects','refresh');
       }
       $row = $this->db->get_where('projects', array('id' => $id))->row();
       if(empty($row)) {
       	redirect('projects','refresh');
       }
       $data = array(
           'row' => $row,
       );
	   
	   //project objectives section
	   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($row->id);
	   
	   $objectives = count($projectobjectives);
	   
	   if($objectives >0)
	   {
		   $totalobjectives = $objectives;
	   }
	   else
	   {
		   $totalobjectives = '';
	   }
	   
	   /**
	   PROJECT OBJECTIVES TABLE
	   **/
	   $table = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_objectives" id="number_of_objectives" title="You must add objectives" data-rule-required="true">
             <option value="'.$totalobjectives.'">'.$totalobjectives.'</option>
             </select> Objective(s)
		    </td>
        </tr>
       <tr>
         <th>Specific Objective</th>
         <th>Indicators</th>
         <th>Means of Verification</th>
         <th>Assumptions</th>
        </tr>
        </thead>
       <tbody>';
	   
	   foreach($projectobjectives as $key=>$projectobjective)
	   {
		   $indicators = $this->projectobjectiveindicatorsmodel->get_list_by_objective($projectobjective['id']);
		   $table .= '<tr><td>'.$projectobjective['objective'].'</td>';
		   $table .= '<td>';
		   $table .= '<ul>';
		   foreach($indicators as $key=>$indicator):
		   	$table .= '<li>'.$indicator['indicator'].'<br> <strong>Target:</strong> '.$indicator['target'].'</li>';
		   endforeach;
		   $table .= '</ul>';
		   $table .= '</td>';
		   $table .= '<td>';
		   $table .= '<ul>';
		   foreach($indicators as $key=>$indicator):
		   	$table .= '<li>'.$indicator['means'].'</li>';
		   endforeach;
		   $table .= '</ul>';
		   $table .= '</td>';
		   $table .= '<td>';
		   $table .= '<ul>';
		   foreach($indicators as $key=>$indicator):
		   	$table .= '<li>'.$indicator['assumptions'].'</li>';
		   endforeach;
		   $table .= '</ul>';
		   $table .= '</td>';

		   $table .= '</tr>';
	   }
	   
	   $table .= '
	   </tbody>
	   </table>';
	   
	   //project objectives select
	   	$projobjselect = '<select name="projectobjective_id[]" id="projectobjective_id" class="form-control">';
		foreach($projectobjectives as $prkey=> $projobj)
		{
			$projobjselect .= '<option value="'.$projobj['id'].'">'.$projobj['objective'].'</option>';
		}
		
		$projobjselect .= '</select>';
		
		/***
		PROJECT OUTCOME TABLE
		
		**/
		
	   $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($row->id);
	   
	   $outcomes = count($projectoutcomes);
	   
	   if($outcomes >0)
	   {
		   $totaloutcomes = $outcomes;
	   }
	   else
	   {
		   $totaloutcomes = '';
	   }
	   
	   $outcometable = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_outcomes" id="number_of_outcomes" title="You must add outcomes" data-rule-required="true">
             <option value="'.$totaloutcomes.'">'.$outcomes.'</option>
             </select> Outcome(s)
		    </td>
        </tr>
       <tr>
         <th>Outcome</th>
         <th>Indicators</th>
         <th>Means of Verification</th>
         <th>Assumptions</th>
        </tr>
        </thead>
       <tbody>';
	   
	   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($row->id);
	   
	   foreach($projectobjectives as $key=>$projectobjective)
	   {
		   $objectiveoutcomes = $this->projectoutcomesmodel->get_by_objective_list($projectobjective['id']);
		   
		   if(!empty($objectiveoutcomes))
		   {
			   $outcometable .= '<tr><td colspan="4">'.$projectobjective['objective'].'</td>';
			   
				
		   
			   foreach($objectiveoutcomes as $key=>$objectiveoutcome)
			   {
				   $indicators = $this->projectoutcomeindicatorsmodel->get_list_by_outcome($objectiveoutcome['id']);
				   $outcometable .= '<tr><td>'.$objectiveoutcome['outcome'].'</td>';
				   $outcometable .= '<td>';
				   $outcometable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outcometable .= '<li>'.$indicator['outcomeindicator'].'</li>';
				   endforeach;
				   $outcometable .= '</ul>';
				   $outcometable .= '</td>';
				   $outcometable .= '<td>';
				   $outcometable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outcometable .= '<li>'.$indicator['outcomemeans'].'</li>';
				   endforeach;
				   $outcometable .= '</ul>';
				   $outcometable .= '</td>';
				   $outcometable .= '<td>';
				   $outcometable .= '<ul>';
				   foreach($indicators as $key=>$indicator):			   
					$outcometable .= '<li>'.$indicator['outcomeassumptions'].'</li>';
					endforeach;
				   $outcometable .= '</ul>';
				   $outcometable .= '</td>';
		
				   $outcometable .= '</tr>';
			   }
		   }
	   }
	   
	   $outcometable .= '
	   </tbody>
	   </table>';
	   
	   
	   //project outcome select
	   
	   $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($row->id);
	   	$outcomeselect = '<select name="projectoutcome_id[]" id="projectoutcome_id" class="form-control">';
		foreach($projectoutcomes as $pokey=> $projectoutcome)
		{
			$outcomeselect .= '<option value="'.$projectoutcome['id'].'">'.$projectoutcome['outcome'].'</option>';
		}
		
		$outcomeselect .= '</select>';
		
		//output table
		 $projectoutputs = $this->projectoutputsmodel->get_by_project_list($row->id);
	   
	   $outputs = count($projectoutputs);
	   if($outputs >0)
	   {
		   $totaloutputs = $outputs;
	   }
	   else
	   {
		   $totaloutputs = '';
	   }
	   
	   /**
	   PROJECT OUTPUTS TABLE
	   **/
	   
	   $outputtable = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_outcomes" id="number_of_outcomes" title="You must add outcomes" data-rule-required="true">
             <option value="'.$totaloutputs.'">'.$outputs.'</option>
             </select> Output(s)
		    </td>
        </tr>
       <tr>
         <th>Output</th>
         <th>Indicators</th>
         <th>Means of Verification</th>
         <th>Assumptions</th>
        </tr>
        </thead>
       <tbody>';
	   
	   $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($row->id);
	   
	   foreach($projectoutcomes as $key=>$projectoutcome)
	   {
		   $outcomeoutputs = $this->projectoutputsmodel->get_by_outcome_list($projectoutcome['id']);
		   
		   if(!empty($outcomeoutputs))
		   {
			   $outputtable .= '<tr><td colspan="4">'.$projectoutcome['outcome'].'</td>';
			   	   
			   foreach($outcomeoutputs as $key=>$outcomeoutput)
			   {
				   $indicators = $this->projectoutputindicatorsmodel->get_list_by_output($outcomeoutput['id']);
				   $outputtable .= '<tr><td>'.$outcomeoutput['output'].'</td>';
				   $outputtable .= '<td>';
				   $outputtable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outputtable .= '<li>'.$indicator['outputindicator'].'</li>';
				   endforeach;
				   $outputtable .= '</ul>';
				   $outputtable .= '</td>';
				   $outputtable .= '<td>';
				   $outputtable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outputtable .= '<li>'.$indicator['outputmeans'].'</li>';
				   endforeach;
				   $outputtable .= '</ul>';
				   $outputtable .= '</td>';
				   $outputtable .= '<td>';
				   $outputtable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outputtable .= '<li>'.$indicator['outputassumptions'].'</li>';
				   endforeach;
				   $outputtable .= '</ul>';
				   $outputtable .= '</td>';
		
				   $outputtable .= '</tr>';
			   }
		   }
	   }
	   
	   $outputtable .= '
	   </tbody>
	   </table>';
	   
	   //output select
	   $projectoutputs = $this->projectoutputsmodel->get_by_project_list($row->id);
	   	$outputselect = '<select name="projectoutput_id" id="projectoutput_id" class="form-control">';
		foreach($projectoutputs as $pukey=> $projectoutput)
		{
			$outputselect .= '<option value="'.$projectoutput['id'].'">'.$projectoutput['output'].'</option>';
		}
		
		$outputselect .= '</select>';
		
		/**
		PLANNED ACTIVITIES TABLE
		**/
	   $plannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($row->id);
	   $activities = count($plannedactivities);
	   if($activities >0)
	   {
		   $totalactivities = $activities;
	   }
	   else
	   {
		   $totalactivities = '';
	   }
		
		$activitytable = '<table class="table table-hover table-nomargin">
		   <thead>
			<tr>
			   <td colspan="4">
				<select name="number_of_activities" id="number_of_activities" title="You must add activities" data-rule-required="true">
				 <option value="'.$totalactivities.'">'.$activities.'</option>
				 </select> Activities
				</td>
			</tr>
		   <tr>
			 <th>Activity</th>
			 <th>Input/Resources</th>
			 <th>Cost &amp; Sources</th>
			 <th>Assumptions</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($plannedactivities as $plankey=>$plannedactivity):
		   
		   $activitytable .= '<tr><td>'.$plannedactivity['activity'].'</td><td>'.$plannedactivity['resources'].'</td><td>'.$plannedactivity['cost'].'</td><td>'.$plannedactivity['activityassumptions'].'</td></tr>';
		   endforeach;
		   
		 $activitytable .= '
		   </tbody>
		   </table>';
		   
		   /**
		   BENEFICIARY TABLE
		   ***/
		   $beneficiaries = $this->projectbeneficiariesmodel->get_by_project_list($row->id);
		
		$beneficiarytable = '<table class="table table-hover table-nomargin">
		   <thead>			
		   <tr>
			 <th>Beneficiary</th>	
			 <th>Target</th>		 
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($beneficiaries as $bkey=>$beneficiary)
		   {
			   $beneficiarytype = $this->beneficiarytypesmodel->get_by_id($beneficiary['beneficiary_id'])->row();
			   $beneficiarytable .= '<tr><td>'.$beneficiarytype->beneficiary_type.'</td><td>'.$beneficiary['target'].'</td></tr>';
		   }
		   
		   $beneficiarytable .= '
		   </tbody>
		   </table>';
		   
		   /**
		   DOCUMENTS TABLE
		   **/
	    $documents = $this->documentsmodel->get_list_by_project($row->id);
		 
		 $documentstable = '<table class="table table-hover table-nomargin">
		   <thead>
			
		   <tr>
			 <th>Document Title</th>
			 <th>Document Category</th>
			 <th>Date Added</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($documents as $key=>$document)
		   {
			  $category = $this->documentcategoriesmodel->get_by_id($document['documentcategory_id'])->row();
			  $documentstable .= '<tr><td>'.$document['document_title'].'</td><td>'.$category->category.'</td><td>'.$document['date_added'].'</td></tr>'; 
		   }
		   
		    $documentstable .= '
		   </tbody>
		   </table>';
	   
	   
	   $data['documentstable'] = $documentstable;
	   $data['beneficiarytable'] = $beneficiarytable;
	   $data['activitytable'] = $activitytable;
	   $data['outputselect'] = $outputselect;	
	   $data['outputtable'] = $outputtable;	   
	   $data['outcomeselect'] = $outcomeselect;	    
	   $data['projobjselect'] = $projobjselect;
	   $data['outcometable'] = $outcometable;
	   $data['table'] = $table;
	   $data['donors'] = $this->donorsmodel->get_list();
	   $data['counties'] = $this->countiesmodel->get_list();
	   $data['currencies'] = $this->currenciesmodel->get_list();
	   $data['sectors'] = $this->sectorsmodel->get_list();
	   $data['partners'] = $this->partnersmodel->get_list();
	   $data['status'] = $this->projectactivitystatusmodel->get_list();
	   $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	   $data['documentcategories'] = $this->documentcategoriesmodel->get_list();
	   $data['projectobjectives'] = $projectobjectives;
       $this->load->view('projects/edit', $data);
   }

   public function edit_validate($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       $this->load->library('form_validation');
       $this->form_validation->set_rules('project_no', 'Project no', 'trim|required');
       $this->form_validation->set_rules('project_title', 'Project title', 'trim|required');
       $this->form_validation->set_rules('project_agreement_number', 'Project agreement number', 'trim|required');
       //$this->form_validation->set_rules('date_of_fund_eligibility', 'Date of fund eligibility', 'trim|required');
       //$this->form_validation->set_rules('date_of_agreement', 'Date of agreement', 'trim|required');
       $this->form_validation->set_rules('project_objective', 'Project objective', 'trim|required');
       $this->form_validation->set_rules('description', 'Description', 'trim|required');
       $this->form_validation->set_rules('project_start_date', 'Project start date', 'trim|required');
       $this->form_validation->set_rules('project_end_date', 'Project end date', 'trim|required');
       //$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
       //$this->form_validation->set_rules('project_budget', 'Project budget', 'trim|required');
       $this->form_validation->set_rules('projectactivitystatus_id', 'Projectactivitystatus id', 'trim|required');
       if ($this->form_validation->run() == false) {
           $this->edit($id);
       } else {
           $data = array(
               'project_no' => $this->input->post('project_no'),
               'project_title' => $this->input->post('project_title'),
               'project_agreement_number' => $this->input->post('project_agreement_number'),
               'date_of_fund_eligibility' => $this->input->post('date_of_fund_eligibility'),
               'date_of_agreement' => $this->input->post('date_of_agreement'),
               'project_objective' => $this->input->post('project_objective'),
               'description' => $this->input->post('description'),
               'project_start_date' => $this->input->post('project_start_date'),
               'project_end_date' => $this->input->post('project_end_date'),
               'currency' => $this->input->post('currency'),
               'project_budget' => $this->input->post('project_budget'),
               'projectactivitystatus_id' => $this->input->post('projectactivitystatus_id'),
           );
           $this->db->where('id', $id);
           $this->db->update('projects', $data);
		   
		   if (!empty($_POST['county_id'])) {
                foreach ($_POST['county_id'] as $rrow => $rid) {
                    
                    $county_id = $rid;
					
					$erasecounty = $this->projectscountiesmodel->delete_project_county($id,$county_id);
					
					 $projectscountiesdata = array(
					   'project_id' => $id,
					   'county_id' => $county_id,
				   );
				   $this->db->insert('projectscounties', $projectscountiesdata);
					
				}
		   }
		   
		   if (!empty($_POST['sector_id'])) {
                foreach ($_POST['sector_id'] as $srow => $sid) {
                    
                    $sector_id = $sid;
					
					$erasesector = $this->projectsectorsmodel->delete_project_sector($id,$sector_id);
										
					$data = array(
					   'project_id' => $id,
					   'sector_id' => $sector_id,
				   );
				   $this->db->insert('projectsectors', $data);
					
				}
		   }
		   
		   if (!empty($_POST['donor_id'])) {
                foreach ($_POST['donor_id'] as $drow => $did) {
                    
                    $donor_id = $did;
					
					$erasedonor = $this->projectdonorsmodel->delete_project_donor($id,$donor_id);
										
					$data = array(
					   'project_id' => $id,
					   'donor_id' => $donor_id,
				   );
				   $this->db->insert('projectdonors', $data);
					
				}
		   }
		   
		   if (!empty($_POST['partner_id'])) {
                foreach ($_POST['partner_id'] as $prow => $pid) {
                    
                    $partner_id = $pid;
					
					$erasepartner = $this->projectpartnersmodel->delete_project_partner($id,$partner_id);
										
					$data = array(
					   'project_id' => $id,
					   'partner_id' => $partner_id,
				   );
				   $this->db->insert('projectpartners', $data);
					
				}
		   }
		   
		   
           redirect('projects','refresh');
       }
   }

   public function delete($id)
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('projects','refresh');
       }
       $this->db->delete('projects', array('id' => $id));
       redirect('projects','refresh');
   }
   
   public function logframe($id)
   {
	   // create new PDF document
			$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('KSG');
			$pdf->SetTitle('Project Logframe');
			$pdf->SetSubject('DRC/DDG Project Logframe');
			$pdf->SetKeywords('DRC, DDG, Logframe, Projects','Objectives');
			
			// set default header data
			$pdf->SetHeaderData(false, false, '', '');
			
			
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			
			//set margins
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
			$pdf->SetMargins(7, 7, 7);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			//set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			//set some language-dependent strings
			//$pdf->setLanguageArray($l);
			
			// ---------------------------------------------------------
			
			// set font
			$pdf->SetFont('dejavusans', '', 9);
			
			$pdf->SetPrintHeader(false);
			
			// add a page
			$pdf->AddPage('L', 'A4');
			
			$project = $this->projectsmodel->get_by_id($id)->row();
			
			$html = '<table width="100%" cellspacing="0" cellpadding="2" border="0">';
			$html .= '<tr><td><img src="' . base_url() . 'img/drc_logo.png" width="98" height="36"/> <img src="' . base_url() . 'img/ddg_logo.png" width="105" height="36"/></td></tr>';
			$html .= '<tr><td><strong><font size="12">LOGFRAME, '.strtoupper($project->project_title).', '.strtoupper($project->project_no).'</font></strong></td></tr>';
			$html .= '</table>';
			
			$html .= '<table width="100%" cellspacing="0" cellpadding="2" border="1">';
			$html .= '<tr bgcolor="#cccccc"><td>&nbsp;</td><td><strong>Intervention Logic</strong></td><td><strong>Objectively verifiable Indicators of achievement</strong></td><td><strong>Means of verification</strong></td><td><strong>Assumptions</strong></td></tr>';
			
			$projectobjectives = $this->projectobjectivesmodel->get_by_project_list($id);
			
			$total_objectives = count($projectobjectives);
			$i = 0;
			
			
			
			foreach($projectobjectives as $key=>$projectobjective)
	   		{
				$projectindicator = '';
				$assumptions = '';
				$means = '';
				$i++;
				if($i==1)
				{
					$title = 'Overall Objective';
				}
				else
				{
					$title = 'Immediate Objective(s)';
				}
				
				$indicators = $this->projectobjectiveindicatorsmodel->get_list_by_objective($projectobjective['id']);
				
				 foreach($indicators as $key=>$indicator):
					$projectindicator .= $indicator['indicator'].'<br><br>';
				 endforeach;
				 
				   foreach($indicators as $key=>$indicator):
					$means .= $indicator['means'].'<br><br>';
				   endforeach;
				   foreach($indicators as $key=>$indicator):
					$assumptions .= $indicator['assumptions'].'<br><br>';
				   endforeach;
				
				if($i==1)
				{
					$html .= '<tr><td  bgcolor="#cccccc"><strong>'.$title.'</strong></td><td>'.$projectobjective['objective'].'</td>';
					//$html .= '<td>'.$projectindicator.'</td>';
					//$html .= '<td>'.$means.'</td>';
					//$html .= '<td>'.$assumptions.'</td>';
					$html .= '<td colspan="3">'.$projectindicator.'</td>';
					$html .= '</tr>';
				}
				elseif($i==2)
				{
					$html .= '<tr><td  bgcolor="#cccccc" rowspan="'.$total_objectives.'"><strong>'.$title.'</strong></td><td>'.$projectobjective['objective'].'</td><td>'.$projectindicator.'</td><td>'.$means.'</td><td>'.$assumptions.'</td></tr>';
				}
				else
				{
					$html .= '<tr><td>'.$projectobjective['objective'].'</td><td>'.$projectindicator.'</td><td>'.$means.'</td><td>'.$assumptions.'</td></tr>';
				}
			
				
	   		}
			
			 $html .= '</table>';
			
			$html .= '<table width="100%" cellspacing="0" cellpadding="2" border="1">';
			$objectiveoutcomes = $this->projectoutcomesmodel->get_by_project_list($id);
			
			$total_outcomes = count($objectiveoutcomes);
			
			$j=0;
			
			   foreach($objectiveoutcomes as $key=>$objectiveoutcome)
			   {
				   $outcome_indicator = '';
				   $outcome_means = '';
				   $outcome_assumptions = '';
				   
				   $j++;
				   
				   $outcomeindicators = $this->projectoutcomeindicatorsmodel->get_list_by_outcome($objectiveoutcome['id']);
								 
				   foreach($outcomeindicators as $key=>$outcomeindicator):
					$outcome_indicator .= $outcomeindicator['outcomeindicator'].'<br><br>';
				   endforeach;
				  
				   foreach($outcomeindicators as $key=>$outcomeindicator):
					$outcome_means .= $outcomeindicator['outcomemeans'].'<br><br>';
				   endforeach;
				 
				   foreach($outcomeindicators as $key=>$outcomeindicator):
					$outcome_assumptions .= $outcomeindicator['outcomeassumptions'].'<br><br>';
				   endforeach;
				   
				   if($j==1)
				   {
				   $html .= '<tr><td  bgcolor="#cccccc" rowspan="'.$total_outcomes.'"><strong>Outputs</strong></td><td>'.$objectiveoutcome['outcome'].'</td><td>'.$outcome_indicator.'</td><td>'.$outcome_means.'</td><td>'.$outcome_assumptions.'</td></tr>';
				   }
				   else
				   {
					    $html .= '<tr><td>'.$objectiveoutcome['outcome'].'</td><td>'.$outcome_indicator.'</td><td>'.$outcome_means.'</td><td>'.$outcome_assumptions.'</td></tr>';
				   }
				  
			   }
			   
			   $html .= '</table>';
			
			$pdf->writeHTML($html, true, false, true, false, '');
			
			$txt = date("m/d/Y h:m:s");    
	
	 // print a block of text using Write()
	 //$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// test pre tag
			
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			// reset pointer to the last page
			$pdf->lastPage();
			ob_start();
				// ---------------------------------------------------------
			 //ob_end_clean();
			//Close and output PDF document
			$pdf->Output('Logical_Framework_'.$project->project_no.'.pdf', 'I');
			
			//============================================================+
			// END OF FILE                                                
			//============================================================+
   }
   
   public function objectivelogframe()
   {
	   
	  $objective = $_POST['objective'];
	  $project_id = $_POST['project_id'];
	  $indicatorarray = $_POST['indicator'];
	  $targetarray = $_POST['target'];
	  $meansarray = $_POST['means'];
	  $assumptionarray = $_POST['assumptions'];
	  
	  if(empty($objective[0]) || empty($indicatorarray[0])|| empty($targetarray[0]) || empty($meansarray[0]) || empty($assumptionarray[0]) ){
		  
		  echo '<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Warning!</strong> Please enter atleast one objective, indicator and its target, means of verification and assumptions
		   </div>
		  ';
	  }
	  else
	  {
		  //add the objective
		   $data = array(
						   'project_id' => $project_id[0],
						   'objective' => $objective[0],
					   );
		  $this->db->insert('projectobjectives', $data);
		  $objective_id = $this->db->insert_id();
		  
		  
		   //add indicators	   
		   foreach ($_POST['indicator'] as $row => $id) {
			   $indicator = $id;
			   $target    = $_POST['target'][$row];
			   $type    = $_POST['type'][$row];
			   $means    = $_POST['means'][$row];
			   $assumptions    = $_POST['assumptions'][$row];
				$data = array(
				   'indicator' => $indicator,
				   'target' => $target,
				   'type' => $type,
				   'means' => $means,
				   'assumptions' => $assumptions,
				   'objective_id' => $objective_id,
				   'project_id' => $project_id[0],
			   );
			   $this->db->insert('projectobjectiveindicators', $data);
		   }
		   
		   echo '<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Success!</strong> Objective successfully added
		   </div>
		  ';
	  }
	   
	   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($project_id[0]);
	   
	   $objectives = count($projectobjectives);
	   if($objectives >0)
	   {
		   $totalobjectives = $objectives;
	   }
	   else
	   {
		   $totalobjectives = '';
	   }
	   
	   $table = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_objectives" id="number_of_objectives" title="You must add objectives" data-rule-required="true">
             <option value="'.$totalobjectives.'">'.$objectives.'</option>
             </select> Objective(s)
		    </td>
        </tr>
       <tr>
         <th>Specific Objective</th>
         <th>Indicators</th>
         <th>Means of Verification</th>
         <th>Assumptions</th>
        </tr>
        </thead>
       <tbody>';
	   
	   foreach($projectobjectives as $key=>$projectobjective)
	   {
		   $indicators = $this->projectobjectiveindicatorsmodel->get_list_by_objective($projectobjective['id']);
		   $table .= '<tr><td>'.$projectobjective['objective'].'</td>';
		   $table .= '<td>';
		   $table .= '<ul>';
		   foreach($indicators as $key=>$indicator):
		   	$table .= '<li>'.$indicator['indicator'].'</li>';
		   endforeach;
		   $table .= '</ul>';
		   $table .= '</td>';
		   $table .= '<td>';
		   $table .= '<ul>';
		   foreach($indicators as $key=>$indicator):
		   	$table .= '<li>'.$indicator['means'].'</li>';
		   endforeach;
		   $table .= '</ul>';
		   $table .= '</td>';
		   $table .= '<td>';
		   $table .= '<ul>';
		   foreach($indicators as $key=>$indicator):
		   	$table .= '<li>'.$indicator['assumptions'].'</li>';
		   endforeach;
		   $table .= '</ul>';
		   $table .= '</td>';

		   $table .= '</tr>';
	   }
	   
	   $table .= '
	   </tbody>
	   </table>';
	   
	   echo $table;
   }
   
   
    function refreshobjectives()
	 {
		 $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
		 //$outputobjective_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['outputobjective_id']))));
		 
		 
		 $projectobj = $this->projectobjectivesmodel->get_by_project_list($project_id);
		 
		$projobjselect = '<select name="projectobjective_id[]" id="projectobjective_id" class="form-control">';
		foreach($projectobj as $prkey=> $projobj)
		{
			$projobjselect .= '<option value="'.$projobj['id'].'">'.$projobj['objective'].'</option>';
		}
		
		$projobjselect .= '</select>';
		
		echo $projobjselect;
		
		
	 }
	 
	 
	 
   public function outcomelogframe()
   {
	   
	  $projectobjective_id = $_POST['projectobjective_id'];
	  $project_id = $_POST['project_id'];
	  $outcomearray = $_POST['outcome'];
	  $outcomeindicatorarray = $_POST['outcomeindicator'];
	  $outcometargetarray = $_POST['outcometarget'];
	  $outcomemeansarray = $_POST['outcomemeans'];
	  $outcomeassumptionsarray = $_POST['outcomeassumptions'];
	  
	  if(empty($outcomearray[0]) || empty($outcomeindicatorarray[0])|| empty($outcometargetarray[0]) || empty($outcomemeansarray[0]) || empty($outcomeassumptionsarray[0]) ){
		  
		  echo '<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Warning!</strong> Please enter atleast one outcome, indicator and its target, means of verification and assumptions
		   </div>
		  ';
	  }
	  else
	  {
		  //add the objective
		   $data = array(
						   'project_id' => $project_id[0],
						   'objective_id' => $projectobjective_id[0],
						   'outcome' => $outcomearray[0],
					   );
		  $this->db->insert('projectoutcomes', $data);
		  $outcome_id = $this->db->insert_id();
		  
		  
		   //add indicators	   
		   foreach ($_POST['outcomeindicator'] as $row => $id) {
			   $outcomeindicator = $id;
			   $outcometarget    = $_POST['outcometarget'][$row];
			   $outcometype    = $_POST['outcometype'][$row];
			   $outcomemeans    = $_POST['outcomemeans'][$row];
			   $outcomeassumptions    = $_POST['outcomeassumptions'][$row];
				$data = array(
				   'outcomeindicator' => $outcomeindicator,
				   'outcometarget' => $outcometarget,
				   'outcometype' => $outcometype,
				   'outcomemeans' => $outcomemeans,
				   'outcomeassumptions' => $outcomeassumptions,
				   'outcome_id' => $outcome_id,				   
				   'project_id' => $project_id[0],
			   );
			   $this->db->insert('projectoutcomeindicators', $data);
		   }
		   
		   echo '<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Success!</strong> Outcome successfully added
		   </div>
		  ';
	  }
	   
	   $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($project_id[0]);
	   
	   $outcomes = count($projectoutcomes);
	   if($outcomes >0)
	   {
		   $totaloutcomes = $outcomes;
	   }
	   else
	   {
		   $totaloutcomes = '';
	   }
	   
	   $outcometable = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_outcomes" id="number_of_outcomes" title="You must add outcomes" data-rule-required="true">
             <option value="'.$totaloutcomes.'">'.$outcomes.'</option>
             </select> Outcome(s)
		    </td>
        </tr>
       <tr>
         <th>Outcome</th>
         <th>Indicators</th>
         <th>Means of Verification</th>
         <th>Assumptions</th>
        </tr>
        </thead>
       <tbody>';
	   
	   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($project_id[0]);
	   
	   foreach($projectobjectives as $key=>$projectobjective)
	   {
		   $objectiveoutcomes = $this->projectoutcomesmodel->get_by_objective_list($projectobjective['id']);
		   
		   if(!empty($objectiveoutcomes))
		   {
			   $outcometable .= '<tr><td colspan="4">'.$projectobjective['objective'].'</td>';
			   	   
			   foreach($objectiveoutcomes as $key=>$objectiveoutcome)
			   {
				   $indicators = $this->projectoutcomeindicatorsmodel->get_list_by_outcome($objectiveoutcome['id']);
				   $outcometable .= '<tr><td>'.$objectiveoutcome['outcome'].'</td>';
				   $outcometable .= '<td>';
				   $outcometable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outcometable .= '<li>'.$indicator['outcomeindicator'].'</li>';
				   endforeach;
				   $outcometable .= '</ul>';
				   $outcometable .= '</td>';
				   $outcometable .= '<td>';
				   $outcometable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outcometable .= '<li>'.$indicator['outcomemeans'].'</li>';
				   endforeach;
				   $outcometable .= '</ul>';
				   $outcometable .= '</td>';
				   $outcometable .= '<td>';
				   $outcometable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outcometable .= '<li>'.$indicator['outcomeassumptions'].'</li>';
				   endforeach;
				   $outcometable .= '</ul>';
				   $outcometable .= '</td>';
		
				   $outcometable .= '</tr>';
			   }
		   }
	   }
	   
	   $outcometable .= '
	   </tbody>
	   </table>';
	   
	   echo $outcometable;
   }
   
   
   function refreshoutcomes()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));		 
		 
		$projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($project_id);
	   	$outcomeselect = '<select name="projectoutcome_id[]" id="projectoutcome_id" class="form-control">';
		foreach($projectoutcomes as $pokey=> $projectoutcome)
		{
			$outcomeselect .= '<option value="'.$projectoutcome['id'].'">'.$projectoutcome['outcome'].'</option>';
		}
		
		$outcomeselect .= '</select>';
		
		echo $outcomeselect;
		
		
	 }
	 
	
	public function outputlogframe()
	{
	  $projectoutcome_id = $_POST['projectoutcome_id'];
	  $project_id = $_POST['project_id'];
	  $outputarray = $_POST['output'];
	  $outputindicatorarray = $_POST['outputindicator'];
	  $outputtargetarray = $_POST['outputtarget'];
	  $outputmeansarray = $_POST['outputmeans'];
	  $outputassumptionsarray = $_POST['outputassumptions'];
	  
	  if(empty($outputarray[0]) || empty($outputindicatorarray[0])|| empty($outputtargetarray[0]) || empty($outputmeansarray[0]) || empty($outputassumptionsarray[0]) ){
		  
		  echo '<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Warning!</strong> Please enter atleast one output, indicator and its target, means of verification and assumptions
		   </div>
		  ';
	  }
	  else
	  {
		  //add the output
		   $data = array(
						   'project_id' => $project_id[0],
						   'outcome_id' => $projectoutcome_id[0],
						   'output' => $outputarray[0],
					   );
		  $this->db->insert('projectoutputs', $data);
		  $output_id = $this->db->insert_id();
		  
		  
		   //add indicators	   
		   foreach ($_POST['outputindicator'] as $row => $id) {
			   $outputindicator = $id;
			   $outputtarget    = $_POST['outputtarget'][$row];
			   $outputtype    = $_POST['outputtype'][$row];
			   $outputmeans    = $_POST['outputmeans'][$row];
			   $outputassumptions    = $_POST['outputassumptions'][$row];
				$data = array(
				   'outputindicator' => $outputindicator,
				   'outputtarget' => $outputtarget,
				   'outputtype' => $outputtype,
				   'outputmeans' => $outputmeans,
				   'outputassumptions' => $outputassumptions,
				   'output_id' => $output_id,				   
				   'project_id' => $project_id[0],
			   );
			   $this->db->insert('projectoutputindicators', $data);
		   }
		   
		   echo '<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Success!</strong> Output successfully added
		   </div>
		  ';
	  }
	   
	   $projectoutputs = $this->projectoutputsmodel->get_by_project_list($project_id[0]);
	   
	   $outputs = count($projectoutputs);
	   
	   $outputs = count($projectoutputs);
	   if($outputs >0)
	   {
		   $totaloutputs = $outputs;
	   }
	   else
	   {
		   $totaloutputs = '';
	   }
	   
	   
	   $outputtable = '<table class="table table-hover table-nomargin">
	   <thead>
	    <tr>
           <td colspan="4">
		   	<select name="number_of_outcomes" id="number_of_outcomes" title="You must add outcomes" data-rule-required="true">
             <option value="'.$totaloutputs.'">'.$outputs.'</option>
             </select> Output(s)
		    </td>
        </tr>
       <tr>
         <th>Output</th>
         <th>Indicators</th>
         <th>Means of Verification</th>
         <th>Assumptions</th>
        </tr>
        </thead>
       <tbody>';
	   
	   $projectoutcomes = $this->projectoutcomesmodel->get_by_project_list($project_id[0]);
	   
	   foreach($projectoutcomes as $key=>$projectoutcome)
	   {
		   $outcomeoutputs = $this->projectoutputsmodel->get_by_outcome_list($projectoutcome['id']);
		   
		   if(!empty($outcomeoutputs))
		   {
			   $outputtable .= '<tr><td colspan="4">'.$projectoutcome['outcome'].'</td>';
			   	   
			   foreach($outcomeoutputs as $key=>$outcomeoutput)
			   {
				   $indicators = $this->projectoutputindicatorsmodel->get_list_by_output($outcomeoutput['id']);
				   $outputtable .= '<tr><td>'.$outcomeoutput['output'].'</td>';
				   $outputtable .= '<td>';
				   $outputtable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outputtable .= '<li>'.$indicator['outputindicator'].'</li>';
				   endforeach;
				   $outputtable .= '</ul>';
				   $outputtable .= '</td>';
				   $outputtable .= '<td>';
				   $outputtable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outputtable .= '<li>'.$indicator['outputmeans'].'</li>';
				   endforeach;
				   $outputtable .= '</ul>';
				   $outputtable .= '</td>';
				   $outputtable .= '<td>';
				   $outputtable .= '<ul>';
				   foreach($indicators as $key=>$indicator):
					$outputtable .= '<li>'.$indicator['outputassumptions'].'</li>';
				   endforeach;
				   $outputtable .= '</ul>';
				   $outputtable .= '</td>';
		
				   $outputtable .= '</tr>';
			   }
		   }
	   }
	   
	   $outputtable .= '
	   </tbody>
	   </table>';
	   
	   echo $outputtable;
	}
	
	
   function refreshoutputs()
   {
	   $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));		 
		 
		$projectoutputs = $this->projectoutputsmodel->get_by_project_list($project_id);
	   	$outputselect = '<select name="projectoutput_id" id="projectoutput_id" class="form-control">';
		foreach($projectoutputs as $pukey=> $projectoutput)
		{
			$outputselect .= '<option value="'.$projectoutput['id'].'">'.$projectoutput['output'].'</option>';
		}
		
		$outputselect .= '</select>';
		
		echo $outputselect;
		
		
	 }
	 
	 function addactivity()
	 {
		 $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
		 $projectoutput_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['projectoutput_id']))));
		 $activity = trim(addslashes(htmlspecialchars(rawurldecode($_POST['activity']))));
		 $resources = trim(addslashes(htmlspecialchars(rawurldecode($_POST['resources']))));
		 $cost = trim(addslashes(htmlspecialchars(rawurldecode($_POST['cost']))));
		 $activityassumptions = trim(addslashes(htmlspecialchars(rawurldecode($_POST['activityassumptions']))));
		 
		 if(empty($projectoutput_id) || empty($activity)|| empty($resources) || empty($cost) || empty($activityassumptions) ){
		  
			  echo '<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Warning!</strong> Please enter all the required information to save the activity
			   </div>
			  ';
		  }
		  else
		  {
			 $data = array(
					   'project_id' => $project_id,
					   'projectoutput_id' => $projectoutput_id,
					   'activity' => $activity,
					   'resources' => $resources,
					   'cost' => $cost,
					   'activityassumptions' => $activityassumptions
				   );
				   
			$this->db->insert('projectplannedactivities', $data);
			
			 echo '<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Activity successfully added
			   </div>
			  ';
		  }
		  
	   $plannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
	   $activities = count($plannedactivities);
	   if($activities >0)
	   {
		   $totalactivities = $activities;
	   }
	   else
	   {
		   $totalactivities = '';
	   }
		
		$activitytable = '<table class="table table-hover table-nomargin">
		   <thead>
			<tr>
			   <td colspan="4">
				<select name="number_of_activities" id="number_of_activities" title="You must add activities" data-rule-required="true">
				 <option value="'.$totalactivities.'">'.$activities.'</option>
				 </select> Activities
				</td>
			</tr>
		   <tr>
			 <th>Activity</th>
			 <th>Input/Resources</th>
			 <th>Cost &amp; Sources</th>
			 <th>Assumptions</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($plannedactivities as $plankey=>$plannedactivity):
		   
		   $activitytable .= '<tr><td>'.$plannedactivity['activity'].'</td><td>'.$plannedactivity['resources'].'</td><td>'.$plannedactivity['cost'].'</td><td>'.$plannedactivity['activityassumptions'].'</td></tr>';
		   endforeach;
		   
		 $activitytable .= '
		   </tbody>
		   </table>';
		   
		 echo $activitytable;
	 }
	 
	 function addbeneficiary()
	 {
		 $project_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['project_id']))));
		 $beneficiary_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['beneficiary_id']))));
		 $beneficiary_target = trim(addslashes(htmlspecialchars(rawurldecode($_POST['beneficiary_target']))));
		 
		 if(empty($beneficiary_target)){
		  
			  echo '<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Warning!</strong> Please enter all the required information to save the beneficiary
			   </div>
			  ';
		  }
		  else
		  {
			 $data = array(
						   'project_id' => $project_id,
						   'beneficiary_id' => $beneficiary_id,
						   'target' => $beneficiary_target,
					   );
					   
			$this->db->insert('projectbeneficiaries', $data);
			
			echo '<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Beneficiary successfully added
			   </div>
			  ';
		  }
		$beneficiaries = $this->projectbeneficiariesmodel->get_by_project_list($project_id);
		
		$beneficiarytable = '<table class="table table-hover table-nomargin">
		   <thead>			
		   <tr>
			 <th>Beneficiary</th>	
			 <th>Target</th>		 
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($beneficiaries as $bkey=>$beneficiary)
		   {
			   $beneficiarytype = $this->beneficiarytypesmodel->get_by_id($beneficiary['beneficiary_id'])->row();
			   $beneficiarytable .= '<tr><td>'.$beneficiarytype->beneficiary_type.'</td><td>'.$beneficiary['target'].'</td></tr>';
		   }
		   
		   $beneficiarytable .= '
		   </tbody>
		   </table>';
		   
		 echo $beneficiarytable;
	 }
	 
	 function upload()
	 {
		 $file_element_name = 'userImage';
		 $config['upload_path'] = './documents/';
		 $config['overwrite'] = 'TRUE';
		 $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|xls|docx|xlsx|ppt|pptx';
		 $this->load->library('upload', $config);
		   
		 if (!$this->upload->do_upload($file_element_name))
		 {
			$error = array('error' => $this->upload->display_errors());
			foreach($error as $key=>$err)
			{
			  echo '<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Warning!</strong> '.$err.'
			   </div>
			  ';	
			}
		 }
		 else
		 {
			$user_id = $this->erkanaauth->getField('id');
			$filedata = $this->upload->data();
			$project_id = $this->input->post('project_id');
				
			 $data = array(
				   'document_title' => $this->input->post('document_title'),
				   'description' => $this->input->post('description'),
				   'file_name' => $filedata['file_name'],
				   'file_type' => $filedata['file_type'],
				   'file_size' => $filedata['file_size'],
				   'documentcategory_id' => $this->input->post('documentcategory_id'),
				   'date_added' => date('Y-m-d'),
				   'author' => '',
				   'year_published' => date('Y'),
				   'user_id' => $user_id,
				   'project_id' => $this->input->post('project_id'),
				   'published' => 1,
				   'tags' => $this->input->post('tags'),
				   'public' => 0,
			   );
			   $this->db->insert('documents', $data);
			
			
			echo '<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Document successfully added
			   </div>
			  ';
		 }
		 
		 $documents = $this->documentsmodel->get_list_by_project($project_id);
		 
		 $documentstable = '<table class="table table-hover table-nomargin">
		   <thead>
			
		   <tr>
			 <th>Document Title</th>
			 <th>Document Category</th>
			 <th>Date Added</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($documents as $key=>$document)
		   {
			  $category = $this->documentcategoriesmodel->get_by_id($document['documentcategory_id'])->row();
			  $documentstable .= '<tr><td>'.$document['document_title'].'</td><td>'.$category->category.'</td><td>'.$document['date_added'].'</td></tr>'; 
		   }
		   
		    $documentstable .= '
		   </tbody>
		   </table>';
		   
		   echo $documentstable;
		 
		 
	 }
	 
	 public function detail($id)
	 {
		 if (!$this->erkanaauth->try_session_login()) {
			redirect('login','refresh');
		   }
		   if(!is_numeric($id)) {
			redirect('home','refresh');
		   }
		   $row = $this->db->get_where('projects', array('id' => $id))->row();
		   if(empty($row)) {
			redirect('home','refresh');
		   }
		   $data = array(
			   'row' => $row,
		   );
		   
		   $documents = $this->documentsmodel->get_list_by_project($row->id);
		 
		 $documentstable = '<table class="table table-hover table-nomargin">
		   <thead>
			
		   <tr>
			 <th>Document Title</th>
			 <th>Document Category</th>
			 <th class=\'hidden-350\'>Date Added</th>
			 <th class=\'hidden-350\'>&nbsp;</th>
			</tr>
			</thead>
		   <tbody>';
		   
		   foreach($documents as $key=>$document)
		   {
			  $category = $this->documentcategoriesmodel->get_by_id($document['documentcategory_id'])->row();
			  $documentstable .= '<tr><td><a href="'.base_url().'documents/'.$document['file_name'].'" target="_blank">'.$document['document_title'].'</a></td><td>'.$category->category.'</td><td>'.$document['date_added'].'				</td>
			  <td class=\'hidden-350\'><a href="'.base_url().'documents/view/'.$document['id'].'" class="btn" rel="tooltip" title="View">
             <i class="fa fa-search"></i>
              </a>
              <a href="'.base_url().'documents/'.$document['file_name'].'" class="btn" rel="tooltip" title="Download" target="_blank">
              <i class="fa fa-arrow-circle-down"></i>
              </a>
              </td>
			  </tr>'; 
		   }
		   
		    $documentstable .= '
		   </tbody>
		   </table>';
		   
		   $logframe = '<table class="table table-hover table-nomargin table-bordered">';
		   $logframe .= '<thead>';
		   $logframe .= '<tr>';
		   $logframe .= '<th>OBJECTIVES</th><th>INDICATORS</th><th>MEANS OF VERIFICATION</th><th>RISKS/ASSUMPTIONS</th></tr>';
		   $logframe .= '</tr>';
		   $logframe .= '</thead>';
		   
		   $projectobjectives = $this->projectobjectivesmodel->get_by_project_list($row->id);
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
		   
		   /*PROJECT MAP*/
		   $county_id = 0;
	   $organization_id = 0;
	   $sector_id = 0;
	   $donor_id = 0;
	   $status = 0;
	   $points = array();
	  	   
	   			$coordinates = $this->mapsmodel->get_by_project($id);
				foreach($coordinates as $ckey=>$coordinate):
						$county = $this->countiesmodel->get_by_id($coordinate->county_id)->row();
						$project = $this->projectsmodel->get_by_id($id)->row();
						$projectsector = $this->projectsectorsmodel->get_by_project($id)->row();
						$sector = $this->sectorsmodel->get_by_id($projectsector->sector_id)->row();
						$status = $this->projectactivitystatusmodel->get_by_id($project->projectactivitystatus_id)->row();
						$gps['lat'] = $county->lat;
						$gps['lng'] = $county->long;
						$mapdata['position'] = $gps;
						
					   $mapdata['icon'] = ''.base_url().'img/other.png';
					   
					   $project_donor = '';
					   $projectdonors = $this->projectdonorsmodel->get_list_by_project($project->id);
					   foreach($projectdonors as $key=>$projectdonor):
							$donor = $this->donorsmodel->get_by_id($projectdonor['donor_id'])->row();
							$project_donor .= $donor->donor_name.',';
						endforeach;
						
					  $thesectors = $this->sectorsmodel->get_list();
					  $sectorlist = '';
					  foreach($thesectors as $key=>$thesector)
					  {
							$projectsector = $this->projectsectorsmodel->get_by_sector_project($project->id,$thesector['id'])->row();
														
							if(empty($projectsector))
							{
								$sectorselected = '';
							}
							else
							{
								$sectorlist .= $thesector['sector'].',';
							}
														
						}
					   
					   $mapdata['info'] = '
					   County: '.$county->county.'<br>
					   Project: '.$project->project_title.'<br>
					   Project No.: '.$project->project_no.'<br>
					   Objective: '.$project->project_objective.'<br>					  
					   Project Start: '.date("d F Y",strtotime($project->project_start_date)).'<br>
					   Project End: '.date("d F Y",strtotime($project->project_end_date)).'<br>
					   Donor: '.$project_donor.'<br>
					   Budget: '.$project->currency.' '.$project->project_budget.'<br>
					   Sector(s): '.$sectorlist.'<br> 
					   Status: '.$status->status.'<br>
					   ';
					   
					   $points[] = $mapdata;
					
					endforeach;
		
			
			
		   $data['points'] = $points;		   
		   $data['logframe'] = $logframe;
		   $data['documentstable'] = $documentstable;
		   $data['donors'] = $this->donorsmodel->get_list();
		   $data['counties'] = $this->countiesmodel->get_list();
		   $data['currencies'] = $this->currenciesmodel->get_list();
		   $data['sectors'] = $this->sectorsmodel->get_list();
		   $data['partners'] = $this->partnersmodel->get_list();
		   $data['status'] = $this->projectactivitystatusmodel->get_list();
		   $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
		   $data['documentcategories'] = $this->documentcategoriesmodel->get_list();
		   
		   $this->load->view('projects/detail', $data);
	 }
	 
	 public function graphical($id)
   {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array();
	   
	   $data['objectives'] = $this->projectobjectivesmodel->get_by_project_list($id);
	   $data['project'] = $this->projectsmodel->get_by_id($id)->row();
	   
	   $this->load->view('projects/graphical', $data);
   }
   
   public function downloadlogicalframework($id)
   {
	    $filename = "LogicalFramework".date('dmY-his').".doc";
		
		//$this->output->set_header("Content-Type: application/xml; charset=UTF-8");
		$this->output->set_header("Content-Type: application/vnd.ms-word");
		$this->output->set_header("Expires: 0");
		$this->output->set_header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header("content-disposition: attachment;filename=$filename");
		
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
       if(!is_numeric($id)) {
       	redirect('home','refresh');
       }
       $project = $this->projectsmodel->get_by_id($id)->row();
	   
	   if(empty($project)) {
       	redirect('home','refresh');
       }
	   
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
		   
		   
		   $this->output->append_output($logframe);
	   
	   
   }

	 

}
