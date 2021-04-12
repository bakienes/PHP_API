<?php
	if($_POST)
	{
		$name = mHelper::postVariable("name");
		$surname = mHelper::postVariable("surname");
		$email = mHelper::postVariable("email");
		$password = mHelper::postVariable("password");
		$gender = mHelper::postVariable("gender");

		if($name!="" and $surname!="" and $email!="" and $password!="")
		{
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$returnArray['message'] = "Email Formatı Hatalı";
			return;
		}
		}
		$c= $db->$db->prepare("SELECT * FROM users WHERE email = ?");
		$c->execute(array($email));
		$count = $c->rowCount();
		if($count!=0)
		{
			$returnArray['message'] = "Bu Email Kullanımda";
			return;
		}
		$password = md5($password);
		$date = date("Y-m-d");
		$eklemeSorgu = $db->db->prepare("INSERT INTO users(name,surname,email,password,gender,date) values(?,?,?,?,?,?)");
		$result = $eklemeSorgu->execute(array($name,$surname,$email,$password,$gender,$date));
		if($result)
		{
			$returnArray['status'] = true;
			$returnArray['userId'] = $db->db->lastInsertId();
			$returnArray['message'] = "Kullanıcı Başarı İle Eklendi";
		}
		else
		{
			$returnArray['message'] = "Kullanıcı Eklenemedi";
		}
	}
	else
	{
		die("Post İşlemi Yapılmamış");
	}
?>
