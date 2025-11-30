<?php
// Pastikan session guru aktif sebelum mengakses data
if (!isset($_SESSION['guru'])) {
    header("Location: ../login.php");
    exit();
}
$sesi = $_SESSION['guru'];
?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> <span class="fa fa-folder-open"></span> Mata Pelajaran Saya</strong>
                <a href="?page=add-mapel" class="btn btn-primary float-right btn-sm"> <span class="fa fa-plus"></span> Tambah</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Tingkat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        $sql = mysqli_query($con, "SELECT tb_mapel.*, tb_kelas.kelas
                                                   FROM tb_mapel
                                                   INNER JOIN tb_kelas ON tb_mapel.idkelas=tb_kelas.idkelas
                                                   WHERE tb_mapel.id_guru='$sesi'
                                                   ORDER BY tb_mapel.id_mapel DESC");

                        if(mysqli_num_rows($sql) == 0) {
                            echo "<tr><td colspan='5' class='text-center'>Tidak ada data mata pelajaran</td></tr>";
                        } else {
                            while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_mapel']; ?></td>
                                <td><?= $data['kelas']; ?></td>
                                <td>Kelas <?= $data['tingkat']; ?></td>
                                <td>
                                    <a href="?page=jurnal&idg=<?= $data['id_mapel']; ?>" class="btn btn-success btn-sm" title="Isi Jurnal"><i class="fa fa-book"></i> Jurnal</a>

                                    <a href="?page=edit-mapel&id=<?= $data['id_mapel']; ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="?page=hapus-mapel&id=<?= $data['id_mapel']; ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>