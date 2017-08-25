<?php 
$filePath = realpath(dirname(__FILE__));
	include_once ($filePath.'/../lib/Database.php');
	include_once ($filePath.'/../helpers/Format.php');
 ?>

<?php
class Category{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function catInsert($catName){
		$catName = $this->fm->validation(mysqli_real_escape_string($this->db->link, $catName));
		if (empty($catName)){
			echo "<span class='error'>"."Category Field Must not Empty !"."</span>";
		}else{
			$query = "INSERT INTO tbl_category (catName) VALUES ('$catName')";
			$catinsert = $this->db->insert($query);
			if ($catinsert) {
				echo "<span class='success'>"."Category Inserted Successfully"."</span>";
			}else{
				echo "<span class='error'>"."Category not Inserted !"."</span>";
			}			
		}
	}

	public function getAllCat(){
		$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getCateById($id){
		$query = "SELECT * FROM tbl_category WHERE catId='$id'";
		$result = $this->db->select($query);
		return $result; 
	}

	public function catUpdate($catName, $id){
		$catName = $this->fm->validation(mysqli_real_escape_string($this->db->link, $catName));
		$id = $this->fm->validation(mysqli_real_escape_string($this->db->link, $id));
		if (empty($catName)){
			echo "<span class='error'>"."Category Field Must not Empty !"."</span>";
		}else{
			$query = "UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
			$update_row = $this->db->update($query);
			if ($update_row) {
				echo "<span class='success'>"."Category Updated Successfuly"."</span>";
			}else{
				echo "<span class='error'>"."Category not Updated !"."</span>";
			}			
		}
	}

	public function delCatById($id){
		$id = $this->fm->validation(mysqli_real_escape_string($this->db->link, $id));
		$query = "DELETE FROM tbl_category WHERE catId='$id'";
		$deldata = $this->db->delete($query);
		if ($deldata) {
			echo "<span class='success'>"."Data Deleted Successfuly"."</span>";
		}else{
			echo "<span class='error'>"."Data not Deleted !"."</span>";
		}
	}


}

?>