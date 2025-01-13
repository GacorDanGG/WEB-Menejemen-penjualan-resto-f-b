<?php
// Periksa role di session
if ($this->session->userdata('role') !== 'owner') {
    $access_denied = true; // Tambahkan variabel penanda akses ditolak
} else {
    $access_denied = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse" style="min-height: 100vh;">
                <a style="color: white;" class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">GGMU🔱👹🔴</a>
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('order_input'); ?>">Orders Input</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('product'); ?>">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('user/main_user'); ?>">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('reports'); ?>">Reports</a>
                        </li>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span style="color: aliceblue;">Omset</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('omset/perbulan'); ?>">Month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('omset/pertahun'); ?>">Year</a>
                            </li>
                            <li class="logout">
                                <a class="nav-link" style="color: red;" href="<?= site_url('login/logout'); ?>">LOG OUT</a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container col-md-9 col-lg-10 px-md-4">
            <h2 class="mt-4">Tambah Produk</h2>

                <?php if ($access_denied): ?>
                    <!-- Modal Akses Ditolak -->
                    <div class="modal fade show" id="accessDeniedModal" tabindex="-1" aria-labelledby="accessDeniedLabel" aria-modal="true" style="display: block; background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="accessDeniedLabel">Akses Ditolak</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                                    <p>Silakan hubungi administrator untuk mendapatkan akses.</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?= site_url('product'); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?= form_open_multipart('product/add_action'); ?>
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name'); ?>" required>
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" value="<?= set_value('price'); ?>" required>
                        <?= form_error('price', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <a href="<?= site_url('product/main_product'); ?>" class="btn btn-secondary">Back</a>
                    <?= form_close(); ?>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php if ($access_denied): ?>
    <script>
        $(document).ready(function() {
            $('#accessDeniedModal').modal('show');
        });
    </script>
    <?php endif; ?>
</body>
</html>
