<?php
include '../koneksi.php';
?>

<div class="card">
    <div class="card-header">
        <h4>📥 Export Data</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Export Data Guru</h5>
                        <p class="card-text">Ekspor data guru ke format Excel</p>
                        <a href="export_excel.php?tabel=tb_guru" class="btn btn-light">Export Excel</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Export Data Siswa</h5>
                        <p class="card-text">Ekspor data siswa ke format Excel</p>
                        <a href="export_excel.php?tabel=tb_siswa" class="btn btn-light">Export Excel</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Export Data Izin Siswa</h5>
                        <p class="card-text">Ekspor data izin siswa ke format Excel</p>
                        <a href="export_excel.php?tabel=tb_izin_siswa" class="btn btn-light">Export Excel</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Export Data Keterlambatan</h5>
                        <p class="card-text">Ekspor data keterlambatan siswa ke format Excel</p>
                        <a href="export_excel.php?tabel=tb_keterlambatan" class="btn btn-dark">Export Excel</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Export Data Agenda Mengajar</h5>
                        <p class="card-text">Ekspor data agenda mengajar ke format Excel</p>
                        <a href="export_excel.php?tabel=tb_agenda" class="btn btn-light">Export Excel</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Export Data Agenda Lain</h5>
                        <p class="card-text">Ekspor data agenda lain ke format Excel</p>
                        <a href="export_excel.php?tabel=tb_agendalain" class="btn btn-light">Export Excel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>