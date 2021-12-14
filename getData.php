<?php

function get_conn(){
    $conn = new PDO('mysql:host=localhost;dbname=wastebin_management', "root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function execute_sql($conn, $sql, $params=[]){
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$sql = "SELECT * FROM bins";
$res = execute_sql(get_conn(), $sql);

echo json_encode($res);
?>