<?php include(APPPATH . 'views/common/head.php'); ?>
<body>
	<div class="row">
				<div class="col-sm-12">
                	<div class="box box-bordered box-color satblue">
                        <div class="box-title">
                            <h3>
                                <i class="fa fa-th-list"></i><?php echo $form->form_name;?>
                            </h3>
                        </div>
                        <div class="box-content nopadding">
                        	<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('',$attributes); ?>
                            <?php 
                            foreach($formelements as $key=>$row)
                            {
                                
                                $id = stripslashes($row['id']);
                                
                              
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
                                       <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $row['label']; ?></label>
                                            <div class="col-sm-10">
                                            <input type="text" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>"  value="<?php echo $row['default_value'];?>" size="<?php echo $row['size'];?>" maxlength="<?php echo $row['max_length'];?>" <?php echo $required;?> class='form-control'/>
                                            <span class="help-block"><?php echo $row['tool_tip'];?></span>
                                                
                                            </div>
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
                                         <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $row['label']; ?></label>
                                            <div class="col-sm-10">
                                           <textarea cols="<?php echo $row['cols'];?>" rows="<?php echo $row['rows'];?>" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" <?php echo $required;?> class='form-control'> <?php echo $row['default_value'];?></textarea>
                                                <span class="help-block"><?php echo $row['tool_tip'];?></span>
                                            </div>
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
									?>
                                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $row['label']; ?></label>
                                            <div class="col-sm-10">
                                    <?php
                                    
                                    foreach($values as $key=>$value)
                                    {
                                        ?>
                                        
                                         <input type="radio" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" value="<?php echo $value;?>" <?php echo $required;?> /> <?php echo $key;?>
                                        
                                        <?php
                                    }
                                    ?>
                                    <span class="help-block"><?php echo $row['tool_tip'];?></span>
                                     </div>
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
										?>
                                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $row['label']; ?></label>
                                            <div class="col-sm-10">
                                    <?php
                                    
                                    foreach($values as $key=>$value)
                                    {
                                        ?>
                                        
                                         <input type="checkbox" name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" value="<?php echo $value;?>" <?php echo $required;?> /> <?php echo $key;?>
                                        
                                        <?php
                                    }
                                    ?>
                                    <span class="help-block"><?php echo $row['tool_tip'];?></span>
                                    </div>
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
                                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $row['label']; ?></label>
                                            <div class="col-sm-10">
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
                                    <span class="help-block"><?php echo $row['tool_tip'];?></span>
                                     </div>
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
                                       
                                       <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $row['label']; ?></label>
                                            <div class="col-sm-10">
                                             <input type="file"  name="element_<?php echo $id ?>" id="element_<?php echo $id ?>" <?php echo $required;?> class="form-control"/>
                                                <span class="help-block"><?php echo $row['tool_tip'];?></span>
                                            </div>
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
                                       <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $row['label']; ?></label>
                                            <div class="col-sm-10">
                                                   <input type="text" name="element_<?php echo $id ?>" class="form-control datepick" data-date-format="<?php echo $row['default_value'];?>" value="" />
                                                   <span class="help-block"><?php echo $row['tool_tip'];?></span>
                                            </div>
                                        </div>
                                   
                                   
                                       <?php
                                   }
                                 
                                
                            }
                            ?>
                           
                     <div class="form-actions col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">SAVE ENTRY</button>
					</div>
                          <?php echo form_close(); ?>   
                             
                        </div>
                        
                	</div>
                </div>
                
     </div>		

</body>
</html>
