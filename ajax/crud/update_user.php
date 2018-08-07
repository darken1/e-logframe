<?php

$id = $_REQUEST['id'];
$id_no = $_REQUEST['id_no'];
$name_of_beneficiary = $_REQUEST['name_of_beneficiary'];
$mothers_name = $_REQUEST['mothers_name'];
$next_of_kin = $_REQUEST['next_of_kin'];
$sex = $_REQUEST['sex'];
$district = $_REQUEST['district'];
$settlement = $_REQUEST['settlement'];
$telephone_number = $_REQUEST['telephone_number'];
$zero_to_four_female = $_REQUEST['zero_to_four_female'];
$zero_to_four_male = $_REQUEST['zero_to_four_male'];
$five_to_seventeen_female = $_REQUEST['five_to_seventeen_female'];
$five_to_seventeen_male = $_REQUEST['five_to_seventeen_male'];
$eighteen_to_fifty_nine_female = $_REQUEST['eighteen_to_fifty_nine_female'];
$eighteen_to_fifty_nine_male = $_REQUEST['eighteen_to_fifty_nine_male'];
$sixty_above_female = $_REQUEST['sixty_above_female'];
$sixty_above_male = $_REQUEST['sixty_above_male'];
$total_family_size = $_REQUEST['total_family_size'];
$programme_area = $_REQUEST['programme_area'];
$donor = $_REQUEST['donor'];
$registration_month = date('M');
$registration_date = date('Y-m-d');
$project_number = $_REQUEST['project_number'];

include 'conn.php';

$sql = "UPDATE `beneficiaryregistration` SET  `id_no` =  '$id_no',
`name_of_beneficiary` =  '$name_of_beneficiary',
`mothers_name` =  '$mothers_name',
`next_of_kin` =  '$next_of_kin',
`sex` =  '$sex',
`district` =  '$district',
`settlement` =  '$settlement',
`telephone_number` =  '$telephone_number',
`zero_to_four_female` =  '$zero_to_four_female',
`zero_to_four_male` =  '$zero_to_four_male',
`five_to_seventeen_female` =  '$five_to_seventeen_female',
`five_to_seventeen_male` =  '$five_to_seventeen_male',
`eighteen_to_fifty_nine_female` =  '$eighteen_to_fifty_nine_female',
`eighteen_to_fifty_nine_male` =  '$eighteen_to_fifty_nine_male',
`sixty_above_female` =  '$sixty_above_female',
`sixty_above_male` =  '$sixty_above_male',
`total_family_size` =  '$total_family_size' WHERE  `beneficiaryregistration`.`id` =$id;";

@mysql_query($sql);
echo json_encode(array(
	'id' => $id,
	'id_no' => $id_no,
'name_of_beneficiary' => $name_of_beneficiary,
'mothers_name' => $mothers_name,
'next_of_kin' => $next_of_kin,
'sex' => $sex,
'district' => $district,
'settlement' => $settlement,
'telephone_number' => $telephone_number,
'zero_to_four_female' => $zero_to_four_female,
'zero_to_four_male' => $zero_to_four_male,
'five_to_seventeen_female' => $five_to_seventeen_female,
'five_to_seventeen_male' => $five_to_seventeen_male,
'eighteen_to_fifty_nine_female' => $eighteen_to_fifty_nine_female,
'eighteen_to_fifty_nine_male' => $eighteen_to_fifty_nine_male,
'sixty_above_female' => $sixty_above_female,
'sixty_above_male' => $sixty_above_male,
'total_family_size' => $total_family_size,
'project_number' => $project_number
));

/**

UPDATE  `drcdbase`.`beneficiaryregistration` SET  `id_no` =  '231542',
`name_of_beneficiary` =  'Abdi Ahmed Salim',
`mothers_name` =  'Fatiah Salim Bughari',
`next_of_kin` =  'Mohamend Ahmed
Fatiah Salim Bughari',
`sex` =  'Female',
`district` =  'Sanaag',
`settlement` =  'Hargeisa Region',
`telephone_number` =  '123256',
`zero_to_four_female` =  '2',
`zero_to_four_male` =  '1',
`five_to_seventeen_female` =  '1',
`five_to_seventeen_male` =  '1',
`eighteen_to_fifty_nine_female` =  '1',
`eighteen_to_fifty_nine_male` =  '1',
`sixty_above_female` =  '1',
`sixty_above_male` =  '1',
`total_family_size` =  '6',
`programme_area` =  'xx',
`donor` =  'xx',
`registration_month` =  'Jul',
`registration_date` =  '2016-07-09' WHERE  `beneficiaryregistration`.`id` =18;
**/
?>