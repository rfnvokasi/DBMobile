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
  

$paket->paket_id = $data->paket_id;
  

$paket->nama_paket = $data->nama_paket;
  

if($paket->update()){
  
   
    http_response_code(200);
  
  
    echo json_encode(array("message" => "Paket was updated."));
}
  
else{
  
  
    http_response_code(503);
  
   
    echo json_encode(array("message" => "Unable to update paket."));
}
?>