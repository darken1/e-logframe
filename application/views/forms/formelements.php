<?php include(APPPATH . 'views/common/head.php'); ?>
<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<link type='text/css' href='<?php echo base_url(); ?>css/dragdrop/basic.css' rel='stylesheet' media='screen' />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/dragdrop/style.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>
<script>
 //initialize the drag and drop functions.
function drag(){
       
        $( "#content_box_drag p" ).draggable({
            appendTo: "body",
            helper: "clone",
            revert: "invalid"
           
            //add comma to previous last line & uncomment this if u want to remove the dropped item
             /*stop: function(){$(this).remove();}*/

        });
       
        $( "#content_box_drop p" ).droppable({
            activeClass: "dropper_hover",
            hoverClass: "dropper_hover",
            accept: ":not(.ui-sortable-helper)",
            drop: function( event, ui ) {
                 var ele = ui.draggable.text();
				 var frm  = document.getElementById("form_id").value;       
                    $.ajax({
                                  url: "<?php echo base_url(); ?>index.php/forms/addelement",
                                  method: "POST",
                                  data: {element:ele,formid:frm},
                                  beforeSend:function(){
                                                $('#search_result').html("<center><br/><h4>Loading.....</h4></center>");
                                                            },
                                success:function(data){
                                               $("#search_result").html(data);
                                                            }
                                 });
            }
        });

}
</script>
<link href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.js"></script>
<script>
	$(function() {
		
		$( "#accordion" ).accordion();
		

		
		var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
		

		
		$( "#button" ).button();
		$( "#radioset" ).buttonset();
		

		
		$( "#tabs" ).tabs();
		

		
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});

		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
		

		
		$( "#datepicker" ).datepicker({
			inline: true
		});
		

		
		$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});
		

		
		$( "#progressbar" ).progressbar({
			value: 20
		});
		

		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
	});
	</script>
<style>
ul {
	padding:0px;
	margin: 0px;
}
#response {
	padding:10px;
	background-color:#9F9;
	border:2px solid #396;
	margin-bottom:20px;
}
#list li {
	margin: 0 0 3px;
	padding:8px;
	background-color:#ecf0f1;
	color:#333;
	list-style: none;
}
</style>

