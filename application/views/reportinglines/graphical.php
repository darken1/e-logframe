<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Matt Everson of Astuteo, LLC – http://astuteo.com/slickmap" />
	<title>Organization Reporting Lines</title>
	<link rel="stylesheet" type="text/css" media="screen, print" href="<?php echo base_url(); ?>css/slickmap.css" />
</head>

<body>

	<div class="sitemap">
		
		<h1><?php echo $organization->organization_name;?></h1>
		<h2>Reporting Lines &mdash; Version 1.0</h2>
	

		<ul id="primaryNav" class="col4">
        <?php
		foreach($reportinglines as $key=>$reportingline)
		{
			?>
            <li id="home"><a href=""><?php echo $reportingline['title'];?></a></li>
            <?php
			$subonelines = $this->reportinglinesmodel->get_parent($reportingline['id']);//level one
			foreach($subonelines as $key=>$suboneline)
			{
				?>
                   <li><a href=""><?php echo $suboneline['title'];?></a>
                   <?php
				   $subtwolines = $this->reportinglinesmodel->get_parent($suboneline['id']);//level two
				   if(!empty($subtwolines))
				   {
				   ?>
                    <ul>
                       <?php
					   foreach($subtwolines as $key=>$subtwoline)
					   {
						?>
                        <li><a href=""><?php echo $subtwoline['title'];?></a>
                        <?php
						 $subthreelines = $this->reportinglinesmodel->get_parent($subtwoline['id']);//level three
						 if(!empty($subthreelines))
				   		 {
						?>
                            <ul>
							<?php
                           foreach($subthreelines as $key=>$subthreeline)
                           {
                            ?>
                                <li><a href=""><?php echo $subthreeline['title'];?></a></li>
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
		}
		?>
        </ul>
        
			
	</div>
	
</body>

</html>
