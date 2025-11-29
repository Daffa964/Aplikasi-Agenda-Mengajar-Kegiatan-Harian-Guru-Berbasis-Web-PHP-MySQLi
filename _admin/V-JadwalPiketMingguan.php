<?php
// Pastikan sudah login sebagai admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> <span class="fa fa-calendar"></span> Daftar Piket Mingguan</strong>
                <div class="float-right">
                    <a href="cetak_jadwal_piket_mingguan.php" target="_blank" class="btn btn-success btn-sm">
                        <i class="fa fa-print"></i> Cetak Jadwal
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> <strong>Informasi:</strong> Jadwal piket mingguan guru SMP Negeri 1 Kaliwungu
                </div>

                <!-- Tabel Jadwal Piket Mingguan -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Hari</th>
                                <th>Nama Guru</th>
                                <th>Tugas Pokok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ambil semua hari dalam tabel tb_piket_mingguan
                            $sqlHari = mysqli_query($con, "SELECT * FROM tb_piket_mingguan ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')");

                            if(mysqli_num_rows($sqlHari) == 0) {
                                echo "<tr><td colspan='4' class='text-center'><i class='fa fa-info-circle'></i> Belum ada data jadwal piket mingguan.</td></tr>";
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
                                        echo "<td class='text-center align-middle font-weight-bold bg-light'>$nama_hari</td>";
                                        echo "<td><span class='text-danger'>Tidak ada guru yang ditugaskan</span></td>";
                                        echo "<td>";
                                        if(count($tugas_list) > 0) {
                                            echo "<ul class='list-unstyled mb-0'>";
                                            foreach($tugas_list as $tugas_item) {
                                                echo "<li><i class='fa fa-check-circle text-success'></i> $tugas_item</li>";
                                            }
                                            echo "</ul>";
                                        } else {
                                            echo "-";
                                        }
                                        echo "</td>";
                                        echo "<td class='text-center'>";
                                        echo "<a href='?page=edit-piket-mingguan&id=$id_mingguan' class='btn btn-warning btn-sm mr-1' title='Edit Jadwal'><i class='fa fa-edit'></i></a>";
                                        echo "<a href='?page=detail-guru-piket&id=$id_mingguan' class='btn btn-info btn-sm' title='Lihat Detail Guru'><i class='fa fa-info-circle'></i></a>";
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
                                                $guru_nama = '<span class="text-danger">Data Guru Terhapus</span>';
                                            }

                                            echo "<tr>";
                                            if($row_num == 1) {
                                                echo "<td class='text-center align-middle font-weight-bold bg-light' rowspan='$guru_count'>$nama_hari</td>";
                                            }
                                            echo "<td>$guru_nama</td>";
                                            if($row_num == 1) {
                                                echo "<td rowspan='$guru_count'>";
                                                if(count($tugas_list) > 0) {
                                                    echo "<ul class='list-unstyled mb-0'>";
                                                    foreach($tugas_list as $tugas_item) {
                                                        echo "<li><i class='fa fa-check-circle text-success'></i> $tugas_item</li>";
                                                    }
                                                    echo "</ul>";
                                                } else {
                                                    echo "-";
                                                }
                                                echo "</td>";
                                                echo "<td class='text-center align-middle' rowspan='$guru_count'>";
                                                echo "<a href='?page=edit-piket-mingguan&id=$id_mingguan' class='btn btn-warning btn-sm mr-1' title='Edit Jadwal'><i class='fa fa-edit'></i></a>";
                                                echo "<a href='?page=detail-guru-piket&id=$id_mingguan' class='btn btn-info btn-sm' title='Lihat Detail Guru'><i class='fa fa-info-circle'></i></a>";
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
                </div>
            </div>
        </div>
    </div>
</div>