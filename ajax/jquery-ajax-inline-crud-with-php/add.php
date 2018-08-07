<?php
error_reporting(0);
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["title"])) {
	$title = mysql_real_escape_string(strip_tags($_POST["title"]));
	$description = mysql_real_escape_string(strip_tags($_POST["description"]));
  $sql = "INSERT INTO posts (post_title,description) VALUES ('" . $title . "','" . $description . "')";
  $faq_id = $db_handle->executeInsert($sql);
  
	if(!empty($faq_id)) {
		$sql = "SELECT * from posts WHERE id = '$faq_id' ";
		$posts = $db_handle->runSelectQuery($sql);
	}
	
	
?>
<tr class="table-row" id="table-row-<?php echo $posts[0]["id"]; ?>">
<td contenteditable="true" onBlur="saveToDatabase(this,'post_title','<?php echo $posts[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[0]["post_title"]; ?></td>
<td contenteditable="true" onBlur="saveToDatabase(this,'description','<?php echo $posts[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[0]["description"]; ?></td>
<td><a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[0]["id"]; ?>);">Delete</a></td>
</tr>  
<?php } ?>