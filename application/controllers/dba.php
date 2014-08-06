<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dba extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function index() {
        redirect('404');
    }

    public function users_list() {
        $listado = $this->users_model->get_users_T();
        echo json_encode($listado);
    }

    public function user_data_for_id($id) {
        $user = $this->users_model->get_user($id);
        echo json_encode($user);
    }

    public function add_user() {
        $data = json_decode(file_get_contents("php://input"));
        
        if ($this->users_model->add_user($data)) {
            $status = "Ok";
            $msg = "Datos guardados correctamente.";
        } else {
            $status = "error";
            $msg = "Error al guardar datos.";
        }        
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    
    public function up_user($id){
        $data = json_decode(file_get_contents("php://input"));
        
        if ($this->users_model->update_user($data,$id)) {
            $status = "Ok";
            $msg = "Datos actualizados correctamente.";
        } else {
            $status = "error";
            $msg = "Error al actualizar los datos.";
        }        
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    
    public function del_user($id){
        if ($this->users_model->delete_user($id)) {
            $status = "Ok";
            $msg = "Datos eliminados correctamente.";
        } else {
            $status = "error";
            $msg = "Error al eliminar los datos.";
        }        
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}

// /dba/add_user