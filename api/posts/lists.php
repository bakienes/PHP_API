<?php 
$category_id = mHelper::getIntegerVariable("category_id");
$c = $db->db->prepare("SELECT * FROM category WHERE id = ?");
$c->execute(array($category_id));
$count = $c->rowCount();
if($count == 0)
{
	$returnArray['message'] = "Böyle Bir Kategori Yok";
	return;
}
$list = $db->db->prepare("SELECT * FROM posts WHERE categoryId = ?");
$list->execute(array($category_id));
$result = $list->fetchAll(PDO::FETCH_ASSOC);
$returnArray['status'] = true;
$returnArray['data'] = $result;
?>
