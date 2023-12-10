<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemenakun extends CI_Controller
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
        $this->db->order_by('id_user', 'ASC');
        $data['users'] = $this->db->get('user')->result_array();
        $this->template->load('templates/dashboard', 'user/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Pengguna";
            $this->template->load('templates/dashboard', 'user/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $password = password_hash($input['password'],PASSWORD_DEFAULT);
            $sql = "INSERT INTO user values('','". $input['nama'] . "','". $input['username'] . "','". $input['role'] . "','". $password . "')'";
            $insert = $this->db->query($sql);
            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('manajemenakun');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('manajemenakun/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Data Pengguna";
            $data['user'] = $this->db->query("SELECT * FROM user WHERE id_user='".$getId."'")->result_array();
            $this->template->load('templates/dashboard', 'user/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $data = array(
                'nama' => $input['nama'],
                'username' => $input['username'],
                'password' => password_hash($input['password'], PASSWORD_DEFAULT),
                'role' => $input['role']
            );
            $update = $this->admin->update('user', 'id_user', $input['id_user'], $data);

            print_r($data);

            if ($update) {
                set_pesan('data berhasil diupdate');
                redirect('manajemenakun');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('manajemenakun/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('user', 'id_user', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('manajemenakun');
    }
}