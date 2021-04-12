<?php 
$post_id = mHelper::getIntegerVariable('post_id');
$c = $db->db->prepare("SELECT * FROM posts WHERE id = ?");
$c->execute(array($post_id));
$count = $c->rowCount();
if($count == 0)
{
	$returnArray['message'] = "Böyle Bir Post Bulunamadı";
	return;
}
$data = $c->fetch(PDO::FETCH_ASSOC);
$returnArray['data'] = $data;
$returnArray['status'] = true;
?>
