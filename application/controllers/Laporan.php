<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
        $tempNisnama = array();
        $this->db->order_by('penilaian.cu_alternatif', 'ASC');
        $this->db->join('alternatif', 'penilaian.cu_alternatif = alternatif.cu_alternatif');
        $parsenama = $this->db->get('penilaian')->result_array();
        foreach ($parsenama as $data) {
            if (!in_array($data['cu_alternatif'], $tempNisnama)) {
                $tempNisnama[$data['cu_alternatif']]['cu_alternatif'] = $data['cu_alternatif'];
                $tempNisnama[$data['cu_alternatif']]['nama'] = $data['nama'];
            }
        }
        $kriteria = $this->db->get('kriteria')->result_array();
        foreach ($kriteria as $datakriteria) {
            foreach ($parsenama as $data) {
                $this->db->where('kd_kriteria', $datakriteria['id_kriteria']);
                $this->db->where('cu_alternatif', $data['cu_alternatif']);
                $temp = $this->db->get('penilaian')->result_array();
                //die(print_r($temp));  
                $tempNisnama[$data['cu_alternatif']][$datakriteria['id_kriteria']] = $temp[0]['nilai'];
            }
        }
        $data['matriks_keputusan'] = $tempNisnama;
        $data['title'] = "Hasil Keputusan Pemilihan Guru Honorer Berprestasi";
        $this->db->order_by('id_kriteria', 'ASC');
        $data['kriteria'] = $this->db->get('kriteria')->result_array();
        $this->template->load('templates/dashboard', 'laporan/analisa', $data);
    }

    public function cetak()
    {
        $this->load->library('CustomPDF');
        //$table = $table_ == 'barang_masuk' ? 'Barang Masuk' : 'Barang Keluar';

        $pdf = new FPDF();
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Times', 'B', 16);
        //$pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');

        $pdf->SetFont("", "B", 15);
        $pdf->MultiCell(0, 12, 'SEKOLAH MENENGAH PERTAMA PAHLAWAN NASIONAL', 0, 'C');
        $pdf->Cell(0, 1, " ", "B");
        $pdf->Ln(5);
        $pdf->SetFont("", "B", 12);
        $pdf->SetX(10);
        $pdf->Cell(0, 10, 'Laporan Hasil Keputusan Pemilihan Guru Honorer Berprestasi SMP Pahlawan Nasional', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 10, 'C', "B");
        $pdf->SetX(17);

        $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
        $pdf->Cell(45, 7, 'Nomor Induk Pegawai', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Nama Guru', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Nilai', 1, 0, 'C');
        $pdf->Ln();

        $no = 1;
        $this->db->order_by('nilai', 'ASC');
        $hasilSPKDatabase = $this->db->get('hasilspk')->result_array();
        foreach ($hasilSPKDatabase as $hasilPemilihan) {
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetX(17);
            $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
            $pdf->Cell(45, 7, $hasilPemilihan['cu_alternatif'], 1, 0, 'C');
            $pdf->Cell(70, 7, $hasilPemilihan['nama'], 1, 0, 'C');
            $pdf->Cell(50, 7, $hasilPemilihan['nilai'], 1, 0, 'C');
            $pdf->Ln();
        }
        
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetX(100);
        $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'C');
        $pdf->SetX(100);
        $pdf->Cell(0, 10, 'Kepala Sekolah', 0, 1, 'C');
        $pdf->Ln(18);
        $pdf->SetX(100);
        $pdf->Cell(0, 10, 'Tusiran, M.Pd', 0, 1, 'C');
        $pdf->Ln();

        


        $file_name =  'Laporan Analisa.pdf';
        $pdf->Output('I', $file_name);
    }
}
