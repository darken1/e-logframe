<?php include(APPPATH . 'views/common/head.php'); ?>
<body>
	<div class="row">
				<div class="col-sm-12">
                	<div class="box box-bordered box-color satblue">
                        <div class="box-title">
                            <h3>
                                <i class="fa fa-th-list"></i><?php echo $row->form_name;?>
                            </h3>
                        </div>
                        <div class="box-content nopadding">
                        	<?php $attributes = array('name' => 'frm', 'id'=>'frm','enctype' => 'multipart/form-data', 'class'=>'form-horizontal form-striped form-validate');?>
					<?php echo form_open('',$attributes); ?>
                    
                    <?php
					$str = $row->form_elements;
					$json = json_decode($str, true);
					$values = $json['fields'];
					
					foreach($values as $key=>$value)
					{
						
						if(empty($value['field_options']))
						{
						}
						else
						{
							
							$field_options = $value['field_options'];
							
							if(empty($field_options['options']))
							{
							}
							else
							{
								//print_r($field_options['options']);
								//echo '<br><br>';
								/**
								echo 'Select options:<br>';
								
								$options = $field_options['options'];
								
								foreach($options as $key=>$option)
								{
									echo $option['label'].' '.$option['checked'].'<br>';
								}
								echo '<br><br>';
								**/
								$options = $field_options['options'];
								if($value['field_type']=='dropdown')
								{
									?>
                                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $value['label']; ?></label>
                                            <div class="col-sm-10">
                                    <select name="" id=""  class='form-control'>
                                                 <?php
												 foreach($options as $key=>$option)
												{
													?>
                                                    <option value="<?php echo $option['label'];?>" <?php if($option['checked']==1){ echo 'checked="checked"';}?>><?php echo $option['label'];?></option>
                                                    <?php
													
												}
												 
												 ?>
                                                 
                                                 </select>
                                    <span class="help-block"><?php //echo $row['tool_tip'];?></span>
                                    </div>
                                     </div>
                                    
                                    <?php
									
								}
								
								if($value['field_type']=='radio')
								{
									?>
                                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $value['label']; ?></label>
                                            <div class="col-sm-10">
                                   
                                                 <?php
												 foreach($options as $key=>$option)
												{
													?>
                                                    <input type="radio" name="" id="" value="<?php echo $option['label']?>"  /> <?php echo $option['label']?>
                                                    <?php
													
												}
												 
												 ?>
                                                 
                                                
                                    <span class="help-block"><?php //echo $row['tool_tip'];?></span>
                                    </div>
                                     </div>
                                    
                                    <?php
									
								}
								if($value['field_type']=='checkboxes')
								{
									?>
                                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $value['label']; ?></label>
                                            <div class="col-sm-10">
                                   
                                                 <?php
												 foreach($options as $key=>$option)
												{
													?>
                                                    <input type="checkbox" name="" id="" value="<?php echo $option['label']?>"  /> <?php echo $option['label']?>
                                                    <?php
													
												}
												 
												 ?>
                                                 
                                                
                                    <span class="help-block"><?php //echo $row['tool_tip'];?></span>
                                    </div>
                                     </div>
                                    
                                    <?php
									
								}
					
							}
							
						
					?>
                    <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><?php echo $value['label'];?> <?php if($value['required']==1){ echo '<font color="#FF0000">*</font>';}?></label>
                                            <div class="col-sm-10">
                                            
                                            <?php
											if($value['field_type']=='text')
											{
											?>
                                            <input type="text" name="" id=""  value="" size="" maxlength=""  class='form-control'/>											<?php
											}
											
											if($value['field_type']=='date')
											{
												?>
                                                 <input type="text" name="" class="form-control datepick" data-date-format="yyyy-mm-dd" value="" />
                                                <?php
											}
											
											
											if($value['field_type']=='number')
											{
												?>
                                                 <input type="text" name="" id=""  value="" size="" maxlength=""  class='form-control'/>
                                                <?php
											}
											?>
                                            <span class="help-block">Tool Tip</span>
                                                
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
