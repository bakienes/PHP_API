<?php 
$id = intval($_GET['id']);
$c = $db->db->prepare('SELECT * FROM users WHERE id = ?');
$c->execute(array($id));
$count = $c->rowCount();
if($count == 0)
{
	$returnArray['message'] = "Böyle Bir Kullanıcı Bulunamadı";
	return;
}
$w = $db->db->prepare('SELECT * FROM users WHERE id = ?');
$w->execute(array($id));
$result = $w->fetch(PDO::FETCH_ASSOC);
$returnArray['data'] = $result;
$returnArray['status'] = true;
?>
