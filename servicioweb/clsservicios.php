<?php
// NOMBRE DE LA CLASE 
class clsservicios
{
    public function vwProducts()
    {
        // arreglo donde guardare los registros
        $datos = array();

        $cmdSql = "SELECT *FROM vw_products;";

        $i = 0;

        // Conexión
        if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

            $renglon = mysqli_query($conn, $cmdSql);

            while ($resultado = mysqli_fetch_assoc($renglon)) {
                //vaciado de datos
                $datos[$i]["product_id"]          = $resultado["product_id"];
                $datos[$i]["product_title"]       = $resultado["product_title"];
                $datos[$i]["product_image"]       = $resultado["product_image"];
                $datos[$i]["product_description"] = $resultado["product_description"];
                $datos[$i]["product_cost"]        = $resultado["product_cost"];
                $datos[$i]["product_created"]     = $resultado["product_created"];
                $i++;
            }

            mysqli_close($conn);
        }
        return $datos;
    }


    public function loginUsuario($username, $password)
    {
        $sql = "CALL sp_login_usuario(?, ?)";

        // Conexión dentro de la función
        if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Error en la preparación: " . $conn->error);
            }

            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            $usuario = $result->fetch_assoc();

            $stmt->close();
            mysqli_close($conn); // cerrar conexión

            return $usuario;
        }
        return null;
    }
}
