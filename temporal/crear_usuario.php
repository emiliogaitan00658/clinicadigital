<?php
include_once "../header/header_panel.php";
if ($_POST) {
    $nombre = strtoupper(filter_var($_POST['textnombre'], FILTER_SANITIZE_STRING));
    $apellido = strtoupper(filter_var($_POST['textapellido'], FILTER_SANITIZE_STRING));
    $user = strtolower(filter_var($_POST['textuser'], FILTER_SANITIZE_STRING));
    $pas = $_POST["textpass"];
    $sucursal = $_POST["textsucursal"];

    datos_clientes::registro_usuario_mysql($nombre, $apellido, $user, $pas, $sucursal, $mysqli);

    echo '<script> swal({
  title: "Usuario Registrado con exito?",
  text: "Exito",
  icon: "success",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   location.href="crear_usuario.php";
  } else {
    location.href="crear_usuario.php";
  }
}); </script>';

}

?>
<br>
<div class="container white rounded z-depth-2" style="border-radius: 6px;">
    <div style="padding: 1em">
        <h5>Agregar usuario de sucursales</h5>
        <p><span class="red-text"></span><i class="icon-stop red-text "></i> Solo Personal Autorizado</p>
        <hr>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>"
              method="post">
            <section class="row">
                <div class="control-pares col-md-3">
                    <label for="">* Nombre:</label>
                    <input type="text" name="textnombre" class="form-control" placeholder="Nombre"
                           value="<?php if ($_POST) {
                               echo $_POST["textnombre"];
                           } ?>" required>
                </div>
                <div class="control-pares col-md-3">
                    <label for="">* Apellido:</label>
                    <input type="text" name="textapellido" class="form-control" placeholder="Apellido"
                           value="<?php if ($_POST) {
                               echo $_POST["textapellido"];
                           } ?>" required>
                </div>
                <div class="control-pares col-md-3">
                    <label for="">* Usuario: </label>
                    <input type="text" name="textuser" class="form-control" placeholder="Usuario"
                           value="<?php if ($_POST) {
                               echo $_POST["textuser"];
                           } ?>" required>
                </div>
                <div class="control-pares col-md-3">
                    <label for="">* Contrase??a:</label>
                    <input type="text" name="textpass" class="form-control" placeholder="Contrase??a"
                           value="<?php if ($_POST) {
                               echo $_POST["textpass"];
                           } ?>" required>
                </div>
                <br>
                <br>
                <br>
                <div class="control-pares col-md-9">
                    <section class="row">
                        <div class="control-pares col-md-3">
                            <label>Seleccionar Sucursal: *</label>
                            <select name="textsucursal" class="form-control" required>
                                <?php
                                $result33 = $mysqli->query("SELECT * FROM `sucursal`");
                                while ($resultado2 = $result33->fetch_assoc()) { ?>
                                    <option class="form-control" value="<?php echo $resultado2["indsucursal"]; ?>"><?php echo $resultado2["nombre_sucursal"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="control-pares col-md-4">
                    <input type="submit" value="Agregar Usuario" class="btn white-text blue-grey btn-primary"/>
                </div>
            </section>
        </form>
        <a class="btn btn-dark light-blue right" href="../panel_control.php"><i
                    class="icon-arrow-left2"></i>Regresar</a>
        <br>
        <p>Nota: Autorizado por el personal adminstrativo de la
            plataforma.</p>
        <p>Contactar al ingeniero de la empresa</p>
        <br>
    </div>
</div>
<br>
<br>
<div class="container row z-depth-1 white">
    <hr>
    <h4 style="padding: 1em;">Usuarios Registrados</h4>
    <hr>
    <table class="table table-responsive-lg" style="height: 86px; width: 1189px;margin-bottom: 4em">
        <tbody>
        <tr>
            <td style="width: 57px;">#</td>
            <td style="width: 260px;"><b>Nombres</b></td>
            <td style="width: 275px;"><b>Apellidos</b></td>
            <td style="width: 188px;"><b>Usuario</b></td>
            <td style="width: 190.038px;"><b>Contrase??a</b></td>
            <td style="width: 205.962px;"><b>Sucursal</b></td>
            <td style="width: 205.962px;"><b>Eliminar</b></td>
        </tr>
        <?php
        $result = $mysqli->query("SELECT * FROM `empleado`");
        while ($resultado = $result->fetch_assoc()) {
            ?>
            <tr>
                <td style="width: 57px;"><?php echo $resultado['indempleado']; ?></td>
                <td style="width: 260px;"><?php echo $resultado['nombre_empleado']; ?></td>
                <td style="width: 275px;"><?php echo $resultado['apellido_empleado']; ?></td>
                <td style="width: 188px;"><?php echo $resultado['user']; ?></td>
                <td style="width: 190.038px;"><?php echo $resultado['pass']; ?></td>
                <td style="width: 205.962px;"><?php echo datos_clientes::nombre_sucursal($resultado['indsucursal'], $mysqli); ?></td>
                <td style="width: 190.038px;"><a href="#" onclick="
                            var i='<?php echo $resultado['indempleado']; ?>';
                            verficar_eliminar(i);" class="btn btn-danger"><i class="icon-bin white-text"></i></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    function verficar_eliminar(codigo) {
        swal({
            title: "Desea Eliminar?",
            text: "Eliminiar Usuario",
            icon: "success",
            buttons: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    location.href = "eliminar_usuario_user.php?induser=" + codigo;
                } else {
                    location.href = "#";
                }
            });
    }

</script>
<?php
include_once "../header/footer_temporal.php";
?>

