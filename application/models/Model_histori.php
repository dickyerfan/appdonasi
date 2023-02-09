<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_histori extends CI_Model
{
    public function getAll(){
        $this->db->select('*');
        $this->db->from('table_log');
        $this->db->order_by('log_time','DESC');
        return $this->db->get()->result();
    }

}
