<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panduan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->helper('tgl_indo');
    }

    public function pimpinan()
    {
        $data['title'] = "Panduan Pimpinan";
        $this->template->load('templates/dashboard', 'panduan/panduanpimpinan', $data);
    }

    public function admin()
    {
        $data['title'] = "Panduan admin";
        $this->template->load('templates/dashboard', 'panduan/admin', $data);
    }
}
