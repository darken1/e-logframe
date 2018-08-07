<?php include(APPPATH . 'views/common/head.php'); ?>
<style>
.wrapper         {width:100%;height:100%;margin:0 auto;background:#ffffff}
.h_iframe        {position:relative;}
.h_iframe .ratio {display:block;width:100%;height:auto;}
.h_iframe iframe {position:absolute;top:0;left:0;width:100%; height:100%;}
</style>

<style>
    #map-canvas{
      width: 100$;
      height: 500px;
	    padding: 6px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc #ccc #999 #ccc;
        -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
    }
	

  </style>
  
   <style type="text/css">
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;     
     border: 2px solid black;
     white-space: nowrap;
   }
 </style>

		<body>
			<?php include(APPPATH . 'views/common/navigation.php'); ?>
				<div class="container-fluid" id="content">
				<?php include(APPPATH . 'views/common/left.php'); ?>
				<div id="main">
				<div class="container-fluid">
				<?php include(APPPATH . 'views/common/pageheader.php'); ?>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo site_url('home')?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url() ?>index.php/projects/listing">Projects Listing</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
				<div class="row">
                <div class="col-sm-12">
						<div class="box box-bordered box-color satblue">
							<div class="box-title">
								<h3>
									<i class="fa fa-bars"></i><?php echo $row->project_title;?></h3>
							</div>
							<div class="box-content nopadding">
                            
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#first11" data-toggle='tab'>
											<i class="fa fa-tasks"></i>Project Details</a>
									</li>
									<li>
										<a href="#second22" data-toggle='tab'>
											<i class="fa fa-file"></i>Logical Framework</a>
									</li>
									<li>
										<a href="#thirds3322" data-toggle='tab'>
											<i class="fa fa-folder-open"></i>Documents</a>
									</li>
									
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="first11">
                                    
                                    <table class="table table-hover table-nomargin">
                                    <tr><td><strong>Project Code:</strong></td><td><?php echo $row->project_no;?></td></tr>
                                    <tr><td><strong>Project Title:</strong></td><td><?php echo $row->project_title;?></td></tr>
                                    <tr><td><strong>Project Objective:</strong></td><td><?php echo $row->project_objective;?></td></tr>
                                    <tr><td><strong>Description:</strong></td><td><?php echo $row->description;?></td></tr>
                                    <tr><td><strong>Beneficiaries:</strong></td><td><?php echo $beneficiarytable;?></td></tr>
                                    <tr><td><strong>Start Date:</strong></td><td><?php echo $row->project_start_date;?></td></tr>	                                    <tr><td><strong>End Date:</strong></td><td><?php echo $row->project_end_date;?></td></tr>   
                                    <!--<tr><td><strong>Budget:</strong></td><td><?php echo number_format($row->project_budget, 2, '.', ',');?> <?php echo $row->currency;?></td></tr>-->   
                                    <tr><td><strong>Donors:</strong></td><td>	<?php
									foreach($donors as $key=>$donor)
									{
										$projectdonor = $this->projectdonorsmodel->get_by_project_donor($row->id,$donor['id'])->row();
																		
										if(empty($projectdonor))
										{
											//do not show
										}
										else
										{
											echo $donor['donor_name'].', ';
										}
										
									}
									?></td></tr>
                                     <tr><td><strong>Partners:</strong></td><td>	<?php
									foreach($partners as $key=>$partner)
									{
										$projectpartner = $this->projectpartnersmodel->get_by_project_partner($row->id,$partner['id'])->row();
																		
										if(empty($projectpartner))
										{
											//do not show
										}
										else
										{
											echo $partner['partner'].', ';
										}
										
										
									}
									?></td></tr>
                                      <tr><td><strong>Sectors:</strong></td><td><?php
									foreach($sectors as $key=>$sector)
									{
										$projectsector = $this->projectsectorsmodel->get_by_sector_project($row->id,$sector['id'])->row();
																		
											if(empty($projectsector))
											{
												//nothing
											}
											else
											{
												echo $sector['sector'].', ';
											}														
										
									}
									?></td></tr> 
                                    <tr><td><strong>Areas of Operation:</strong></td><td><?php
									foreach($counties as $key=>$county)
									{
										$projectcounty = $this->projectscountiesmodel->get_by_project_county($row->id,$county['id'])->row();
																		
										if(empty($projectcounty))
										{
										 	//nothing
										}
										else
										{
											echo $county['county'].', ';
										}
										
										
									}
									?></td></tr> 
                                    <tr><td><strong>Status:</strong></td><td><?php
									$projectstatus = $this->projectactivitystatusmodel->get_by_id($row->projectactivitystatus_id)->row();
									echo $projectstatus->status;
									?></td></tr>
                                   
                                    </table>
									</div>
									<div class="tab-pane" id="second22">
										
                                  
								<div class="tabs-container">
									<ul class="tabs tabs-inline tabs-left">
										<li class='active'>
											<a href="#first" data-toggle='tab'>
												<i class="fa fa-table"></i>Tabular</a>
										</li>
										<li>
											<a href="#second" data-toggle='tab'>
												<i class="fa fa-sitemap"></i>Graphical</a>
										</li>
										
									</ul>
								</div>
								<div class="tab-content padding tab-content-inline">
									<div class="tab-pane active" id="first">
                                    <p>
                                    <a href="<?php echo base_url() ?>index.php/projects/downloadlogicalframework/<?php echo $row->id; ?>" class="btn btn-success" target="_blank">DOWNLOAD LOGICAL FRAMEWORK <i class="fa fa-file-word-o"></i> </a>
                                    </p>
										<?php echo $logframe; ?>
                                        
									</div>
									<div class="tab-pane" id="second">
										<div class="wrapper">
                                        <div class="h_iframe">
                                            <!-- a transparent image is preferable -->
                                            <img class="ratio" src="<?php echo base_url();?>img/placeholder300.png"/>
                                          <iframe src="<?php echo base_url();?>index.php/projects/graphical/<?php echo $row->id;?>" width="1100" height="400" allowfullscreen="" frameborder="0"></iframe>
                                        </div>
                                    </div>


									</div>
								
								</div>
							
                                        
                                        
                                        
									</div>
									<div class="tab-pane" id="thirds3322">
										<?php echo $documentstable; ?>
                                        
									</div>
									
								</div>
							</div>
                            
                            
						</div>
					</div>
                </div>
                <div class="row">
                <div class="col-sm-12">
                <table class="table table-hover table-nomargin">
                             <tr><th colspan="2">PROJECT MAP</th></tr>
                                    <tr><td colspan="2">
                                    <div id="json_data" style="display:none;">
									 <?php
                                    
                      					echo json_encode($points,JSON_HEX_QUOT | JSON_HEX_TAG);
                                     
                                     ?>
                                     </div>
                                   <div id="map-canvas"></div>
                                <script src="<?php echo base_url(); ?>js/mapwithmarker.js"></script>
                   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                   <script src="<?php echo base_url(); ?>js/markerclusterer.js"></script>
                  
  <script src="<?php echo base_url(); ?>js/map.js"></script>
                                    </td></tr>
                            </table>
                </div>
                </div>
</div>
</div>
</div>



    
</body>
</html>
