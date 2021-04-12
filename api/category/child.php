<?php 
$parent_id = mHelper::getIntegerVariable($_GET['parent_id']);
$c = $db->db->prepare("SELECT * FROM category WHERE id = ?");
$c->execute(array($parent_id));
$count = $c->rowCount();
if($count == 0)
{
	$returnArray['message'] = "Böyle Bir Kategori Yok"
}
$sorgu = $db->db->prepare("SELECT * FROM category WHERE parent_id = ?");
$sorgu->execute(array($parent_id));
$result = $sorgu->fetchAll(PDO::FETCH_ASSOC);
$returnArray['status'] = true;
$returnArray['data'] = $result;

?>
