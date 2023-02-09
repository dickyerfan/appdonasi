<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_histori');

        if ($this->session->userdata('level') == 'Pengguna') {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login sebagai Admin...
                      </div>'
            );
            redirect('auth');
        }elseif(!$this->session->userdata('level')){
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login... 
                      </div>'
            );
            redirect('auth');
        }
    }

    public function index()
    {

        $data['title'] = 'Log Histori';
        $data['histori'] = $this->Model_histori->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('histori', $data);
        $this->load->view('templates/footer');
    }
}