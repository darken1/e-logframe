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
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Settings</span>
					</a>
				</div>
				<ul class="subnav-menu">
                <li class='dropdown'>
						<a href="#" data-toggle="dropdown">Organization Setting</a>
						<ul class="dropdown-menu">
							<li <?php if($active_class=='organizations'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('organizations')?>">Organization Information</a>
							</li>
							<li <?php if($active_class=='reportinglines'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('reportinglines')?>">Reporting Lines</a>
							</li>
							<li <?php if($active_class=='departments'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('departments')?>">Departments</a>
							</li>
							<li <?php if($active_class=='staff'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('staff')?>">Staff</a>
							</li>
						</ul>
					</li>
                	
					<li <?php if($active_class=='donors'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('donors')?>">Donors</a>
					</li>
                    <li <?php if($active_class=='currencies'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('currencies')?>">Currencies</a>
					</li>
                    <li class='dropdown'>
						<a href="#" data-toggle="dropdown">Partners</a>
						<ul class="dropdown-menu">
							<li <?php if($active_class=='levelsofoperation'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('levelsofoperation')?>">Partners Level of Operation</a>
							</li>
							<li <?php if($active_class=='organizationtypes'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('organizationtypes')?>">Partner Organization Type</a>
							</li>
							<li <?php if($active_class=='partners'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('partners')?>">Partners List</a>
							</li>
						</ul>
					</li>
                  
                   
                    <li <?php if($active_class=='documentcategories'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('documentcategories')?>">Document Categories</a>
					</li>
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Locations settings</a>
						<ul class="dropdown-menu">
							<li <?php if($active_class=='counties'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('counties')?>">Regions</a>
							</li>
							<!--<li>
								<a href="#">Sub County</a>
							</li>
							<li>
								<a href="#">Wards</a>
							</li>-->
						</ul>
					</li>
						<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Project settings</a>
						<ul class="dropdown-menu">
							<li <?php if($active_class=='sectors'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('sectors')?>">Sectors</a>
							</li>
							<li <?php if($active_class=='subsectors'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('subsectors')?>">Sub Sectors</a>
							</li>
                            <li <?php if($active_class=='activities'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('activities')?>">Activities</a>
							</li>
							<li <?php if($active_class=='projectactivitystatus'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('projectactivitystatus')?>">Project Status</a>
							</li>
                             <li <?php if($active_class=='beneficiarytypes'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('beneficiarytypes')?>">Beneficiary Types</a>
                            </li>
						</ul>
					</li>
				</ul>
			</div>
            <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Users</span>
					</a>
				</div>
				<ul class="subnav-menu">
                <li class='dropdown' <?php if($active_class=='passwordpolicies'||$active_class=='lockedips'||$active_class=='roles'||$active_class=='rolefunctionpermission'){ echo 'class="active"';}?>>
						<a href="#" data-toggle="dropdown">Authentication settings</a>
						<ul class="dropdown-menu">
                        	<li  <?php if($active_class=='passwordpolicies'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('passwordpolicies/edit')?>">Password Policies</a>
							</li>
							<li <?php if($active_class=='lockedips'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('lockedips')?>">IP Blacklist</a>
							</li>
							<li <?php if($active_class=='roles'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('roles')?>">Roles</a>
							</li>
							<!--<li <?php if($active_class=='rolefunctionpermission'){ echo 'class="active"';}?>>
								<a href="<?php echo site_url('rolefunctionpermission/add')?>">Assign Priviledge</a>
							</li>-->
						</ul>
					</li>
					<li <?php if($active_class=='users'){ echo 'class="active"';}?>>
						<a href="<?php echo site_url('users')?>">Users List</a>
					</li>
                     <li class='dropdown' <?php if($active_class=='loginattempts' || $active_class=='audittrail'){ echo 'class="active"';}?>>
						<a href="#" data-toggle="dropdown">Security</a>
						<ul class="dropdown-menu">
                        	<li <?php if($active_class=='loginattempts'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('loginattempts')?>">Login Attempts</a>
                            </li>
                            <li <?php if($active_class=='audittrail'){ echo 'class="active"';}?>>
                                <a href="<?php echo site_url('audittrail')?>">Audit Trail</a>
                            </li>
						</ul>
					</li>
                    
                  
					
						
				</ul>
			</div>
			
		</div>