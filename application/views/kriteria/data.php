<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
</div>
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <?php
                    $jumlah_bobot = 0;
                    if ($kriteria) :
                        foreach ($kriteria as $datakriteria) :
                            $jumlah_bobot += $datakriteria['bobot'];
                        endforeach;
                    endif;
                ?>
                <h4 class="h5 align-middle m-0 font-weight-bold text-dark">
                    <i class="fas fa-table"></i> Data Kriteria
                </h4>
                <?php
                    if($jumlah_bobot < 1){
                        echo "<p class='mb-0 mt-1 text-danger' style='font-size: 12px;'><i class='fas fa-exclamation-triangle mr-2'></i> Jumlah bobot kriteria harus 1</p>";
                    }
                ?>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('datakriteria/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fas fa-fw fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Kriteria
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th width="30">No.</th>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Tipe Kriteria</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($kriteria) :
                    foreach ($kriteria as $datakriteria) :
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $datakriteria['id_kriteria']; ?></td>
                    <td><?= $datakriteria['nama_kriteria']; ?></td>
                    <td><?= $datakriteria['bobot']; ?></td>
                    <td><?php if($datakriteria['tipe'] == "b") echo "Benefit"; elseif($datakriteria['tipe'] == "c") echo "Cost"?>
                    </td>
                    <td>
                        <a href="<?= base_url('datakriteria/edit/') . $datakriteria['id_kriteria'] ?>"
                            class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i> Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data?')"
                            href="<?= base_url('datakriteria/delete/') . $datakriteria['id_kriteria'] ?>"
                            class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endforeach;
                    ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><?php echo "Jumlah Bobot: " ?></td>
                    <td><?php echo $jumlah_bobot  ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                else : ?>
                <tr>
                    <td colspan="8" class="text-center">Silahkan tambahkan data kriteria baru</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function() {
    $('[data-toggle="tooltip"]').tooltip()

})
</script>