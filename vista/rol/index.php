<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'rol/nuevo'; ?>" class="btn btn-link">Nuevo Rol</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Nombre del Rol</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($this->listaRoles as $key => $tipoEspacio): ?>
            <tr>
                <td><?php echo $tipoEspacio->getNombre(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'rol/editar/' . $tipoEspacio->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'rol/mostrar/' . $tipoEspacio->getId(); ?>" >Mostrar</a> | 
                    <a href="<?php echo ROOT . 'rol/eliminar/' . $tipoEspacio->getId(); ?>" >Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    
    
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
