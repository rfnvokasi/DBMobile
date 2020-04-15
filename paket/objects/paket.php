<?php
class paket{
    private $conn;
    private $table_name = "paket";
  
    public $paket_id;
    public $nama_paket;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
           $query = " SELECT * FROM " . $this->table_name;



                $stmt = $this->conn->prepare($query);



                $stmt->execute();

                return $stmt;

            }

function create(){
  
  
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nama_paket=:nama_paket";
  
   
    $stmt = $this->conn->prepare($query);
  
   
    $this->nama_paket=htmlspecialchars(strip_tags($this->nama_paket));
    
    
    $stmt->bindParam(":nama_paket", $this->nama_paket);
  
   
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
	}

	function update(){
  
    
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nama_paket = :nama_paket
            WHERE
                paket_id = :paket_id";
  
   
    $stmt = $this->conn->prepare($query);
  
    
    $this->nama_paket=htmlspecialchars(strip_tags($this->nama_paket));
    $this->paket_id=htmlspecialchars(strip_tags($this->paket_id));
  
    
    $stmt->bindParam(':nama_paket', $this->nama_paket);
    $stmt->bindParam(':paket_id', $this->paket_id);
  
    
    if($stmt->execute()){
        return true;
    }
  
    return false;
	}

function delete(){
  
    
    $query = "DELETE FROM " . $this->table_name . " WHERE paket_id = ?";
  
    
    $stmt = $this->conn->prepare($query);
  
   
    $this->paket_id=htmlspecialchars(strip_tags($this->paket_id));
  
    
    $stmt->bindParam(1, $this->paket_id);
  
    
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
}
?>