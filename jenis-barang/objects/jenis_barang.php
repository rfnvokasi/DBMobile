<?php
class jenis_barang{
    private $conn;
    private $table_name = "jenis_barang";
  
    public $jnsbrng_id;
    public $nama_barang;
    public $satuan;
 
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
                nama_barang=:nama_barang, satuan=:satuan";
  
   
    $stmt = $this->conn->prepare($query);
  
   
    $this->nama_barang=htmlspecialchars(strip_tags($this->nama_barang));
    $this->satuan=htmlspecialchars(strip_tags($this->satuan));
  
    
    $stmt->bindParam(":nama_barang", $this->nama_barang);
    $stmt->bindParam(":satuan", $this->satuan);
  
   
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
	}

	function update(){
  
    
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nama_barang = :nama_barang,
                satuan = :satuan
            WHERE
                jnsbrng_id = :jnsbrng_id";
  
   
    $stmt = $this->conn->prepare($query);
  
    
    
    $this->nama_barang=htmlspecialchars(strip_tags($this->nama_barang));
    $this->satuan=htmlspecialchars(strip_tags($this->satuan));
    $this->jnsbrng_id=htmlspecialchars(strip_tags($this->jnsbrng_id));
  
    
    $stmt->bindParam(":nama_barang", $this->nama_barang);
    $stmt->bindParam(":satuan", $this->satuan);
    $stmt->bindParam(':jnsbrng_id', $this->jnsbrng_id);
  
    
    if($stmt->execute()){
        return true;
    }
  
    return false;
	}

function delete(){
  
    
    $query = "DELETE FROM " . $this->table_name . " WHERE jnsbrng_id = ?";
  
    
    $stmt = $this->conn->prepare($query);
  
   
    $this->jnsbrng_id=htmlspecialchars(strip_tags($this->jnsbrng_id));
  
    
    $stmt->bindParam(1, $this->jnsbrng_id);
  
    
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
}
?>