<style>
	
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	</style>
<script type="text/javascript">
$(document).ready(function(){ 	
	  function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });
    
}, 2000);}
	
    $("#response").hide();
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable("serialize") + '&update=update&form_id=<?php echo $form->id;?>'; 
			$.post("<?php echo base_url(); ?>index.php/forms/updatelist", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	
</script> 

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
							<a href="<?php echo base_url() ?>forms">Form Elements</a>
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
						<i class="fa fa-th-list"></i><?php echo $form->form_name;?>
					</h3>
				</div>
				<div class="box-content nopadding">
                <div class="form-actions col-sm-offset-2 col-sm-10">
						
                        <a href="<?php echo site_url('forms')?>" class="btn btn-success">BACK TO FORM LIST <i class="fa fa-backward"></i></a>
					</div>
                <table class="table table-nomargin">
<tr><td>
                <input type="hidden" name="form_id" value="<?php echo $form->id;?>" id="form_id"/>
                <div class="content_box" id="content_box_drag" onMouseOver="drag();"> Drag Form Element
 
<p class='dragelement' id='dragelement_1' title="Input Text"><img src="<?php echo base_url(); ?>img/new_text.png"> Input Text</p>
<p class='dragelement' id='dragelement_2' title="Text Area"><img src="<?php echo base_url(); ?>img/new_textarea.png"> Text Area</p>
<p class='dragelement' id='dragelement_3' title="Radio Button"><img src="<?php echo base_url(); ?>img/new_radio.png"> Radio Button</p>
<p class='dragelement' id='dragelement_4' title="Checkbox"><img src="<?php echo base_url(); ?>img/new_checkbox.png"> Checkbox</p>
<p class='dragelement' id='dragelement_5' title="Selectable List"><img src="<?php echo base_url(); ?>img/new_list.png"> Selectable List</p>
<p class='dragelement' id='dragelement_6' title="File"><img src="<?php echo base_url(); ?>img/new_file.png"> File</p>
<p class='dragelement' id='dragelement_7' title="DatePicker"><img src="<?php echo base_url(); ?>img/new_date_picker.png"> DatePicker</p>
<p class='dragelement' id='dragelement_9' title="Section Break"><img src="<?php echo base_url(); ?>img/new_wizard.png"> Section Break</p>

</div>

<div class="content_holder_box" id="content_box_drop">Drop here

<p class="dropper"></p>
</div>


</td></tr>
<tr><td>
<p>
 <a href="<?php echo base_url() ?>forms/formelements/<?php echo $form->id; ?>" title="" class="btn btn-success" style="margin: 5px;">Refresh Form <i class="fa fa-refresh"></i></a>
 
<a href="<?php echo base_url() ?>forms/previewform/<?php echo $form->id; ?>" class="btn btn-success" target="_blank">PREVIEW FORM <i class="fa fa-eye"></i></a>

  
</p>
<div id="response"> </div></td></tr>
</table>
 
 <div id="search_result">

<table class="table table-nomargin">
<tr><td>

<div id="container">
  <div id="list">
 <ul>
<?php 
foreach($formelements as $key=>$row)
{
	
	$id = stripslashes($row['id']);
	
	?>
       <li id="arrayorder_<?php echo $id ?>"><?php echo $row['label']; ?><br /><br />
       <?php
	   if(trim($row['type'])=='Input Text')
	   {
		   if($row['required']==1)
		   {
			   $required = 'required';
		   }
		   else
		   {
			   $required = '';
		   }
		   ?>
        <input type="text" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>"  value="<?php echo $row['default_value'];?>" size="<?php echo $row['size'];?>" maxlength="<?php echo $row['max_length'];?>" <?php echo $required;?> class='form-control'/> <br /><br />
        <div id='basic-modal'>
        
        <a href='#' title="<?php echo $id ?>" class='basic'><img src="<?php echo base_url(); ?>img/edit.png"></a> <a href="delete.php?id=<?php echo $id ?>" onClick="return confirm('Are you sure you want to delete? This action is not reversable')"><img src="<?php echo base_url(); ?>img/cross.png"></a>
        </div>
     
           <?php
	   }
	    if(trim($row['type'])=='Text Area')
	   {
		   if($row['required']==1)
		   {
			   $required = 'required';
		   }
		   else
		   {
			   $required = '';
		   }
		   ?>
        <textarea cols="<?php echo $row['cols'];?>" rows="<?php echo $row['rows'];?>" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" <?php echo $required;?> class='form-control'> <?php echo $row['default_value'];?></textarea>
      <br /><br />
        <div id='basic-modal'>
        <a href='#' title="<?php echo $id ?>" class='basic'><img src="<?php echo base_url(); ?>img/edit.png"></a> <a href="delete.php?id=<?php echo $id ?>" onClick="return confirm('Are you sure you want to delete? This action is not reversable')"><img src="<?php echo base_url(); ?>img/cross.png"></a>
        </div>
           <?php
	   }
	    if(trim($row['type'])=='Radio Button')
	   {
		   if($row['required']==1)
		   {
			   $required = 'required';
		   }
		   else
		   {
			   $required = '';
		   }
		   
		   $json = $row['options'];
		
		$myarray=json_decode($json,true);
		$values = $myarray[0];
		
		foreach($values as $key=>$value)
		{
			?>
			
             <input type="radio" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" value="<?php echo $value;?>" <?php echo $required;?> /> <?php echo $key;?>
            
			<?php
		}
		?>
       <br /><br />
        <div id='basic-modal'>
        <a href='#' title="<?php echo $id ?>" class='basic'><img src="<?php echo base_url(); ?>img/edit.png"></a> <a href="delete.php?id=<?php echo $id ?>" onClick="return confirm('Are you sure you want to delete? This action is not reversable')"><img src="<?php echo base_url(); ?>img/cross.png"></a>
        </div> 
           <?php
	   }
	    if(trim($row['type'])=='Checkbox')
	   {
		   if($row['required']==1)
		   {
			   $required = 'required';
		   }
		   else
		   {
			   $required = '';
		   }
		  
		$json = $row['options'];
		
		$myarray=json_decode($json,true);
		$values = $myarray[0];
		
		foreach($values as $key=>$value)
		{
			?>
			
             <input type="checkbox" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" value="<?php echo $value;?>" <?php echo $required;?> /> <?php echo $key;?>
            
			<?php
		}
		?>
		
        
        <br /><br />
        <div id='basic-modal'>
        <a href='#' title="<?php echo $id ?>" class='basic'><img src="<?php echo base_url(); ?>img/edit.png"></a> <a href="delete.php?id=<?php echo $id ?>" onClick="return confirm('Are you sure you want to delete? This action is not reversable')"><img src="<?php echo base_url(); ?>img/cross.png"></a>
        </div>
           <?php
	   }
	    if(trim($row['type'])=='Selectable List')
	   {
		  if($row['required']==1)
		   {
			   $required = 'required';
		   }
		   else
		   {
			   $required = '';
		   }
		    
		$json = $row['options'];
		
		$myarray=json_decode($json,true);
		$values = $myarray[0];
		?>
		<select name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" <?php echo $required;?> class='form-control'>
		<?php
		foreach($values as $key=>$value)
		{
			?>
			<option value="<?php echo $value;?>"><?php echo $key;?></option>
			<?php
		}
		?>
		</select>
         <br /><br />
        <div id='basic-modal'>
        <a href='#' title="<?php echo $id ?>" class='basic'><img src="<?php echo base_url(); ?>img/edit.png"></a> <a href="delete.php?id=<?php echo $id ?>" onClick="return confirm('Are you sure you want to delete? This action is not reversable')"><img src="<?php echo base_url(); ?>img/cross.png"></a>
        </div>
           <?php
	   }
	   if(trim($row['type'])=='File')
	   {
		   if($row['required']==1)
		   {
			   $required = 'required';
		   }
		   else
		   {
			   $required = '';
		   }
		   ?>
           <div class="col-sm-10">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="input-group">
													<div class="form-control" data-trigger="fileinput">
														<i class="glyphicon glyphicon-file fileinput-exists"></i>
														<span class="fileinput-filename"></span>
													</div>
													<span class="input-group-addon btn btn-default btn-file">
														<span class="fileinput-new">Select file</span>
													<span class="fileinput-exists">Change</span>
													<input type="file"  name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" <?php echo $required;?> />
													</span>
													<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												</div>
											</div>
										</div>
        
        <br /><br />
        <div id='basic-modal'>
        <a href='#' title="<?php echo $id ?>" class='basic'><img src="<?php echo base_url(); ?>img/edit.png"></a> <a href="delete.php?id=<?php echo $id ?>" onClick="return confirm('Are you sure you want to delete? This action is not reversable')"><img src="<?php echo base_url(); ?>img/cross.png"></a>
        </div>
           <?php
	   }
	   if(trim($row['type'])=='DatePicker')
	   {
		   if($row['required']==1)
		   {
			   $required = 'required';
		   }
		   else
		   {
			   $required = '';
		   }
		   ?>
        <input type="text" name="element_<?php echo $id ?>" class="form-control datepick" data-date-format="<?php echo $row['default_value'];?>" value="" />  
        <br /><br />
        <div id='basic-modal'>
        <a href='#' title="<?php echo $id ?>"class='basic'><img src="<?php echo base_url(); ?>img/edit.png"></a> <a href="delete.php?id=<?php echo $id ?>" onClick="return confirm('Are you sure you want to delete? This action is not reversable')"><img src="<?php echo base_url(); ?>img/cross.png"></a>
        </div>
           <?php
	   }
	   ?>
      
        <div class="clear"></div>
      </li>
    <?php
    
}
?>
 </ul>
 </div>
 </div>
</td></tr>

</table>
 
 
 
</div>       
      <div class="form-actions col-sm-offset-2 col-sm-10">
						
                        <a href="<?php echo site_url('forms')?>" class="btn btn-success">BACK TO FORM LIST <i class="fa fa-backward"></i></a>
					</div>  
        
                
                
                </div>
		</div>
	</div>
</div>
</div>
</div>
</div>

</body>
</html>
