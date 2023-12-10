<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataalternatif extends CI_Controller
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
        $this->db->order_by('cu_alternatif', 'ASC');
        $data['alternatif'] = $this->db->get('alternatif')->result_array();
        $this->template->load('templates/dashboard', 'alternatif/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Data Alternatif";
            $this->template->load('templates/dashboard', 'alternatif/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $sql = "INSERT INTO alternatif values('". $input['cu_alternatif'] . "','". $input['nama'] . "','". $input['jenis_kelamin']."','". $input['tempat_lahir']."','". $input['tanggal_lahir']."','". $input['pendidikan']."','". $input['pengalaman']."','". $input['status_menikah']."','". $input['alamat']."')";
            $insert = $this->db->query($sql);
            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('dataalternatif');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('dataalternatif/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Alternatif";
            $data['alternatif'] = $this->db->query("SELECT * FROM alternatif WHERE cu_alternatif='".$getId."'")->result_array();
            $this->template->load('templates/dashboard', 'alternatif/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $id = $input['id'];
            $data = array(
                'nama' => $input['nama'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'tempat_lahir' => $input['tempat_lahir'],
                'pendidikan' => $input['pendidikan'],
                'pengalaman' => $input['pengalaman'],
                'status' => $input['status_menikah'],
                'alamat' => $input['alamat']
                
            );
            $datapenilaian = array(
                'cu_alternatif' => $input['cu_alternatif']
            );
            $update = $this->admin->update('alternatif', 'cu_alternatif', $id, $data);
            $update = $this->admin->update('penilaian', 'cu_alternatif', $id, $datapenilaian);

            if ($update) {
                set_pesan('data berhasil diupdate');
                redirect('dataalternatif');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('dataalternatif/edit/' . $id);
            }
        }
    }

    public function show($getId)
    {
        $id = encode_php_tags($getId);
        $data['title'] = "";
        $data['alternatif'] = $this->db->query("SELECT * FROM alternatif WHERE cu_alternatif='".$getId."'")->result_array();
        $this->template->load('templates/dashboard', 'alternatif/show', $data);
    }
    
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('alternatif', 'cu_alternatif', $id) && $this->admin->delete('penilaian', 'cu_alternatif', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('dataalternatif');
    }
}