<?php 
if($_POST)
{
	$email = mHelper::postVariable("email");
	$password = mHelper::postVariable("password");

	if($email=="" and $password=="")
	{
		$returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
		return;
	}
	$c = $db->db->prepare("SELECT * FROM users WHERE email = ?");
	$c->execute(array($email));
	$count = $c->rowCount();
	if($count == 0)
	{
		$returnArray['message'] = "Bu Email Sistemte Kayıtlı Değildir";
		return;
	}

	$w = $db->db->prepare("SELECT * FROM users WHERE email = ?");
	$w->execute(array($email));
	$result = $w->fetch(PDO::FETCH_ASSOC);
	if($result['password'] != md5($password))
	{
		$returnArray['message'] = "Şifreniz Hatalıdır";
		return;
	}

	$returnArray['status'] = true;
	$returnArray['userId'] = $result['id'];
	$returnArray['message'] = "Başarılı Bir Şekilde Giriş Yaptınız";
}


?>
