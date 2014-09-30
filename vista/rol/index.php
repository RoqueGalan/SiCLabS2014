<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'rol/nuevo'; ?>" class="btn btn-link">Nuevo Rol</a>
</p>

<table class="table table-striped table-hover  t">
    <thead>
        <tr>
            <th>Nombre del Rol</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($this->listaRoles as $key => $rol): ?>
            <tr>
                <td><?php echo $rol->getNombre(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'rol/editar/' . $rol->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'rol/mostrar/' . $rol->getId(); ?>" >Mostrar</a> | 
                    <a href="<?php echo ROOT . 'rol/eliminar/' . $rol->getId(); ?>" >Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
