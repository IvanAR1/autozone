<?php
include_once './config.php';

// Datos de conexión a la base de datos
$serverName = "127.0.0.1";

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Verificar la conexión
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta SQL
$sql = "SELECT * FROM autozone";
$query = sqlsrv_query($conn, $sql);

// Verificar la ejecución de la consulta
if ($query === false) {
    die(print_r(sqlsrv_errors(), true));
}
$array = array();
// Recorrer los resultados
while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
    if(isset($row["fecha"]) && is_object($row["fecha"]))
        $row["fecha"] = $row["fecha"]->format('Y-m-d');
    array_push($array, $row);
}

// Cerrar la conexión
sqlsrv_close($conn);
return print json_encode($array);