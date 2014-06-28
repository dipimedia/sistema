<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('inicio/inicio_vw');
    }

}

/* Fin de archivo acceso.php */
/* Ubicación: ./application/controllers/acceso.php */