<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jsgantt.css"/>
<script language="javascript" src="<?php echo base_url(); ?>js/jsgantt.js"></script>
<script language="javascript" src="<?php echo base_url(); ?>js/graphics.js"></script>
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
							<a href="<?php echo base_url() ?>index.php/ganttchart/mytasks">My tasks</a>
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
                <?php
				$project = $this->projectsmodel->get_by_id($project_id)->row();
				?>
					<h3>
						<i class="fa fa-th-list"></i>Project Activity Gantt Chart for <?php echo $project->project_no;?> <?php echo $project->project_title;?> in <?php echo $region->county;?>
					</h3>
				</div>
				<div class="box-content nopadding">
                <table class="table table-hover table-nomargin">
                <thead>
                <tr><th><?php echo $plannedactivity->activity;?></th></tr>
                </thead>
                <tbody>
                
                </tbody>
                
                </table>
                
                
                <div style="position:relative" class="gantt" id="GanttChartDIV"></div>
<script>


  // here's all the html code neccessary to display the chart object

  // Future idea would be to allow XML file name to be passed in and chart tasks built from file.

  var g = new JSGantt.GanttChart('g',document.getElementById('GanttChartDIV'), 'day');

	g.setShowRes(1); // Show/Hide Responsible (0/1)
	g.setShowDur(1); // Show/Hide Duration (0/1)
	g.setShowComp(1); // Show/Hide % Complete(0/1)
   g.setCaptionType('Resource');  // Set to Show Caption (None,Caption,Resource,Duration,Complete)


  //var gr = new Graphics();

  if( g ) {

    // Parameters             (pID, pName,                  pStart,      pEnd,        pColor,   pLink,          pMile, pRes,  pComp, pGroup, pParent, pOpen, pDepend, pCaption)
	
	JSGantt.parseXML('<?php echo base_url(); ?>xml/file_activity<?php echo trim($region->county);?><?php echo $plannedactivity_id;?>.xml',g)

    g.Draw();	
    g.DrawDependencies();

  }

  else

  {

    alert("not defined");

  }

</script>

                
                </div>
		</div>
	</div>
</div>
</div>
</div>
</div>

</body>
</html>
