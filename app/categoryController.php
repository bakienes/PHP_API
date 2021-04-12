<?php 
class categoryController extends Controller
{
	public function list()
	{
		$id = 0;
		$returnArray = [];
		$returnArray['status'] = false;
		$sorgu = $this->db->prepare("SELECT * FROM category WHERE parent_id = ?");
		$sorgu->execute(array($id));
		$result = $sorgu->fetchAll(PDO::FETCH_ASSOC);
		$returnArray['status'] = true;
		$returnArray['data'] = $result;
		echo json_encode($returnArray);	
	}
	public function get($id)
	{
		$returnArray = [];
		$returnArray['status'] = false;
		$c = $this->db->prepare("SELECT * FROM category WHERE id = ?");
		$c->execute(array($parent_id));
		$count = $c->rowCount();
		if($count == 0)
		{
			$returnArray['message'] = "Böyle Bir Kategori Yok"
		}
		$sorgu = $this->db->prepare("SELECT * FROM category WHERE parent_id = ?");
		$sorgu->execute(array($parent_id));
		$result = $sorgu->fetchAll(PDO::FETCH_ASSOC);
		$returnArray['status'] = true;
		$returnArray['data'] = $result;
		echo json_encode($returnArray);	
	}
}


?>
