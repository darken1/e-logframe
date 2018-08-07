<!DOCTYPE html>
<html>
<head>
	<title>CRUD SYSTEM</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- datatables css -->
	<link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<center><h1 class="page-header">CRUD System <small>DataTables</small> </h1> </center>

				<div class="removeMessages"></div>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Member
				</button>

				<br /> <br /> <br />

				<table class="table" id="manageMemberTable">					
					<thead>
						<tr>
							<th>#</th>
							<th>ID #</th>													
							<th>Name</th>
							<th>Sex</th>								
							<th>District</th>
                            <th>Settlement</th>
                            <th>Telephone Number</th>
                            <th>Registration Date</th>
							<th>Option</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<!-- add modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addMember">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Member</h4>
	      </div>
	      
	      <form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">

	      <div class="modal-body">
	      	<div class="messages"></div>

			  <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Id no</label>
				<div class="col-sm-10">
					<input type="text" name="id_no" value="" id="id_no" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Name of beneficiary</label>
				<div class="col-sm-10">
					<input type="text" name="name_of_beneficiary" value="" id="name_of_beneficiary" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Mothers name</label>
				<div class="col-sm-10">
					<input type="text" name="mothers_name" value="" id="mothers_name" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Next of kin</label>
				<div class="col-sm-10">
					<input type="text" name="next_of_kin" value="" id="next_of_kin" class="form-control"   />
                    
                    		</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sex</label>
				<div class="col-sm-10">
					<input type="text" name="sex" value="" id="sex" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">District</label>
				<div class="col-sm-10">
					<input type="text" name="district" value="" id="district" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Settlement</label>
				<div class="col-sm-10">
					<input type="text" name="settlement" value="" id="settlement" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Telephone number</label>
				<div class="col-sm-10">
					<input type="text" name="telephone_number" value="" id="telephone_number" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Zero to four female</label>
				<div class="col-sm-10">
					<input type="text" name="zero_to_four_female" value="" id="zero_to_four_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Zero to four male</label>
				<div class="col-sm-10">
					<input type="text" name="zero_to_four_male" value="" id="zero_to_four_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen female</label>
				<div class="col-sm-10">
					<input type="text" name="five_to_seventeen_female" value="" id="five_to_seventeen_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen male</label>
				<div class="col-sm-10">
					<input type="text" name="five_to_seventeen_male" value="" id="five_to_seventeen_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine female</label>
				<div class="col-sm-10">
					<input type="text" name="eighteen_to_fifty_nine_female" value="" id="eighteen_to_fifty_nine_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine male</label>
				<div class="col-sm-10">
					<input type="text" name="eighteen_to_fifty_nine_male" value="" id="eighteen_to_fifty_nine_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above female</label>
				<div class="col-sm-10">

					<input type="text" name="sixty_above_female" value="" id="sixty_above_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above male</label>
				<div class="col-sm-10">
					<input type="text" name="sixty_above_male" value="" id="sixty_above_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Total family size</label>
				<div class="col-sm-10">
					<input type="text" name="total_family_size" value="" id="total_family_size" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Programme area</label>
				<div class="col-sm-10">
					<input type="text" name="programme_area" value="" id="programme_area" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Donor</label>
				<div class="col-sm-10">
					<input type="text" name="donor" value="" id="donor" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Registration month</label>
				<div class="col-sm-10">
					<input type="text" name="registration_month" value="" id="registration_month" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Registration date</label>
				<div class="col-sm-10">
					<input type="text" name="registration_date" value="" id="registration_date" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project number</label>
				<div class="col-sm-10">
					<input type="text" name="project_number" value="" id="project_number" class="form-control"   />				</div>
			</div>		 		

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form> 
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /add modal -->

	<!-- remove modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove Member</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to remove ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="removeBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /remove modal -->

	<!-- edit modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editMemberModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Member</h4>
	      </div>

		<form class="form-horizontal" action="php_action/update.php" method="POST" id="updateMemberForm">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			  <div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Id no</label>
				<div class="col-sm-10">
					<input type="text" name="id_no" id="Editid_no" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Name of beneficiary</label>
				<div class="col-sm-10">
					<input type="text" name="name_of_beneficiary"  id="Editname_of_beneficiary" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Mothers name</label>
				<div class="col-sm-10">
					<input type="text" name="mothers_name"  id="Editmothers_name" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Next of kin</label>
				<div class="col-sm-10">
					<textarea name="next_of_kin" cols="90" rows="12" id="next_of_kin" class="form-control"  ></textarea>				</div>
			</div>
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sex</label>
				<div class="col-sm-10">
					<input type="text" name="sex"  id="Editsex" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">District</label>
				<div class="col-sm-10">
					<input type="text" name="district"  id="Editdistrict" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Settlement</label>
				<div class="col-sm-10">
					<input type="text" name="settlement"  id="Editsettlement" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Telephone number</label>
				<div class="col-sm-10">
					<input type="text" name="telephone_number"  id="Edittelephone_number" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Zero to four female</label>
				<div class="col-sm-10">
					<input type="text" name="zero_to_four_female"  id="Editzero_to_four_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Zero to four male</label>
				<div class="col-sm-10">
					<input type="text" name="zero_to_four_male"  id="Editzero_to_four_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen female</label>
				<div class="col-sm-10">
					<input type="text" name="five_to_seventeen_female"  id="Editfive_to_seventeen_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Five to seventeen male</label>
				<div class="col-sm-10">
					<input type="text" name="five_to_seventeen_male"  id="Editfive_to_seventeen_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine female</label>
				<div class="col-sm-10">
					<input type="text" name="eighteen_to_fifty_nine_female"  id="Editeighteen_to_fifty_nine_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Eighteen to fifty nine male</label>
				<div class="col-sm-10">
					<input type="text" name="eighteen_to_fifty_nine_male"  id="Editeighteen_to_fifty_nine_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above female</label>
				<div class="col-sm-10">

					<input type="text" name="sixty_above_female"  id="Editsixty_above_female" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Sixty above male</label>
				<div class="col-sm-10">
					<input type="text" name="sixty_above_male"  id="Editsixty_above_male" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Total family size</label>
				<div class="col-sm-10">
					<input type="text" name="total_family_size"  id="Edittotal_family_size" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Programme area</label>
				<div class="col-sm-10">
					<input type="text" name="programme_area"  id="Editprogramme_area" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Donor</label>
				<div class="col-sm-10">
					<input type="text" name="donor"  id="Editdonor" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Registration month</label>
				<div class="col-sm-10">
					<input type="text" name="registration_month"  id="Editregistration_month" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Registration date</label>
				<div class="col-sm-10">
					<input type="text" name="registration_date"  id="Editregistration_date" class="form-control"   />				</div>
			</div>

			<div class="form-group">
				<label for="textfield" class="control-label col-sm-2">Project number</label>
				<div class="col-sm-10">
					<input type="text" name="project_number"  id="Editproject_number" class="form-control"   />				</div>
			</div>	
	      </div>
	      <div class="modal-footer editMemberModal">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->

	<!-- jquery plugin -->
	<script type="text/javascript" src="assests/jquery/jquery.min.js"></script>
	<!-- bootstrap js -->
	<script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script>
	<!-- datatables js -->
	<script type="text/javascript" src="assests/datatables/datatables.min.js"></script>
	<!-- include custom index.js -->
	<script type="text/javascript" src="custom/js/index.js"></script>

</body>
</html>