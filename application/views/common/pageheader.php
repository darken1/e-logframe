<?php
 $projects = $this->db->get('projects');
 $budget = array();
	  
foreach($projects->result() as $project)
{
	$budget[]= preg_replace("/,/", "", $project->project_budget);
}
	  
$total_budget = array_sum($budget);
$total_projects = count($this->projectsmodel->get_list());
$total_donors = count($this->donorsmodel->get_list());
	  
?>
<div class="page-header">
					<div class="pull-left">
						<h1>DRC/DDG Central Database System</h1>
					</div>
					<div class="pull-right">
						
						<ul class="stats">
                        <li class='brown'>
								<i class="fa fa-money"></i>
								<div class="details">
									<span class="big"><?php echo $total_donors;?></span>
									<span>Donors</span>
								</div>
							</li>
                        <li class='blue'>
								<i class="fa fa-folder-open"></i>
								<div class="details">
									<span class="big"><?php echo $total_projects;?></span>
									<span>Projects</span>
								</div>
							</li>
							<!--<li class='satgreen'>
								<i class="fa fa-dollar"></i>
								<div class="details">
									<span class="big">$<?php echo number_format($total_budget, 2, '.', ',');?></span>
									<span>Total Funding</span>
								</div>
							</li>-->
                            <li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big"><?php echo date("d F Y",strtotime(date('Y-m-d')));?></span>
									<span><?php echo date("D");?>, <?php echo date("H:i:s");?></span>
								</div>
							</li>
							
						</ul>
					</div>
				</div>