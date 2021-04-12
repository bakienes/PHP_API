<?php 
$parent_id = 0;
$sorgu = $db->db->prepare("SELECT * FROM category WHERE parent_id = ?");
$sorgu->execute(array($parent_id));
$result = $sorgu->fetchAll(PDO::FETCH_ASSOC);
$returnArray['status'] = true;
$returnArray['data'] = $result;

?>
