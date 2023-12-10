<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datakriteria extends CI_Controller
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
        $this->template->load('templates/dashboard', 'kriteria/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'required');
        $this->form_validation->set_rules('nama_kriteria', 'nama_kriteria', 'required');
        $this->form_validation->set_rules('bobot', 'bobot', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Data Kriteria";
            $kode = 'K';
            $kode_terakhir = $this->admin->getMax('kriteria', 'id_kriteria', $kode);
            $kode_tambah = substr($kode_terakhir, -1, 1);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['kode'] = $kode . $kode_tambah;
            
            $this->template->load('templates/dashboard', 'kriteria/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $sql = "INSERT INTO kriteria(id_kriteria,nama_kriteria,bobot) values('". $input['id_kriteria'] . "','". $input['nama_kriteria']."','". $input['bobot']."')";
            $insert = $this->db->query($sql);
            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('datakriteria');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('datakriteria/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Kriteria";
            $data['kriteria'] = $this->db->query("SELECT * FROM kriteria WHERE id_kriteria='".$getId."'")->result_array();
            $this->template->load('templates/dashboard', 'kriteria/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $data = array(
                'nama_kriteria' => $input['nama_kriteria'],
                'bobot' => $input['bobot']
            );
            $update = $this->admin->update('kriteria', 'id_kriteria', $input['id_kriteria'], $data);
            if ($update) {
                set_pesan('data berhasil diupdate');
                redirect('datakriteria');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('datakriteria/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('kriteria', 'id_kriteria', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('datakriteria');
    }
}
