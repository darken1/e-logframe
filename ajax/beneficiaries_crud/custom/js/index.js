// global the manage memeber table 
var manageMemberTable;

$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
		"ajax": "php_action/retrieve.php",
		"order": []
	});

	$("#addMemberModalBtn").on('click', function() {
		// reset the form 
		$("#createMemberForm")[0].reset();
		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".messages").html("");

		// submit form
		$("#createMemberForm").unbind('submit').bind('submit', function() {

			$(".text-danger").remove();

			var form = $(this);

			// validation
			var id_no = $("#id_no").val();
			var name_of_beneficiary = $("#name_of_beneficiary").val();
			var mothers_name = $("#mothers_name").val();
			var next_of_kin = $("#next_of_kin").val();
			var sex = $("#sex").val();
			var district = $("#district").val();
			var settlement = $("#settlement").val();
			var telephone_number = $("#telephone_number").val();
			var zero_to_four_female = $("#zero_to_four_female").val();
			var zero_to_four_male = $("#zero_to_four_male").val();
			var five_to_seventeen_female = $("#five_to_seventeen_female").val();
			var five_to_seventeen_male = $("#five_to_seventeen_male").val();
			var eighteen_to_fifty_nine_female = $("#eighteen_to_fifty_nine_female").val();
			var eighteen_to_fifty_nine_male = $("#eighteen_to_fifty_nine_male").val();
			var sixty_above_female = $("#sixty_above_female").val();
			var sixty_above_male = $("#sixty_above_male").val();
			var programme_area = $("#programme_area").val();
			var donor = $("#donor").val();
			var registration_month = $("#registration_month").val();
			var registration_date = $("#registration_date").val();
			var project_number = $("#project_number").val();

			if(id_no == "") {
				$("#id_no").closest('.form-group').addClass('has-error');
				$("#id_no").after('<p class="text-danger">The ID No. field is required</p>');
			} else {
				$("#id_no").closest('.form-group').removeClass('has-error');
				$("#id_no").closest('.form-group').addClass('has-success');				
			}

			if(name_of_beneficiary == "") {
				$("#name_of_beneficiary").closest('.form-group').addClass('has-error');
				$("#name_of_beneficiary").after('<p class="text-danger">The name of beneficiary field is required</p>');
			} else {
				$("#name_of_beneficiary").closest('.form-group').removeClass('has-error');
				$("#name_of_beneficiary").closest('.form-group').addClass('has-success');				
			}

			if(mothers_name == "") {
				$("#mothers_name").closest('.form-group').addClass('has-error');
				$("#mothers_name").after('<p class="text-danger">The mothers name field is required</p>');
			} else {
				$("#mothers_name").closest('.form-group').removeClass('has-error');
				$("#mothers_name").closest('.form-group').addClass('has-success');				
			}

			if(sex == "") {
				$("#sex").closest('.form-group').addClass('has-error');
				$("#sex").after('<p class="text-danger">The Sex field is required</p>');
			} else {
				$("#sex").closest('.form-group').removeClass('has-error');
				$("#sex").closest('.form-group').addClass('has-success');				
			}

			if(id_no && name_of_beneficiary && mothers_name && sex) {
				//submi the form to server
				$.ajax({
					url : form.attr('action'),
					type : form.attr('method'),
					data : form.serialize(),
					dataType : 'json',
					success:function(response) {

						// remove the error 
						$(".form-group").removeClass('has-error').removeClass('has-success');

						if(response.success == true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// reset the form
							$("#createMemberForm")[0].reset();		

							// reload the datatables
							manageMemberTable.ajax.reload(null, false);
							// this function is built in function of datatables;

						} else {
							$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
						}  // /else
					} // success  
				}); // ajax subit 				
			} /// if


			return false;
		}); // /submit form for create member
	}); // /add modal

});

function removeMember(id = null) {
	if(id) {
		// click on remove button
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'php_action/remove.php',
				type: 'post',
				data: {member_id : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {						
						$(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

						// refresh the table
						manageMemberTable.ajax.reload(null, false);

						// close the modal
						$("#removeMemberModal").modal('hide');

					} else {
						$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
					}
				}
			});
		}); // click remove btn
	} else {
		alert('Error: Refresh the page again');
	}
}

