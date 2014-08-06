<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_users_T() {
        //Ejecutamos la consulta y guardamos el resultado en la variable consulta
        $consulta = $this->db->get('users_T');

        //Verificamos que exista registros con los parametros proporcionados
        //Si es asi retornamos un arreglo con los resultados
        //De lo contrario retornamos FALSE
        if ($consulta->num_rows() > 0) {
            return $consulta->result_array();
        } else {
            return FALSE;
        }
    }

    function get_user($id) {
        $parametro['user_id'] = $id;
        //Ejecutamos la consulta y guardamos el resultado en la variable consulta
        $consulta = $this->db->get_where('users_T', $parametro);
        //Verificamos que exista registros con los parametros proporcionados
        //Si es asi retornamos un arreglo con los resultados
        //De lo contrario retornamos FALSE
        if ($consulta->num_rows() > 0) {
            return $consulta->result_array();
        } else {
            return FALSE;
        }
    }

    function add_user($data) {
        if ($this->db->insert('users_T', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function update_user($data, $id) {
        $parametro['user_id'] = $id;
        $this->db->where($parametro);
        if ($this->db->update('users_T', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function delete_user($id){
        $parametro['user_id'] = $id;
        if ($this->db->delete('users_T',$parametro)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }

}
