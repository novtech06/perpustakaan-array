<?php
$message = "";
$email = "";


if (isset($_POST['submit'])) {

    // edit data akun
    function edit_akun()
    {
        include('database/akun.php');
        $no_index = $_SESSION['id_akun'];
        $akun2 = "akun[$no_index] = [";
        $data_akun = $akun[$no_index];

        extract($_REQUEST);
        $file = fopen("database/akun.php", "a");
        fwrite($file, "$$akun2" . "\n");
        fwrite($file, '"id" => "' . $data_akun['id'] . '",' . "\n");
        fwrite($file, '"nama" => "' . $data_akun['nama'] . '",' . "\n");
        fwrite($file, '"email" => "' . $_POST['email'] . '",' . "\n");
        fwrite($file, '"password" => "' . $data_akun['password'] . '",' . "\n");
        fwrite($file, '"role" => "' . $data_akun['role'] . '",' . "\n");
        fwrite($file, '];' . "\n");
        fclose($file);
    }

    // membuat file temp
    function newfile_temp_akun()
    {
        if (!file_exists('database/temp.php')) {
            fopen('database/temp.php', 'w');
        } else {
            echo 'File sudah ada';
        }
    }

    // masukkan data ke file temp
    function insert_temp_akun()
    {
        include('database/akun.php');
        $akun2 = 'akun[] = [';
        $file = fopen("database/temp.php", "a");
        fwrite($file, "<?php" . "\n");
        fclose($file);
        foreach ($akun as $a) {
            $file = fopen("database/temp.php", "a");
            fwrite($file, "$$akun2" . "\n");
            fwrite($file, '"id" => "' . $a["id"] . '",' . "\n");
            fwrite($file, '"nama" => "' . $a["nama"] . '",' . "\n");
            fwrite($file, '"email" => "' . $a["email"] . '",' . "\n");
            fwrite($file, '"password" => "' . $a["password"] . '",' . "\n");
            fwrite($file, '"role" => "' . $a["role"] . '",' . "\n");
            fwrite($file, '];' . "\n");
            fclose($file);
        }
    }

    // hapus file database_akun
    function delete_database_akun()
    {
        $file_database_akun = 'database/akun.php';
        if (file_exists($file_database_akun)) {
            unlink($file_database_akun);
            'File berhasil di hapus';
        } else {
            'File tidak ditemukan';
        }
    }

    // buat file database_akun
    function newfile_database_akun()
    {
        if (!file_exists('database/akun.php')) {
            fopen('database/akun.php', 'w');
        } else {
            'File sudah ada';
        }
    }

    // masukkan data ke file database_akun
    function insert_database_akun()
    {
        include('database/temp.php');
        $akun2 = 'akun[] = [';
        $file = fopen("database/akun.php", "a");
        fwrite($file, "<?php" . "\n");
        fclose($file);
        foreach ($akun as $a) {
            $file = fopen("database/akun.php", "a");
            fwrite($file, "$$akun2" . "\n");
            fwrite($file, '"id" => "' . $a["id"] . '",' . "\n");
            fwrite($file, '"nama" => "' . $a["nama"] . '",' . "\n");
            fwrite($file, '"email" => "' . $a["email"] . '",' . "\n");
            fwrite($file, '"password" => "' . $a["password"] . '",' . "\n");
            fwrite($file, '"role" => "' . $a["role"] . '",' . "\n");
            fwrite($file, '];' . "\n");
            fclose($file);
        }
    }

    // hapus file temp
    function delete_temp_akun()
    {
        $file_temp = 'database/temp.php';
        if (file_exists($file_temp)) {
            unlink($file_temp);
            'File berhasil di hapus';
        } else {
            'File tidak ditemukan';
        }
    }





    // membuat file temp
    function newfile_temp_pinjam()
    {
        if (!file_exists('database/temp.php')) {
            fopen('database/temp.php', 'w');
        } else {
            echo 'File sudah ada';
        }
    }

    function change_email_pinjam()
    {
        include('database/pinjam.php');
        include('database/akun.php');
        $no_index = $_SESSION['id_akun'];
        $data_akun_saya = $akun[$no_index];

        // tag php
        $file = fopen("database/temp.php", "a");
        fwrite($file, "<?php" . "\n");
        fclose($file);
        // loop cari email yang sama didatabase pinjam
        foreach ($pinjam as $p) {
            if ($p['email'] == $data_akun_saya['email']) {
                $pinjam = 'pinjam[] = [';
                //Fungsi extract() mengimpor variabel ke dalam tabel simbol lokal dari sebuah array.
                extract($_REQUEST);
                $file = fopen("database/temp.php", "a");
                fwrite($file, "$$pinjam" . "\n");
                fwrite($file, '"id" => "' . $p['id'] . '",' . "\n");
                fwrite($file, '"email" => "' . $_POST['email'] . '",' . "\n");
                fwrite($file, '"judul_buku" => "' . $p['judul_buku'] . '",' . "\n");
                fwrite($file, '"tanggal_pinjam" => "' . $p['tanggal_pinjam'] . '",' . "\n");
                fwrite($file, '"tanggal_kembali" => "' . $p['tanggal_kembali'] . '",' . "\n");
                fwrite($file, '"id_buku" => "' . $p['id_buku'] . '",' . "\n");
                fwrite($file, '];' . "\n");
                fclose($file);
            } else {
                $pinjam = 'pinjam[] = [';
                $file = fopen("database/temp.php", "a");
                fwrite($file, "$$pinjam" . "\n");
                fwrite($file, '"id" => "' . $p['id'] . '",' . "\n");
                fwrite($file, '"email" => "' . $p['email'] . '",' . "\n");
                fwrite($file, '"judul_buku" => "' . $p['judul_buku'] . '",' . "\n");
                fwrite($file, '"tanggal_pinjam" => "' . $p['tanggal_pinjam'] . '",' . "\n");
                fwrite($file, '"tanggal_kembali" => "' . $p['tanggal_kembali'] . '",' . "\n");
                fwrite($file, '"id_buku" => "' . $p['id_buku'] . '",' . "\n");
                fwrite($file, '];' . "\n");
                fclose($file);
            }
        }
    }

    // hapus file temp
    function delete_database_pinjam()
    {
        $file_database_pinjam = 'database/pinjam.php';
        if (file_exists($file_database_pinjam)) {
            unlink($file_database_pinjam);
            'File berhasil di hapus';
        } else {
            'File tidak ditemukan';
        }
    }

    // membuat file database_pinjam
    function newfile_database_pinjam()
    {
        if (!file_exists('database/pinjam.php')) {
            fopen('database/pinjam.php', 'w');
        } else {
            echo 'File sudah ada';
        }
    }

    // hapus file temp
    function delete_temp_pinjam()
    {
        $file_temp = 'database/temp.php';
        if (file_exists($file_temp)) {
            unlink($file_temp);
            'File berhasil di hapus';
        } else {
            'File tidak ditemukan';
        }
    }

    // masukkan data file database_pinjam
    function insert_database_pinjam()
    {
        include('database/temp.php');
        $pinjam2 = 'pinjam[] = [';
        $file = fopen("database/pinjam.php", "a");
        fwrite($file, "<?php" . "\n");
        fclose($file);
        foreach ($pinjam as $p) {
            $file = fopen("database/pinjam.php", "a");
            fwrite($file, "$$pinjam2" . "\n");
            fwrite($file, '"id" => "' . $p['id'] . '",' . "\n");
            fwrite($file, '"email" => "' . $p['email'] . '",' . "\n");
            fwrite($file, '"judul_buku" => "' . $p['judul_buku'] . '",' . "\n");
            fwrite($file, '"tanggal_pinjam" => "' . $p['tanggal_pinjam'] . '",' . "\n");
            fwrite($file, '"tanggal_kembali" => "' . $p['tanggal_kembali'] . '",' . "\n");
            fwrite($file, '"id_buku" => "' . $p['id_buku'] . '",' . "\n");
            fwrite($file, '];' . "\n");
            fclose($file);
        }
    }

    // redirect home
    function redirect_login()
    {
        message_alert("Anda berhasil mengubah email!");
        logout();
    }

    // cek email
    $email_ada = "";
    $email = $_POST['email'];
    include('database/akun.php');
    foreach ($akun as $a) {
        if ($a['email'] == $_POST['email']) {
            $email_ada = true;
        }
    }

    if (!$email_ada) {
        // run function
        newfile_temp_pinjam();
        change_email_pinjam();
        delete_database_pinjam();
        newfile_database_pinjam();
        insert_database_pinjam();
        delete_temp_pinjam();

        edit_akun();
        newfile_temp_akun();
        insert_temp_akun();
        delete_database_akun();
        newfile_database_akun();
        insert_database_akun();
        delete_temp_akun();


        redirect_login();
    } else {
        $message = "Email yang anda masukkan sudah terdaftar!";
    }
}
?>

<div class="container py-3">
    <div class="col-lg-8 col-md-10 mx-auto">
        <a href="<?= url_tujuan("akun"); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left pe-1"></i>Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <h4 class="card-header"><i class="fas fa-cog"></i> Ubah Email</h4>
                <div class="card-body">
                    <?php if ($message) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email baru</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= (!$email ? '' : $email); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>