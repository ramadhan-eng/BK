<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pasien</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('asset/') ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url('asset/') ?>AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('asset/') ?>AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('asset/') ?>AdminLTE/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/') ?>AdminLTE/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?= base_url('asset/') ?>AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('asset/') ?>AdminLTE/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('asset/') ?>AdminLTE/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Edit Modal -->
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Daftar Poli</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                                <li class="breadcrumb-item active">Riwayat</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Riwayat Daftar Poli</h3>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Poli</th>
                                                <th>Dokter</th>
                                                <th>Hari</th>
                                                <th>Mulai</th>
                                                <th>Selesai</th>
                                                <th>Antrian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($riwayat_poli as $key => $row) : ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $row['poli_nama'] ?></td>
                                                <td><?= $row['nama_dokter'] ?></td>
                                                <td><?= $row['jadwal_hari'] ?></td>
                                                <td><?= $row['jadwal_mulai'] ?></td>
                                                <td><?= $row['jadwal_selesai'] ?></td>
                                                <td><?= $row['antrian'] ?></td>
                                                <td>
                                                    <!-- Your action buttons here -->
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Poli</h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('pasien/pasien/register_poli'); ?>" method="post">
                                        <div class="mb-3">
                                            <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                                            <input type="text" class="form-control" id="no_rm"
                                                placeholder="Nomor Rekam Medis"
                                                value="<?= isset($no_rm) ? $no_rm : ''; ?>" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="input-poli" class="form-label">Pilih Poli</label>
                                            <select name="id_poli" id="input_poli" class="form-control">
                                                <option value="0">Open This Select Menu</option>
                                                <?php
                                                $data = $this->db->get('poli')->result_array();
                                                if (empty($data)) {
                                                    echo "<option value=''>Tidak Ada Poli</option>";
                                                } else {
                                                    foreach ($data as $d) {
                                                ?>
                                                <option value="<?= $d['id'] ?>"><?= $d['nama_poli'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input-jadwal" class="form-label">Pilih Jadwal</label>
                                            <select name="id_jadwal" id="input_jadwal" class="form-control">
                                            </select>
                                        </div>
                                        <div class="mb3">
                                            <label for="keluhan" class="form-label">Keluhan</label>
                                            <textarea class="form-control" id="keluhan" rows="3"
                                                placeholder="Tulis Keluhan disini" name="keluhan" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary float-end">Daftar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- JavaScript to dynamically populate "Pilih Jadwal" dropdown -->
    <!-- Include jQuery library -->

    <!-- End of JavaScript -->

    <!-- Add this script block at the end of your view -->

    <!-- Update the script block in your view -->
    <!-- Updated script block in your view -->

    <!-- Add this script at the end of your view file -->
    <script>
    $(document).ready(function() {
        // Triggered when the Poli selection changes
        $('#input_poli').on('change', function() {
            var selectedPoliId = $(this).val();

            // Send an AJAX request to fetch jadwal based on the selected poli id
            $.ajax({
                type: 'POST',
                url: '<?= base_url('pasien/pasien/get_jadwal_by_poli'); ?>',
                data: {
                    id_poli: selectedPoliId
                },
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    // Update the Jadwal select input with the fetched data
                    $('#input_jadwal').empty();
                    if (response.length > 0) {
                        $.each(response, function(index, jadwal) {
                            $('#input_jadwal').append('<option value="' + jadwal
                                .id_jp + '">' +
                                'Dokter ' + jadwal.nama_dokter + ' | ' +
                                jadwal.hari + ' | ' +
                                jadwal.jam_mulai + ' | ' +
                                jadwal.jam_selesai +
                                '</option>');
                        });
                    } else {
                        $('#input_jadwal').append('<option>Tidak ada jadwal</option>');
                    }
                }
            });
        });
    });
    </script>

    <!-- jQuery -->
    <script src="<?= base_url('asset/') ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('asset/') ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('asset/') ?>AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>