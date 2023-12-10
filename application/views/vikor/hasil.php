<?php
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
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-square-root-alt"></i> Perhitungan Vikor</h1>
</div>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Tabel Penilaian Alternatif Terhadap Kriteria
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive" id="dataTable">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No. </th>
                            <th>NUPTK</th>
                            <th>Nama</th>
                            <?php foreach ($kriteria as $datakriteria) { ?>
                            <th><?php echo $datakriteria['nama_kriteria'] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($matriks_keputusan as $matrikskeputusan) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $matrikskeputusan['cu_alternatif']; ?></td>
                            <td><?= $matrikskeputusan['nama']; ?></td>
                            <?php
                                foreach ($kriteria as $datakriteria) {
                                ?>
                            <td>
                                <?php
                                        echo $matrikskeputusan[$datakriteria['id_kriteria']];
                                        $maxKriteria[$datakriteria['id_kriteria']][] = $matrikskeputusan[$datakriteria['id_kriteria']];
                                        ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" align="center"><b>MAX</b></td>
                            <?php
                            foreach ($kriteria as $datakriteria) {
                                rsort($maxKriteria[$datakriteria['id_kriteria']]);
                                echo "<td>" . $maxKriteria[$datakriteria['id_kriteria']][0] . "</td>";
                                $nilaiMaxKriteria[] = $maxKriteria[$datakriteria['id_kriteria']][0];
                            }

                            ?>
                        </tr>
                        <tr>
                            <td colspan="3" align="center"><b>MIN</b></td>
                            <?php
                            foreach ($kriteria as $datakriteria) {
                                sort($maxKriteria[$datakriteria['id_kriteria']]);
                                echo "<td>" . $maxKriteria[$datakriteria['id_kriteria']][0] . "</td>";
                                $nilaiMinKriteria[] = $maxKriteria[$datakriteria['id_kriteria']][0];
                            }

                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<br>

<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Perhitungan Normalisasi Matriks [<i>R<sub>ij</sub> = (X<sub>i</sub> - X<sub>ij</sub>) /
                                (X<sub>j</sub> - X<sub>j</sub>)</i>]
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
                    <tbody>
                        <?php
                        $no = 1;
                        $indexNilai = 0;
                        foreach ($matriks_keputusan as $nilaiAlternatif) {
                            $hasil = array();
                        ?>
                        <tr>
                            <td>
                                <b><?= $no . ". [" . $nilaiAlternatif['cu_alternatif'] . "] " . $nilaiAlternatif['nama'] ?></b>
                                <br>

                                <?php
                                    $nomorKriteria = 1;
                                    $hasilTernormalisasiR[$nilaiAlternatif['cu_alternatif']]['nama'] = $nilaiAlternatif['nama'];
                                    $hasilTernormalisasiR[$nilaiAlternatif['cu_alternatif']]['cu_alternatif'] = $nilaiAlternatif['cu_alternatif'];
                                    $indexKriteria = 0;
                                    foreach ($kriteria as $datakriteria) {
                                        echo  "<i>R<sub>A" . $no . ",</sub><sub>" . $datakriteria['id_kriteria'] . "</sub></i> = (";
                                        echo $nilaiMaxKriteria[$indexKriteria] . " - ";
                                        echo $nilaiAlternatif[$datakriteria['id_kriteria']] . ")/(";
                                        echo $nilaiMaxKriteria[$indexKriteria] . " - ";
                                        echo $nilaiMinKriteria[$indexKriteria] . ") = ";

                                        $hasil[] = round(($nilaiMaxKriteria[$indexKriteria] - $nilaiAlternatif[$datakriteria['id_kriteria']]) / ($nilaiMaxKriteria[$indexKriteria] - $nilaiMinKriteria[$indexKriteria]), 2);
                                        echo round(($nilaiMaxKriteria[$indexKriteria] - $nilaiAlternatif[$datakriteria['id_kriteria']]) / ($nilaiMaxKriteria[$indexKriteria] - $nilaiMinKriteria[$indexKriteria]), 2);
                                        $indexNilai += 1;
                                        echo "<br>";
                                        $hasilTernormalisasiR[$nilaiAlternatif['cu_alternatif']][$datakriteria['id_kriteria']] = round(($nilaiMaxKriteria[$indexKriteria] - $nilaiAlternatif[$datakriteria['id_kriteria']]) / ($nilaiMaxKriteria[$indexKriteria] - $nilaiMinKriteria[$indexKriteria]), 2);
                                        $indexKriteria += 1;
                                    }
                                    $no++;
                                    $indexNilai = 0;
                                    ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Hasil Normalisasi Matriks
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive" id="dataTable">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No. </th>
                            <th>NUPTK</th>
                            <th>Nama</th>
                            <?php foreach ($kriteria as $datakriteria) { ?>
                            <th>[<?php echo $datakriteria['id_kriteria'] . " " . $datakriteria['nama_kriteria'] ?>]</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        //die(print_r($hasilTernormalisasiR));
                        foreach ($hasilTernormalisasiR as $data) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['cu_alternatif']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <?php
                                foreach ($kriteria as $datakriteria) {
                                ?>
                            <td>
                                <?php
                                        echo $hasilTernormalisasiR[$data['cu_alternatif']][$datakriteria['id_kriteria']];
                                        ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Perhitungan Normalisasi Matriks X Bobot
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive" id="dataTable">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No. </th>
                            <th>NUPTK</th>
                            <th>Nama</th>
                            <?php foreach ($kriteria as $datakriteria) { ?>
                            <th>[<?php echo $datakriteria['id_kriteria'] . " " . $datakriteria['nama_kriteria'] ?>]</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        //die(print_r($hasilTernormalisasiR));
                        foreach ($hasilTernormalisasiR as $data) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['cu_alternatif']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <?php
                                foreach ($kriteria as $datakriteria) {
                                ?>
                            <td>
                                <?php
                                        echo $hasilTernormalisasiR[$data['cu_alternatif']][$datakriteria['id_kriteria']];
                                        ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="8" align="center"><b>X (Dikali)</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center"><b>Bobot</b></td>
                            <?php
                                foreach ($kriteria as $datakriteria) {
                                ?>
                            <td>
                                <?php
                                   echo $datakriteria['bobot'];
                                  ?>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Matriks Keputusan Ternormalisasi (Hasil)
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive" id="dataTable">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No. </th>
                            <th>NUPTK</th>
                            <th>Nama</th>
                            <?php foreach ($kriteria as $datakriteria) { ?>
                            <th>[<?php echo $datakriteria['id_kriteria'] . " " . $datakriteria['nama_kriteria'] ?>]</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        //die(print_r($hasilTernormalisasiR));
                        foreach ($hasilTernormalisasiR as $data) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['cu_alternatif']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <?php
                                foreach ($kriteria as $datakriteria) {
                                ?>
                            <td>
                                <?php
                                        $PembobotanMatriksKeputusanTernormalisasi[$datakriteria['id_kriteria']][] = $hasilTernormalisasiR[$data['cu_alternatif']][$datakriteria['id_kriteria']] * $datakriteria['bobot'];
                                        $matriksTernormalisasiY[$data['cu_alternatif']][$datakriteria['id_kriteria']] = $hasilTernormalisasiR[$data['cu_alternatif']][$datakriteria['id_kriteria']] * $datakriteria['bobot'];
                                        $matriksTernormalisasiY[$data['cu_alternatif']]['cu_alternatif'] = $data['cu_alternatif'];
                                        echo $hasilTernormalisasiR[$data['cu_alternatif']][$datakriteria['id_kriteria']] * $datakriteria['bobot'];
                                        ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-light text-center">
                            Mencari Nilai S<sub>i</sub> (Menjumlahkan Seluruh Nilai)
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($matriksTernormalisasiY as $nilaiAlternatif) {
                            $tempHasil = 0;
                            $hasil = array() ?>
                        <tr>
                            <td>
                                S (<?= $nilaiAlternatif['cu_alternatif'] ?>) =
                                <?php
                                        $nomorSum = 1;
                                        foreach ($kriteria as $datakriteria) {
                                            echo $nilaiAlternatif[$datakriteria['id_kriteria']];
                                            //echo "(" . $nilaiAlternatif[$datakriteria['id_kriteria']] . " - " . $nilaiAlternatif[$datakriteria['id_kriteria']] . ")<sup>2</sup>";
                                            if ($nomorSum != count($kriteria)) {
                                                echo " +";
                                            }
                                            //$tempHasil = $idealPositif[$datakriteria['id_kriteria']] - $nilaiAlternatif[$datakriteria['id_kriteria']];
                                            //$hasil[] = pow($tempHasil, 2);
                                            $nomorSum++;
                                            //echo $tempBobot . ";";
                                            $tempHasil += $nilaiAlternatif[$datakriteria['id_kriteria']];
                                        ?>
                                <?php }
                                        $nilaiS[$nilaiAlternatif['cu_alternatif']] = $tempHasil;
                                        echo " = " . $tempHasil;
                                        ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-light text-center">
                            Mencari Nilai R<sub>i</sub> (Nilai Max)
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($matriksTernormalisasiY as $nilaiAlternatif) {
                            $tempHasil = 0;
                            $hasil = array() ?>
                        <tr>
                            <td>
                                R (<?= $nilaiAlternatif['cu_alternatif'] ?>) = MAX
                                <?php
                                        $nomorSum = 1;
                                        foreach ($kriteria as $datakriteria) {
                                            echo "{ ";    
                                            echo $nilaiAlternatif[$datakriteria['id_kriteria']];
                                                if ($nomorSum != count($kriteria)) {
                                                    echo " }";
                                                }   
                                                                                                
                                            if ($nilaiAlternatif[$datakriteria['id_kriteria']] > $tempHasil) {
                                                $tempHasil = $nilaiAlternatif[$datakriteria['id_kriteria']];
                                            } 
                                        ?>
                                <?php } 
                                        $nilaiR[$nilaiAlternatif['cu_alternatif']] = $tempHasil;
                                        echo " = " . $tempHasil; 
                                        ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Hasil Nilai S Dan Nilai R
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive" id="dataTable">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No. </th>
                            <th class="text-center">NUPTK</th>
                            <?php foreach ($kriteria as $datakriteria) { ?>
                            <th>[<?php echo $datakriteria['id_kriteria'] . " " . $datakriteria['nama_kriteria'] ?>]</th>
                            <?php } ?>
                            <th>S<sub>i</sub></th>
                            <th>R<sub>i</sub></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $hasilS = $nilaiS;
                        $hasilR = $nilaiR;
                        $maxR = 0;
                        $maxS = 0;
                        $minR = 0;
                        $minS = 0;
                        foreach ($matriksTernormalisasiY as $data) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['cu_alternatif']; ?></td>
                            <?php
                                foreach ($kriteria as $datakriteria) {
                                ?>
                            <td class="text-center">
                                <?php
                                        echo $data[$datakriteria['id_kriteria']];
                                        ?>
                            </td>
                            <?php }
                                echo "<td>" . $nilaiS[$data['cu_alternatif']] . "</td>";
                                echo "<td>" . $nilaiR[$data['cu_alternatif']] . "</td>";
                                ?>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="<?= count($kriteria) + 2 ?>" align="center"><b>MAX</b></td>
                            <?php
                            rsort($nilaiS);
                            rsort($nilaiR);
                            $maxS = $nilaiS[0];
                            $maxR = $nilaiR[0];
                            echo "<td>" . $nilaiS[0] . "</td>";
                            echo "<td>" . $nilaiR[0] . "</td>";
                            ?>
                        </tr>
                        <tr>
                            <td colspan="<?= count($kriteria) + 2 ?>" align="center"><b>MIN</b></td>
                            <?php
                            sort($nilaiS);
                            sort($nilaiR);
                            $minS = $nilaiS[0];
                            $minR = $nilaiR[0];
                            echo "<td>" . $nilaiS[0] . "</td>";
                            echo "<td>" . $nilaiR[0] . "</td>";
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Nilai Max dan Min Vikor
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
                    <tbody>
                        <tr align="center">
                            <td>
                                S<b><sup> +</sup></b> =
                                <?php
                                    rsort($nilaiS);
                                    $maxS = $nilaiS[0];
                                    echo $nilaiS[0];
                                    ?>
                            </td>
                            <td>
                                S<b><sup> -</sup></b> =
                                <?php
                                    sort($nilaiS);
                                    $minS = $nilaiS[0];
                                    echo $nilaiS[0];
                                    ?>
                            </td>
                            <td>
                                R<b><sup> +</sup></b> =
                                <?php
                                    rsort($nilaiR);
                                    $maxR = $nilaiR[0];
                                    echo $nilaiR[0];
                                    ?>
                            </td>
                            <td>
                                R<b><sup> -</sup></b> =
                                <?php
                                    sort($nilaiR);
                                    $minR = $nilaiR[0];
                                    echo $nilaiR[0];
                                    ?>
                            </td>

                            <td>
                                V = (0.5)
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white">
                            Perhitungan Indeks Vikor
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive" id="dataTable">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>NUPTK</th>
                            <th>Nama</th>
                            <th>Perhitungan</th>
                            <th>Nilai Q</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        $this->db->empty_table('hasilspk');
                        foreach ($matriks_keputusan as $matrikskeputusan) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $matrikskeputusan['cu_alternatif']; ?></td>
                            <td><?= $matrikskeputusan['nama']; ?></td>
                            <td>
                                <?php
                                    echo "= ((" . $hasilS[$matrikskeputusan['cu_alternatif']] . " - " . $maxS . ") / (" . $minS . "-" . $maxS . ")0.5) + ((1-0.5)(" . $hasilR[$matrikskeputusan['cu_alternatif']] . " - ".$maxR.") / (".$minR."-".$maxR."))";
                                    echo "<br>";
                                    $hasil1 =round((0.5*(($hasilS[$matrikskeputusan['cu_alternatif']]-$maxS)/($minS-$maxS))),2);
                                    echo "= " . $hasil1;
                                    echo " + ";
                                    $hasil2 =round(((1-0.5)*($hasilR[$matrikskeputusan['cu_alternatif']]-$maxR)/($minR-$maxR)),2);
                                    echo $hasil2;
                                    echo "<br>";
                                    $hasilAkhir = $hasil1+$hasil2;
                                    ?>
                            </td>
                            <td>
                                <?php
                                    echo $hasilAkhir;
                                    $hasilSPK[$matrikskeputusan['cu_alternatif']]['cu_alternatif'] = $matrikskeputusan['cu_alternatif'];
                                    $hasilSPK[$matrikskeputusan['cu_alternatif']]['nama'] = $matrikskeputusan['nama'];
                                    $hasilSPK[$matrikskeputusan['cu_alternatif']]['nilai'] = $hasilAkhir;

                                    $dataSimpan = array(
                                        'cu_alternatif' => $matrikskeputusan['cu_alternatif'],
                                        'nama' => $matrikskeputusan['nama'],
                                        'nilai' => $hasilAkhir
                                    );

                                    $this->db->insert("hasilspk",$dataSimpan);

                                    //$sql = "INSERT INTO hasilspk values('" . $matrikskeputusan['nik'] . "','" . $matrikskeputusan['nama'] . "'," . $$hasilAkhir .")";
                                    //$insert = $this->db->query($sql);
                                    ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>