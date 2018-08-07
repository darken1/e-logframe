<?php 

require_once 'db_connect.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$id = $_POST['member_id'];
	$id_no = $_POST['id_no'];
               $name_of_beneficiary = $_POST['name_of_beneficiary'];
               $mothers_name = $_POST['mothers_name'];
               $next_of_kin = $_POST['next_of_kin'];
               $sex = $_POST['sex'];
               $district = $_POST['district'];
               $settlement = $_POST['settlement'];
               $telephone_number = $_POST['telephone_number'];
               $zero_to_four_female = $_POST['zero_to_four_female'];
               $zero_to_four_male = $_POST['zero_to_four_male'];
               $five_to_seventeen_female = $_POST['five_to_seventeen_female'];
               $five_to_seventeen_male = $_POST['five_to_seventeen_male'];
               $eighteen_to_fifty_nine_female = $_POST['eighteen_to_fifty_nine_female'];
               $eighteen_to_fifty_nine_male = $_POST['eighteen_to_fifty_nine_male'];
               $sixty_above_female = $_POST['sixty_above_female'];
               $sixty_above_male = $_POST['sixty_above_male'];
               $total_family_size = $_POST['total_family_size'];
               $programme_area = $_POST['programme_area'];
               $donor = $_POST['donor'];
               $registration_month = $_POST['registration_month'];
               $registration_date = $_POST['registration_date'];
               $project_number = $_POST['project_number'];

	$sql = "UPDATE beneficiaryregistration SET id_no = '$id_no', name_of_beneficiary = '$name_of_beneficiary', next_of_kin = '$next_of_kin', sex = '$sex', district = '$district', settlement = '$settlement', telephone_number = '$telephone_number', zero_to_four_female = '$zero_to_four_female', zero_to_four_male = '$zero_to_four_male', five_to_seventeen_female = '$five_to_seventeen_female', five_to_seventeen_male = '$five_to_seventeen_male', eighteen_to_fifty_nine_female = '$eighteen_to_fifty_nine_female', eighteen_to_fifty_nine_male = '$eighteen_to_fifty_nine_male', sixty_above_female = '$sixty_above_female', sixty_above_male = '$sixty_above_male', total_family_size = '$total_family_size', programme_area = '$programme_area', donor = '$donor', registration_month = '$registration_month', registration_date = '$registration_date', project_number = '$project_number' WHERE id = $id";
	$query = $connect->query($sql);

	if($query === TRUE) {			
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";		
	} else {		
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the member information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}