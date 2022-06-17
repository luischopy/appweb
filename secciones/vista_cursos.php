<?php include('../templates/cabecera.php'); ?>
<?php include('../secciones/curso.php'); ?>
<div class="row">
    <div class="col-12">
        <br>
        <div class="row">

            <div class="col-md-5">
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header">
                            cursos
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">ID</label>
                                <input type="text" class="form-control" name="id" id="id" value="<?php echo $id ?>" aria-describedby="helpId" placeholder="ID">

                            </div>
                            <div class="mb-3">
                                <label for="nombre_curso" class="form-label">Nombre </label>
                                <input type="text" class="form-control" value="<?php echo $nombre_curso; ?>" name="nombre_curso" id="nombre_curso" aria-describedby="helpId" placeholder="Nombre del curso">

                            </div>
                            <div class="btn-group" role="group" aria-label="">
                                <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                                <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                                <button type="submit" name="accion" value="borrar" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>

                    </div>
                </form>





            </div>
            <div class="col-md-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre curso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listaCursos as $curso) { ?>
                            <tr>
                                <td> <?php echo $curso['id']; ?> </td>
                                <td><?php echo $curso['nombre_curso']; ?> </td>
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
    </div>

    <?php include('../templates/pie.php'); ?>