
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