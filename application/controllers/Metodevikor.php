<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Metodevikor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        $this->load->helper('tgl_indo');
    }

    public function index()
    {
        $tempNisNama = array();
        $this->db->order_by('penilaian.cu_alternatif', 'ASC');
        $this->db->join('alternatif', 'penilaian.cu_alternatif = alternatif.cu_alternatif');
        $parseNama = $this->db->get('penilaian')->result_array();
        foreach ($parseNama as $data) {
            if (!in_array($data['cu_alternatif'], $tempNisNama)) {
                $tempNisNama[$data['cu_alternatif']]['cu_alternatif'] = $data['cu_alternatif'];
                $tempNisNama[$data['cu_alternatif']]['nama'] = $data['nama'];
            }
        }
        $this->db->select('*');
        $this->db->from('kriteria');
        $this->db->order_by('CAST(id_kriteria AS UNSIGNED)', 'ASC');
        $query = $this->db->get();
        $kriteria = $query->result_array();
        foreach ($kriteria as $datakriteria) {
            foreach ($parseNama as $data) {
                $this->db->where('kd_kriteria', $datakriteria['id_kriteria']);
                $this->db->where('cu_alternatif', $data['cu_alternatif']);
                $temp = $this->db->get('penilaian')->result_array();
                //die(print_r($temp));  
                $tempNisNama[$data['cu_alternatif']][$datakriteria['id_kriteria']] = $temp[0]['nilai'];
            }
        }
        $data['matriks_keputusan'] = $tempNisNama;
        $data['title'] = "";
        // $this->db->order_by('id_kriteria', 'ASC');
        // $data['kriteria'] = $this->db->get('kriteria')->result_array();
        $this->db->select('*');
        $this->db->from('kriteria');
        $this->db->order_by('CAST(id_kriteria AS UNSIGNED)', 'ASC');
        $query = $this->db->get();
        $data['kriteria'] = $query->result_array();
        $this->template->load('templates/dashboard', 'vikor/hasil', $data);
    }
}