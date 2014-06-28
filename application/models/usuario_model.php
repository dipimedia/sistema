<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usuario_model extends CI_Model {

    protected $table;
    protected $id;

    /*
      Constructor del modelo, aqui establecemos
      que tabla utilizamos y cual es su llave primaria.
     */

    function __construct() {
        parent::__construct();
        $this->table = 'usuarios';
        $this->id = 'idUsuario';
    }

    /*
      Con esta funcion comprobamos que exista el
      usuario en la base de datos, si es asi retornamos
      el contenido del registro, de lo contrario se
      retorna FALSE.
     */

    function getUsuario($email = '', $pass = '') {
        //Parametros de la consulta
        $parametros = array(
            'sEmail' => $email,
            'sPassword' => $pass,
            'bActivo' => 1);
        
        //Ejecutamos la consulta y guardamos el resultado en la variable consulta
        $consulta = $this->db->get_where($this->table, $parametros);
        
        //Verificamos que exista registros con los parametros proporcionados
        //Si es asi retornamos la fila con el usuario
        //De lo contrario retornamos FALSE
        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        }else{
            return FALSE;
        }            
    }
}
