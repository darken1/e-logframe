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
				<li <?php if($active_class=='projects' || $active_class=='rollingactionplans' || $active_class=='projectactivities'|| $active_class=='ganttchart' || $active_class=='projectsmandeplans'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Projects</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li <?php if($active_class=='projects'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('projects')?>">Projects</a>
						</li>
                        <li <?php if($active_class=='projectactivities'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('projectactivities')?>">Project Activities</a>
						</li>
                        <li <?php if($active_class=='ganttchart' && $active_method=='mytasks'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('ganttchart/mytasks')?>">My Tasks</a>
						</li>
                        <li <?php if($active_class=='projectsmandeplans'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('projectsmandeplans')?>">M&amp;E Plans</a>
						</li>
						<li <?php if($active_class=='rollingactionplans' || $active_class=='ganttchart'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('rollingactionplans')?>">Project Rolling Action Plans</a>
						</li>
                      
						<!--<li>
							<a href="">Interim Reports</a>
						</li>
                        <li>
							<a href="">Project Closure Reports</a>
						</li>-->
					
					</ul>
				</li>
                <li <?php if($active_class=='calendar'){ echo 'class="active"';}?>>
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
				</li>
                <li <?php if($active_class=='staff' || $active_class=='reportinglines'){ echo 'class="active"';}?>>
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
				</li>
                
                <li <?php if($active_class=='reports' || $active_class=='savedreports'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Analysis &amp; Reports</span>
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
							<!--<li>
								<a href="#">Budget by Sector</a>
							</li>
                            <li>
								<a href="#">Donors by Sector</a>
							</li>-->
							</ul>
						</li>
						<li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Donor Analysis</a>
							<ul class="dropdown-menu">
							<!--<li>
								<a href="#">Beneficiaries by Donors</a>
							</li>-->
							<li <?php if($active_method=='projectsbydonors' || $active_method=='projectsbydonorsreport'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('reports/projectsbydonors')?>">Projects by Donor</a>
							</li>
							<!--<li>
								<a href="#">Budget by Donor</a>
							</li>-->
							</ul>
						</li>
                        
                        <!--<li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Location Analysis</a>
							<ul class="dropdown-menu">
								<li>
								<a href="#">Beneficiaries by Location</a>
							</li>
							<li>
								<a href="#">Projects by Location</a>
							</li>
							<li>
								<a href="#">Budget by Location</a>
							</li>
                            <li>
								<a href="#">Sectors by Location</a>
							</li>
							</ul>
						</li>-->
						

					</ul>
				</li>
                
				<li <?php if($active_class=='maps'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Maps</span>
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
				
				<li <?php if($active_class=='formcategories' || $active_class=='forms' || $active_class=='formelements'){ echo 'class="active"';}?>>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Data Collection</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                    	<li class='dropdown-submenu'>
							<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Create Forms</a>
							<ul class="dropdown-menu">
								<li <?php if($active_class=='formcategories'){ echo 'class="active"';}?>>
									<a href="<?php echo site_url('formcategories')?>">Form Categories</a>
								</li>
								<li <?php if($active_class=='forms' || $active_class=='formelements'){ echo 'class="active"';}?>>
									<a href="<?php echo site_url('forms')?>">Forms</a>
								</li>
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