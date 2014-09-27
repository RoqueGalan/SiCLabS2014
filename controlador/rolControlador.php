<?php
class RolControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        //echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
        //echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
        
        //los index son listas por default
       
        
        $this->vista->titulo = 'Rol';
        $this->vista->mensaje = "Estas en la principal de Rol";
        
        
        $rol = new Rol();
        
        $this->vista->listaRoles = $rol->lista();
   
        $this->vista->render('rol/index');
       
    }
    
    function crear(){
        $this->vista->titulo = 'Rol-Nuevo';
        $this->vista->mensaje = "Estas Creando un nuevo Rol";
        
        $this->vista->rol = new Rol();
                       
    
        if(isset($_POST['enviar'])){
            //validar los campos
            
            
            $this->vista->rol->set_Nombre($_POST['Nombre']);
            
            print_r($_POST);
 
        }
  
   
        $this->vista->render('rol/crear');        
    }
   
            
    function editar($id){
        $this->vista->titulo = 'Rol-Editar';
        $this->vista->mensaje = "Estas Editando el rol {$id}";

        $rol = new Rol();
       
        $this->vista->rol = $rol->buscar($id);
        //$this->vista->listaRoles = $rol->lista();
   
        if (empty($this->vista->rol)) {
            die('This is an invalid rol!');
        }
        
        $this->vista->render('rol/editar');
        
    }
    
}