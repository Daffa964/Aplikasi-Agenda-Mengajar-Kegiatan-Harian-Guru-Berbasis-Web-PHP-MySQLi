<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> <span class="fa fa-briefcase"></span> Daftar Kegiatan Lainnya</strong>
                <a href="?page=add-agenda-lain" class="btn btn-primary float-right btn-sm">
                    <i class="fa fa-plus"></i> Tambah Kegiatan
                </a>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="hari-ini-tab" data-toggle="tab" href="#hari-ini" role="tab" aria-controls="hari-ini" aria-selected="true">
                            <i class="fa fa-calendar-o"></i> Hari Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="semua-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="semua" aria-selected="false">
                            <i class="fa fa-list"></i> Semua Data
                        </a>
                    </li>
                </ul>

                <div class="tab-content pl-3 p-1" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="hari-ini" role="tabpanel" aria-labelledby="hari-ini-tab">
                        <br>
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> Kegiatan Tanggal : <strong><?= date('d-m-Y'); ?></strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Guru / Pelaksana</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Waktu / Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $today = date('Y-m-d');
                                    // Gunakan LEFT JOIN agar kegiatan tanpa spesifik guru tetap muncul
                                    $sql = mysqli_query($con, "
                                        SELECT al.*, g.nama_guru 
                                        FROM tb_agenda_lain al
                                        LEFT JOIN tb_guru g ON al.id_guru = g.id_guru
                                        WHERE al.tanggal = '$today'
                                        ORDER BY al.id_lain DESC
                                    ");
                                    
                                    if(mysqli_num_rows($sql) == 0){
                                        echo "<tr><td colspan='5' class='text-center text-danger'>Tidak ada kegiatan tercatat hari ini.</td></tr>";
                                    }

                                    while ($data = mysqli_fetch_array($sql)) {
                                        $pelaksana = $data['nama_guru'] ? $data['nama_guru'] : "<strong>(Kegiatan Sekolah/Umum)</strong>";
                                    ?>
                                    <tr>
                                        <td><?=$no++;?></td>
                                        <td><?=$pelaksana;?></td>
                                        <td><?=$data['nama_kegiatan'];?></td>
                                        <td>
                                            <i class="fa fa-clock-o"></i> <?=$data['jam_mulai'];?> - <?=$data['jam_selesai'];?><br>
                                            <small class="text-muted"><?=$data['keterangan'];?></small>
                                        </td>
                                        <td>
                                            <a href="?page=e_agenda_lain&id=<?=$data['id_lain'];?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="?page=d_agenda_lain&id=<?=$data['id_lain'];?>" onclick="return confirm('Yakin menghapus kegiatan ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                        <br>
                        <div class="table-responsive">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pelaksana</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // Query Semua Data
                                    $sqlAll = mysqli_query($con, "
                                        SELECT al.*, g.nama_guru 
                                        FROM tb_agenda_lain al
                                        LEFT JOIN tb_guru g ON al.id_guru = g.id_guru
                                        ORDER BY al.tanggal DESC
                                    ");
                                    
                                    while ($data = mysqli_fetch_array($sqlAll)) {
                                        $pelaksana = $data['nama_guru'] ? $data['nama_guru'] : "(Umum)";
                                    ?>
                                    <tr>
                                        <td><?=$no++;?></td>
                                        <td><?=date('d-m-Y', strtotime($data['tanggal']));?></td>
                                        <td><?=$pelaksana;?></td>
                                        <td><?=$data['nama_kegiatan'];?></td>
                                        <td>
                                            <span class="badge badge-info"><?=$data['jam_mulai'];?> - <?=$data['jam_selesai'];?></span><br>
                                            <?=$data['keterangan'];?>
                                        </td>
                                        <td>
                                            <a href="?page=e_agenda_lain&id=<?=$data['id_lain'];?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="?page=d_agenda_lain&id=<?=$data['id_lain'];?>" onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
    </div>
</div>