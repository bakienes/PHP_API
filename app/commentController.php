<?php 
class commentController extends Controller
{
	public function store()
	{
		$returnArray = [];
		$returnArray['status'] = false;	
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
		$c = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
		$c->execute(array($postid));
		$count = $c->rowCount();
		if($count == 0)
		{
			$returnArray['message'] = "Böyle Bir Yazı Yok";
			return;
		}
		$data = date("Y-m-d");
		$insert = $this->db->prepare("INSERT INTO comments(userid,postid,text,date) value (?,?,?,?)");
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
		echo json_encode($returnArray);	
	}
	public function get($id)
	{	
		$returnArray = [];
		$returnArray['status'] = false;
		$c = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
		$c->execute(array($id));
		$count = $c->rowCount();
		if($count == 0)
		{
			$returnArray['message'] = "Böyle Bir Post Bulunamadı";
			return;
		}
		$list = $this->db->prepare("SELECT * FROM comments WHERE postid = ?");
		$list->execute(array($id));
		$result = $list->fectAll(PDO::FETCH_ASSOC);
		$returnDataArray = [];
		foreach ($result as $key => $value) 	
		{
			$user = $this->db->prepare("SELECT * FROM users WHERE id = ?");
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
		echo json_encode($returnArray);		
	}
}
?>
