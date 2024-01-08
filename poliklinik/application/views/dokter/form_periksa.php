<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokter</title>

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
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
    .js-example-basic-multiple {
        width: 100%;
        /* Adjust the width as needed */
        height: 3em;
        /* Adjust the height as needed */
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Add Modal -->

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Periksa</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                                <li class="breadcrumb-item active">Periksa</li>
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Periksa</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-info btn-block btn-flat"
                                            onclick="redirectToPeriksa()"><i class=" fa fa-solid fa-chevron-left"></i>
                                            Kembali</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('dokter/periksa/submit_periksa'); ?>" method="post">
                                        <div class="mb-3">
                                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                                                value="<?= $namapasien ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                                            <input type="datetime-local" class="form-control" id="tgl_periksa"
                                                name="tgl_periksa">
                                        </div>
                                        <div class="mb-3">
                                            <label for="catatan" class="form-label">Catatan</label>
                                            <input type="text" class="form-control" id="catatan" name="catatan">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="obat" class="form-label">Obat</label>
                                                <select class="js-example-basic-multiple" name="obat[]"
                                                    multiple="multiple" style="width: 100%;height: 3em;">
                                                    <?php
                                                    $data = $this->db->get('obat')->result_array();
                                                    if (empty($data)) {
                                                        echo "<option value=''>Tidak Ada Poli</option>";
                                                    } else {
                                                        foreach ($data as $d) {
                                                    ?>
                                                    <option value="<?= $d['id'] ?>" data-harga="<?= $d['harga'] ?>">
                                                        <?= $d['nama_obat'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input type="text" class="form-control" id="harga" name="harga" readonly>
                                        </div>
                                        <button type="submit" class="btn btn-primary float-end">Periksa</button>
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

    <script>
    function redirectToPeriksa() {
        // Replace 'your_controller' with the actual controller name
        window.location.href = '<?php echo base_url('dokter/dokter'); ?>';
    }
    </script>
    <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>
    </script>

    <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').on('change', function() {
            var selectedObats = $(this).val();
            var totalHarga = 0;

            if (selectedObats) {
                selectedObats.forEach(function(obatId) {
                    var harga = $('option[value="' + obatId + '"]').data('harga');
                    totalHarga += parseFloat(harga);
                });
            }

            // Add a fixed amount of 50,000 to the total price
            totalHarga += 50000;

            $('#harga').val(totalHarga.toFixed(2));
        });
    });
    </script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('asset/') ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('asset/') ?>AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>