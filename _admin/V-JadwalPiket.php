<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"> <span class="fa fa-calendar-check-o"></span> Jadwal & Agenda Guru Piket</strong>
            <a href="?page=add-jadwal" class="btn btn-primary float-right btn-sm">
                <i class="fa fa-plus"></i> Tambah Jadwal
            </a>
        </div>
        <div class="card-body">
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="hari-ini-tab" data-toggle="tab" href="#hari-ini" role="tab" aria-controls="hari-ini" aria-selected="true">
                        <i class="fa fa-calendar"></i> Piket Hari Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="semua-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="semua" aria-selected="false">
                        <i class="fa fa-list"></i> Semua Jadwal
                    </a>
                </li>
            </ul>

            <div class="tab-content pl-3 p-1" id="myTabContent">
                
                <div class="tab-pane fade show active" id="hari-ini" role="tabpanel" aria-labelledby="hari-ini-tab">
                    <br>
                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-info-circle"></i> Menampilkan jadwal untuk tanggal: <strong><?= date('d F Y'); ?></strong>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Guru Piket</th>
                                <th>Hari</th>
                                <th>Agenda/Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $today = date('Y-m-d');
                            
                            // PERBAIKAN QUERY: Menggunakan LEFT JOIN agar data tetap muncul meski ID Guru bermasalah
                            $sqlToday = mysqli_query($con, "
                                SELECT jp.*, g.nama_guru 
                                FROM tb_jadwal_piket jp
                                LEFT JOIN tb_guru g ON jp.id_guru = g.id_guru
                                WHERE jp.tanggal_piket = '$today'
                                ORDER BY jp.id_jadwal DESC
                            ");
                            
                            // Cek apakah ada data
                            if(mysqli_num_rows($sqlToday) == 0){
                                echo "<tr><td colspan='5' class='text-center text-danger'><strong>Tidak ada jadwal piket untuk HARI INI.</strong><br>Silakan cek tab 'Semua Jadwal' jika Anda baru saja menambahkan jadwal untuk tanggal lain.</td></tr>";
                            }

                            while ($row = mysqli_fetch_array($sqlToday)) {
                                // Handle jika nama guru kosong (karena guru dihapus/invalid)
                                $nama_guru = $row['nama_guru'] ? $row['nama_guru'] : "<span class='text-danger'>Guru Tidak Dikenal (ID: $row[id_guru])</span>";
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $nama_guru; ?></td>
                                <td><?= $row['hari_piket']; ?></td>
                                <td><?= $row['keterangan']; ?></td>
                                <td>
                                    <a href="?page=e_jadwal&id=<?=$row['id_jadwal'];?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="?page=d_jadwal&id=<?=$row['id_jadwal'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                    <br>
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Guru Piket</th>
                                <th>Agenda/Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // PERBAIKAN QUERY: Menggunakan LEFT JOIN
                            $sqlAll = mysqli_query($con, "
                                SELECT jp.*, g.nama_guru 
                                FROM tb_jadwal_piket jp
                                LEFT JOIN tb_guru g ON jp.id_guru = g.id_guru
                                ORDER BY jp.tanggal_piket DESC
                            ");
                            
                            while ($row = mysqli_fetch_array($sqlAll)) {
                                $nama_guru = $row['nama_guru'] ? $row['nama_guru'] : "<span class='text-danger'>-</span>";
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_piket'])); ?></td>
                                <td><?= $row['hari_piket']; ?></td>
                                <td><?= $nama_guru; ?></td>
                                <td><?= $row['keterangan']; ?></td>
                                <td>
                                    <a href="?page=e_jadwal&id=<?=$row['id_jadwal'];?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="?page=d_jadwal&id=<?=$row['id_jadwal'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>