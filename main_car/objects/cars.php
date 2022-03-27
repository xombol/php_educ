<? 
class Car {

		private $conn;
		private $table_name = "cars";
		
		public $id;
		public $marka;
		public $model;
		public $year;
		public $owner;
		public $timestamp;
		
		public function __construct($db){
			$this->conn = $db;	
		}
			
		function create_car(){
			$query = "INSERT INTO ".$this->table_name."
						SET 
						marka=:marka,
						model=:model,
						year=:year,
						owner=:owner,
						created=:created";
	
		
			$stmt = $this->conn->prepare($query);
			
			// опубликованные значения 
			$this->marka=htmlspecialchars(strip_tags($this->marka));
			$this->model=htmlspecialchars(strip_tags($this->model));
			$this->year=htmlspecialchars(strip_tags($this->year));
			$this->owner=htmlspecialchars(strip_tags($this->owner));
				
			// получаем время создания записи 
			$this->timestamp = date('Y-m-d H:i:s');

			// привязываем значения 
			$stmt->bindParam(":marka", $this->marka);
			$stmt->bindParam(":model", $this->model);
			$stmt->bindParam(":year", $this->year);
			$stmt->bindParam(":owner", $this->owner);
			$stmt->bindParam(":created", $this->timestamp);

				
			if ($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
		
	function readAll($from_record_num, $records_per_page) {

        // запрос MySQL 
        $query = "SELECT
                    id, marka, model, year, owner
					
                FROM
                    " . $this->table_name . "
                ORDER BY
                    marka ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
	
	function delete() {

		// запрос MySQL для удаления 
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function deleteCar($delete_id) {
		
		echo $delete_id;
		// запрос MySQL для удаления 
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ".$delete_id."";

		$stmt = $this->conn->prepare($query);
		//$stmt->bindParam(1, $this->id);

    if ($result = $stmt->execute()) {
        return true;
    } else {
        return false;
    }

		
	}
		
		
}




