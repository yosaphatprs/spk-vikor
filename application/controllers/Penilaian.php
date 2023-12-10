<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
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
        //$this->db->query("UPDATE penilaian SET keterangan = REPLACE(keterangan, '&lt;', '<')");
        //$this->db->query("UPDATE penilaian SET keterangan = REPLACE(keterangan, '&gt;', '>')");
        $data['title'] = "";
        $this->db->order_by('id_kriteria', 'ASC');
        $data['kriteria'] = $this->db->get('kriteria')->result_array();
        $this->db->order_by('cu_alternatif', 'ASC');
        $data['alternatif'] = $this->db->get('alternatif')->result_array();
        $this->template->load('templates/dashboard', 'penilaian/data', $data);
        
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('cu_alternatif', 'cu_alternatif', 'required');
    }

    public function add()
    {
        $this->db->query("UPDATE penilaian SET keterangan = REPLACE(keterangan, '&lt;', '<')");
        $this->db->query("UPDATE penilaian SET keterangan = REPLACE(keterangan, '&gt;', '>')");
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Penilaian Guru Berdasarkan Kriteria";
            $data['maxkriteria'] = $this->db->count_all('kriteria');
            $this->db->order_by('nis', 'ASC');
            $data['siswa'] = $this->db->get('siswa')->result_array();
            $this->db->order_by('id_kriteria', 'ASC');
            $data['kriteria'] = $this->db->get('kriteria')->result_array();
            $this->template->load('templates/dashboard', 'penilaian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $loopkriteria = $input['maxkriteria'];
            try {
                for ($i = 1; $i <= $loopkriteria; $i++) {
                    $nis = $input['nis'];
                    $sql = "INSERT INTO penilaian(id_penilaian,nis,tahun_akademik,kd_kriteria,keterangan) values('','" . $nis . "','" . $input['tahun_akademik'] . "','" . $input['kriteria'.$i] . "','" . $input['nilaikriteria'.$i] . "')";
                    $insert = $this->db->query($sql);
                }
                set_pesan('data berhasil disimpan.');
                redirect('penilaian');
            } catch (Exception $e) {
                set_pesan('Opps ada kesalahan!'. $e->getMessage());
                        redirect('penilaian/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Penilaian Guru Berdasarkan Kriteria";
            $data['id'] = $getId;
            $data['alternatif'] = $this->db->query("SELECT * FROM alternatif WHERE cu_alternatif='" . $getId . "'")->result_array();
            $this->db->order_by('id_kriteria', 'ASC');
            $data['penilaian'] = $this->db->query("SELECT * FROM penilaian WHERE cu_alternatif='" . $getId . "' ORDER BY kd_kriteria ASC")->result_array();
            $data['maxkriteria'] = $this->db->count_all('kriteria');
            $this->db->order_by('id_kriteria', 'ASC');
            $data['kriteria'] = $this->db->get('kriteria')->result_array();
            $this->template->load('templates/dashboard', 'penilaian/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $loopkriteria = $input['maxkriteria'];
            try {
                $this->db->delete('penilaian', ['cu_alternatif' => $input['cu_alternatif']]);
                for ($i = 1; $i <= $loopkriteria; $i++) {
                    $cu_alternatif = $input['cu_alternatif'];
                    $sql = "INSERT INTO penilaian(id_penilaian,cu_alternatif,kd_kriteria,nilai) values('','" . $cu_alternatif . "','" . $input['kriteria'.$i] . "','" . $input['nilaikriteria'.$i] . "')";
                    $insert = $this->db->query($sql);
                }
                set_pesan('data berhasil disimpan.');
                redirect('penilaian');
            } catch (Exception $e) {
                set_pesan('Opps ada kesalahan!'. $e->getMessage());
                        redirect('penilaian/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('penilaian', 'cu_alternatif', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('penilaian');
    }
}