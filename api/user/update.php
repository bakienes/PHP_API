<?php 
if($_POST)
{
	$id = mHelper::postIntegerVeriable("id");
	$name = mHelper::postIntegerVeriable("name");
	$surname = mHelper::postIntegerVeriable("surname");
	$email = mHelper::postIntegerVeriable("email");
	$password = mHelper::postIntegerVeriable("password");
	$gender = mHelper::postIntegerVeriable("gender");

	if($name=="" and $surname=="" and $email=="")
	{
		$returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
		return;
	}
	$c = $db->db->prepare("SELECT * FROM users WHERE id = ?");
	$c->execute(array($id));
	$count = $c->rowCount();
	if($count == 0)
	{
		$returnArray['message'] = "Böyle Bir Kullanıcı Yok";
		return;
	}
	$cEmail = $db->db->prepare("SELECT * FROM users WHERE id != ? and email = ?");
	$cEmail->execute(array($id,$email));
	$countEmail = $cEmail->rowCount();
	if($countEmail !=0)
	{
		$returnArray['message'] = "Bu Email Kullanımda";
	}
	$w = $db->db->prepare("SELECT * FROM users WHERE id = ?");
	$w->execute(array(($id));
	$result = $w->fetch(PDO::FETCH_ASSOC);
	if($password == "")
	{
		$password = $result['password'];
	}
	else
	{
		$password = md5($result['password']);
	}
	$update = $db->db->prepare("UPDATE users SET name = ?, surname = ?, email = ?, password = ?, gender = ? WHERE id = ?");
	$updateResult = update->execute(array($name,$surname,$email,$password,$gender,$id));
	if($updateResult)
	{
		$returnArray['status'] = true;
		$returnArray['message'] = "Bilgiler Başarı İle Güncellendi";
	}
	else
	{
		$returnArray['message'] = "Bilgiler Güncellenemedi";
	}
}

?>
