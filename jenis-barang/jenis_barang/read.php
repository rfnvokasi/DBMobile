<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/database.php';
include_once '../objects/jenis_barang.php';
  
$database = new Database();
$db = $database->getConnection();
  
$jenis_barang = new jenis_barang($db);
  
$stmt = $jenis_barang->read();
$num = $stmt->rowCount();
  
if($num>0){
  
    $products_arr=array();
    $products_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $product_item=array(
            "jnsbrng_id" => $jnsbrng_id,
            "nama_barang" => $nama_barang,
            "satuan" => $satuan
        );
  
        array_push($products_arr["records"], $product_item);
    }
  
    http_response_code(200);
  
    echo json_encode($products_arr);
}
  
else{
  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No jenis barang found.")
    );
}