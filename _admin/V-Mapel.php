<div class="card">
    <div class="card-header">
        <strong class="card-title"> <span class="fa fa-folder"></span> Daftar Mata Pelajaran</strong>
        <a href="?page=add-mapel" class="btn btn-primary float-right btn-sm"> <i class="fa fa-plus"></i> Tambah Mapel</a>
    </div>
    <div class="card-body">
        <table id="bootstrap-data-table" class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Tingkat</th>
                    <th>Guru Pengampu</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                // Query join tabel mapel, kelas, dan guru
                $sql = mysqli_query($con, "SELECT tb_mapel.*, tb_kelas.kelas, tb_guru.nama_guru 
                                           FROM tb_mapel 
                                           INNER JOIN tb_kelas ON tb_mapel.idkelas=tb_kelas.idkelas 
                                           INNER JOIN tb_guru ON tb_mapel.id_guru=tb_guru.id_guru
                                           ORDER BY tb_mapel.id_mapel DESC");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama_mapel']; ?></td>
                        <td><?= $data['kelas']; ?></td>
                        <td>Kelas <?= $data['tingkat']; ?></td>
                        <td><?= $data['nama_guru']; ?></td>
                        <td>
                            <a href="?page=edit-mapel&id=<?= $data['id_mapel']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="?page=del-mapel&id=<?= $data['id_mapel']; ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>