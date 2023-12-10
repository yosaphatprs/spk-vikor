<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datasubkriteria extends CI_Controller
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
        $data['title'] = "";
        $this->db->order_by('id_kriteria', 'ASC');
        $data['kriteria'] = $this->db->get('kriteria')->result_array();
        $data['subkriteria'] = $this->db->get('subkriteria')->result_array();
        $this->template->load('templates/dashboard', 'subkriteria/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('kategori', 'kategori', 'required');
        $this->form_validation->set_rules('bobot', 'bobot', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Data Sub Kriteria";
            $this->db->order_by('id_kriteria', 'ASC');
            $data['kriteria'] = $this->db->get('kriteria')->result_array();
            $this->template->load('templates/dashboard', 'subkriteria/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $sql = "INSERT INTO subkriteria(id_subkriteria,cu_subkriteria,id_kriteria,kategori,bobot) values('','" . $input['cu_subkriteria'] . "','" . $input['kriteria'] . "','" . $input['kategori'] . "','" . $input['bobot'] . "')";
            //die(print_r($sql));
            $insert = $this->db->query($sql);
            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('datasubkriteria');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('datasubkriteria/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data SubKriteria";
            $this->db->order_by('id_kriteria', 'ASC');
            $data['kriteria'] = $this->db->get('kriteria')->result_array();
            $data['subkriteria'] = $this->db->query("SELECT * FROM subkriteria WHERE id_subkriteria='" . $getId . "'")->result_array();
            $this->template->load('templates/dashboard', 'subkriteria/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $data = array(
                'kategori' => $input['kategori'],
                'bobot' => $input['bobot'],
                'id_kriteria' => $input['kriteria'],
            );
            $update = $this->admin->update('subkriteria', 'id_subkriteria', $input['id_subkriteria'], $data);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('datasubkriteria');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('datasubkriteria/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('subkriteria', 'id_subkriteria', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('datasubkriteria');
    }
}
