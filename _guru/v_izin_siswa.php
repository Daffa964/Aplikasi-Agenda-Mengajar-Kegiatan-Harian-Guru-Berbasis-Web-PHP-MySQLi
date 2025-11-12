<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1><span class="fa fa-plus"></span> Tambah Data Izin Siswa</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="?page=cover">Dashboard</a></li>
                    <li><a href="?page=v_izin_siswa">Izin Siswa</a></li>
                    <li class="active">Tambah Izin</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Form Pencatatan Izin Siswa</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="?page=act&act=add-izin" method="post" enctype="multipart/form-data" class="form-horizontal">
                            
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="tanggal" class="form-control-label">Tanggal Izin</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="date" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="id_siswa" class="form-control-label">Nama Siswa & Kelas</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="id_siswa" id="id_siswa" data-placeholder="Pilih Siswa..." class="standardSelect" required>
                                        <option value=""></option>
                                        <?php 
                                        // Query untuk mengambil data siswa dan kelas
                                        $sql_siswa = mysqli_query($con, "
                                            SELECT 
                                                s.id_siswa, 
                                                s.nama_siswa, 
                                                k.nama_kelas 
                                            FROM tb_siswa s
                                            JOIN tb_kelas k ON s.id_kelas = k.id_kelas 
                                            ORDER BY k.nama_kelas, s.nama_siswa ASC
                                        ");
                                        while ($siswa = mysqli_fetch_array($sql_siswa)) {
                                            echo '<option value="'. $siswa['id_siswa'] .'">'. htmlspecialchars($siswa['nama_siswa']) .' ('. htmlspecialchars($siswa['nama_kelas']) .')</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="alasan_izin" class="form-control-label">Alasan Izin</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="alasan_izin" id="alasan_izin" class="form-control" required>
                                        <option value="">Pilih Alasan Izin</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin Keluarga">Izin Keluarga</option>
                                        <option value="Izin Sekolah">Izin Sekolah (Misal: Lomba)</option>
                                        <option value="Lainnya">Lainnya...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="keterangan" class="form-control-label">Keterangan Tambahan</label></div>
                                <div class="col-12 col-md-9">
                                    <textarea name="keterangan" id="keterangan" rows="5" placeholder="Contoh: Sakit demam, dijemput orang tua. Atau detail izin lainnya." class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file_surat" class="form-control-label">Upload Surat Izin (PDF/JPG)</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file_surat" name="file_surat" class="form-control-file">
                                    <small class="form-text text-muted">Maksimal ukuran file 2MB.</small>
                                </div>
                            </div>

                            <input type="hidden" name="id_guru_piket" value="<?php echo $_SESSION['guru']; ?>">


                            <div class="row form-group">
                                <div class="col col-md-3"></div>
                                <div class="col-12 col-md-9">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-save"></i> Simpan Data Izin
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm" onclick="window.location='?page=v_izin_siswa'">
                                        <i class="fa fa-ban"></i> Batal
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div></div>```

---

## ✅ Tindak Lanjut: File Proses

Setelah membuat `t_izin_siswa.php`, Anda sekarang harus membuat *logic* untuk memproses data ini, yang kita asumsikan akan ditangani oleh file **`proses.php`** (atau `act.php`) dengan parameter `act=add-izin`.

**Anda perlu menambahkan blok kode berikut di file `proses.php` atau `act.php` Anda:**

```php
<?php 
// ... (Kode proses/act.php yang sudah ada) ...

if (@$_GET['act'] == 'add-izin') {
    $tanggal        = mysqli_real_escape_string($con, $_POST['tanggal']);
    $id_siswa       = mysqli_real_escape_string($con, $_POST['id_siswa']);
    $alasan_izin    = mysqli_real_escape_string($con, $_POST['alasan_izin']);
    $keterangan     = mysqli_real_escape_string($con, $_POST['keterangan']);
    $id_guru_piket  = mysqli_real_escape_string($con, $_POST['id_guru_piket']);
    
    // --- Proses Upload File ---
    $file_name = null;
    if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] == 0) {
        $ekstensi_izin = array('pdf', 'jpg', 'jpeg', 'png');
        $file_surat = $_FILES['file_surat']['name'];
        $x = explode('.', $file_surat);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['file_surat']['size'];
        $file_tmp = $_FILES['file_surat']['tmp_name'];
        
        // Buat nama file unik
        $file_name = 'IZIN-' . time() . '.' . $ekstensi;

        if (in_array($ekstensi, $ekstensi_izin) === true) {
            if ($ukuran < 2048000) { // Maks 2MB
                move_uploaded_file($file_tmp, '../files/izin/' . $file_name);
            } else {
                echo "<script>alert('UKURAN FILE TERLALU BESAR (Maks 2MB)!');window.location='?page=t_izin_siswa';</script>";
                exit;
            }
        } else {
            echo "<script>alert('EKSTENSI FILE TIDAK DIIZINKAN (Hanya PDF/JPG/PNG)!');window.location='?page=t_izin_siswa';</script>";
            exit;
        }
    }
    // --- End Proses Upload File ---

    $save = mysqli_query($con, "
        INSERT INTO tb_izin_siswa 
        (tanggal, id_siswa, alasan_izin, keterangan, file_surat, id_guru_piket) 
        VALUES 
        ('$tanggal', '$id_siswa', '$alasan_izin', '$keterangan', '$file_name', '$id_guru_piket')
    ");

    if ($save) {
        echo "<script>alert('Data Izin Siswa Berhasil Disimpan!');window.location='?page=v_izin_siswa';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($con) . "');window.location='?page=t_izin_siswa';</script>";
    }
}

// ... (Kode proses/act.php yang sudah ada) ...
?>