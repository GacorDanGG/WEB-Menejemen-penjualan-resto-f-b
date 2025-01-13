<?php
// Periksa role di session
if ($this->session->userdata('role') !== 'owner') {
    $access_denied = true; // Variabel penanda akses ditolak
} else {
    $access_denied = false;
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="display: flex; min-height: 100vh;">

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse" style="min-height: 100vh;">
    <a style="color: white;" class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">GGMU🔱👹🔴</a>
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="<?= site_url('order_input'); ?>">Orders Input</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('product'); ?>">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('user/main_user'); ?>">User</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('reports'); ?>">Reports</a></li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color: aliceblue;">Omset</span>
            </h6>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('omset/perbulan'); ?>">Month</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('omset/pertahun'); ?>">Year</a></li>
            <li class="logout"><a class="nav-link text-danger" href="<?= site_url('login/logout'); ?>">LOG OUT</a></li>
        </ul>
    </div>
</nav>

<div class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
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
                        <a href="<?= site_url('order_input'); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <h2>Data User</h2>
        <a href="<?= site_url('user/add_action'); ?>" class="btn btn-primary mb-3">Tambah User</a>
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-success"><?= $this->session->flashdata('message'); ?></div>
        <?php endif; ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Kelola</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['password'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <a href="<?= site_url('user/edit/' . $user['user_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= site_url('user/delete_user/' . $user['username']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data user</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php if ($access_denied): ?>
<script>
    $(document).ready(function() {
        $('#accessDeniedModal').modal('show');
    });
</script>
<?php endif; ?>

</body>
</html>
