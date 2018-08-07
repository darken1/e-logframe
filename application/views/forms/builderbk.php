<?php include(APPPATH . 'views/common/head.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/css/vendor.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>dist/formbuilder.css" />

<style>
  * {
    box-sizing: border-box;
  }
 
  .fb-main {
    background-color: #fff;
    border-radius: 5px;
    min-height: 600px;
  }
  input[type=text] {
    height: 26px;
    margin-bottom: 3px;
  }
  select {
    margin-bottom: 5px;
    font-size: 40px;
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
							<a href="<?php echo base_url() ?>index.php/forms">Forms</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
                <?php
   
   $contents = $row->form_elements;
    $strlength = strlen($contents) - 2;
    $contents = substr ($contents, 10);
	
	//echo $contents;
	
	?>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-bordered">
				<div class="box-title">
					<h3>
						<i class="fa fa-th-list"></i><?php echo $row->form_name; ?>
					</h3>
				</div>
				<div class="box-content nopadding">
                <table class="table table-hover table-nomargin">
                <tr><td><a href="<?php echo site_url('forms')?>" class="btn btn-danger"><i class="fa fa-close"></i> CLOSE</a>&nbsp;<a href="<?php echo site_url('forms/preview/'.$row->id)?>" class="btn btn-success" target="_blank"><i class="fa fa-eye"></i> PREVIEW</a>&nbsp;<a href="<?php echo site_url('forms/edit/'.$row->id)?>" class="btn btn-primary"><i class="fa fa-list"></i> FORM PROPERTIES</a></td></tr>
                </table>
                
					<div id="status"></div>
  <div class='fb-main'></div>

  <script src="<?php echo base_url(); ?>vendor/js/vendor.js"></script>
  <script src="<?php echo base_url(); ?>dist/formbuilder.js"></script>

  <script>
 
   
    $(function(){
      fb = new Formbuilder({
        selector: '.fb-main',
		
		<?php 
		if(empty($contents))
		{
			?>
		 bootstrapData: []
      });	
			<?php
		}
		else
		{
			?>
        bootstrapData: <?php echo $contents;?>);
		<?php
		}
		?>
      
      fb.on('save', function(payload){
        console.log(payload);
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
        xmlhttp.open("POST","<?php echo base_url(); ?>index.php/forms/saveJSON",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var return_data = xmlhttp.responseText;
        document.getElementById("status").innerHTML = return_data;
    }
}
        xmlhttp.send("content="+payload+"&formid=<?php echo $row->id;?>");
      // window.location.href = "saveJSON.php?content="+payload;
    })
    });
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
