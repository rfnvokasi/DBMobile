<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

include_once '../config/database.php';
  

include_once '../objects/paket.php';
  
$database = new Database();
$db = $database->getConnection();
  
$paket = new paket($db);
  

$data = json_decode(file_get_contents("php://input"));
  

if(
    !empty($data->nama_paket)
){
  
   
    $paket->nama_paket = $data->nama_paket;
  
    
    if($paket->create()){
  
        
        http_response_code(201);
  
        
        echo json_encode(array("message" => "Paket was created."));
    }
  
    
    else{
  
        
        http_response_code(503);
  
        
        echo json_encode(array("message" => "Unable to create paket."));
    }
}
  

else{
  
    
    http_response_code(400);
  
   
    echo json_encode(array("message" => "Unable to create paket. Data is incomplete."));
}
?>