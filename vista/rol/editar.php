

<h1>Rol: Editar</h1>

<form method="post" action="<?php echo URL;?>rol/guardar/<?php echo $this->rol[0]['Id']; ?>">
    <label>Id</label> <?php echo $this->rol[0]['Id'];?><br />
    <label>Nombre</label><input type="text" name="Nombre" value="<?php echo $this->rol[0]['Nombre']; ?>" /><br />
    <label>&nbsp;</label><input type="submit" />
</form>
