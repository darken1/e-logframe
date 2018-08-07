<?php

/**
DO NOT REMOVE THIS NOTICE FROM THE CODE
 This code belongs to Joash Gomba (The developer).
The code cannot be reproduced without the express written permission of the developer.
The code can only be changed, enhanced or modified for the sole purpose of adding features or customizing the eLogFrame system.
Contravention of any of the above stated rules will constitute a violation of copyright laws.
**/
class Reports extends CI_Controller {

   function __construct()
   {
       parent::__construct();
   }

   public function index()
   {
       if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array(
           'rows' => $this->db->get('sectors'),
       );
	   
	   $data['error'] = '';
       
       $this->load->view('reports/beneficiariesbysector', $data);
   }
   
   public function benficiariesbysectorreport()
   {
	   
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array();
	   
	   $from_year = $this->input->post('from_year');
	   $from_month = $this->input->post('from_month');
	   $to_year = $this->input->post('to_year');
	   $to_month = $this->input->post('to_month');	   
	   $sector_id = $this->input->post('sector_id');
	   
	  $sector = $this->sectorsmodel->get_by_id($sector_id)->row();
	  
	  $start = $from_year.'-'.$from_month.'-01';
	   
	   if($to_month==02)
	   {
		   $to_date = '28';
	   }
	   else
	   {
		   $to_date = '30';
	   }
	   $end = $to_year.'-'.$to_month.'-'.$to_date;
	   
	   $begin_year = $from_year.'-01-01';
	   $end_year = $from_year.'-12-31';
	   
	   $diversities = $this->db->get('beneficiarytypes');
	   
	   $categories = '';
	   $beneficiarynumbers = '';
	   $piedata = '';
	   $reachednumbers = '';
	   $reachedpiedata = '';
	   $percentagedata = '';
	   $reachedpercentagedata = '';
	   
	   $total_by_sector = $this->reportsmodel->get_by_sector($sector_id,$start,$end);
	   
	    $numberstable = '<table id="customers"><thead>';
	   
	   $numberstable .= '<tr><th>Beneficiary</th><th>Reached</th><th>Percentage</th><th>No. of Projects</th></tr>';
	   $numberstable .= '</thead><tbody>';
	   
	   $beneficiaries = $this->db->get('beneficiarytypes');
	   $class = 'class="alt"';
	   
	   $total_reviewed = 0;
	   $totalprojects = 0;
	   $piedata = '';
	   $beneficiarynumbers = '';
	   $categories = '';
	   $series = '';
	   
	   $total_by_sector = $this->reportsmodel->get_by_sector($sector_id,$start,$end);
	   
	   foreach ($beneficiaries->result() as $beneficiary):
	   
		   if($class == 'class="alt"')
		   {
				$class = '';
		   }
		   else
		   {
			   $class = 'class="alt"';
		   }
		   
		   $projects = $this->reportsmodel->get_by_sector_beneficiary($sector_id,$beneficiary->id,$start,$end);
		   $allprojects = $this->reportsmodel->get_by_sector_beneficiary_total($sector_id,$beneficiary->id,$start,$end);
		   
		   $total = count($allprojects);
					 
		 $total = count($allprojects);
		   
		   if($total_by_sector==0)
			{
				$percentage = 0;
			}
			else
			{
			 
			 $percentage = ($projects/$total_by_sector)*100;
			 $piedata .= "['".$beneficiary->beneficiary_type."',   ".number_format($percentage,1)."],";
			
				$categories .= "'".$beneficiary->beneficiary_type."',";
				$beneficiarynumbers .= $projects.',';
			}
			
			 //for the line graph			 
			 $jandata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,1,$begin_year,$end_year);
			 $febdata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,2,$begin_year,$end_year);
			 $mardata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,3,$begin_year,$end_year);
			 $aprdata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,4,$begin_year,$end_year);
			 $maydata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,5,$begin_year,$end_year);
			 $jundata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,6,$begin_year,$end_year);
			 $juldata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,7,$begin_year,$end_year);
			 $augdata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,8,$begin_year,$end_year);
			 $septdata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,9,$begin_year,$end_year);
			 $octdata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,10,$begin_year,$end_year);
			 $novdata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,11,$begin_year,$end_year);
			 $decdata = $this->reportsmodel->get_diversity_by_review_month($sector_id,$beneficiary->id,12,$begin_year,$end_year);
			
			
					 $series .= "{
                name: '".$beneficiary->beneficiary_type."',
                data: [".$jandata.", ".$febdata.", ".$mardata.", ".$aprdata.", ".$maydata.", ".$jundata.", ".$juldata.", ".$augdata.", ".$septdata.", ".$octdata.", ".$novdata.", ".$decdata."]
            },";
			
			
			
			
			$totalprojects = $total+$totalprojects;
		   
		   $numberstable .= '<tr '.$class.'><td>'.$beneficiary->beneficiary_type.'</td><td>'.$projects.'</td><td>'.number_format($percentage,2).'%</td><td>'.$total.'</td></tr>';
	   
	   endforeach;
	   
	   $numberstable .= '<tr><td><strong>Total</strong></td><td colspan="2"><strong>'.$total_by_sector.'</strong></td><td><strong>'.$totalprojects.'</strong></td></tr>';
	   $numberstable .= '</tbody></table>';
	   
	   $reporttitle = 'Report on beneficiaries by '.$sector->sector.' sector from '.$from_year.'/'.$from_month.' to '.$to_year.'/'.$to_month.' as of '.date('Y-m-d');
	   
	   $data['sector'] = $sector;
	   $data['from_year'] = $from_year;
	   $data['from_month'] = $from_month;
	   $data['to_year'] = $to_year;
	   $data['to_month'] = $to_month;
	   $data['piedata'] = $piedata;
	   $data['categories'] = $categories;
	   $data['beneficiarynumbers'] = $beneficiarynumbers;
	   $data['series'] = $series;
	   $data['sector_id'] = $sector_id;
	   $data['reporttitle'] = $reporttitle;
	   $data['numberstable'] = $numberstable;
	   

	   
	  $this->load->view('reports/beneficiariesbysectorreport', $data);
	   
	   
	   
   }
   
   public function savereport()
   {
	   $user_id = $this->erkanaauth->getField('id');   
	   $data = array(
	   		   'reporttitle' => $this->input->post('reporttitle'),
               'searchparameter' => $this->input->post('searchparameter'),
               'searchvalue' => $this->input->post('searchvalue'),
               'from_year' => $this->input->post('from_year'),
               'from_month' => $this->input->post('from_month'),
               'to_year' => $this->input->post('to_year'),
               'to_month' => $this->input->post('to_month'),
               'reportmethod' => $this->input->post('reportmethod'),
               'user_id' => $user_id ,
			   'date_saved' => date('Y-m-d'),
           );
           $this->db->insert('savedreports', $data);
		   redirect('savedreports','refresh');
   }
   
   
   function projectsbysector()
	{
		if (!$this->erkanaauth->try_session_login()) {

    		redirect('login','refresh');

  	 	}
		
		$data = array();
		
		$this->load->view('reports/projectsbysector', $data);
	 
	 
	}
	
	function projectsbysectorreport()
	{
		if (!$this->erkanaauth->try_session_login()) {

    		redirect('login','refresh');

  	 	}
		$from_year = $this->input->post('from_year');
		 $from_month = $this->input->post('from_month');
		 $to_year = $this->input->post('to_year');
		 $to_month = $this->input->post('to_month');
		
		 $start = $from_year.'-'.$from_month.'-01';
			   
			   if($to_month==02)
			   {
				   $to_date = '28';
			   }
			   else
			   {
				   $to_date = '30';
			   }
			   $end = $to_year.'-'.$to_month.'-'.$to_date;
		$begin_year = $from_year.'-01-01';
	   $end_year = $from_year.'-12-31';
	   
	   $sectors = $this->sectorsmodel->get_list();
	   $piedata = '';
	   
	    $numberstable = '<table id="customers"><thead>';
	   
	   $numberstable .= '<tr><th>Sector</th><th>No. of Projects</th></tr>';
	   $numberstable .= '</thead><tbody>';
	   
	   
	   foreach($sectors as $key=>$sector)
	   {
		   $results = $this->reportsmodel->get_projects_by_sector($start,$end,$sector['id']);
		   $sector_total = count($results);
		   if($sector_total==0)
		   {
			   /// do not display on chart
		   }
		   else
		   {
			   $piedata .= "['".$sector['sector']."',     ".$sector_total."],";
			   
			   $numberstable .= '<tr><td>'.$sector['sector'].'</td><td>'.$sector_total.'</td></tr>';
		   }
	   }
	   
	   
	   $numberstable .= '</tbody></table>';
	   
	    $reporttitle = 'Report on projects by sector from '.$from_year.'/'.$from_month.' to '.$to_year.'/'.$to_month.' as of '.date('Y-m-d');
	   
	   $data['numberstable'] = $numberstable;
	   $data['piedata'] = $piedata;
	   $data['from_year'] = $from_year;
	   $data['from_month'] = $from_month;
	   $data['to_year'] = $to_year;
	   $data['to_month'] = $to_month;
	   $data['reporttitle'] = $reporttitle;
	   
	   
	   $this->load->view('reports/projectsbysectorreport', $data);
	   
	   
	}
	
	public function projectsbydonors()
	{
		
		if (!$this->erkanaauth->try_session_login()) {

    		redirect('login','refresh');

  	 	}
		
		$data = array();
		
		$data['donors'] = $this->donorsmodel->get_list();
		
		$this->load->view('reports/projectsbydonors', $data);
	}
	
	public function projectsbydonorsreport()
	{
		
		if (!$this->erkanaauth->try_session_login()) {

    		redirect('login','refresh');

  	 	}
		$from_year = $this->input->post('from_year');
		 $from_month = $this->input->post('from_month');
		 $to_year = $this->input->post('to_year');
		 $to_month = $this->input->post('to_month');
		 		
		 $start = $from_year.'-'.$from_month.'-01';
			   
			   if($to_month==02)
			   {
				   $to_date = '28';
			   }
			   else
			   {
				   $to_date = '30';
			   }
			   $end = $to_year.'-'.$to_month.'-'.$to_date;
		 $begin_year = $from_year.'-01-01';
	     $end_year = $from_year.'-12-31';
		 
		 $donors = $this->donorsmodel->get_list();
	   $piedata = '';
	   
	    $numberstable = '<table id="customers"><thead>';
	   
	   $numberstable .= '<tr><th>Donor</th><th>No. of Projects</th></tr>';
	   $numberstable .= '</thead><tbody>';
	   
	   
	   foreach($donors as $key=>$donor)
	   {
		   $results = $this->reportsmodel->get_projects_by_donor($start,$end,$donor['id']);
		   $donor_total = count($results);
		   if($donor_total==0)
		   {
			   /// do not display on chart
		   }
		   else
		   {
			   $piedata .= "['".$donor['donor_name']."',     ".$donor_total."],";
			   
			   $numberstable .= '<tr><td>'.$donor['donor_name'].'</td><td>'.$donor_total.'</td></tr>';
		   }
	   }
	   
	   
	   $numberstable .= '</tbody></table>';
	   
	   $reporttitle = 'Report on projects by donor from '.$from_year.'/'.$from_month.' to '.$to_year.'/'.$to_month.' as of '.date('Y-m-d');
	   
	   $data['numberstable'] = $numberstable;
	   $data['piedata'] = $piedata;
	   $data['from_year'] = $from_year;
	   $data['from_month'] = $from_month;
	   $data['to_year'] = $to_year;
	   $data['to_month'] = $to_month;
	   $data['reporttitle'] = $reporttitle;
	   	   
	   
	   $this->load->view('reports/projectsbydonorsreport', $data);
	}
	

   

}
