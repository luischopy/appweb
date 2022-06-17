<?php 
include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();


$id=isset($_POST['id'])?$_POST['id']:'';
$nombre=isset($_POST['nombre'])?$_POST['nombre']:'';
$apellido=isset($_POST['apellidos'])?$_POST['apellidos']:'';

$cursos=isset($_POST['cursos'])?$_POST['cursos']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion!=''){
    switch($accion){
        case 'agregar':
            $sql="INSERT INTO alumnos (id, nombre,apellidos) VALUES (NULL,:nombre,:apellidos)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellidos',$apellido);
            $consulta->execute();

            $idAlumno=$conexionBD->lastInsertId();
           
        break;
        case 'editar':
            $sql="UPDATE cursos SET nombre_curso=:nombre_curso WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
        break;
        case 'borrar':
            $sql="DELETE FROM cursos WHERE id=:id"; 
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
        break;
        case "seleccionar":
            $sql="SELECT * FROM cursos WHERE id=:id"; 
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $curso=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre_curso=$curso['nombre_curso'];
            
        break;
    
    }

}

$consulta=$conexionBD->prepare("select * from alumnos");
$consulta->execute();
$alumnos=$listaAlumnos=$consulta->fetchAll();

foreach($alumnos as  $clave => $alumno){
    $sql="SELECT * FROM cursos WHERE id IN (SELECT idcurso FROM alumnos_cursos WHERE idalumno=:idalumno)";
    $consulta=$conexionBD->prepare($sql);
    $consulta->bindParam(':idalumno',$alumno['id']);
    $consulta->execute();
    $cursosAlumno=$consulta->fetchAll();
    $alumnos[$clave]['cursos']=$cursosAlumno;
}

?>