<!-- Outer Row -->
<div class="row justify-content-center mt-5 pt-lg-5">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-10 shadow-lg">
            <div class="card-body bg-light p-lg-5 p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="p-3">
                            <div class="text-center mb-4">
                                <h3>Politeknik Negeri Malang</h3><br>
                                <strong class="text-dark">Silahkan Login</strong>
                            </div>
                            <?= form_open('', ['class' => 'user']); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>"
                                    type="text" name="username" class="form-control form-control-user"
                                    placeholder="Masukkan Username">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user"
                                    placeholder="Masukkan Password">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-success btn-user btn-block"> <i
                                    class="fas fa-sign-in-alt"></i>
                                M A S U K
                            </button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="text-center">Penerapan Metode VIKOR</h3>
                        <hr class="bg-dark">
                        <h6 class="text-justify">
                            Vikor merupakan salah satu metode dalam Sistem Pendukung Keputusan (SPK), metode ini
                            berfokus pada perangkingan dengan menggunakan indeks peringkat multi kriteria berdasarkan
                            ukuran tertentu dari kedekatan dengan solusi ideal. Metode VIKOR fokus pada perangkingan dan
                            memilih dari satu set sampel dengan kriteria yang saling bertentangan, yang dapat membantu
                            para pengambil keputusan untuk mendapatkan keputusan akhir (Opricovic and Tzeng 2007). </i>.
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>