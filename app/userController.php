<?php 
class userController extends Controller
{
	public function store()
	{
		if($_POST)
	{
		$returnArray = [];
		$returnArray['status'] = false;
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
		$c= $this->$db->prepare("SELECT * FROM users WHERE email = ?");
		$c->execute(array($email));
		$count = $c->rowCount();
		if($count!=0)
		{
			$returnArray['message'] = "Bu Email Kullanımda";
			return;
		}
		$password = md5($password);
		$date = date("Y-m-d");
		$eklemeSorgu = $this->db->prepare("INSERT INTO users(name,surname,email,password,gender,date) values(?,?,?,?,?,?)");
		$result = $eklemeSorgu->execute(array($name,$surname,$email,$password,$gender,$date));
		if($result)
		{
			$returnArray['status'] = true;
			$returnArray['userId'] = $this->db->lastInsertId();
			$returnArray['message'] = "Kullanıcı Başarı İle Eklendi";
		}
		else
		{
			$returnArray['message'] = "Kullanıcı Eklenemedi";
		}
		echo json_encode($returnArray);
	}
	else
	{
		die("Post İşlemi Yapılmamış");
	}
	}
	public function info($id)
	{	
		$returnArray = [];
		$returnArray['status'] = false;
		$c = $this->db->prepare('SELECT * FROM users WHERE id = ?');
		$c->execute(array($id));
		$count = $c->rowCount();
		if($count == 0)
		{
			$returnArray['message'] = "Böyle Bir Kullanıcı Bulunamadı";
		}
		$w = $this->db->prepare('SELECT * FROM users WHERE id = ?');
		$w->execute(array($id));
		$result = $w->fetch(PDO::FETCH_ASSOC);
		$returnArray['data'] = $result;
		$returnArray['status'] = true;
		echo json_encode($returnArray);
	}
	public function login()
	{
		if($_POST)
		{
			$returnArray = [];
			$returnArray['status'] = false;
			$email = mHelper::postVariable("email");
			$password = mHelper::postVariable("password");
			if($email=="" and $password=="")
			{
				$returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
				return;
			}
			$c = $this->db->prepare("SELECT * FROM users WHERE email = ?");
			$c->execute(array($email));
			$count = $c->rowCount();
			if($count == 0)
			{
				$returnArray['message'] = "Bu Email Sistemde Kayıtlı Değil";
				return;
			}
			$w = $this->db->prepare("SELECT * FROM users WHERE email = ?");
			$w->execute(array($email));
			$result = $w->fetch(PDO::FETCH_ASSOC);
			if($result['password'] != md5($password))
			{
				$returnArray['message'] = "Şifreniz Hatalı";
				return;
			}
			$returnArray['status'] = true;
			$returnArray['userId'] = $result['id'];
			$returnArray['message'] = "Başarılı Bir Şekilde Giriş Yaptınız";
			echo json_encode($returnArray);
			}
		}
	public function update()
	{
		if($_POST)
	{
		$returnArray = [];
		$returnArray['status'] = false;
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
		$c = $this->db->prepare("SELECT * FROM users WHERE id = ?");
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
		$w = $this->db->prepare("SELECT * FROM users WHERE id = ?");
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
		$update = $this->db->prepare("UPDATE users SET name = ?, surname = ?, email = ?, password = ?, gender = ? WHERE id = ?");
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
		echo json_encode($returnArray);	
	}
}
?>
