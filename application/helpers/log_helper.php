<?php
defined('BASEPATH') or exit('No direct script access allowed');

function helper_log($log_tipe = "", $str = ""){
    $CI =& get_instance();
 
    // if (strtolower($tipe) == "login"){
    //     $log_tipe   = 0;
    // }
    // elseif(strtolower($tipe) == "logout")
    // {
    //     $log_tipe   = 1;
    // }
    // elseif(strtolower($tipe) == "add"){
    //     $log_tipe   = 2;
    // }
    // elseif(strtolower($tipe) == "edit"){
    //     $log_tipe  = 3;
    // }
    // else{
    //     $log_tipe  = 4;
    // }
 
    // parameter
    $param['log_user']      = $CI->session->userdata('nama_lengkap');
    $param['log_tipe']      = $log_tipe;
    $param['log_desc']      = $str;
 
    //load model log
    $CI->load->model('m_log');
 
    //save to database
    $CI->m_log->save_log($param);
 
}

function helper_log_reg($log_tipe = "", $str = "")
{
    $CI =& get_instance();
    $param['log_user']      = $CI->input->post('nama_lengkap');
    $param['log_tipe']      = $log_tipe;
    $param['log_desc']      = $str;

    $CI->load->model('m_log');
    $CI->m_log->save_log($param);
}