function editMember(id = null) {
	if(id) {

		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");

		// remove the id
		$("#member_id").remove();

		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedMember.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {
				$("#Editid_no").val(response.id_no);

				$("#Editname_of_beneficiary").val(response.name_of_beneficiary);

				$("#Editmothers_name").val(response.mothers_name);

				$("#Editsex").val(response.sex);
				
				$("#Editdistrict").val(response.district);
				
				$("#Editsettlement").val(response.settlement);
				
				$("#Edittelephone_number").val(response.telephone_number);
				
				$("#Editzero_to_four_female").val(response.zero_to_four_female);
				
				$("#Editzero_to_four_male").val(response.zero_to_four_male);
				
				$("#Editfive_to_seventeen_female").val(response.five_to_seventeen_female);
				
				$("#Editfive_to_seventeen_male").val(response.five_to_seventeen_male);
				
				$("#Editeighteen_to_fifty_nine_female").val(response.eighteen_to_fifty_nine_female);
				
				$("#Editeighteen_to_fifty_nine_male").val(response.eighteen_to_fifty_nine_male);
				
				$("#Editsixty_above_female").val(response.sixty_above_female);
				
				$("#Editsixty_above_male").val(response.sixty_above_male);
				
				$("#Editprogramme_area").val(response.programme_area);
				
				$("#Editdonor").val(response.donor);
				
				$("#Editregistration_month").val(response.registration_month);
				
				$("#Editregistration_date").val(response.registration_date);
				
				$("#Editproject_number").val(response.registration_date);

				// mmeber id 
				$(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updateMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var Editid_no = $("#Editid_no").val();
					var Editname_of_beneficiary = $("#Editname_of_beneficiary").val();
					var Editmothers_name = $("#Editmothers_name").val();
					var Editsex = $("#Editsex").val();
					var Editdistrict = $("#Editdistrict").val();
					var Editsettlement = $("#Editsettlement").val();
					var Edittelephone_number = $("#Edittelephone_number").val();
					var Editzero_to_four_female = $("#Editzero_to_four_female").val();
					var Editzero_to_four_male = $("#Editzero_to_four_male").val();
					var Editfive_to_seventeen_female = $("#Editfive_to_seventeen_female").val();
					var Editfive_to_seventeen_male = $("#Editfive_to_seventeen_male").val();
					var Editeighteen_to_fifty_nine_female = $("#Editeighteen_to_fifty_nine_female").val();
					var Editeighteen_to_fifty_nine_male = $("#Editeighteen_to_fifty_nine_male").val();
					var Editsixty_above_female = $("#Editsixty_above_female").val();
					var Editsixty_above_male = $("#Editsixty_above_male").val();
					var Editprogramme_area = $("#Editprogramme_area").val();
					var Editdonor = $("#Editdonor").val();
					var Editregistration_month = $("#Editregistration_month").val();
					var Editregistration_date = $("#Editregistration_date").val();
					var Editproject_number = $("#Editproject_number").val();

					if(Editid_no == "") {
						$("#Editid_no").closest('.form-group').addClass('has-error');
						$("#Editid_no").after('<p class="text-danger">The id number field is required</p>');
					} else {
						$("#Editid_no").closest('.form-group').removeClass('has-error');
						$("#Editid_no").closest('.form-group').addClass('has-success');				
					}

					if(Editname_of_beneficiary == "") {
						$("#Editname_of_beneficiary").closest('.form-group').addClass('has-error');
						$("#Editname_of_beneficiary").after('<p class="text-danger">The name of beneficiary field is required</p>');
					} else {
						$("#editAddress").closest('.form-group').removeClass('has-error');
						$("#editAddress").closest('.form-group').addClass('has-success');				
					}

					if(Editsex == "") {
						$("#Editsex").closest('.form-group').addClass('has-error');
						$("#Editsex").after('<p class="text-danger">The sex field is required</p>');
					} else {
						$("#Editsex").closest('.form-group').removeClass('has-error');
						$("#Editsex").closest('.form-group').addClass('has-success');				
					}

					if(Editmothers_name == "") {
						$("#Editmothers_name").closest('.form-group').addClass('has-error');
						$("#Editmothers_name").after('<p class="text-danger">The mothers name field is required</p>');
					} else {
						$("#Editmothers_name").closest('.form-group').removeClass('has-error');
						$("#Editmothers_name").closest('.form-group').addClass('has-success');				
					}

					if(editName && editAddress && editContact && editActive) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {
									$(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
									'</div>');

									// reload the datatables
									manageMemberTable.ajax.reload(null, false);
									// this function is built in function of datatables;

									// remove the error 
									$(".form-group").removeClass('has-success').removeClass('has-error');
									$(".text-danger").remove();
								} else {
									$(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>')
								}
							} // /success
						}); // /ajax
					} // /if

					return false;
				});

			} // /success
		}); // /fetch selected member info

	} else {
		alert("Error : Refresh the page again");
	}
}