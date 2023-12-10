<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Data Sub Kriteria</h1>
</div>
<?= $this->session->flashdata('pesan'); ?>
<?php
foreach ($kriteria as $datakriteria) {
?>
    <div class="card shadow-sm mb-4 border-bottom-info">
        <div class="card-header bg-white py-3">
          <div class="row">
              <div class="col">
                  <h4 class="h5 align-middle m-0 font-weight-bold text-dark">
                  <i class="fas fa-table"></i> <?php echo "[" . $datakriteria['id_kriteria'] . "] " . $datakriteria['nama_kriteria']; ?>
                    </h4>
                </div>
        
        <div class="col-auto">
            <a href="<?= base_url('datasubkriteria/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">
                    Tambah SubKriteria
                </span>
             </a>
          </div>
       </div>
    </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th width="5%">No.</th>
                        <th>Kode SubKriteria</th>
                        <th>Kategori</th>
                        <th>Nilai</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($subkriteria as $datasubkriteria) {
                        if ($datakriteria['id_kriteria'] == $datasubkriteria['id_kriteria']) {
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $datasubkriteria['cu_subkriteria']; ?></td>
                                <td><?= $datasubkriteria['kategori']; ?></td>
                                <td><?= $datasubkriteria['bobot']; ?></td>
                                <td>
                                    <a href="<?= base_url('datasubkriteria/edit/') . $datasubkriteria['id_subkriteria'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('datasubkriteria/delete/') . $datasubkriteria['id_subkriteria'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>