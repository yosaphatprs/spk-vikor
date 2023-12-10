<div class="row">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Perangkingan Metode Vikor</h1>
    </div>
</div>
<?php
$tipeKriteria = array();
$maxKriteria = array();
$nilaiMaxKriteria = array();
$nilaiMinKriteria = array();
$nilaikriteria = array();
$nilaisubkriteria = array();
$nilaiS = array();
$nilaiR = array();
$nilaiRata = array();
$hasilakhir = array();
$hasilMatriksKeputusanTernormalisasi = array();
$hasilTernormalisasiR = array();
$PembobotanMatriksKeputusanTernormalisasi = array();
$idealPositif = array();
$idealNegatif = array();
$matriksTernormalisasiY = array();
$JarakNilaiTerbobotPositif = array();
$JarakNilaiTerbobotNegatif = array();
$hasilSPK = array();

foreach ($matriks_keputusan as $matrikskeputusan) {
    foreach ($kriteria as $datakriteria) {
        $maxKriteria[$datakriteria['id_kriteria']][] = $matrikskeputusan[$datakriteria['id_kriteria']];
    }
}
foreach ($kriteria as $datakriteria) {
    if($datakriteria['tipe'] == "b"){
        $tipeKriteria[$datakriteria['id_kriteria']] = "Benefit";
    }else if($datakriteria['tipe'] == "c"){
        $tipeKriteria[$datakriteria['id_kriteria']] = "Cost";
    }
}
foreach ($kriteria as $datakriteria) {
    if($tipeKriteria[$datakriteria['id_kriteria']] == "Benefit"){
        rsort($maxKriteria[$datakriteria['id_kriteria']]);
        $nilaiMaxKriteria[] = $maxKriteria[$datakriteria['id_kriteria']][0];
    }else if($tipeKriteria[$datakriteria['id_kriteria']] == "Cost"){   
        sort($maxKriteria[$datakriteria['id_kriteria']]);
        $nilaiMaxKriteria[] = $maxKriteria[$datakriteria['id_kriteria']][0];
    }
}
foreach ($kriteria as $datakriteria) {
    if($tipeKriteria[$datakriteria['id_kriteria']] == "Benefit"){
        sort($maxKriteria[$datakriteria['id_kriteria']]);
        $nilaiMinKriteria[] = $maxKriteria[$datakriteria['id_kriteria']][0];
    }else if($tipeKriteria[$datakriteria['id_kriteria']] == "Cost"){
        rsort($maxKriteria[$datakriteria['id_kriteria']]);
        $nilaiMinKriteria[] = $maxKriteria[$datakriteria['id_kriteria']][0];
    }
}
$no = 1;
$indexNilai = 0;
foreach ($matriks_keputusan as $nilaiAlternatif) {
    $hasil = array();
    $nomorKriteria = 1;
    $hasilTernormalisasiR[$nilaiAlternatif['cu_alternatif']]['nama'] = $nilaiAlternatif['nama'];
    $hasilTernormalisasiR[$nilaiAlternatif['cu_alternatif']]['cu_alternatif'] = $nilaiAlternatif['cu_alternatif'];
    $indexKriteria = 0;
    foreach ($kriteria as $datakriteria) {
        $hasil[] = round(($nilaiMaxKriteria[$indexKriteria] - $nilaiAlternatif[$datakriteria['id_kriteria']]) / ($nilaiMaxKriteria[$indexKriteria] - $nilaiMinKriteria[$indexKriteria]), 3);
        $indexNilai += 1;
        $hasilTernormalisasiR[$nilaiAlternatif['cu_alternatif']][$datakriteria['id_kriteria']] = round(($nilaiMaxKriteria[$indexKriteria] - $nilaiAlternatif[$datakriteria['id_kriteria']]) / ($nilaiMaxKriteria[$indexKriteria] - $nilaiMinKriteria[$indexKriteria]), 3);
        $indexKriteria += 1;
    }
    $no++;
    $indexNilai = 0;
}

