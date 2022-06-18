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

            foreach($cursos as $curso){
            $sql="INSERT INTO alumnos_cursos (id, idalumno,idcurso) VALUES (NULL,:idalumno,:idcurso)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':idalumno',$idAlumno);
            $consulta->bindParam(':idcurso',$curso);
            $consulta->execute();
        }
           
        break;
        case 'editar':
            $sql="UPDATE alumnos SET nombre=:nombre, apellidos=:apellidos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellidos',$apellido);
            $consulta->bindParam(':id',$id);
            $consulta->execute();

            if(isset($cursos))
            {
                $sql="DELETE FROM alumnos_cursos WHERE idalumno=:idalumno"; 
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':idalumno',$id);
                $consulta->execute();
                foreach($cursos as $curso){
                    $sql="INSERT INTO alumnos_cursos (id, idalumno,idcurso) VALUES (NULL,:idalumno,:idcurso)";
                    $consulta=$conexionBD->prepare($sql);
                    $consulta->bindParam(':idalumno',$id);
                    $consulta->bindParam(':idcurso',$curso);
                    $consulta->execute();

                }
            }
        break;
        case 'borrar':
            $sql="DELETE FROM alumnos WHERE id=:id"; 
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
        break;
        case "seleccionar":
            $sql="SELECT * FROM alumnos WHERE id=:id"; 
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre= $alumno['nombre'];
            $apellido= $alumno['apellidos'];

            $sql="SELECT  cursos.id FROM alumnos_cursos INNER JOIN cursos ON cursos.id=alumnos_cursos.idcurso WHERE alumnos_cursos.idalumno=:idalumno"; 
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':idalumno',$id);
            $consulta->execute();
            $cursosAlumno=$consulta->fetchAll(PDO::FETCH_ASSOC);

           

            foreach($cursosAlumno as $curso){

                $arregloCursos[]=$curso['id'];

            }

            
            
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

$sql="SELECT * FROM cursos";
$listaCursos=$conexionBD->query($sql);
$cursos=$listaCursos->fetchAll();

?>