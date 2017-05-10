<?php
	  
 /* Función para crear una conexión con la base de datos Oracle
 ========================================================================== */
function crearConexionBD() {
	$host = "oci:dbname=localhost/XE;charset=UTF8";
	$usuario = "ProyectoIISSI";
	$password = "1234";
	try {
		$conexion = new PDO($host, $usuario, $password, array(PDO::ATTR_PERSISTENT => true));
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conexion;
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location:excepcion.php");
	}
}

/* Función para cerrar la conexión con la base de datos Oracle.
 ========================================================================== */
function cerrarConexionBD($conexion) {
	$conexion = null;
}

/* Función para la creación del slider.
 ========================================================================== */
function crearSlider() {
	$imagenes = array(
		"http://welltechnically.com/wp-content/uploads/2013/08/android-wallpapers-700x300.jpg", 
		"http://pgembeddedsystems.org/images/vlsifront.png", 
		"http://welltechnically.com/wp-content/uploads/2013/09/android-widescreen-wallpaper-14165-hd-wallpapers-700x300.jpg"
	);
	foreach ($imagenes as $imagen) {?>
		<section class="sliderSection">
			<img src="<?php echo $imagen; ?>">
		</section>
	<?php }
			}

			 /* Función para obtener el tipo del usuario que entra en la página.
	 ========================================================================== */

	function tipoUsuario($conexion, $DNI) {
		try {
			$stmt = $conexion -> prepare("SELECT TipoUsuario FROM Usuarios WHERE DNI = :DNI");
			$stmt -> bindparam(':DNI', $DNI);
			$stmt -> execute();
			return $stmt -> fetch();
		} catch(PDOException $e) {
			$_SESSION["excepcion"] = $e -> GetMessage();
			header("Location: excepcion.php");
		}
	}
			 /* Función para obtener todas las tutorías de un profesor.
		 ========================================================================== */
		function tutoriasProfesor($conexion, $DNI) {
			try {
				$stmt = $conexion -> prepare('CALL PR_Tutorias_Profesor(:DNI)');
				$stmt -> bindParam(':DNI', $DNI);
				$stmt -> execute();
			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}

			return $stmt;
		}

		/* Función para obtener un alumno dado su DNI.
		 ========================================================================== */
		function nombreAlumno($DNI, $conexion) {
			try {
				$stmt = $conexion -> prepare('SELECT NOMBRE FROM ALUMNOS WHERE DNI = :DNI');
				$stmt -> bindParam(':DNI', $DNI);
				$stmt -> execute();
				return $stmt -> fetch();
			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}

			return $stmt;
		}

		/* Función para obtener un profesor dado su DNI.
		 ========================================================================== */
		function nombreProfesor($DNI, $conexion) {
			try {
				$stmt = $conexion -> prepare('SELECT NOMBRE, APELLIDOS FROM Profesores WHERE DNI = :DNI');
				$stmt -> bindParam(':DNI', $DNI);
				$stmt -> execute();
				return $stmt -> fetch();
			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}

			return $stmt;
		}

		/* Función para obtener el nombre del despacho.
		 ========================================================================== */
		function nombreDespacho($conexion, $oid_d) {
			try {
				$stmt = $conexion -> prepare("SELECT Nombre FROM Despachos WHERE OID_D = :OID_D");
				$stmt -> bindparam(":OID_D", $oid_d);
				$stmt -> execute();
				return $stmt -> fetch();

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		/* Función para obtener el nombre del departamento.
		 ========================================================================== */
		function nombreDepartamento($conexion, $oid_dep) {
			try {

				$stmt = $conexion -> prepare("SELECT Nombre FROM Departamentos WHERE OID_Dep = :OID_Dep");
				$stmt -> bindparam(":OID_Dep", $oid_dep);
				$stmt -> execute();
				return $stmt -> fetch();

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		/* Función para modificar el departamento de un profesor.
		 ========================================================================== */
		function modificarDepartamento($conexion, $DNI, $oid_dep) {
			try {
				$stmt = $conexion -> prepare("UPDATE PROFESORES SET OID_Dep = :OID_Dep WHERE DNI = :DNI ");
				$stmt -> bindparam(":OID_DEP", $oid_dep);
				$stmt -> bindparam(":DNI", $DNI);
				$stmt -> execute();
				return $stmt;

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		/* Función para modificar el despacho de un profesor.
		 ========================================================================== */
		function modificarDespacho($conexion, $DNI, $oid_d) {
			try {
				$stmt = $conexion -> prepare("UPDATE PROFESORES SET OID_D = :OID_D WHERE DNI = :DNI ");
				$stmt -> bindparam(":OID_D", $oid_d);
				$stmt -> bindparam(":DNI", $DNI);
				$stmt -> execute();

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		 /* Función para modificar la categoría de un profesor.
	 ========================================================================== */
	function modificarCategoria($conexion, $DNI, $categoria) {
		try {
			$stmt = $conexion -> prepare("UPDATE PROFESORES SET Categoria = :Categoria WHERE DNI = :DNI ");
			$stmt -> bindparam(":Categoria", $categoria);
			$stmt -> bindparam(":DNI", $DNI);
			$stmt -> execute();
			return $stmt -> fetch();

		} catch(PDOException $e) {
			$_SESSION["excepcion"] = $e -> GetMessage();
			header("Location: excepcion.php");
		}
	}

	/* Función para modificar el dia de tutoria de un profesor.
	 ========================================================================== */
	function modificarDiaTutoria($conexion, $DNI, $dia) {
		try {
			$stmt = $conexion -> prepare("UPDATE DiasTutoriaProfesores SET Dia = :dia WHERE DNI = :DNI ");
			$stmt -> bindparam(":dia", $dia);
			$stmt -> bindparam(":DNI", $DNI);
			$stmt -> execute();
			return $stmt;

		} catch(PDOException $e) {
			$_SESSION["excepcion"] = $e -> GetMessage();
			header("Location: excepcion.php");
		}
	}

	/* Función para modificar el horario de tutorias de un profesor.
	 ========================================================================== */

	function modificarHorario($conexion, $DNI, $hora_Inicio, $hora_Fin) {

		try {

			$stmt = $conexion -> prepare("UPDATE DiasTutoriaProfesores SET Hora_Comienzo_Tutoria = :hora_Inicio, Hora_Fin_Tutoria = :hora_Fin  WHERE DNI = :DNI ");
			$stmt -> bindparam(":hora_Inicio", $hora_Inicio);
			$stmt -> bindparam(":hora_Fin", $hora_Fin);
			$stmt -> bindparam(":DNI", $DNI);
			$stmt -> execute();
			return $stmt;

		} catch(PDOException $e) {
			$_SESSION["excepcion"] = $e -> GetMessage();
			header("Location: excepcion.php");
		}
	}

	/* Función para obtener la información de un profesor.
	 ========================================================================== */
	function getInfoProfesor($conexion, $DNI) {
		try {
			$stmt = $conexion -> prepare('SELECT Nombre , Apellidos, Fecha_Nacimiento, Email, Categoria, OID_D, OID_Dep FROM Profesores WHERE DNI = :DNI');
			$stmt -> bindParam(":DNI", $DNI);
			$stmt -> execute();
			return $stmt -> fetch();

		} catch(PDOException $e) {
			$_SESSION["excepcion"] = $e -> GetMessage();
			header("Location: excepcion.php");
		}
	}

	/* Función para obtener la información de un Alumno.
	 ========================================================================== */
	function getInfoAlumno($conexion, $DNI) {
		try {
			$stmt = $conexion -> prepare('SELECT Nombre, Apellidos, Fecha_Nacimiento, Email FROM Alumnos WHERE DNI = :DNI');
			$stmt -> bindParam(":DNI", $DNI);
			$stmt -> execute();
			return $stmt -> fetch();

		} catch(PDOException $e) {
			$_SESSION["excepcion"] = $e -> GetMessage();
			header("Location: excepcion.php");
		}
	}
			 /* Función para obtener el grupo de un alumno.
		 ========================================================================== */
		function getGrupoAlumno($conexion, $DNI) {
			try {
				$stmt = $conexion -> prepare('SELECT OID_Grup FROM AlumnosPertenecenAGrupos WHERE DNI = :DNI');
				$stmt -> bindParam(":DNI", $DNI);
				$stmt -> execute();
				return $stmt -> fetch();

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		/* Función para obtener el nombre de un grupo.
		 ========================================================================== */
		function getNombreGrupo($conexion, $oid_grup) {
			try {
				$stmt = $conexion -> prepare('SELECT Nombre FROM Grupos WHERE OID_Grup = :oid_grup');
				$stmt -> bindParam(":oid_grup", $oid_grup);
				$stmt -> execute();
				return $stmt -> fetch();

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		/* Función para obtener la información de un profesor.
		 ========================================================================== */
		function getCursoAlumno($conexion, $DNI) {
			try {
				$stmt = $conexion -> prepare('SELECT Curso FROM Matriculas WHERE DNI = :DNI');
				$stmt -> bindParam(":DNI", $DNI);
				$stmt -> execute();
				return $stmt -> fetch();

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		/* Función para obtener el codigo de una matrícula.
		 ========================================================================== */
		function getCodigoMatricula($conexion, $DNI) {
			try {
				$stmt = $conexion -> prepare('SELECT Codigo_Matric FROM Matriculas WHERE DNI=:DNI');
				$stmt -> bindParam(":DNI", $DNI);
				$stmt -> execute();
				return $stmt -> fetch();

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}

		/* Función para obtener el codigo de las asignaturas.
		 ========================================================================== */
		function getCodigoAsignaturas($conexion, $DNI) {
			try {
				$codigo_matric = getCodigoMatricula($conexion, $DNI);
				$stmt1 = $conexion -> prepare('SELECT Codigo_Asig FROM MatriculasContienenAsignaturas WHERE Codigo_Matric=:codigo_matric');
				$stmt1 -> bindParam(":codigo_matric", $codigo_matric['CODIGO_MATRIC']);
				$stmt1 -> execute();
				return $stmt1;

			} catch(PDOException $e) {
				$_SESSION["excepcion"] = $e -> GetMessage();
				header("Location: excepcion.php");
			}
		}
			 /* Función para obtener las asignaturas de un alumno.
			 ========================================================================== */
			function getAsignaturaAlumno($conexion, $codigo_asig) {
				try {

					$stmt2 = $conexion -> prepare('SELECT Nombre, Curso, Tipo, Creditos FROM Asignaturas WHERE Codigo_Asig=:codigo_asig');
					$stmt2 -> bindParam(":codigo_asig", $codigo_asig);
					$stmt2 -> execute();
					return $stmt2 -> fetch();

				} catch(PDOException $e) {
					$_SESSION["excepcion"] = $e -> GetMessage();
					header("Location: excepcion.php");
				}
			}

			/* Función para obtener el grado de un alumno.
			 ========================================================================== */
			function getGradoAlumno($conexion, $DNI) {
				try {

					$codigo_matric = getCodigoMatricula($conexion, $DNI);
					$stmt1 = $conexion -> prepare('SELECT OID_G FROM MatriculasPertenecenAGrados WHERE Codigo_Matric = :codigo_matric');
					$stmt1 -> bindParam(":codigo_matric", $codigo_matric['CODIGO_MATRIC']);
					$stmt1 -> execute();
					return $stmt1 -> fetch();

				} catch(PDOException $e) {
					$_SESSION["excepcion"] = $e -> GetMessage();
					header("Location: excepcion.php");
				}
			}
			 /* Función para obtener el nombre de un grado.
				 ========================================================================== */
				function getNombreGrado($conexion, $oid_g) {
					try {
						$stmt2 = $conexion -> prepare('SELECT Nombre FROM Grados WHERE OID_G = :oid_g');
						$stmt2 -> bindParam(":oid_g", $oid_g);
						$stmt2 -> execute();
						return $stmt2 -> fetch();
					} catch(PDOException $e) {
						$_SESSION["excepcion"] = $e -> GetMessage();
						header("Location: excepcion.php");
					}

				}

				/* Función para obtener la información un usuario.
				 ========================================================================== */
				function getInfoUsuario($conexion, $DNI) {
					try {
						$stmt = $conexion -> prepare("SELECT DNI, Pass FROM Usuarios WHERE DNI = :DNI");
						$stmt -> bindParam(":DNI", $DNI);
						$stmt -> execute();
						return $stmt -> fetch();
					} catch(PDOException $e) {
						$_SESSION["excepcion"] = $e -> GetMessage();
						header("Location: excepcion.php");
					}

				}

				/* Función para obtener la información de DiasTutoriaProfesores.
				 ========================================================================== */
				function DiasTutoriaProfesor($conexion, $DNI) {

					try {
						$stmt = $conexion -> prepare('SELECT Hora_Comienzo_Tutoria, Hora_Fin_Tutoria, Dia FROM DiasTutoriaProfesores WHERE DNI = :DNI');
						$stmt -> bindParam(':DNI', $DNI);
						$stmt -> execute();
						return $stmt;
					} catch(PDOException $e) {
						$_SESSION["excepcion"] = $e -> GetMessage();
						header("Location: excepcion.php");
					}
				}
			/* Función para cambiar el estado de una tutoría a aceptada.
			========================================================================== */
			function aceptaTutoria($conexion, $OID_T) {

				try {

					$stmt = $conexion -> prepare("UPDATE TUTORIAS SET ESTADO = 'Aceptada' WHERE OID_T = :OID_T");
					$stmt -> bindParam(':OID_T', $OID_T);
					$stmt -> execute();
				} catch(PDOException $e) {
					$_SESSION["excepcion"] = $e -> GetMessage();
					header("Location: excepcion.php");
				}
			}
			 /* Función para cambiar el estado de una tutoría a Rechazada.
				 ========================================================================== */
				function rechazaTutoria($conexion, $OID_T) {

					try {
						$stmt = $conexion -> prepare("UPDATE TUTORIAS SET ESTADO = 'Rechazada' WHERE OID_T = :OID_T");
						$stmt -> bindParam(':OID_T', $OID_T);
						$stmt -> execute();
					} catch(PDOException $e) {
						$_SESSION["excepcion"] = $e -> GetMessage();
						header("Location: excepcion.php");
					}
				}
			/* Función para la creación del menú tanto en la cabecera como en el pie.
========================================================================== */
function crearMenu($boton_on=0, $tipoMenu, $DNI=""){

$id = "menuCabecera";
$conexion = crearConexionBD();
$tipoUsuario = tipoUsuario($conexion, $DNI);
$admin = esAdministrador($conexion, $DNI);
cerrarConexionBD($conexion);
$nombreMenuAlumno = array(
"Inicio",
"Pedir tutoría",
"Calendario",
"Registro",
"Tablón de anuncios",
"Mis tutorias"
);
$hrefAlumno = array(
"index.php",
"pedirTutoria.php",/*En desarrollo */
"",/*En desarrollo */
"",/*En desarrollo */
"", /*En desarrollo */
"tutoriasAlumno.php"
);
$nombreMenuProfesor = array(
"Inicio",
"Tutorías solicitadas",
"Realizar un anuncio",
"Tablón de anuncios",
"Editar perfil"
);
$hrefProfesor = array(
"index.php",
"verTutorias.php",
"",
"",
"editarPerfilProfesor.php"
);
$hrefAdministrador = array(
"index.php",
"meterProfesor.php",
"",/*En desarrollo */
"",/*En desarrollo */
"" /*En desarrollo */
);
$nombreMenuAdministrador = array(
"Inicio",
"Meter Profesor",
"",/*En desarrollo */
"",/*En desarrollo */
"" /*En desarrollo */
);
$nombreMenuSinLogin = array(
"Inicio",
"Información"
);
$hrefSinLogin = array(
"index.php",
"" /*En desarrollo */
);
if($tipoUsuario["TIPOUSUARIO"] == 'Alumno'){
$nombre=$nombreMenuAlumno;
$href=$hrefAlumno;
}
elseif($tipoUsuario["TIPOUSUARIO"] == 'Profesor'){
$nombre=$nombreMenuProfesor;
			$href=$hrefProfesor;
			}
			elseif($admin["ESADMINISTRADOR"] == 1){
			$nombre=$nombreMenuAdministrador;
			$href=$hrefAdministrador;
			}
			else {
			$nombre=$nombreMenuSinLogin;
			$href=$hrefSinLogin;
			}
			$numElementos = count($nombre);
			if($tipoMenu == 0){
			echo "<a href='#' id='desplegableMenu' class='esconderEnEscritorio' >MENÚ <img src='img/varios/icono_menu.png' alt='Menú' /></a>";
			}
			else{
			$id = "menuPie";
			}
	?>
	<ul id=<?php echo $id; ?> >
		
	<?php
	for($i=0; $i < $numElementos; $i++){
		if($boton_on == ($i+1)){
			$class="boton_on";
		}
		else{
			$class="boton_off";
		}
	?>
		<li class="<?php echo $class?>">
			<a href="<?php echo $href[$i]; ?>"><?php echo $nombre[$i]; ?></a>				
		</li>
	<?php
	}
	?>
	</ul>
<?php
}
?>
 <?php

/* Función para paginar una consulta.
 ========================================================================== */

function consulta_paginada($conn, $query, $pag_num, $pag_size) {
	try {
		$primera = ($pag_num - 1) * $pag_size + 1;
		$ultima = $pag_num * $pag_size;
		$consulta_paginada = "SELECT * FROM ( " . "SELECT ROWNUM RNUM, AUX.* FROM ( $query ) AUX " . "WHERE ROWNUM <= :ultima" . ") " . "WHERE RNUM >= :primera";

		$stmt = $conn -> prepare($consulta_paginada);
		$stmt -> bindParam(':primera', $primera);
		$stmt -> bindParam(':ultima', $ultima);
		$stmt -> execute();
		return $stmt;
	} catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function total_consulta($conn, $query) {
	try {
		$total_consulta = "SELECT COUNT(*) AS TOTAL FROM ($query)";

		$stmt = $conn -> query($total_consulta);
		$result = $stmt -> fetch();
		$total = $result['TOTAL'];
		return $total;
	} catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

/* Función para dar de alta un alumno.
 ========================================================================== */
function alta_alumno($conexion, $usuario) {
	try {
		$fecha = date('d/m/Y', strtotime($usuario['fecha']));
		$stmt = $conexion -> prepare("INSERT INTO Alumnos (DNI, Nombre, Apellidos, Fecha_Nacimiento, Email) VALUES (:dni, :nombre, :apellidos, :fecha, :email)");

		$stmt -> bindParam(":dni", $usuario['dni']);
		$stmt -> bindParam(":nombre", $usuario['nombre']);
		$stmt -> bindParam(":apellidos", $usuario['apellidos']);
		$stmt -> bindParam(":fecha", $fecha);
		$stmt -> bindParam(":email", $usuario['email']);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		echo $e -> getMessage();
		return false;
	}
}

/* Función para dar de alta un usuario. Alumno
 ========================================================================== */
function alta_usuario($conexion, $usuario) {
	try {
		$stmt = $conexion -> prepare("INSERT INTO USUARIOS (DNI, PASS, TIPOUSUARIO, ESADMINISTRADOR) VALUES (:dni, :pass, :tipoUsuario, :esAdmin)");
		$alumno = "Alumno";
		$esAdmin = "0";
		$stmt -> bindParam(":dni", $usuario["dni"]);
		$stmt -> bindParam(":pass", $usuario["pass"]);
		$stmt -> bindParam(":tipoUsuario", $alumno);
		$stmt -> bindParam(":esAdmin", $esAdmin);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		echo $e -> getMessage();
		return false;
	}
}
/* Función para dar de alta un usuario. Profesor
 ========================================================================== */
function alta_usuarioProf($conexion, $usuario) {
	try {
		$stmt = $conexion -> prepare("INSERT INTO USUARIOS (DNI, PASS, TIPOUSUARIO, ESADMINISTRADOR) VALUES (:dni, :pass, :tipoUsuario, :esAdmin)");
		$alumno = "Profesor";
		$esAdmin = "0";
		$stmt -> bindParam(":dni", $usuario["DNI"]);
		$stmt -> bindParam(":pass", $usuario["PASS"]);
		$stmt -> bindParam(":tipoUsuario", $alumno);
		$stmt -> bindParam(":esAdmin", $esAdmin);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		echo $e -> getMessage();
		return false;
	}
}
/* Función para dar de alta un Profesor.
 ========================================================================== */
function alta_profesor($conexion,$usuario) {
	try{
		$oiddep=getOIDDespacho($conexion,$usuario['oid_d']);
		$fecha = date('d/m/Y',strtotime($usuario['fecha']));
		$stmt = $conexion->prepare("INSERT INTO Profesores (DNI, Nombre, Apellidos, Fecha_Nacimiento, Email,Categoria,OID_D,OID_Dep) VALUES (:dni, :nombre, :apellidos, :fecha, :email,:categoria,:oid_d,oid_dep)");
		
		$stmt->bindParam(":dni",$usuario['DNI']);
		$stmt->bindParam(":nombre",$usuario['nombre']);
		$stmt->bindParam(":apellidos",$usuario['apellidos']);
		$stmt->bindParam(":fecha",$fecha);
		$stmt->bindParam(":email",$usuario['email']);
		$stmt->bindParam(":categoria",$usuario['categoria']);
		$stmt->bindParam(":oid_d",$oiddep); //array to string?¿
		$stmt->bindParam(":oid_dep",$usuario['oid_dep']);
		$stmt->execute();
		return true;
	} catch(PDOException $e){
		echo $e->getMessage();
		return false;
	}
}
/* Función para consultar profesores por búsqueda
 ========================================================================== */
function consultarProfesores($conexion, $busqueda) {

	$etiquetas = ucwords($busqueda);
	$etiquetas = trim($etiquetas);
	$consulta = "SELECT NOMBRE,APELLIDOS FROM PROFESORES WHERE UPPER(TRANSLATE(NOMBRE, 'áéíóúÁÉÍÓÚ', 'aeiouAEIOU')) LIKE UPPER(TRANSLATE('%$etiquetas%', 'áéíóúÁÉÍÓÚ', 'aeiouAEIOU'))" . "OR DNI IN (SELECT DNI FROM PROFESORESIMPARTENASIGNATURAS WHERE CODIGO_ASIG IN (SELECT CODIGO_ASIG FROM ASIGNATURAS WHERE" . " UPPER(TRANSLATE(NOMBRE, 'áéíóúÁÉÍÓÚ', 'aeiouAEIOU')) LIKE UPPER(TRANSLATE('%$etiquetas%', 'áéíóúÁÉÍÓÚ', 'aeiouAEIOU'))))" . "OR OID_DEP IN (SELECT OID_DEP FROM DEPARTAMENTOS WHERE " . " UPPER(TRANSLATE(NOMBRE, 'áéíóúÁÉÍÓÚ', 'aeiouAEIOU')) LIKE UPPER(TRANSLATE('%$etiquetas%', 'áéíóúÁÉÍÓÚ', 'aeiouAEIOU')))";

	return $conexion -> query($consulta);
}

/* Función para mostrar todos los profesores
 ========================================================================== */
function mostrarProfesores($conexion) {

	$consulta = "SELECT DNI,NOMBRE,APELLIDOS FROM PROFESORES";

	return $conexion -> query($consulta);
}

/* Función para obtener el oid de un despacho.
 ========================================================================== */
function getOIDDespacho($conexion, $despacho) {
	try {
		$stmt = $conexion -> prepare("SELECT OID_D FROM DESPACHOS WHERE NOMBRE = :nombre");
		$stmt -> bindparam(":nombre", $despacho);
		$stmt -> execute();
		return $stmt -> fetch();

	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

/* Función para obtener el valor de EsAdministrador de un usuario.
 ========================================================================== */

function esAdministrador($conexion, $DNI) {
	try {
		$stmt = $conexion -> prepare("SELECT EsAdministrador FROM Usuarios WHERE DNI = :DNI");
		$stmt -> bindparam(':DNI', $DNI);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

/* Función para pedir una tutoría
 ========================================================================== */
function pedir_tutoria($conexion, $dniAlum, $dniProf, $fecha, $hora) {
	try {
		$fecha = date('d/m/Y', strtotime($fecha));
		$stmt = $conexion -> prepare("INSERT INTO Tutorias (Fecha,Hora_comienzo,Duracion,Estado,DNI_Alum,DNI_Prof) VALUES (:fecha, :hora, '15', 'Pendiente', :dniAlum, :dniProf)");

		$stmt -> bindParam(":dniAlum", $dniAlum);
		$stmt -> bindParam(":dniProf", $dniProf);
		$stmt -> bindParam(":hora", $hora);
		$stmt -> bindParam(":fecha", $fecha);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		echo $e -> getMessage();
		return false;
	}
}

/* Función para obtener cuantas tutorías tiene un profesor
 ========================================================================== */
function getNumeroTutoriasProfesor($conexion, $DNI) {

	try {
		$consulta = "SELECT COUNT(*) FROM DiasTutoriaProfesores WHERE DNI = :DNI";
		$pdoStmt = $conexion -> prepare($consulta);
		$pdoStmt -> bindParam(':DNI', $DNI);
		$pdoStmt -> execute();
		return $pdoStmt -> fetchColumn();

	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

/* Función para obtener las horas disponibles de tutorías (15 minutos cada una)
 ========================================================================== */
function getHorasTutoriaDisponibles($conexion, $dniProf, $dia) {

	try {
		$stmt = $conexion -> prepare('SELECT Hora_Comienzo_Tutoria, Hora_Fin_Tutoria FROM DiasTutoriaProfesores WHERE DNI = :DNI AND DIA = :DIA');
		$stmt -> bindParam(':DNI', $dniProf);
		$stmt -> bindParam(':DIA', $dia);
		$stmt -> execute();
		$horasTutoria = $stmt -> fetch();

		$horaComienzo = $horasTutoria["HORA_COMIENZO_TUTORIA"];
		$horaFin = $horasTutoria["HORA_FIN_TUTORIA"];
		$horaComienzoFormat = strtotime($horaComienzo);
		$horaFinFormat = strtotime($horaFin);
		$horas = array();

		while ($horaComienzoFormat != $horaFinFormat) {
			array_push($horas, $horaComienzoFormat);
			$horaComienzoFormat = strtotime('+15 minute', $horaComienzoFormat);

		}

		return $horas;

	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

}

/* Función para traducir días inglés->español
 ========================================================================== */
function traducirDiaInglesEsp($day) {
	$dia = "";
	switch($day) {
		CASE 'Monday' :
			$dia = 'Lunes';
			break;
		CASE 'Tuesday' :
			$dia = 'Martes';
			break;
		CASE 'Wednesday' :
			$dia = 'Miércoles';
			break;
		CASE 'Thursday' :
			$dia = 'Jueves';
			break;
		CASE 'Friday' :
			$dia = 'Viernes';
			break;
	}
	return $dia;
}

/* Función para traducir días español->inglés
 ========================================================================== */
function traducirDiaEspIngles($dia) {
	$day = "";
	switch($dia) {
		CASE 'Lunes' :
			$day = 'Monday';
			break;
		CASE 'Martes' :
			$day = 'Tuesday';
			break;
		CASE 'Miércoles' :
			$day = 'Wednesday';
			break;
		CASE 'Jueves' :
			$day = 'Thursday';
			break;
		CASE 'Viernes' :
			$day = 'Friday';
			break;
	}
	return $day;
}

/* Función para obtener la fecha de las tutorías (desde el día actual hasta 2 semanas)
 ========================================================================== */
function getFechasTutorias($diaEsp) {

	$diaIngles = traducirDiaEspIngles($diaEsp);
	$fechaActual = date("d-m-Y");
	$fechaActualFormat = strtotime($fechaActual);
	$dias = array();
	for ($i = 0; $i < 30; $i++) {
		$dia = strftime('%A', date($fechaActualFormat));
		$dia = traducirDiaInglesEsp(ucwords($dia));
		if ($dia == $diaEsp) {
			array_push($dias, date("d-m-Y", $fechaActualFormat));
		}
		$fechaActualFormat = strtotime('+1 days', $fechaActualFormat);
	}

	return $dias;
}

/* Función para obtener la información de DiasTutoriaProfesores.
 ========================================================================== */
function getInfoDiasTutoriaProfesor($conexion, $DNI) {

	try {
		$stmt = $conexion -> prepare('SELECT Hora_Comienzo_Tutoria, Hora_Fin_Tutoria, Dia FROM DiasTutoriaProfesores WHERE DNI = :DNI');
		$stmt -> bindParam(':DNI', $DNI);
		$stmt -> execute();
		return $stmt;
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}
?>