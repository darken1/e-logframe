<?php
$active_class = $this->router->fetch_class();

$active_method =  $this->router->fetch_method();

?>
<div id="left">
			<form action="" method="GET" class='search-form'>
				<div class="search-pane">
					<input type="text" name="search" placeholder="Search here...">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</form>
             <?php
			if($statisticalreportsauth)
			{
				?>
            <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Statistical Reports</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li <?php if($active_class=='statisticalreports'){ echo 'class="active"';}?>>
							<a href="<?php echo site_url('statisticalreports')?>">Country Statistical Reports</a>
					</li>
					
					
					
				</ul>
			</div>
            <?php
			}
			if($calendarauth)
			{
				?>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Calendar</span>
					</a>
				</div>
				<ul class="subnav-menu">
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
			</div>
            <?php
			}
			
			if($documentsauth)
			{
			?>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Documents</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li <?php if($active_class=='documents' && $active_method=='add'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('documents/add')?>">Add Document</a>
					</li>
					
					<li <?php if($active_class=='documents' && $active_method=='mydocuments'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('documents/mydocuments')?>">My Documents</a>
					</li>
					<li class='dropdown'>
						<a href="" data-toggle="dropdown">All Documents</a>
						<ul class="dropdown-menu">
							<li <?php if($active_class=='documents' && $active_method=='search'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('documents/search')?>">Search</a>
							</li>
							<li>
								<a href="<?php echo site_url('documents')?>">Document List</a>
							</li>
							
						</ul>
					</li>
				</ul>
			</div>
            <?php
			}
			?>
            <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Reports</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li <?php if($active_class=='savedreports'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('savedreports');?>">My Saved Reports</a>
					</li>
                   <!-- <li>
						<a href="#">Interim Project Reports</a>
					</li>-->
					
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Sector Project Analysis</a>
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
                    <li class='dropdown'>
						<a href="#" data-toggle="dropdown">Donors Project Analysis</a>
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
                    
                   <!-- <li class='dropdown'>
						<a href="#" data-toggle="dropdown">Location Project Analysis</a>
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
			</div>
            <?php
			if($organizationsauth||$reportinglinesauth || $departmentsauth || $staffauth || $donorsauth || $currenciesauth || $levelsofoperationauth || $organizationtypesauth || $partnersauth || $documentcategoriesauth || $taskcategoriesauth || $tasksauth || $countriesauth || $countiesauth || $districtsauth || $programmeareasauth || $sectorsauth || $subsectorsauth || $activitiesauth || $projectactivitystatusauth || $beneficiarytypesauth || $aggregationtypesauth || $beneficiarysubcategoriesauth || $typesofsupportauth)
			{
				?>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Settings</span>
					</a>
				</div>
				<ul class="subnav-menu">
                 <?php
			if($organizationsauth||$reportinglinesauth || $departmentsauth || $staffauth)
			{
				?>
                <li class='dropdown'>
						<a href="#" data-toggle="dropdown">Organization Setting</a>
						<ul class="dropdown-menu">
                         <?php
						if($organizationsauth)
						{
							?>
							<li <?php if($active_class=='organizations'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('organizations')?>">Organization Information</a>
							</li>
                            <?php
						}
			
						if($reportinglinesauth)
						{
							?>
							<li <?php if($active_class=='reportinglines'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('reportinglines')?>">Reporting Lines</a>
							</li>
                            <?php
						}
			
                        if($departmentsauth)
                        {
                            ?>
							<li <?php if($active_class=='departments'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('departments')?>">Departments</a>
							</li>
                            <?php
							}
							?>
							 <?php
                            if($staffauth)
                            {
                                ?>
							<li <?php if($active_class=='staff'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('staff')?>">Staff</a>
							</li>
                            <?php
							}
							?>
						</ul>
					</li>
                    <?php
					}
					
					if($donorsauth)
					{
						?>
                	
					<li <?php if($active_class=='donors'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('donors')?>">Donors</a>
					</li>
                    <?php
					}
					
					if($currenciesauth)
					{
						?>
                    <li <?php if($active_class=='currencies'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('currencies')?>">Currencies</a>
					</li>
                    <?php
			}
			
			if($levelsofoperationauth || $organizationtypesauth || $partnersauth)
			{
				?>
                    <li class='dropdown'>
						<a href="#" data-toggle="dropdown">Partners</a>
						<ul class="dropdown-menu">
                        <?php
						if($levelsofoperationauth)
						{
							?>
							<li <?php if($active_class=='levelsofoperation'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('levelsofoperation')?>">Partners Level of Operation</a>
							</li>
                            <?php
							}
							if($organizationtypesauth)
							{
							?>
							<li <?php if($active_class=='organizationtypes'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('organizationtypes')?>">Partner Organization Type</a>
							</li>
                            <?php
							}
							if($partnersauth)
							{
								?>
							<li <?php if($active_class=='partners'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('partners')?>">Partners List</a>
							</li>
                            <?php
							}
							?>
						</ul>
					</li>
                 <?php
			}
			
			if($documentcategoriesauth)
			{
				?>
                   
                    <li <?php if($active_class=='documentcategories'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('documentcategories')?>">Document Categories</a>
					</li>
                    <?php
			}
			
			if($taskcategoriesauth || $tasksauth)
			{
				?>
                    
                    <li class='dropdown'>
						<a href="#" data-toggle="dropdown">Task settings</a>
						<ul class="dropdown-menu">
                        <?php
						if($taskcategoriesauth)
						{
						?>
                        <li <?php if($active_class=='taskcategories'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('taskcategories')?>">Task Categories</a>
							</li>
                            <?php
						}
						if($tasksauth)
						{
							?>
                         <li <?php if($active_class=='tasks'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('tasks')?>">Tasks</a>
							</li>
                            <?php
						}
						?>
						
						</ul>
					</li>
                    <?php
			}
			
			if($countriesauth || $countiesauth || $districtsauth || $programmeareasauth)
			{
				?>
                    
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Locations settings</a>
						<ul class="dropdown-menu">
                        <?php
						if($countriesauth)
						{
						?>
                        <li <?php if($active_class=='countries'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('countries')?>">Countries</a>
							</li>
                            <?php
							}
							if($countiesauth)
							{
							?>
							<li <?php if($active_class=='counties'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('counties')?>">Regions</a>
							</li>
                            <?php
							}
							if($districtsauth)
							{
							?>
                            <li <?php if($active_class=='districts'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('districts')?>">Districts</a>
							</li>
                            <?php
							}
							if($programmeareasauth)
							{
							?>
                            <li <?php if($active_class=='programmeareas'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('programmeareas')?>">Programme Areas</a>
							</li>
                            <?php
							}
							?>
							<!--<li>
								<a href="#">Sub County</a>
							</li>
							<li>
								<a href="#">Wards</a>
							</li>-->
						</ul>
					</li>
                    
                    <?php
			}
			
			if( $sectorsauth || $subsectorsauth || $activitiesauth || $projectactivitystatusauth || $beneficiarytypesauth || $aggregationtypesauth || $beneficiarysubcategoriesauth || $typesofsupportauth)
			{
				?>
						<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Project settings</a>
						<ul class="dropdown-menu">
                        <?php
							if( $sectorsauth)
							{
							?>
							<li <?php if($active_class=='sectors'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('sectors')?>">Sectors</a>
							</li>
                            <?php
							}
							if($subsectorsauth)
							{
							?>
							<li <?php if($active_class=='subsectors'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('subsectors')?>">Sub Sectors</a>
							</li>
                            <?php
							}
							if($activitiesauth)
							{
							?>
                            <li <?php if($active_class=='activities'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('activities')?>">Activities</a>
							</li>
                            <?php
							}
							if($projectactivitystatusauth)
							{
				            ?>
							<li <?php if($active_class=='projectactivitystatus'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('projectactivitystatus')?>">Project Status</a>
							</li>
                            <?php
							}
							if($beneficiarytypesauth)
							{
								?>
                             <li <?php if($active_class=='beneficiarytypes'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('beneficiarytypes')?>">Beneficiary Types</a>
                            </li>
                            <?php
							}
							if($aggregationtypesauth)
							{
								?>
                            <li <?php if($active_class=='aggregationtypes'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('aggregationtypes')?>">Beneficiary aggregation types</a>
                            </li>
                            <?php
							}
							if($beneficiarysubcategoriesauth)
							{
								?>
                            <li <?php if($active_class=='beneficiarysubcategories'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('beneficiarysubcategories')?>">Beneficiary Sub categories</a>
                            </li>
                            <?php
							}
							if($typesofsupportauth)
							{
								?>
                            <li <?php if($active_class=='typesofsupport'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('typesofsupport')?>">Support Given</a>
                            </li>
                            <?php
							}
							?>
						</ul>
					</li>
                    <?php
			}
			?>
				</ul>
			</div>
            
            <?php
			}
			if($userauthorised||$lockedipsauth||$rolesauth||$rolefunctionpermissionauth||$passwordpoliciesauth||$loginattemptsauth||$audittrailauth || $permissionsauth)
			{
			?>
            <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Users</span>
					</a>
				</div>
				<ul class="subnav-menu">
                <?php
				if($lockedipsauth||$rolesauth||$rolefunctionpermissionauth||$passwordpoliciesauth || $permissionsauth)
				{
				?>
                <li class='dropdown' <?php if($active_class=='passwordpolicies'||$active_class=='lockedips'||$active_class=='roles'||$active_class=='rolefunctionpermission' ||$active_class=='permissions'){ echo 'class="active"';}?>>
						<a href="#" data-toggle="dropdown">Authentication settings</a>
						<ul class="dropdown-menu">
                        <?php
						if($passwordpoliciesauth)
						{
						?>
                        	<li  <?php if($active_class=='passwordpolicies'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('passwordpolicies/edit')?>">Password Policies</a>
							</li>
                        <?php
						}
						if($lockedipsauth)
						{
						?>
							<li <?php if($active_class=='lockedips'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('lockedips')?>">IP Blacklist</a>
							</li>
                        <?php
						}
						if($permissionsauth)
						{
						?>
							<li <?php if($active_class=='permissions'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('permissions')?>">Permissions</a>
							</li>
                        <?php
						}
						if($rolesauth)
						{
						?>
							<li <?php if($active_class=='roles'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('roles')?>">Roles</a>
							</li>
                        <?php
						}
						?>
							<!--<li <?php if($active_class=='rolefunctionpermission'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('rolefunctionpermission/add')?>">Assign Priviledge</a>
							</li>-->
						</ul>
					</li>
                    <?php
					}
					if($userauthorised)
					{
					?>
					<li <?php if($active_class=='users'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('users')?>">Users List</a>
					</li>
                    <?php
					}
					
					if($loginattemptsauth||$audittrailauth)
					{
					?>
                     <li class='dropdown' <?php if($active_class=='loginattempts' || $active_class=='audittrail'){ echo 'class="active"';}?>>
						<a href="#" data-toggle="dropdown">Security</a>
						<ul class="dropdown-menu">
							<?php
                            if($loginattemptsauth)
                            {
                            ?>
                        	<li <?php if($active_class=='loginattempts'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('loginattempts')?>">Login Attempts</a>
                            </li>
                            <?php
							}
							if($audittrailauth)
							{
							?>
                            <li <?php if($active_class=='audittrail'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('audittrail')?>">Audit Trail</a>
                            </li>
                            <?php
							}
							?>
						</ul>
					</li>
                    <?php
					}
					?>
                    
                  
					
						
				</ul>
			</div>
			<?php
			}
			?>

            
			
		</div>