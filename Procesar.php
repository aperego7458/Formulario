
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8"/>
	<title>Formularios</title>
	</head>
<body>

<?php
	$conexion=mysqli_connect("localhost","root","","formulario");

	if (!empty($_POST['nombre'])) {
		$nombre=$_POST{'nombre'};
		$sql=mysqli_query($conexion,"SELECT id FROM formularios WHERE nombre='$nombre'");
		if ($row=mysqli_fetch_array($sql)) {
			echo "NO SE PERMITEN DATOS DUPLICADOS EN LA BASE DE DATOS<br><br>";
		}else
			mysqli_query($conexion,"INSERT INTO formularios (nombre) VALUES ('$nombre')");
			$ss=mysqli_query($conexion,"SELECT MAX(id) as id_maximo FROM formularios");
			if ($rr=mysqli_fetch_array($ss)) {
				$id_maximo=$rr['id_maximo'];
				
			}

			$nameimagen=$_FILES['imagen']['name'];
			$tmpimagen=$_FILES['imagen']['tmp_name'];
			$urlnueva="imagen/foto_".$id_maximo.".jpg";
			if(is_uploaded_file($tmpimagen)){
				copy($tmpimagen,$urlnueva);
				echo "Imagen Cargada con Exito";
			}else{
				echo "Error al cargar la imagen";
			}
		}
	

?>
	<form name="form" action="" method="post" enctype="multipart/form-data">
		<strong>Nombre</strong><br>
		<input type="text" name="nombre" autocomplete="off" required value="">
		<strong>Seleccionar Imagen</strong><br>
		<input type="file" name="imagen" id="imagen" accept="image/*"><br><br>
		<button type="submit"><strong>Aceptar</strong>
		</button>

		</form>

	</body>
</html>