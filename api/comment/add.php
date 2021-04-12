<?php 
if($_POST)
{
	$userid = mHelper::postIntegerVariable('userid');
	$postid = mHelper::postIntegerVariable('postid');
	$text = mHelper::postVariable('text');
	if($text == "")
	{
		$returnArray['message'] = "Text Alanı Boş Bırakılamaz";
		return;
	}
	$c = $db->db->prepare("SELECT * FROM posts WHERE id = ?");
	$c->execute(array($postid));
	$count = $c->rowCount();
	if($count == 0)
	{
		$returnArray['message'] = "Böyle Bir Yazı Yok";
		return;
	}
	$data = date("Y-m-d");
	$insert = $db->db->prepare("INSERT INTO comments(userid,postid,text,date) value (?,?,?,?)");
	$insertResult = $insert->execute(array($userid,$postid,$text,$date));
	if($insertResult)
	{
		$returnArray['message'] = "Yorum Başarı ile Eklendi";
		$returnArray['status'] = true;
 	}
 	else
 	{
 		$returnArray['message'] = "Yorum Eklenemedi";
 	}
}
?>