$no = 1;
foreach ($hasilTernormalisasiR as $data) {
    foreach ($kriteria as $datakriteria) {
        $PembobotanMatriksKeputusanTernormalisasi[$datakriteria['id_kriteria']][] = $hasilTernormalisasiR[$data['cu_alternatif']][$datakriteria['id_kriteria']] * $datakriteria['bobot'];
        $matriksTernormalisasiY[$data['cu_alternatif']][$datakriteria['id_kriteria']] = $hasilTernormalisasiR[$data['cu_alternatif']][$datakriteria['id_kriteria']] * $datakriteria['bobot'];
        $matriksTernormalisasiY[$data['cu_alternatif']]['cu_alternatif'] = $data['cu_alternatif'];
    }
}

$no = 1;
foreach ($matriksTernormalisasiY as $nilaiAlternatif) {
    $tempHasil = 0;
    $hasil = array();
    foreach ($kriteria as $datakriteria) {
        $tempHasil += $nilaiAlternatif[$datakriteria['id_kriteria']];
    }
    $nilaiS[$nilaiAlternatif['cu_alternatif']] = $tempHasil;
}

$no = 1;
foreach ($matriksTernormalisasiY as $nilaiAlternatif) {
    $tempHasil = 0;
    $hasil = array();
    $nomorSum = 1;
    foreach ($kriteria as $datakriteria) {
        if ($nilaiAlternatif[$datakriteria['id_kriteria']] > $tempHasil) {
            $tempHasil = $nilaiAlternatif[$datakriteria['id_kriteria']];
        }
    }
    $nilaiR[$nilaiAlternatif['cu_alternatif']] = $tempHasil;
}

$no = 1;
$hasilS = $nilaiS;
$hasilR = $nilaiR;
$maxR = 0;
$maxS = 0;
$minR = 0;
$minS = 0;
foreach ($matriksTernormalisasiY as $data) {
    rsort($nilaiS);
    rsort($nilaiR);
    $maxS = $nilaiS[0];
    $maxR = $nilaiR[0];
    sort($nilaiS);
    sort($nilaiR);
    $minS = $nilaiS[0];
    $minR = $nilaiR[0];
    $no = 1;
}
$this->db->empty_table('hasilspk');
foreach ($matriks_keputusan as $matrikskeputusan) {

    $hasil1 = round((0.5 * (($hasilS[$matrikskeputusan['cu_alternatif']] - $minS) / ($maxS - $minS))), 3);
    $hasil2 = round(((1 - 0.5) * ($hasilR[$matrikskeputusan['cu_alternatif']] - $minR) / ($maxR - $minR)), 3);

    $hasilAkhir = $hasil1 + $hasil2;

    $hasilSPK[$matrikskeputusan['cu_alternatif']]['cu_alternatif'] = $matrikskeputusan['cu_alternatif'];
    $hasilSPK[$matrikskeputusan['cu_alternatif']]['nama'] = $matrikskeputusan['nama'];
    $hasilSPK[$matrikskeputusan['cu_alternatif']]['nilai'] = $hasilAkhir;

    $dataSimpan = array(
        'cu_alternatif' => $matrikskeputusan['cu_alternatif'],
        'nama' => $matrikskeputusan['nama'],
        'nilai' => $hasilAkhir
    );

    $this->db->insert("hasilspk", $dataSimpan);
}
?>

<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-dark">
                            <i class="fas fa-table"></i> Perangkingan Guru
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>NIK</th>
                            <th>Nama Guru Honorer
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $this->db->order_by('nilai', 'ASC');
                        $hasilSPKDatabase = $this->db->get('hasilspk')->result_array();
                        foreach ($hasilSPKDatabase as $hasilPemilihan) {
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $hasilPemilihan['cu_alternatif']; ?></td>
                            <td><?= $hasilPemilihan['nama']; ?></td>
                            <td><?= $hasilPemilihan['nilai']; ?></td>
                        </tr>

                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>