<?php
include('connect.php');
include('functions.php');
$query = '';
$output = array();
$query .= "SELECT * FROM beneficiaryregistration ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE name_of_beneficiary LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR mothers_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}

echo $query;

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	/**
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	
	**/
	$sub_array = array();
	//$sub_array[] = $image;
	$sub_array[] = $row["id_no"];
	$sub_array[] = $row["name_of_beneficiary"];
	$sub_array[] = $row["mothers_name"];
	$sub_array[] = $row["sex"];
	$sub_array[] = $row["district"];
	$sub_array[] = $row["settlement"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
	
	
}


$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>