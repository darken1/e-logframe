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
	   
	   $data['organizations'] = $this->db->get('organizations');
	   
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
	   
	   $numberstable .= '<tr><th>Beneficiary</th><th>Reached</th><th>Percentage</th><th>No. of Activities</th></tr>';
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
	   
	   $numberstable .= '<tr><th>Sector</th><th>No. of Activities</th></tr>';
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

  
  public function beneficirybyregion()
  {
	  if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array(
           'rows' => $this->db->get('counties'),
       );
	   
	   $data['error'] = '';
       
       $this->load->view('reports/beneficirybyregion', $data);
  }
  
  
  public function benficiariesregionreport()
  {
	  
	  if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array();
	  $county_id = $this->input->post('county_id');
	  $start_date = $this->input->post('start_date');
	  $end_date = $this->input->post('end_date');
	  
	  if(empty($start_date))
	  {
		  $from_year = $this->input->post('from_year');
		   $from_month = $this->input->post('from_month');
		   $to_year = $this->input->post('to_year');
		   $to_month = $this->input->post('to_month');	
		   		  
		  $start_date = $from_year.'-'.$from_month.'-01';
		   
		   if($to_month==02)
		   {
			   $to_date = '28';
		   }
		   else
		   {
			   $to_date = '30';
		   }
		   $end_date = $to_year.'-'.$to_month.'-'.$to_date;
		   
		   $begin_year = $from_year.'-01-01';
		   $end_year = $from_year.'-12-31';
		   
		    $reportyear = $from_year;
	  }
	  else
	  {
	  
	  
		  $reportyear =  date('Y', strtotime($start_date));	  
		  
		  $from_year = $reportyear;
		  $from_month = date('m', strtotime($start_date));
		  
		  $to_year = date('Y', strtotime($end_date));
		  $to_month = date('m', strtotime($end_date));
		  
		  $begin_year = $reportyear.'-01-01';
	   	  $end_year = $reportyear.'-12-31';
	  
	  }
	  
	   
	   
	  
	  $county = $this->countiesmodel->get_by_id($county_id)->row();
	  
	   $beneficiaries = $this->db->get('beneficiarytypes');
	   $beneficiarysubcategories = $this->db->get('beneficiarysubcategories');
	   
	   
	   /******BENEFICIARIES******/
	   
	   
	   $countydistricts = $this->districtsmodel->get_by_county($county_id);
	   
	   $district_columns = '';
	   
	   foreach($countydistricts as $key=>$countydistrict)
	   {
		   $district_columns .= '<th>'.$countydistrict['district'].'</th>';
	   }
	   
	   $disttable = '<table id="datatable" width="100%"><thead>';
	   
	   $disttable .= '<tr><th></th>';
	   $disttable .= $district_columns;
	   $disttable .= '</tr>';
	   $disttable .= '</thead><tbody>';
	   	   
	   foreach ($beneficiaries->result() as $beneficiary):
	   
		   $disttable .= '<tr><th>'.$beneficiary->beneficiary_type.'</th>';
		   foreach($countydistricts as $key=>$countydistrict)
		   {
			   $district_beneficiary_no = $this->reportsmodel->get_activities_by_district_beneficiary($countydistrict['id'],$start_date,$end_date,$beneficiary->id);
			   $disttable .= '<td>'.$district_beneficiary_no.'</td>';
		   }
		   
		   $disttable .= '<tr>';
	   
	   endforeach;
	   
	   
	   $disttable .= '</tbody></table>';
	   
	   $total_in_region = 0;
	   $series = '';
	   
	     
	   
	    foreach ($beneficiaries->result() as $beneficiary):
		 $beneficiary_reach = $this->reportsmodel->get_activities_by_region_beneficiary($county_id,$start_date,$end_date,$beneficiary->id);
		 
		 $total_in_region = $total_in_region + $beneficiary_reach;
		
		endforeach;
	
	   $numberstable = '<table id="customers"><thead>';
	   
	   $numberstable .= '<tr><th>Beneficiary</th><th>Reached</th><th>Percentage</th><th>No. of Activities</th></tr>';
	   $numberstable .= '</thead><tbody>';
	   
	   $beneficiarydata = '';
	   
	   foreach ($beneficiaries->result() as $beneficiary):
	   
	   	$beneficiary_no = $this->reportsmodel->get_activities_by_region_beneficiary($county_id,$start_date,$end_date,$beneficiary->id);
		$activities = $this->reportsmodel->count_activities_by_region_beneficiary($county_id,$start_date,$end_date,$beneficiary->id);
		if($beneficiary_no==0)
		{
			$percentage = 0;
		}
		else
		{
		 $percentage = ($beneficiary_no/$total_in_region)*100;
		 $beneficiarydata .= "['".$beneficiary->beneficiary_type."',     ".$beneficiary_no."],";
		}
		
		
		 //for the line graph			 
			 $jandata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,1,$begin_year,$end_year);
			 $febdata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,2,$begin_year,$end_year);
			 $mardata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,3,$begin_year,$end_year);
			 $aprdata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,4,$begin_year,$end_year);
			 $maydata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,5,$begin_year,$end_year);
			 $jundata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,6,$begin_year,$end_year);
			 $juldata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,7,$begin_year,$end_year);
			 $augdata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,8,$begin_year,$end_year);
			 $septdata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,9,$begin_year,$end_year);
			 $octdata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,10,$begin_year,$end_year);
			 $novdata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,11,$begin_year,$end_year);
			 $decdata = $this->reportsmodel->get_diversity_by_region_review_month($county_id,$beneficiary->id,12,$begin_year,$end_year);
			
		
			
			  $series .= "{
                name: '".$beneficiary->beneficiary_type."',
                data: [".$jandata.", ".$febdata.", ".$mardata.", ".$aprdata.", ".$maydata.", ".$jundata.", ".$juldata.", ".$augdata.", ".$septdata.", ".$octdata.", ".$novdata.", ".$decdata."]
            },";
	   
	   	$numberstable .= '<tr><td>'.$beneficiary->beneficiary_type.'</td><td>'.$beneficiary_no.'</td><td>'.number_format($percentage).'%</td><td>'.$activities.'</td></tr>';
		
	   endforeach;
	   
	   $numberstable .= '<tr><td><strong>TOTAL:</strong></td><td><strong>'.$total_in_region.'</strong></td><td></td><td></td></tr>';
	   $numberstable .= '</tbody></table>';
	   
	   
	   
	   /**BENEFICICIARY SUBCATEGORIES**/
	   
	   $total_in_the_region = 0;
	   
	    foreach ($beneficiarysubcategories->result() as $beneficiarysubcategory):
		 $the_beneficiary_reach = $this->reportsmodel->get_activities_by_region_beneficiary_subcategory($county_id,$start_date,$end_date,$beneficiarysubcategory->id);
		 
		 $total_in_the_region = $total_in_the_region + $the_beneficiary_reach;
		
		endforeach;
		
		
		
		$sub_district_columns = '';
	   
	   foreach($countydistricts as $key=>$countydistrict)
	   {
		   $sub_district_columns .= '<th>'.$countydistrict['district'].'</th>';
	   }
	   
	   $subdisttable = '<table id="mytable" width="100%"><thead>';
	   
	   $subdisttable .= '<tr><th></th>';
	   $subdisttable .= $sub_district_columns;
	   $subdisttable .= '</tr>';
	   $subdisttable .= '</thead><tbody>';
	   	   
	   foreach ($beneficiarysubcategories->result() as $beneficiarysubcategory):
	   
		   $subdisttable .= '<tr><th>'.$beneficiarysubcategory->beneficiary_category.'</th>';
		   foreach($countydistricts as $key=>$countydistrict)
		   {
			   $district_beneficiary_reach = $this->reportsmodel->get_activities_by_district_beneficiary_subcategory($countydistrict['id'],$start_date,$end_date,$beneficiarysubcategory->id);
			   $subdisttable .= '<td>'.$district_beneficiary_reach.'</td>';
		   }
		   
		   $subdisttable .= '<tr>';
	   
	   endforeach;
	   
	   
	   $subdisttable .= '</tbody></table>';
	   
	   	   
	   $table = '<table id="customers"><thead>';
	    $table .= '<tr><th colspan="4">Beneficiary sub categories</th></tr>';
	   $table .= '<tr><th>Beneficiary</th><th>Reached</th><th>Percentage</th><th>No. of Activities</th></tr>';
	   $table .= '</thead><tbody>';
	   
	   $piedata = '';
	   $subseries = '';
	   
	   foreach ($beneficiarysubcategories->result() as $beneficiarysubcategory):
	   
	    $the_beneficiary_reach = $this->reportsmodel->get_activities_by_region_beneficiary_subcategory($county_id,$start_date,$end_date,$beneficiarysubcategory->id);
		 $activity_reach = $this->reportsmodel->count_activities_by_region_beneficiary_subcategory($county_id,$start_date,$end_date,$beneficiarysubcategory->id);
		 
		 $sql = $this->reportsmodel->test_get_activities_by_region_beneficiary_subcategory($county_id,$start_date,$end_date,$beneficiarysubcategory->id);
		 
		
		 
		 
		 if($the_beneficiary_reach==0)
		 {
			 $the_percentage = 0;
		 }
		 else
		 {
			 $the_percentage = ($the_beneficiary_reach/$total_in_the_region)*100;
		 }
		 
		 if($the_beneficiary_reach==0)
		   {
			   /// do not display on chart
		   }
		   else
		   {
			   
			   $piedata .= "['".$beneficiarysubcategory->beneficiary_category."',     ".$the_beneficiary_reach."],";
		   }
		   
		   
		    //for the line graph			 
			 $jandata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,1,$begin_year,$end_year);
			 $febdata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,2,$begin_year,$end_year);
			 $mardata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,3,$begin_year,$end_year);
			 $aprdata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,4,$begin_year,$end_year);
			 $maydata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,5,$begin_year,$end_year);
			 $jundata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,6,$begin_year,$end_year);
			 $juldata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,7,$begin_year,$end_year);
			 $augdata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,8,$begin_year,$end_year);
			 $septdata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,9,$begin_year,$end_year);
			 $octdata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,10,$begin_year,$end_year);
			 $novdata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,11,$begin_year,$end_year);
			 $decdata = $this->reportsmodel->get_category_by_region_review_month($county_id,$beneficiarysubcategory->id,12,$begin_year,$end_year);
			
		
			
			  $subseries .= "{
                name: '".$beneficiarysubcategory->beneficiary_category."',
                data: [".$jandata.", ".$febdata.", ".$mardata.", ".$aprdata.", ".$maydata.", ".$jundata.", ".$juldata.", ".$augdata.", ".$septdata.", ".$octdata.", ".$novdata.", ".$decdata."]
            },";


	   
	   	$table .= '<tr><td>'.$beneficiarysubcategory->beneficiary_category.'</td><td>'.$the_beneficiary_reach.'</td><td>'.number_format($the_percentage).'%</td><td>'.$activity_reach.'</td></tr>';
	   endforeach;
	   
	   $table .= '<tr><td><strong>TOTAL:</strong></td><td><strong>'.$total_in_the_region.'</strong></td><td></td><td></td></tr>';
	   
	   $table .= '</tbody></table>';
	  
	  
	  $reporttitle = 'BENEFICIARIES REACHED IN '.$county->county.' FROM '.date("d F Y",strtotime($start_date)).' TO '.date("d F Y",strtotime($end_date));
	  
	  $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	  $data['beneficiarysubcategories'] = $this->beneficiarysubcategoriesmodel->get_list();	  
	  $data['districts'] = $this->districtsmodel->get_by_county($county_id);
	  $data['start_date'] = $start_date;
	  $data['end_date'] = $end_date;
	  $data['county_id'] = $county_id;
	  $data['reporttitle'] = $reporttitle;
	  $data['county'] = $county->county;
	  $data['numberstable'] = $numberstable;
	  $data['table'] = $table;
	  $data['piedata'] = $piedata;
	  $data['beneficiarydata'] = $beneficiarydata;
	  $data['series'] = $series;
	  $data['reportyear'] = $reportyear;
	  $data['subseries'] = $subseries;
	  $data['disttable'] = $disttable;
	  $data['subdisttable'] = $subdisttable;
	    $data['from_year'] = $from_year;
	   $data['from_month'] = $from_month;
	   $data['to_year'] = $to_year;
	   $data['to_month'] = $to_month;
	  
	  
	  
	  
	  $this->load->view('reports/benficiariesregionreport', $data);
	  
	  
  }
  
  
  
   public function beneficirybyproject()
  {
	  if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array(
           'rows' => $this->db->get('projects'),
       );
	   
	   $data['error'] = '';
	   $data['organizations'] = $this->db->get('organizations');
       
       $this->load->view('reports/beneficirybyproject', $data);
  }
  
  public function benficiariesprojectreport()
  {
	   if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	  $data = array();
	  $project_id = $this->input->post('project_id');
	  $start_date = $this->input->post('start_date');
	  $end_date = $this->input->post('end_date');
	  
	  if(empty($start_date))
	  {
		  $from_year = $this->input->post('from_year');
		   $from_month = $this->input->post('from_month');
		   $to_year = $this->input->post('to_year');
		   $to_month = $this->input->post('to_month');	
		   		  
		  $start_date = $from_year.'-'.$from_month.'-01';
		   
		   if($to_month==02)
		   {
			   $to_date = '28';
		   }
		   else
		   {
			   $to_date = '30';
		   }
		   $end_date = $to_year.'-'.$to_month.'-'.$to_date;
		   
		   $begin_year = $from_year.'-01-01';
		   $end_year = $from_year.'-12-31';
		   
		    $reportyear = $from_year;
	  }
	  else
	  {
	  
	  
		  $reportyear =  date('Y', strtotime($start_date));	  
		  
		  $from_year = $reportyear;
		  $from_month = date('m', strtotime($start_date));
		  
		  $to_year = date('Y', strtotime($end_date));
		  $to_month = date('m', strtotime($end_date));
		  
		  $begin_year = $reportyear.'-01-01';
	   	  $end_year = $reportyear.'-12-31';
	  
	  }
	  
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	  
	   $beneficiaries = $this->db->get('beneficiarytypes');
	   $beneficiarysubcategories = $this->db->get('beneficiarysubcategories');
	   
	   
	   
	   $numberstable = '<table id="datatable" width="100%"><thead>';
	   
	   $numberstable .= '<tr><th>&nbsp;</th><th>Target</th><th>Reached</th></tr>';
	   $numberstable .= '</thead><tbody>';
	   
	   
	   $reachtable = '<table id="customers" width="100%"><thead>';
	   
	   $reachtable .= '<tr><th>Beneficiary</th><th>Reached</th></tr>';
	   $reachtable .= '</thead><tbody>';
	   
	   $beneficiarydata = '';
	   
	   $total_reach = 0;
	   $total_target = 0;
	   
	   foreach ($beneficiaries->result() as $beneficiary):
	   
	   	$beneficiary_target = $this->projectbeneficiariesmodel->get_by_beneficiary_project($project_id,$beneficiary->id)->row();
		$reach = $this->reportsmodel->get_activities_by_project_beneficiary($project_id,$start_date,$end_date,$beneficiary->id);
		
		if(empty($beneficiary_target))
		{
			$target = 0;
		}
		else
		{
			$target = $beneficiary_target->target;
			
	   		$numberstable .= '<tr><th>'.$beneficiary->beneficiary_type.'</th><td>'.$target.'</td><td>'.$reach.'</td></tr>';  
		}
		
		$total_reach = $total_reach + $reach;
	    $total_target = $total_target + $target;
			
		
		$reachtable .= '<tr><td>'.$beneficiary->beneficiary_type.'</td><td>'.$reach.'</td></tr>'; 
		
		
	   
	   endforeach;
	   
	   $reachtable .= '<tr><td><strong>TOTAL</strong></td><td><strong>'.$total_reach.'</strong></td></tr>';
	   
	   $reachtable .= '</tbody></table>';
	   
	   $numberstable .= '</tbody></table>';
	   
	   
	   
	   
	   $reporttitle = 'BENEFICIARIES REACHED BY '.$project->project_title.' FROM '.date("d F Y",strtotime($start_date)).' TO '.date("d F Y",strtotime($end_date));
	  
	  $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	  $data['beneficiarysubcategories'] = $this->beneficiarysubcategoriesmodel->get_list();	  
	  $data['start_date'] = $start_date;
	  $data['end_date'] = $end_date;
	  $data['project_id'] = $project_id;
	  $data['reporttitle'] = $reporttitle;
	  $data['reportyear'] = $reportyear;
	  $data['from_year'] = $from_year;
	  $data['from_month'] = $from_month;
	  $data['to_year'] = $to_year;
	  $data['to_month'] = $to_month;
	  $data['numberstable'] = $numberstable;
	  $data['reachtable'] = $reachtable;
	   
	   
	   $data['theproject'] = $project->project_title;
	   $this->load->view('reports/benficiariesprojectreport', $data);
  }
  
  
  
    public function beneficirybyactivity()
  {
	  if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	   $data = array(
           'rows' => $this->db->get('projects'),
       );
	   
	   $data['organizations'] = $this->db->get('organizations');
	   
	   $data['error'] = '';
       
       $this->load->view('reports/beneficirybyactivity', $data);
  }
  
  
  public function benficiariesactivityreport()
  {
	  if (!$this->erkanaauth->try_session_login()) {
       	redirect('login','refresh');
       }
	   
	  $data = array();
	  $project_id = $this->input->post('project_id');
	  $plannedactivity_id = $this->input->post('plannedactivity_id');
	  $start_date = $this->input->post('start_date');
	  $end_date = $this->input->post('end_date');
	  
	  if(empty($start_date))
	  {
		  $from_year = $this->input->post('from_year');
		   $from_month = $this->input->post('from_month');
		   $to_year = $this->input->post('to_year');
		   $to_month = $this->input->post('to_month');	
		   		  
		  $start_date = $from_year.'-'.$from_month.'-01';
		   
		   if($to_month==02)
		   {
			   $to_date = '28';
		   }
		   else
		   {
			   $to_date = '30';
		   }
		   $end_date = $to_year.'-'.$to_month.'-'.$to_date;
		   
		   $begin_year = $from_year.'-01-01';
		   $end_year = $from_year.'-12-31';
		   
		    $reportyear = $from_year;
	  }
	  else
	  {
	  
	  
		  $reportyear =  date('Y', strtotime($start_date));	  
		  
		  $from_year = $reportyear;
		  $from_month = date('m', strtotime($start_date));
		  
		  $to_year = date('Y', strtotime($end_date));
		  $to_month = date('m', strtotime($end_date));
		  
		  $begin_year = $reportyear.'-01-01';
	   	  $end_year = $reportyear.'-12-31';
	  
	  }
	  
	   $project = $this->projectsmodel->get_by_id($project_id)->row();
	   
	   $activity = $this->projectplannedactivitiesmodel->get_by_id($plannedactivity_id)->row();
	   
	   
	   $projectactivities = $this->projectactivitiesmodel->get_by_activity_date($plannedactivity_id,$start_date,$end_date);
	   
	   
	   $reachtable = '<table id="customers" width="100%"><thead>';
	   
	   $reachtable .= '<tr><th>Activity</th><th>Beneficiaries Reached</th></tr>';
	   $reachtable .= '</thead><tbody>';
	   
	   
	   foreach($projectactivities as $key=>$projectactivity)
	   {
		   $reachtable .= '<tr><td>'.$projectactivity->activity.'</td><td>'.$projectactivity->total_beneficiaries.'</td></tr>';
		 
	   }
	   
	   
	   $reachtable .= '</tbody></table>';
	   
	   
	   	  
		  $beneficiaries = $this->db->get('beneficiarytypes');
		  
		  $beneficiary_columns = '';
			
			foreach ($beneficiaries->result() as $beneficiary):
			
				$beneficiary_columns .= '<th>'.$beneficiary->beneficiary_type.'</th>';
				
				
						
			endforeach;
				   
			$disttable = '<table id="datatable" width="100%"><thead>';
				   
			$disttable .= '<tr><th></th>';
			$disttable .= $beneficiary_columns;
			$disttable .= '</tr>';
		    $disttable .= '</thead><tbody>';
			
			
			$plannedactivities = $this->projectplannedactivitiesmodel->get_by_project_list($project_id);
			
			
		 foreach($projectactivities as $key=>$projectactivity):
	   
		   $disttable .= '<tr><th>'.$projectactivity->activity.'</th>';
		   
		   
		   foreach($beneficiaries->result() as $beneficiary)
		   {
			   $activity_beneficiary_no = $this->reportsmodel->get_activities_by_activity_beneficiary($projectactivity->id,$start_date,$end_date,$beneficiary->id);
			   $disttable .= '<td>'.$activity_beneficiary_no.'</td>';
		   }
		   
		 
		   
		   $disttable .= '<tr>';
	   
	   endforeach;
	   
		
			
			
			$disttable .= '</tbody></table>';


	   
	   $reporttitle = 'BENEFICIARIES REACHED BY '.$activity->activity.' ACTIVITY IN PROJECT '.$project->project_title.' FROM '.date("d F Y",strtotime($start_date)).' TO '.date("d F Y",strtotime($end_date));
	   
	  
	  $data['beneficiaries'] = $this->beneficiarytypesmodel->get_list();
	  $data['beneficiarysubcategories'] = $this->beneficiarysubcategoriesmodel->get_list();	  
	  $data['start_date'] = $start_date;
	  $data['end_date'] = $end_date;
	  $data['project_id'] = $project_id;
	  $data['reporttitle'] = $reporttitle;
	  $data['reportyear'] = $reportyear;
	  $data['from_year'] = $from_year;
	  $data['from_month'] = $from_month;
	  $data['to_year'] = $to_year;
	  $data['to_month'] = $to_month;
	  $data['plannedactivity_id'] = $plannedactivity_id;
	  $data['activity'] = $activity;
	  $data['reachtable'] = $reachtable;
	  $data['disttable'] = $disttable;
	   
	   
	   $data['theproject'] = $project->project_title;
	   $this->load->view('reports/benficiariesactivityreport', $data);
	   
	   
  }
  
  
   public function getprojects()
   {
	   
	   $organization_id = trim(addslashes(htmlspecialchars(rawurldecode($_POST['organization_id']))));
	   
	   $projects = $this->projectsmodel->get_list_by_organization($organization_id);
	   
	   $sectorselect = '<select id="project_id" name="project_id" onChange="Getactivities(this)" class=\'chosen-select form-control\' required="required">';
	   
	   $sectorselect .=  '<option value="">Select Project</option>';
	   
	   foreach($projects as $key=>$project)
		{
				
            $sectorselect .=  '<option value="'.$project['id'].'" >'.$project['project_no'].'/'.$project['project_title'].'</option>';
      
		}
					
					
	   $sectorselect .= '</select>';
	   
	   
	   echo $sectorselect;
	   
   }
  
  
   

}
