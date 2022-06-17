<?php include('../templates/cabecera.php'); ?>
<?php include('../secciones/alumnos.php'); ?>

<div class="row">
    <div class="col-md-5">
        <form action="" method="post">
            <div class="card">
                <div class="card-header">
                    Alumnos
                </div>
                <div class="card-body">
                    <div class="mb-3">
                      <label for="id" class="form-label">ID</label>
                      <input type="text"id
                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                      
                    </div>
                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre</label>
                      <input type="text"
                        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Escriba nombre">
                      
                    </div>
                    <div class="mb-3">
                      <label for="apellidos" class="form-label">Apellidos</label>
                      <input type="text"
                        class="form-control" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="Escriba apellidos">
                      
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Curso del alumno:</label>
                      <select multiple class="form-control" name="cursos[]" id="listaCursos">
                        <option>Selecciona una opciòn</option>
                        <option>curso 1</option>
                        <option>curso 2</option>
                      </select>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit"  name="accion" value="agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="editar"  class="btn btn-warning">Editar</button>
                        <button type="submit"  name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-7">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($alumnos as $alumno) { ?>
                            <tr>
                                <td> <?php echo $alumno['id']; ?> </td>
                                <td><?php echo $alumno['nombre']; ?> </td>
                                <td><?php echo $alumno['apellidos']; ?> <br>
                                <?php 
                                foreach($alumno["cursos"] as $cursos){ ?>
                                    - <a href="#"><?php echo $cursos['nombre_curso'];?></a><br>
                                 
                             <?php   } ?>
                                

                             </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="id" id="id" value="<?php echo $curso['id']; ?>">
                                        <input type="submit" name="accion" value="seleccionar" class="btn btn-info">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
               
            </tbody>
        </table>
        
    </div>
</div>

<?php include('../templates/pie.php'); ?>