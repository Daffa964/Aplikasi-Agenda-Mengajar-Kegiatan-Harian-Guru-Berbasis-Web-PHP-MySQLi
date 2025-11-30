<div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-primary text-white">
                        <strong> <span class="fa fa-user-plus"></span> Form Input Data Guru</strong>
                      </div>
                      <div class="card-body card-block">
                        <form action="proses.php" method="post" enctype="multipart/form-data" class="form-horizontal" id="formTambahGuru">
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="nip" class="form-control-label">NIP / NUPTK <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="number" id="nip" name="nip" required class="form-control" placeholder="Masukkan NIP atau NUPTK">
                              <small class="form-text text-muted">NIP atau NUPTK guru yang bersangkutan</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="nama_guru" class="form-control-label">Nama Lengkap <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-5">
                              <input type="text" id="nama_guru" name="nama_guru" required class="form-control" placeholder="Nama lengkap guru">
                              <small class="form-text text-muted">Nama lengkap guru</small>
                            </div>
                            <div class="col-12 col-md-4">
                              <input type="text" id="gelar" name="gelar" class="form-control" placeholder="Contoh: S.Pd., M.Pd.">
                              <small class="form-text text-muted">Gelar akademik (opsional)</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label class="form-control-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            </div>
                            <div class="col col-md-9">
                              <div class="form-check">
                                <div class="radio">
                                  <label for="kelamin_l" class="form-check-label">
                                    <input type="radio" id="kelamin_l" name="kelamin" value="Laki-laki" class="form-check-input" required> Laki-laki
                                  </label>
                                </div>
                                <div class="radio ml-4">
                                  <label for="kelamin_p" class="form-check-label">
                                    <input type="radio" id="kelamin_p" name="kelamin" value="Perempuan" class="form-check-input" required> Perempuan
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="tempat_lahir" class="form-control-label">Tempat Tanggal Lahir <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-5">
                              <input type="text" id="tempat_lahir" name="tempat" required class="form-control" placeholder="Tempat lahir">
                              <small class="form-text text-muted">Tempat lahir</small>
                            </div>
                            <div class="col-12 col-md-4">
                              <input type="date" id="tanggal_lahir" name="tgl" required class="form-control">
                              <small class="form-text text-muted">Tanggal lahir</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="alamat" class="form-control-label">Alamat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                              <textarea name="alamat" id="alamat" rows="3" required placeholder="Alamat lengkap guru" class="form-control"></textarea>
                              <small class="form-text text-muted">Alamat lengkap tempat tinggal guru</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="email" class="form-control-label">Email <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="email" id="email" name="email" required class="form-control" placeholder="email@domain.com">
                              <small class="form-text text-muted">Alamat email aktif guru</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="telp" class="form-control-label">Telp / HP <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="number" id="telp" name="telp" required class="form-control" placeholder="Nomor telepon aktif">
                              <small class="form-text text-muted">Nomor telepon/HP aktif guru</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="agama" class="form-control-label">Agama <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                              <select name="agama" id="agama" required class="standardSelect form-control">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                              </select>
                              <small class="form-text text-muted">Agama yang dianut</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="username" class="form-control-label">Username <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="username" name="username" required class="form-control" placeholder="Username untuk login">
                              <small class="form-text text-muted">Username untuk akses sistem</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="password" class="form-control-label">Password <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="password" name="password" required class="form-control" placeholder="Password untuk login">
                              <small class="form-text text-muted">Password untuk akses sistem (akan disimpan dalam format teks)</small>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="photo" class="form-control-label">Foto Guru</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="file" id="photo" name="photo" class="form-control-file" accept="image/*">
                              <small class="form-text text-muted">Foto profil guru (opsional, format: jpg, png, gif)</small>
                            </div>
                          </div>

                          <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> <strong>Catatan:</strong> Field dengan tanda bintang (<span class="text-danger">*</span>) wajib diisi.
                          </div>
                      </div>
                      <div class="card-footer bg-light">
                        <button type="submit" name="sguru" class="btn btn-success">
                          <i class="fa fa-save"></i> Simpan Data Guru
                        </button>
                        <button type="reset" class="btn btn-secondary">
                          <i class="fa fa-refresh"></i> Reset Form
                        </button>
                        <a href="javascript:history.back()" class="btn btn-warning"> <span class="fa fa-chevron-left"></span> Kembali </a>
                      </div>
                      </form>
                    </div>
                  </div>
