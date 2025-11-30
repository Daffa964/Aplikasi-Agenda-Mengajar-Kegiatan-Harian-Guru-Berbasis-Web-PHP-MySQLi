  <?php
include '../koneksi.php';
// Pastikan session guru aktif sebelum mengakses data
if (!isset($_SESSION['guru'])) {
    header("Location: ../login.php");
    exit();
}
$sesi = $_SESSION['guru'];

// Ambil data guru untuk ditampilkan
$sql_guru = mysqli_query($con,"SELECT * FROM tb_guru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
$data_guru = mysqli_fetch_array($sql_guru);
?>


<div class="card">
                        <div class="card-header">
                            <h3>
                              <strong class="card-title"> <span class="fa fa-calendar"></span> Daftar Kegiatan Lain</strong>
                            </h3>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-condensed table-hover table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Nama Kegiatan</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th><span class="fa fa-cog"></span></th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=1;
                    // Perbaikan nama tabel dan field sesuai struktur database
                    $sql = mysqli_query($con,"SELECT * FROM tb_agenda_lain WHERE id_guru = '$sesi' ORDER BY tanggal DESC")
                    or die(mysqli_error($con));

                    if(mysqli_num_rows($sql) == 0) {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada data kegiatan lain</td></tr>";
                    } else {
                        while ( $data=mysqli_fetch_array($sql)) {
                    ?>
                      <tr>
                        <td> <?=$no++;?> </td>
                        <td> <?=$data['tanggal'];?> </td>
                        <td> <?=$data['nama_kegiatan'];?></td>
                         <td> <?=$data['jam_mulai'];?> - <?=$data['jam_selesai'];?></td>
                        <td><?=$data['keterangan'];?></td>
                        <td>
                          <a href="?page=e_agenda_lain&id=<?= $data['id_lain']; ?>" title="Edit" class="btn btn-info btn-xs"> <span class="fa fa-edit"></span></a>
                           <a href="?page=d_agenda_lain&id=<?= $data['id_lain']; ?>" title="Hapus" class="btn btn-danger btn-xs"> <span class="fa fa-trash"></span></a>
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
   			<div class="card">
              <div class="card-header">
                <!-- <p>BAGAIMANA CARA MENYIMPAN KE TAB AGENDA BERDASARKAN MAPEL MASING2 DAN MASING2 GURU</p> -->
                     <a href="javascript:history.back()" class="btn btn-warning"> <span class="fa fa-chevron-left"></span> Kembali </a>
                <a href="?page=taglain" class="btn btn-primary">
                  <i class="fa fa-plus"></i> Tambah Kegiatan Lain
                </a>
                 <a target="_blank" href="Print-AgendaLain.php?idg=<?= $data_guru['id_guru']; ?>" class="btn btn-danger" style="border-top-right-radius: 20px;background-color:#f50057;border:none;">
                  <i class="fa fa-print"></i> Cetak / Print
                </a>
              <!--   <a target="_blank" href="Excel-AgendaLain.php?idg= <?php echo $data['id_guru']; ?> " class="btn btn-success">
                  <i class="fa fa-print"></i> Export Ke Excell
                </a> -->
              </div>
              </div>