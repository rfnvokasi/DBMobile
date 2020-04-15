<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

include_once '../config/database.php';
  

include_once '../objects/jenis_barang.php';
  
$database = new Database();
$db = $database->getConnection();
  
$jenis_barang = new jenis_barang($db);
  

$data = json_decode(file_get_contents("php://input"));
  

if(
    !empty($data->nama_barang) &&
    !empty($data->satuan)
){
  
   
    $jenis_barang->nama_barang = $data->nama_barang;
    $jenis_barang->satuan = $data->satuan;
  
  
    
    if($jenis_barang->create()){
  
        
        http_response_code(201);
  
        
        echo json_encode(array("message" => "Jenis Barang was created."));
    }
  
    
    else{
  
        
        http_response_code(503);
  
        
        echo json_encode(array("message" => "Unable to create jenis barang."));
    }
}
  

else{
  
    
    http_response_code(400);
  
   
    echo json_encode(array("message" => "Unable to create jenis barang. Data is incomplete."));
}
?>