<tbody>
    <?php foreach ($menu as $obat) : ?>
        <tr>
            <td><?= $obat['id']; ?></td>
            <td><?= $obat['nama_obat']; ?></td>
            <td><?= $obat['kemasan']; ?></td>
            <td><?= $obat['harga']; ?></td>
            <td>
                <button type='button' class='btn btn-sm btn-warning edit-btn' data-obatid="<?= $obat['id']; ?>">Edit</button>
                <a href="<?= base_url('admin/admin/hapus/' . $obat['id']); ?>" class='btn btn-sm btn-danger' onclick='return confirm("Anda yakin ingin hapus?");'>Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manajemen Obat</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                            <li class="breadcrumb-item active">Obat</li>
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
                                <h3 class="card-title">Data Obat</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addModal">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Obat</th>
                                            <th>Kemasan</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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