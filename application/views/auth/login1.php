<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Form Login SMP Pahlawan Nasional</title>
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>
    
<body>
    <div class="contact-container">
        <div class="form-login">
            <h1>Form Login</h1>
            <?= $this->session->flashdata('pesan'); ?>
            <?= form_open('', ['class' => 'user']); ?>
            <form id="contact-form" method="post">
                <label for="username">Username</label>
                    <input type="text" value="<?= set_value('username'); ?>" id="username" name="username" placeholder="Masukkan Username" required>
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                <label for="password">Password</label>
                    <input type="password" value="<?= set_value('password'); ?>" id="password" name="password" placeholder="Masukkan Password" required>
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                <button type="submit" id="submit" name="submit">Login</button>
            </form>
            <?= form_close(); ?>
           </div>
          </div>
        <script  src="<?= base_url(); ?>assets/js/toggleSwitch.js"></script>
    </body>
</html>
