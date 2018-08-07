<?php
$active_class = $this->router->fetch_class();

$active_method =  $this->router->fetch_method();



?>

<div id="navigation">
		<div class="container-fluid">
        <div style="float:left; margin-top:1px;"><img src="<?php echo base_url(); ?>img/drc_logo.png" alt="" class='retina-ready' width="98" height="36"> &nbsp;&nbsp;&nbsp; <img src="<?php echo base_url(); ?>img/ddg_logo.png" alt="" class='retina-ready' width="105" height="36"></div>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
				<i class="fa fa-bars"></i>
			</a>
			<ul class='main-nav'>
				<li  <?php if($active_class=='home'){ echo 'class="active"';}?>>
					<a href="<?php echo site_url('home')?>">
						<span>Dashboard</span>
					</a>
				</li>
                
                <?php
				if($projectsauth || $rollingactionplansauth || $projectactivitiesauth || $projectsmandeplansauth || $monthlyreportsauth || $managementreportsauth || $trainingreportsauth)
				{
				?>
				<li <?php if($active_class=='projects' || $active_class=='rollingactionplans' || $active_class=='projectactivities'|| $active_class=='ganttchart' || $active_class=='projectsmandeplans' || $active_class=='monthlyreports' || $active_class=='managementreports'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Projects</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                    <?php
						if($projectsauth)
						{
						?>
						<li <?php if($active_class=='projects'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('projects')?>">Projects</a>
						</li>
                        <?php
						}
						if($rollingactionplansauth)
						{
						?>
                        <li <?php if($active_class=='rollingactionplans'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('rollingactionplans')?>">Project Rolling Action Plans</a>
							</li>
                            <?php
						}
						?>
                             <li <?php if($active_method=='getcharts' || $active_method=='getcharts'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('ganttchart/getcharts')?>">Project Gantt Charts</a>
							</li>
                            <li <?php if($active_method=='getactivitycharts' || $active_method=='activityganttchart'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('ganttchart/getactivitycharts')?>">Activity Gantt Charts</a>
							</li>
                            
                            <li <?php if($active_method=='getregionactivitycharts' || $active_method=='regionactivityganttchart'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('ganttchart/getregionactivitycharts')?>">Regional Activity Gantt Charts</a>
							</li>
                        <!--<li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Activity Action Plans</a>
							<ul class="dropdown-menu">
							<li <?php if($active_class=='rollingactionplans' || $active_class=='ganttchart'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('rollingactionplans')?>">Project Rolling Action Plans</a>
							</li>
                        
                           
							</ul>
						</li>-->
                        
                        <li <?php if($active_method=='mytasks'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('ganttchart/mytasks')?>">My Tasks</a>
						</li>
                        <?php
						if($projectactivitiesauth)
						{
							?>
                        <li <?php if($active_class=='projectactivities'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('projectactivities')?>">Project Activity Reporting</a>
						</li>
                        <?php
						}
						?>
                        
                        <!--<li <?php if($active_class=='projectsmandeplans'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('projectsmandeplans')?>">M&amp;E Plans</a>
						</li>-->
						
                        
                        
                        <?php
						if($trainingreportsauth)
						{
							?>
                        
                        <li <?php if($active_class=='trainingreports'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('trainingreports')?>">Training Reports</a>
						</li>
                        <?php
						}
						if($monthlyreportsauth)
						{
							?>
                         <li <?php if($active_class=='monthlyreports'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('monthlyreports')?>">Monthly Reports</a>
						</li>
                        <?php
						}
						if($managementreportsauth)
						{
							?>
                        <li <?php if($active_class=='managementreports'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('managementreports')?>">Management Reports</a>
						</li>
                        <?php
						}
						?>
                      
						<!--<li>
							<a href="">Interim Reports</a>
						</li>
                        <li>
							<a href="">Project Closure Reports</a>
						</li>-->
					
					</ul>
				</li>
                <?php
				}
				?>
                
                <?php
				if($indicatorstrackingauth || $outcomeindicatortrackingauth)
				{
				?>
                <li <?php if($active_class=='indicatorstracking' || $active_class=='outcomeindicatortracking'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Indicators &amp; Activity Tracking</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li <?php if($active_class=='indicatorstracking' && $active_method=='add'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('indicatorstracking/add')?>">Update Output indicator</a>
						</li>
                        <li <?php if($active_class=='outcomeindicatortracking' && $active_method=='add'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('outcomeindicatortracking/add')?>">Update Outcome Indicator</a>
						</li>
                        
                        <li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Indicator Tracking Reports</a>
							<ul class="dropdown-menu">
							<li <?php if($active_class=='indicatorstracking' && $active_method=='trackindicator'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('indicatorstracking/trackindicator')?>">Output Indicators</a>
							</li>
							<li <?php if($active_class=='outcomeindicatortracking' && $active_method=='trackoutcomeindicator'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('outcomeindicatortracking/trackoutcomeindicator')?>">Outcome Indicators</a>
							</li>
                           
							</ul>
						</li>
                        
                         <li <?php if($active_class=='outcomeindicatortracking' && $active_method=='plannedactivities'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('outcomeindicatortracking/plannedactivities')?>">Activities Tracking Report</a>
						</li>
                        <li <?php if($active_class=='outcomeindicatortracking' && $active_method=='beneficiaryactivities'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('outcomeindicatortracking/beneficiaryactivities')?>">Activity Beneficiary Tracking Report</a>
						</li>
						
					</ul>
				</li>
                <?php
				}
				?>
               <!-- <li <?php if($active_class=='calendar'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Calendar</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li <?php if($active_class=='calendar' && $active_method=='add'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('calendar/add')?>">New Event</a>
						</li>
						<li <?php if($active_class=='calendar' && $active_method=='index'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('calendar')?>">My Events List</a>
						</li>
						<li <?php if($active_method=='calendarview' || $active_method=='browsecalendar' || $active_method=='searchcalendar'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('calendar/calendarview')?>">Events Calendar</a>
						</li>
					</ul>
				</li>-->
                <!--<li <?php if($active_class=='staff' || $active_class=='reportinglines'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>The Organization</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('staff/liststaff')?>">Staff</a>
						</li>
						<li>
							<a href="<?php echo site_url('reportinglines/view')?>">Reporting Lines</a>
						</li>
						
					</ul>
				</li>-->
                
                <!--<li <?php if($active_class=='documents'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Documents</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li <?php if($active_class=='documents' && $active_method=='add'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('documents/add')?>">Add Document</a>
					</li>
					<li <?php if($active_class=='documents' && $active_method=='mydocuments'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('documents/mydocuments')?>">My Documents</a>
					</li>
                    
                    <li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>All Documents</a>
							<ul class="dropdown-menu">
							<li <?php if($active_method=='search'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('documents/search')?>">Search</a>
							</li>
							<li>
								<a href="<?php echo site_url('documents')?>">Document List</a>
							</li>
						
							</ul>
						</li>
						
					</ul>
				</li>-->
                
                <li <?php if($active_class=='reports' || $active_class=='savedreports'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Project &amp; Beneficiary Analysis</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                     <li <?php if($active_class=='savedreports'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('savedreports')?>">Saved Reports</a>
						</li>
                       <!-- <li>
							<a href="">Interim Reports</a>
						</li>-->
                    	<li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Sector Analysis</a>
							<ul class="dropdown-menu">
							<li <?php if($active_class=='reports' && $active_method=='index'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('reports')?>">Beneficiaries by Sector</a>
							</li>
							<li <?php if($active_method=='projectsbysector'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('reports/projectsbysector')?>">Projects by Sector</a>
							</li>
                            <!--<li <?php if($active_method=='fundingbysector'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('reports/fundingbysector')?>">Donors by Sector</a>
							</li>-->
							<!--<li>
								<a href="#">Budget by Sector</a>
							</li>
                            <li>
								<a href="#">Donors by Sector</a>
							</li>-->
							</ul>
						</li>
						<!--<li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Donor Analysis</a>
							<ul class="dropdown-menu">
							<li>
								<a href="#">Beneficiaries by Donors</a>
							</li>
							<li <?php if($active_method=='projectsbydonors' || $active_method=='projectsbydonorsreport'){ echo 'class="active"';}?>>
								<a href="<?php //echo site_url('reports/projectsbydonors')?>">Projects by Donor</a>
							</li>
							<li>
								<a href="#">Areas of Operation by Donor</a>
							</li>
							</ul>
						</li>-->
                        
                     <li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Region Analysis</a>
							<ul class="dropdown-menu">
								<li>
								<a href="<?php echo site_url('reports/beneficirybyregion')?>">Beneficiaries by Region</a>
							</li>
							<!--<li>
								<a href="#">Projects by Region</a>
							</li>-->
							
							</ul>
						</li>
                        
                        <li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Project Analysis</a>
							<ul class="dropdown-menu">
								<li>
								<a href="<?php echo site_url('reports/beneficirybyproject')?>">Beneficiaries by Project</a>
							</li>
                            <li>
								<a href="<?php echo site_url('reports/beneficirybyactivity')?>">Beneficiaries by Project Activities</a>
							</li>
							<!--<li>
								<a href="#">Projects by Region</a>
							</li>-->
							
							</ul>
						</li>
						

					</ul>
				</li>
                
				<li <?php if($active_class=='maps'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Project &amp; Activity Maps</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('maps/fullscreen')?>" target="_blank">Full Screen</a>
						</li>
						<li>
							<a href="<?php echo site_url('maps')?>">Search Projects Map</a>
						</li>
                        <li>
							<a href="<?php echo site_url('maps/projectactivities')?>">Activities Map</a>
						</li>
						
					</ul>
				</li>
                
                 <?php
				if($beneficiaryregistrationauth || $cashforworkauth || $noncashdistributionauth || $attendancelistauth)
				{
				?>
                
                <li <?php if($active_class=='beneficiaryregistration'||$active_class=='cashforwork'||$active_class=='noncashdistribution'||$active_class=='attendancelist'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Beneficiary Tracking Forms</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                    <?php
						if($beneficiaryregistrationauth)
						{
						?>
						<li>
							<a href="<?php echo site_url('beneficiaryregistration/cashregistration')?>">Cash for work Beneficiries registration form</a>
						</li>
                        <?php
						}
						if($cashforworkauth)
						{
						?>
						<li <?php if($active_class=='cashforwork' || $active_method=='addreport'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('cashforwork/activityreport')?>">Cash for work Payment form</a>
						</li>
                        <?php
						}
						if($noncashdistributionauth)
						{
						?>
                        <li <?php if($active_class=='noncashdistribution' || $active_method=='add_report'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('noncashdistribution/activity')?>">None Cash distribution form</a>
						</li>
                        <?php
						}
						if($attendancelistauth)
						{
						?>
                         <li <?php if($active_class=='attendancelist'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('attendancelist/activity')?>">Training attendance list</a>
						</li>
                        <?php
						}
						?>
						
					</ul>
				</li>
                
                <?php
				}
				?>
                
                <?php
				if($formcategoriesauth || $formsauth || $formelementsauth)
				{
				?>
				
				<li <?php if($active_class=='formcategories' || $active_class=='forms' || $active_class=='formelements'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Data Collection</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                    	<li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Create Forms</a>
							<ul class="dropdown-menu">
                             <?php
								if($formcategoriesauth)
								{
								?>
								<li <?php if($active_class=='formcategories'){ echo 'class="active"';}?>>
									<a href="<?php echo site_url('formcategories')?>">Form Categories</a>
								</li>
                                 <?php
								}
								if($formsauth || $formelementsauth)
								{
								?>
								<li <?php if($active_class=='forms' || $active_class=='formelements'){ echo 'class="active"';}?>>
									<a href="<?php echo site_url('forms')?>">Forms</a>
								</li>
                                <?php
								}
								?>
							</ul>
						</li>
						
                        <li>
							<a href="">Data Entry</a>
						</li>
						<li>
							<a href="">Form Data</a>
						</li>
						<li>
							<a href="">Form Data Analysis</a>
						</li>
						

					</ul>
				</li>
                
                <?php
				}
				?>
				
			</ul>
            
            
			<div class="user">
				
				<div class="dropdown">
                <?php
				$user_id = $this->erkanaauth->getField('id');
				$profile = $this->profilesmodel->get_by_user_id($user_id)->row();
				$user = $this->usersmodel->get_by_id($user_id)->row();
				?>
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $user->fname;?> <?php echo $user->lname;?>
						<?php
						if(empty($profile->photo))
					    {
							?>
                             <img src="<?php echo base_url();?>profilepics/one22.jpg" height="27" width="27" alt="">
                            <?php
						}
						else
						{
						?>
                        <img src="<?php echo base_url();?>profilepics/<?php echo $profile->photo;?>" height="27" width="27" alt="">
                        <?php
						}
						?>
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="<?php echo site_url('profiles/edit')?>">Edit profile</a>
						</li>
					
						<li>
							<a href="<?php echo site_url('home/logout')?>">Sign out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>