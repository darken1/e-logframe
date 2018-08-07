<?php include(APPPATH . 'views/common/head.php'); ?>
<style>
				.tagcloud {
	font-size: 19px;
	text-align: center;
	padding: 15px;
	border: 1px solid #eeeeee;
	background-color: #f2f2f2;
}

a.t10 {
	color: #FF3300;
    font-size: 115%;
    font-weight: bold;
}

a.t10:hover {
	background-color: #FF3300;
	color: #FFFFFF;
}

a.t9 {
	color: #FF3300;
	font-size: 110%;
}

a.t9:hover {
	background-color: #FF3300;
	color: #FFFFFF;
}

a.t8 {
	color: #FF9933;
    font-size: 105%;
    font-weight: bold;
}

a.t8:hover {
	background-color: #FF9933;
	color: #FFFFFF;
}

a.t7 {
	color: #FF9933;
	font-size: 100%;
}

a.t7:hover {
	background-color: #FF9933;
	color: #FFFFFF;
}

a.t6 {
	color: #99CC33;
    font-size: 95%;
    font-weight: bold;
}

a.t6:hover {
	background-color: #99CC33;
	color: #FFFFFF;
}

a.t5 {
	color: #339933;
	font-size: 90%;
}

a.t5:hover {
	background-color: #339933;
	color: #FFFFFF;
}

a.t4 {
	color: #339933;
	font-size: 80%;
    font-weight: bold;
}

a.t4:hover {
	background-color: #339933;
	color: #FFFFFF;
}

a.t3 {
	color: #339999;
	font-size: 75%;
}

a.t3:hover {
	background-color: #339999;
	color: #FFFFFF;
}

a.t2 {
	color: #3399FF;
	font-size: 65%;
    font-weight: bold;
}

a.t2:hover
{
	background-color: #3399FF;
	color: #FFFFFF;
}

a.t1 {
	color: #888888;
	font-size: 60%;
}

a.t1:hover {
	background-color: #888888;
	color: #FFFFFF;
}
</style>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
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
							<a href="<?php echo base_url() ?>index.php/documents">documents</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
				<div class="row">
				
                <div class="col-sm-6">
						<div class="box box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-search"></i>Search</h3>
							</div>
							<div class="box-content nopadding">
								
                                 <?php     

$attributes = array('name' => 'searchform','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped');

echo form_open('documents/searchdocument',$attributes); ?>
									<div class="form-group">
										<label for="county" class="control-label col-sm-2">Document Category <font color="#FF0000">*</font></label>
										<div class="col-sm-10">
										<select name="doccategory_id" id="doccategory_id" class="chosen-select form-control">
										<?php
                                        foreach($doccategories as $key=>$doccategory)
                                        {
                                            ?>
                                            <option value="<?php echo $doccategory['id'];?>" <?php if($doccategory['id']==set_value('doccategory_id')){ echo 'selected="selected"';}?>><?php echo $doccategory['category'];?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
										</div>
									</div>
									<div class="form-group">
										<label for="sector" class="control-label col-sm-2">Created by</label>
										<div class="col-sm-10">
											<select name="user_id" id="user_id" class="chosen-select form-control">
                                            <option value="0">Select user</option>
											<?php
                                            foreach($users as $key=>$user)
                                            {
                                                ?>
                                                <option value="<?php echo $user['id'];?>" <?php if($user['id']==set_value('user_id')){ echo 'selected="selected"';}?>><?php echo $user['fname'];?> <?php echo $user['lname'];?></option>
                                                <?php
                                            }
                                            ?>
                                            </select>
										</div>
									</div>
                                    <div class="form-group">
										<label for="donor" class="control-label col-sm-2">Project</label>
										<div class="col-sm-10">
											<select name="project_id" id="project_id" class="chosen-select form-control">
                                            <option value="0">Select project</option>
											<?php foreach ($projects->result() as $project): ?>
                                           <option value="<?php echo $project->id;?>"><?php echo $project->project_no;?> / <?php echo $project->project_title;?></option>
                                           <?php endforeach; ?>
                                            </select>
										</div>
									</div>
                                     <div class="form-group">
										<label for="donor" class="control-label col-sm-2">Year Published</label>
										<div class="col-sm-10">
											<select name="year_published" id="year_published" class="form-control">
                                                   <option value="">Select Year</option>
                                                   <?php
                                                         $currentYear = date('Y');
                                                            foreach (range(2008, $currentYear) as $value) {
                                                              ?>
                                                               <option value="<?php echo $value;?>" <?php 
                                                               if($value==set_value('year_published'))
                                                               {
                                                                   echo 'selected="selected"';
                                                               }
                                                               ?>><?php echo $value;?></option>
                                                              <?php
                                                    
                                                            }
                                                    ?>
                                           </select>
										</div>
									</div>
									
									<div class="form-actions col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary">Search</button>
										
									</div>
								
                                <?php echo form_close(); ?>
							</div>
						</div>
					</div>
                    
                    <div class="box-content nopadding">
                    <div class="col-sm-6">
						   <div class="box-title">
								<h3>
									<i class="fa fa-bars"></i>
									File Tree
								</h3>
							</div>
									<div class="filetree">
										<ul>
											<?php
											foreach($doccategories as $key=>$doccategory)
											{
												?>
                                                <li id="key<?php echo $doccategory['id'];?>" class="folder"><?php echo $doccategory['category'];?>
                                                <?php
												$documents = $this->documentsmodel->get_list_by_category($doccategory['id']);
												if(!empty($documents))
												{
													?>
                                                    <ul>
                                                    	<?php
														foreach($documents as $dkey=>$document):
														?>
														<li id="key<?php echo $doccategory['id'];?>.<?php echo $document['id'];?>"><a href="<?php echo base_url();?>documents/<?php echo $document['file_name'];?>" target="_blank"><?php echo $document['document_title'];?></a>
                                                        
                                                        
                                                       
                                                        </li>
														<?php
														
														endforeach;														
														?>
                                                    </ul>
                                                    <?php
												}
												?>
                                                </li>
												<?php
											}
											?>
										
											
										</ul>
									</div>
								</div>
                               </div>
                                
                
                
</div>
</div>
</div>
</div>

</body>
</html>
