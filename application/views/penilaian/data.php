<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Penilaian Guru Honorer</h1>
</div>
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-dark">
                    <i class="fa fa-table"></i> Data Penilaian Guru Honorer
                </h4>
                <p class="mb-0 mt-1 text-muted" style="font-size: 12px;"><i class="fa fa-info mr-3"></i> Arahkan cursor
                    ke
                    header kriteria untuk
                    menampilkan informasi kriteria.</p>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('metodevikor') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fas fa-fw fa-square-root-alt"></i>
                    </span>
                    <span class="text">
                        Perhitungan Metode Vikor
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th>No.</th>
                    <th>NUPTK</th>
                    <th width="12%">Nama Guru Honorer</th>
                    <?php 
                    $i = 0;
                    foreach ($kriteria as $datakriteria) { 
                        $i++; ?>
                    <th class="text-center" title=" <?php echo $datakriteria['nama_kriteria'] ?>">
                        <?php echo "K" . strval($i); ?>
                    </th>
                    <?php } ?>
                    <th width="5%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($alternatif as $dataalternatif) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dataalternatif['cu_alternatif']; ?></td>
                    <td><?= $dataalternatif['nama']; ?></td>
                    <?php
                        foreach ($kriteria as $datakriteria) {
                            $this->db->order_by('CAST(kd_kriteria AS UNSIGNED)', 'ASC');
                            $this->db->where('cu_alternatif', $dataalternatif['cu_alternatif']);
                            $this->db->where('kd_kriteria', $datakriteria['id_kriteria']);
                            $penilaian = $this->db->get('penilaian');
                            if ($penilaian->num_rows() > 0) {
                        ?>
                    <td class="text-center">
                        <?php
                                    $nilai = $penilaian->result_array();
                                    echo $nilai[0]['nilai'];
                                    ?>
                    </td>
                    <?php } else {
                                echo "<td></td>";
                            }
                        } ?>
                    <td>
                        <a href="<?= base_url('penilaian/edit/') . $dataalternatif['cu_alternatif'] ?>"
                            class="btn btn-success btn-sm btn-icon-split">
                            <spann class="icon"><i class="fa fa-fw fa-plus"></i></spann>
                            <span class="text">Input</span>
                        </a>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<script>
$(function() {
    $('[data-toggle="tooltip"]').tooltip()

})
</script>