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


    public function agregarProducto($seller_id, $category_id, $title, $image_url, $description, $cost, $num_dueno)
    {
        $sql = "CALL sp_add_product(?, ?, ?, ?, ?, ?, ?)";

        try {
            // Conexión dentro de la función (igual que tus otras funciones)
            if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    return ["estado" => 0, "mensaje" => "Error en prepare: " . $conn->error];
                }

                // bind_param → i = int, s = string, d = double
                $stmt->bind_param(
                    "iisssds",
                    $seller_id,
                    $category_id,
                    $title,
                    $image_url,
                    $description,
                    $cost,
                    $num_dueno
                );

                if ($stmt->execute()) {
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 1, "mensaje" => "Producto agregado correctamente"];
                } else {
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "No se pudo ejecutar el procedimiento"];
                }
            }

            return ["estado" => 0, "mensaje" => "No se pudo conectar a la base de datos"];
        } catch (Exception $e) {
            return ["estado" => 0, "mensaje" => "Error: " . $e->getMessage()];
        }
    }



    public function obtenerProductosPorSeller($seller_id)
    {
        $sql = "call sp_get_products_by_seller(?)";
        $productos = [];

        if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                return [];
            }

            $stmt->bind_param("i", $seller_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }

            $stmt->close();
            mysqli_close($conn);
        }

        return $productos;
    }



    public function crearVendedor($username, $password, $fullname, $phone)
    {
        $sql = "CALL sp_add_seller(?, ?, ?, ?)";

        try {
            if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    return ["estado" => 0, "mensaje" => "Error en prepare: " . $conn->error];
                }

                $stmt->bind_param(
                    "ssss",
                    $username,
                    $password, // AHORA SE USA LA CONTRASEÑA EN TEXTO PLANO
                    $fullname,
                    $phone
                );

                if ($stmt->execute()) {
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 1, "mensaje" => "Vendedor creado correctamente"];
                } else {
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "No se pudo ejecutar el procedimiento"];
                }
            }

            return ["estado" => 0, "mensaje" => "No se pudo conectar a la base de datos"];
        } catch (Exception $e) {
            return ["estado" => 0, "mensaje" => "Error: " . $e->getMessage()];
        }
    }


    public function obtenerSellers()
    {
        $query = "CALL sp_obtener_sellers()";

        try {
            // Conexión independiente para esta función
            if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

                $stmt = $conn->prepare($query);

                if (!$stmt) {
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "Error en prepare: " . $conn->error];
                }

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 1, "resultado" => $result]; // Devuelve el resultado si es exitoso
                } else {
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "No se pudo ejecutar el procedimiento"];
                }
            }
            return ["estado" => 0, "mensaje" => "No se pudo conectar a la base de datos"];
        } catch (Exception $e) {
            return ["estado" => 0, "mensaje" => "Error: " . $e->getMessage()];
        }
    }


    public function actualizarSeller($id, $username, $fullname, $phone)
    {
        $query = "CALL sp_actualizar_seller(?, ?, ?, ?)";

        try {
            // Conexión independiente para esta función
            if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

                $stmt = $conn->prepare($query);

                if (!$stmt) {
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "Error en prepare: " . $conn->error];
                }

                $stmt->bind_param("isss", $id, $username, $fullname, $phone);

                if ($stmt->execute()) {
                    $filasAfectadas = $stmt->affected_rows;
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 1, "mensaje" => "Vendedor actualizado correctamente", "filas_afectadas" => $filasAfectadas];
                } else {
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "No se pudo ejecutar el procedimiento"];
                }
            }
            return ["estado" => 0, "mensaje" => "No se pudo conectar a la base de datos"];
        } catch (Exception $e) {
            return ["estado" => 0, "mensaje" => "Error: " . $e->getMessage()];
        }
    }


    public function eliminarSeller($id)
    {
        $query = "CALL sp_eliminar_seller(?)";

        try {
            // Conexión independiente para esta función
            if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

                $stmt = $conn->prepare($query);

                if (!$stmt) {
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "Error en prepare: " . $conn->error];
                }

                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    $filasAfectadas = $stmt->affected_rows;
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 1, "mensaje" => "Vendedor eliminado correctamente", "filas_afectadas" => $filasAfectadas];
                } else {
                    $stmt->close();
                    mysqli_close($conn);
                    return ["estado" => 0, "mensaje" => "No se pudo ejecutar el procedimiento"];
                }
            }
            return ["estado" => 0, "mensaje" => "No se pudo conectar a la base de datos"];
        } catch (Exception $e) {
            return ["estado" => 0, "mensaje" => "Error: " . $e->getMessage()];
        }
    }


    public function actualizarProducto($id, $title, $image_url, $description, $cost, $num_dueno)
    {
        $conn = new mysqli("localhost", "root", "", "bd_contactos");

        if ($conn->connect_error) {
            return ["estado" => 0, "mensaje" => "Error de conexión"];
        }

        $stmt = $conn->prepare("CALL sp_actualizar_producto(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssds", $id, $title, $image_url, $description, $cost, $num_dueno);

        if ($stmt->execute()) {
            return ["estado" => 1, "mensaje" => "Producto actualizado correctamente"];
        } else {
            return ["estado" => 0, "mensaje" => "Error al actualizar"];
        }
    }


    public function obtenerProductoPorId($id)
    {
        $conn = new mysqli("localhost", "root", "", "bd_contactos");

        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    public function eliminarProducto($id)
    {
        $conn = new mysqli("localhost", "root", "", "bd_contactos");

        if ($conn->connect_error) {
            return ["estado" => 0, "mensaje" => "Error de conexión"];
        }

        $stmt = $conn->prepare("CALL sp_eliminar_producto(?)");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return ["estado" => 1, "mensaje" => "Producto eliminado correctamente"];
        } else {
            return ["estado" => 0, "mensaje" => "No se pudo eliminar el producto"];
        }
    }

    public function obtenerProductosPorCategoria($category_id)
    {
        $productos = [];

        $sql = "CALL SP_ObtenerProductosPorCategoria(?)";

        // Conexión dentro de la función
        if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Error en la preparación: " . $conn->error);
            }

            // bind_param → "i" porque es un entero
            $stmt->bind_param("i", $category_id);
            $stmt->execute();

            $resultado = $stmt->get_result();

            while ($fila = $resultado->fetch_assoc()) {
                $productos[] = $fila;
            }

            $stmt->close();
            mysqli_close($conn); // cerrar conexión
        }

        return $productos;
    }

    public function obtenerAnuncios()
    {
        $anuncios = [];

        if ($conn = mysqli_connect("localhost", "root", "", "bd_contactos")) {

            $sql = "CALL SP_ObtenerAnuncios()";
            $resultado = $conn->query($sql);

            while ($fila = $resultado->fetch_assoc()) {
                $anuncios[] = $fila;
            }

            mysqli_close($conn);
        }

        return $anuncios;
    }
}
