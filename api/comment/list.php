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
$list = $db->db->prepare("SELECT * FROM comments WHERE postid = ?");
$list->execute(array($post_id));
$result = $list->fectAll(PDO::FETCH_ASSOC);
$returnDataArray = [];
foreach ($result as $key => $value) 
{
	$user = $db->db->prepare("SELECT * FROM users WHERE id = ?");
	$user->execute(array($value['userid']));
	$userInfo = $user->fetch(PDO::FETCH_ASSOC);
	$returnDataArray[$key]['id'] = $value['id'];
	$returnDataArray[$key]['postid'] = $value['postid'];
	$returnDataArray[$key]['user'] = $userInfo['name']." ".$userInfo['surname'];
	$returnDataArray[$key]['text'] = $value['text'];
	$returnDataArray[$key]['date'] = $value['date'];
}
$returnArray['status'] = true;
$returnArray['data'] = $returnDataArray;
?>
