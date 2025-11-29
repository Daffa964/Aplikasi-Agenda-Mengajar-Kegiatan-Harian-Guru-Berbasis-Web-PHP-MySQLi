<?php include '../koneksi.php'; ?>
<?php
session_start();
if (@$_SESSION['admin']) {
?>
	<?php
if (@$_SESSION['admin']) {
$sesi = @$_SESSION['admin'];
}

$sql = mysqli_query($con,"select * from tb_user where id_admin = '$sesi'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Piket Mingguan - Cetak</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: white;
        }
        .kop {
            border-bottom: 3px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .kop img {
            display: block;
            margin: 0 auto 5px;
        }
        .kop h3 {
            text-align: center;
            margin: 0;
            font-size: 18px;
        }
        .kop p {
            text-align: center;
            margin: 0;
            font-size: 12px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .data-table th, .data-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .data-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .data-table .hari {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .header-info {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .header-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-info td {
            padding: 4px 0;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
        .footer table {
            width: 100%;
        }
    </style>
</head>
<body>
    <table class="kop" width="100%">
        <tr>
            <td align="center">
                <img src="../images/logo.jpg" width="60" height="60">
                <h3>JADWAL PIKET MINGGUAN<br>SMP Negeri 1 Kaliwungu</h3>
                <p>Kedungdowo, Kec. Kaliwungu, Kabupaten Kudus, Jawa Tengah 59361<br>
                Telepon: (0291) 438068</p>
            </td>
        </tr>
    </table>

    <div class="header-info">
        <table>
            <tr>
                <td width="150">Nama Admin</td>
                <td width="20">:</td>
                <td> <?php echo $data['nama']; ?> </td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>
                    <?php
                    $sql_tajaran = mysqli_query($con, "SELECT tahun_ajaran FROM tb_tajaran WHERE status='Y'");
                    $ajaran = mysqli_fetch_array($sql_tajaran);
                    echo $ajaran['tahun_ajaran'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Periode</td>
                <td>:</td>
                <td><?php echo date('d F Y'); ?></td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="100">Hari</th>
                <th>Nama Guru</th>
                <th>Tugas Pokok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            // Ambil semua hari dalam tabel tb_piket_mingguan
            $sqlHari = mysqli_query($con, "SELECT * FROM tb_piket_mingguan ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')");

            if(mysqli_num_rows($sqlHari) == 0) {
                echo "<tr><td colspan='4' style='text-align: center;'>Belum ada data hari dalam jadwal piket mingguan.</td></tr>";
            } else {
                while($hari = mysqli_fetch_array($sqlHari)) {
                    $id_mingguan = $hari['id_mingguan'];
                    $nama_hari = $hari['hari'];

                    // Ambil guru-guru yang bertugas di hari tersebut
                    $sqlGuru = mysqli_query($con, "
                        SELECT p_guru.*, g.nama_guru, g.gelar, g.id_guru as guru_id
                        FROM tb_piket_mingguan_guru p_guru
                        LEFT JOIN tb_guru g ON p_guru.id_guru = g.id_guru
                        WHERE p_guru.id_mingguan = '$id_mingguan'
                        ORDER BY g.nama_guru ASC
                    ");

                    // Ambil tugas-tugas untuk hari tersebut
                    $sqlTugas = mysqli_query($con, "
                        SELECT tugas
                        FROM tb_piket_mingguan_tugas
                        WHERE id_mingguan = '$id_mingguan'
                    ");

                    // Ambil tugas sebagai array
                    $tugas_list = array();
                    while($tugas = mysqli_fetch_array($sqlTugas)) {
                        $tugas_list[] = $tugas['tugas'];
                    }

                    // Jika tidak ada guru untuk hari tersebut
                    if(mysqli_num_rows($sqlGuru) == 0) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td class='hari'>".$nama_hari."</td>";
                        echo "<td>-</td>";
                        echo "<td>";
                        if(count($tugas_list) > 0) {
                            foreach($tugas_list as $tugas_item) {
                                echo "• ".$tugas_item."<br>";
                            }
                        } else {
                            echo "-";
                        }
                        echo "</td>";
                        echo "</tr>";
                    } else {
                        // Jika ada lebih dari satu guru, buat baris untuk setiap guru
                        $guru_count = mysqli_num_rows($sqlGuru);
                        $guru_sql = mysqli_query($con, "
                            SELECT p_guru.*, g.nama_guru, g.gelar, g.id_guru as guru_id
                            FROM tb_piket_mingguan_guru p_guru
                            LEFT JOIN tb_guru g ON p_guru.id_guru = g.id_guru
                            WHERE p_guru.id_mingguan = '$id_mingguan'
                            ORDER BY g.nama_guru ASC
                        ");

                        $row_num = 0;
                        while($guru = mysqli_fetch_array($guru_sql)) {
                            $row_num++;
                            $guru_nama = $guru['nama_guru'];
                            $guru_gelar = $guru['gelar'];
                            if($guru_nama) {
                                if($guru_gelar && $guru_gelar !== '') {
                                    $guru_nama = $guru['nama_guru'] . ', ' . $guru['gelar'];
                                }
                            } else {
                                $guru_nama = 'Data Guru Terhapus';
                            }

                            echo "<tr>";
                            echo "<td>".$no++."</td>";
                            if($row_num == 1) {
                                echo "<td class='hari' rowspan='".$guru_count."'>".$nama_hari."</td>";
                            }
                            echo "<td>".$guru_nama."</td>";
                            if($row_num == 1) {
                                echo "<td rowspan='".$guru_count."'>";
                                if(count($tugas_list) > 0) {
                                    foreach($tugas_list as $tugas_item) {
                                        echo "• ".$tugas_item."<br>";
                                    }
                                } else {
                                    echo "-";
                                }
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                }
            }
            ?>
        </tbody>
    </table>

    <div class="footer">
        <table>
            <tr>
                <td width="70%">&nbsp;</td>
                <td align="center">
                    Kudus, <?php echo date("d F Y") ?><br><br>
                    Kepala Sekolah<br><br><br>
                    <?php
                      $sqlKepsek = mysqli_query($con, "SELECT * FROM tb_kepsek ORDER BY id_kepsek DESC LIMIT 1");
                      $dataKepsek = mysqli_fetch_array($sqlKepsek);
                      echo $dataKepsek['nama'];
                    ?><br>
                    ____________________
                </td>
            </tr>
        </table>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>

<?php
} else{
echo "<script> window.location='../index.php';</script>";
}
?>