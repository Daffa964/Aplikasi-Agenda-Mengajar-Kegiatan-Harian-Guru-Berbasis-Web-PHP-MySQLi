<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-upload"></i> Upload File Data Guru (.csv)</strong>
            </div>
            <div class="card-body card-block">
                
                <div class="alert alert-warning" role="alert">
                    <h5 class="alert-heading">Format CSV Harus Sesuai!</h5>
                    <p>File CSV Anda **wajib** menggunakan pemisah **titik koma (`;`)** dan memiliki 9 kolom dengan urutan ini:</p>
                    <pre>id_guru;kode_sekolah;kode_guru;nama_guru;nip;username;pass;password;penugasan</pre>
                    <p class="mb-0">Sistem akan melakukan **UPDATE** data jika `id_guru` sudah ada, atau **INSERT** data baru jika `id_guru` belum ada.</p>
                </div>

                <form action="proses.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="csv_file" class="form-control-label">Pilih File CSV</label></div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="csv_file" name="csv_file" accept=".csv" class="form-control-file" required>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="form-actions form-group">
                        <button type="submit" name="upload_guru_csv" class="btn btn-success btn-sm">
                            <i class="fa fa-file-excel-o"></i> Proses Import Data
                        </button>
                        <a href="?page=v_guru" class="btn btn-warning btn-sm">
                            <i class="fa fa-arrow-left"></i> Batal / Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>