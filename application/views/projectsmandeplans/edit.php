<?php include(APPPATH . 'views/common/head.php'); ?>
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
							<a href="<?php echo base_url() ?>projectsmandeplans">M&amp;E plans</a>
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
				<div class="box box-bordered">
				<div class="box-title">
					<h3>
						<i class="fa fa-th-list"></i>Edit Form
					</h3>
				</div>
				<div class="box-content nopadding">
					<?php if(validation_errors()){?>
						<p><div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Note!</strong><?php echo validation_errors(); ?>
							</div>
						</p>
					<?php } ?>
					<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('projectsmandeplans/edit_validate/'.$row->id,$attributes); ?>
                    <div class="box-content nopadding">
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#first11" data-toggle='tab'>
											<i class="fa fa-tasks"></i>Introduction</a>
									</li>
									<li>
										<a href="#second22" data-toggle='tab'>
											<i class="fa fa-table"></i>Logical Framework</a>
									</li>
									<li>
										<a href="#thirds3322" data-toggle='tab'>
											<i class="fa fa-info"></i>Indicators</a>
									</li>
									<li>
										<a href="#thirds33" data-toggle='tab'>
											<i class="fa fa-user"></i>Roles &amp; Responsibilities</a>
									</li>
                                    <li>
										<a href="#fourth44" data-toggle='tab'>
											<i class="fa fa-sitemap"></i>Dataflow</a>
									</li>
                                    <li>
										<a href="#fifth55" data-toggle='tab'>
											<i class="fa fa-database"></i>Data Management</a>
									</li>
                                    <li>
										<a href="#sixth66" data-toggle='tab'>
											<i class="fa fa-bars"></i>Appendices</a>
									</li>
                                    
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="first11">
										<div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Project</label>
                                            <div class="col-sm-10">
                                            
                                            <?php $project = $this->projectsmodel->get_by_id($row->project_id)->row();?>
                                            <input type="text" name="project" id="project" value="<?php echo $project->project_no;?> / <?php echo $project->project_title;?>" class="form-control" readonly>
                                            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project->id;?>">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Introduction</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                $data = array('id' => 'background', 'name' => 'background', 'value' => $row->background, 'class'=>'form-control','required'=>'required');
                                                echo form_textarea($data, set_value('background'));
                                                ?>
                                                 <script>
                                                    var glob10 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('background');
                                                     glob10 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
                                                      <span class="help-block">
                                                          <code>Complete this section with background details.</code>
                                                      </span>
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Purpose of plan</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                $data = array('id' => 'purpose_of_plan', 'name' => 'purpose_of_plan', 'value' => $row->purpose_of_plan, 'class'=>'form-control','required'=>'required');
                                                echo form_textarea($data, set_value('purpose_of_plan'));
                                                ?>
                                                 <script>
                                                    var glob1 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('purpose_of_plan');
                                                     glob1 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
                                                      <span class="help-block">
                                                          <code>Describe what the purpose of the monitoring and evaluation plan is, such as who prepared it, for which audience and why</code>
                                                      </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Project summary</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                $data = array('id' => 'project_summary', 'name' => 'project_summary', 'value' => $row->project_summary, 'class'=>'form-control','required'=>'required');
                                                echo form_textarea($data, set_value('project_summary'));
                                                ?>
                                                 <script>
                                                    var glob2 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('project_summary');
                                                     glob2 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
                                                      <span class="help-block">
                                                          <code>Provide basic information on the project that this monitoring and evaluation plan is for</code>
                                                      </span>
                                            </div>
                                        </div>
									</div>
									<div class="tab-pane" id="second22">
										<div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Logical framework</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                $data = array('id' => 'logical_framework', 'name' => 'logical_framework', 'value' => $row->logical_framework, 'class'=>'form-control','required'=>'required');
                                                echo form_textarea($data, set_value('logical_framework'));
                                                ?>
                                                <script>
                                                    var glob3 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('logical_framework');
                                                     glob3 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
                                                    
                                            </div>
                                        </div>
									</div>
									<div class="tab-pane" id="thirds3322">
										<div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Indicators</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                $data = array('id' => 'indicators', 'name' => 'indicators', 'value' => $row->indicators, 'class'=>'form-control','required'=>'required');
                                                echo form_textarea($data, set_value('indicators'));
                                                ?>
                                                  <script>
                                                    var glob4 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('indicators');
                                                     glob4 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
                                                      <span class="help-block">
                                                          <code>For each indicator listed in the previous logframe table describe precisely what the indicator is and how it will be measured</code>
                                                      </span>
                                            </div>
                                        </div>
									</div>
                                    <div class="tab-pane" id="thirds33">
                                    
                                        <div class="form-group">
                                                <label for="textfield" class="control-label col-sm-2">Roles &amp; Responsibilities</label>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $data = array('id' => 'roles_and_responsibilities', 'name' => 'roles_and_responsibilities', 'value' => $row->roles_and_responsibilities, 'class'=>'form-control','required'=>'required');
                                                    echo form_textarea($data, set_value('roles_and_responsibilities'));
                                                    ?>
                                                     <script>
                                                        var glob9 = '';
                                                        $(document).ready(function()
                                                        {
                                                         var editorpunt = CKEDITOR.replace('roles_and_responsibilities');
                                                         glob9 = editorpunt;
                                                         
                                                        });
                                                        
                                                            
                                                        </script> 
                                                          <span class="help-block">
                                                              <code>List each role in the organisation and their specific responsibilities for monitoring and evaluation. This may include collecting data, checking data, conducting analysis, reviewing reports, making decisions based on the data.</code>
                                                          </span>
                                                </div>
                                            </div>
                                    
                                    </div>
									<div class="tab-pane" id="fourth44">
										<div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Data flow</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                $data = array('id' => 'data_flow', 'name' => 'data_flow', 'value' => $row->data_flow, 'class'=>'form-control','required'=>'required');
                                                echo form_textarea($data, set_value('data_flow'));
                                                ?>
                                                 <script>
                                                    var glob6 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('data_flow');
                                                     glob6 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
                                                      <span class="help-block">
                                                          <code>Insert a flow chart and description showing how the monitoring data will flow from the place where it is collected up to the management team and then to other stakeholders, including the donor. </code>
                                                      </span>
                                            </div>
                                        </div>
									</div>
                                    <div class="tab-pane" id="fifth55">
										<div class="form-group">
                                                <label for="textfield" class="control-label col-sm-2">Storage</label>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $data = array('id' => 'storage', 'name' => 'storage', 'value' => $row->storage, 'class'=>'form-control','required'=>'required');
                                                    echo form_textarea($data, set_value('storage'));
                                                    ?>
                                                     <script>
                                                        var glob7 = '';
                                                        $(document).ready(function()
                                                        {
                                                         var editorpunt = CKEDITOR.replace('storage');
                                                         glob7 = editorpunt;
                                                         
                                                        });
                                                        
                                                            
                                                        </script> 
                                                          <span class="help-block">
                                                              <code>Describe how the data collected will be stored. For example, will it be stored in a spread sheet, database, hard copies, etc. How will it be backed up? How long will it be stored for? Data for different indicators may be stored in different ways. </code>
                                                          </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="textfield" class="control-label col-sm-2">Analysis</label>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $data = array('id' => 'analysis', 'name' => 'analysis', 'value' => $row->analysis, 'class'=>'form-control','required'=>'required');
                                                    echo form_textarea($data, set_value('analysis'));
                                                    ?>
                                                     <script>
                                                        var glob8 = '';
                                                        $(document).ready(function()
                                                        {
                                                         var editorpunt = CKEDITOR.replace('analysis');
                                                         glob8 = editorpunt;
                                                         
                                                        });
                                                        
                                                            
                                                        </script> 
                                                          <span class="help-block">
                                                              <code>Describe which software / tools will be used to analyse the data, such as SPSS, Stata, Excel, Tableau Public, etc. </code>
                                                          </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="textfield" class="control-label col-sm-2">Privacy</label>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $data = array('id' => 'privacy', 'name' => 'privacy', 'value' => $row->privacy, 'class'=>'form-control','required'=>'required');
                                                    echo form_textarea($data, set_value('privacy'));
                                                    ?>
                                                     <script>
                                                        var glob9 = '';
                                                        $(document).ready(function()
                                                        {
                                                         var editorpunt = CKEDITOR.replace('privacy');
                                                         glob9 = editorpunt;
                                                         
                                                        });
                                                        
                                                            
                                                        </script> 
                                                          <span class="help-block">
                                                              <code>Discuss any privacy issues with the data and how they will be addressed. For example, if you are collecting personal medical records how will they be kept confidential, who will have access to them, when will they be destroyed, etc. </code>
                                                          </span>
                                                </div>
                                            </div>
									</div>
                                   <div class="tab-pane" id="sixth66">
                                   		<div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Introduction</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                $data = array('id' => 'appendices', 'name' => 'appendices', 'value' => $row->appendices, 'class'=>'form-control','required'=>'required');
                                                echo form_textarea($data, set_value('appendices'));
                                                ?>
                                                 <script>
                                                    var glob11 = '';
                                                    $(document).ready(function()
                                                    {
                                                     var editorpunt = CKEDITOR.replace('appendices');
                                                     glob11 = editorpunt;
                                                     
                                                    });
                                                    
                                                        
                                                    </script> 
                                                      <span class="help-block">
                                                          <code>Add any necessary appendices. As a minimum this should include the tools (questionnaires, interview guides, procedures etc) that will be used to measure each indicator.</code>
                                                      </span>
                                            </div>
                                        </div>
                                   </div>
								</div>
							</div>
                    
        			<div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">UPDATE CHANGES</button>
                        <a href="<?php echo site_url('projectsmandeplans')?>" class="btn btn-danger">CANCEL</a>
					</div>
				<?php echo form_close(); ?>
 			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

</body>
</html>
