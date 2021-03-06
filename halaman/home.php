<?php
$buku = [];
$keyword2 = "";
if (isset($_POST['search'])) {
    $keyword2 = $_POST['keyword'];
}
?>

<div class="container pt-3">
    <div class="row">
        <form action="" method="post">
            <div class="col-lg-6 col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci" name="keyword" value="<?= $keyword2; ?>">
                    <button type="submit" class="btn btn-outline-primary" type="button" id="button-addon2" name="search">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container pb-3">
    <?php if (isset($_POST['search'])) : ?>
        <a href="<?= url_tujuan("home"); ?>" class="btn btn-primary tambah-buku"><i class="fas fa-fw fa-sync-alt"></i> Refresh</a>
    <?php else : ?>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <a href="<?= url_tujuan("tambah_buku"); ?>" class="btn btn-primary tambah-buku">Tambah Buku</a>
        <?php endif; ?>
    <?php endif; ?>
    <div class="row">

        <?php
        include('database/buku.php');
        ?>
        <?php if (!$buku) : ?>
            <div class="alert alert-danger alert-dismissible fade show my-3 mx-2" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                Data buku belum tersedia!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php
        $jumlah_array = count($buku) - 1;
        $no_index = $jumlah_array;
        $buku_reverse = array_reverse($buku);
        ?>
        <?php foreach ($buku_reverse as $b) : ?>
            <?php if (isset($_POST['search'])) : ?>
                <?php $keyword = $_POST['keyword']; ?>
                <?php if (like_match("%$keyword%", $b['isbn']) || like_match("%$keyword%", $b['judul_buku']) || like_match("%$keyword%", $b['penulis_buku']) || like_match("%$keyword%", $b['penerbit_buku']) || like_match("%$keyword%", $b['tahun_terbit']) || like_match("%$keyword%", $b['halaman'])) : ?>

                    <div class="col-10 col-sm-10 col-md-6 col-lg-3 col-xl-3 my-3 konten-tengah">
                        <!-- card untuk buku -->
                        <div class="card card-book">
                            <div class="face face1">
                                <div class="content">
                                    <h4><?= substr_judul($b['judul_buku']); ?></h4>
                                    <p><?= substr_karakter($b['deskripsi']); ?></p>
                                    <a href="<?= url_tujuan("lihat_buku&no_index=" . $no_index); ?>" class="btn btn-primary">Lihat</a>
                                    <?php if ($_SESSION['role'] == 'admin') : ?>
                                        <a href="<?= url_tujuan("edit_buku&no_index=" . $no_index); ?>" class="btn btn-warning">Edit</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="face face2">
                                <img src="img/buku/<?= $b['gambar']; ?>" alt="gambar-buku">
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            <?php else : ?>

                <div class="col-10 col-sm-10 col-md-6 col-lg-3 col-xl-3 my-3 konten-tengah">
                    <!-- card untuk buku -->
                    <div class="card card-book">
                        <div class="face face1">
                            <div class="content">
                                <h4><?= substr_judul($b['judul_buku']); ?></h4>
                                <p><?= substr_karakter($b['deskripsi']); ?></p>
                                <a href="<?= url_tujuan("lihat_buku&no_index=" . $no_index); ?>" class="btn btn-primary">Lihat</a>
                                <?php if ($_SESSION['role'] == 'admin') : ?>
                                    <a href="<?= url_tujuan("edit_buku&no_index=" . $no_index); ?>" class="btn btn-warning">Edit</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="face face2">
                            <img src="img/buku/<?= $b['gambar']; ?>" alt="gambar-buku">
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <?php $no_index--; ?>
        <?php endforeach; ?>


    </div>
</div>