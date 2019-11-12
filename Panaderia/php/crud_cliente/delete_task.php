<?php

include("db.php");

if(isset($_GET['NIT_CLIENTE'])){
    $id = $_GET['NIT_CLIENTE'];
    $query = "DELETE FROM cliente WHERE NIT_CLIENTE = $id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Fallida");
    }

    $_SESSION['Message'] = 'Registro eliminado correctamente';
    $_SESSION['Message_type'] = 'danger';
    header("Location: index.php");
}

?>