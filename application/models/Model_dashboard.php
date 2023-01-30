<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('donasi')->result();
    }

    public function getDetail($id)
    {
        return $this->db->get_where('donasi', ['id_donasi' => $id])->row();
    }
    public function getGambar($id)
    {
        return $this->db->get_where('donasi', ['id_donasi' => $id])->result();
    }

}
