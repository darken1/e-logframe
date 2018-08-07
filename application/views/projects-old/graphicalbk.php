<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Matt Everson of Astuteo, LLC – http://astuteo.com/slickmap" />
	<title>Logical Framework</title>
	<link rel="stylesheet" type="text/css" media="screen, print" href="<?php echo base_url(); ?>css/slickmap.css" />
</head>

<body>

	<div class="sitemap">
		
		<h1><?php echo $project->project_title;?> PROJECT LOG FRAME</h1>
		<h2>Logical Framework &mdash; Version 1.0</h2>
	

		<ul id="primaryNav" class="col4">
        <li id="home"><a href=""><?php echo $project->project_title;?></a></li>
        <?php
			
			foreach($subonelines as $key=>$suboneline)
			{
				?>
                   <li><a href=""><?php echo $suboneline['objective'];?></a>
                   <?php
				  
				  $subtwolines = $this->projectoutcomesmodel->get_by_objective_list($suboneline['id']);
				   if(!empty($subtwolines))
				   {
				   ?>
                    <ul>
                       <?php
					   foreach($subtwolines as $key=>$subtwoline)
					   {
						?>
                        <li><a href=""><?php echo $subtwoline['outcome'];?></a>
                        <?php
						 
						$subthreelines =  $this->projectoutputsmodel->get_by_outcome_list($subtwoline['id']);
						 if(!empty($subthreelines))
				   		 {
						?>
                            <ul>
							<?php
                           foreach($subthreelines as $key=>$subthreeline)
                           {
                            ?>
                                <li><a href=""><?php echo $subthreeline['output'];?></a>
                                	<?php
									$subfourlines = $this->projectplannedactivitiesmodel->get_by_output_list($subthreeline['id']);
									if(!empty($subfourlines))
				   		 			{
									?>
                                	<ul>
                                    <?php
									foreach($subfourlines as $key=>$subfourline)
								    {
									?>
                                    <li><a href=""><?php echo $subfourline['activity'];?></a></li>
                                    <?php
									   }
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
                            <?php
						 }
						 ?>
                        </li>
                        <?php
					   }
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
	
</body>

</html>
