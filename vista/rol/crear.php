<h1><?php echo $this->mensaje; ?></h1>

<form name="form" id="form" method="post" action="">

    <input type="hidden" name="enviar" value="1">

    <p>
        <label>Nombre</label>
        <input type="text" name="Nombre" value="">
    </p>

    <p>
        <input type="submit" value="Registrar" class="btn btn-default"/>
    </p>
    
</form>
