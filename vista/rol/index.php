
<h2><?php echo $this->mensaje; ?></h2>

<a href="rol/crear" class="btn btn-link">Nuevo Rol</a>


<table class="table">
    <tr>
        <td>ID</td>
        <td>Nombre del Rol</td>
        <td></td>
    </tr>

    <?php foreach ($this->listaRoles as $key => $rol): ?>
        <tr>
            <td><?php echo $rol['Id']; ?></td>
            <td><?php echo $rol['Nombre']; ?></td>
            <td>
                <a href="rol/editar/<?php echo $rol['Id'];?>">Editar</a>
                <a href="rol/ver/<?php echo $rol['Id'];?>" >Ver</a>
                <a href="rol/eliminar/<?php echo $rol['Id'];?>" >Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>


</table>