<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->helper('tgl_indo');
    }

    public function index()
    {
        $data['title'] = "";
        $data['jumlahpegawai'] = $this->db->query("SELECT*FROM hasilspk")->num_rows();
        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
