<?php
// Periksa role di session
if ($this->session->userdata('role') !== 'owner') {
    $access_denied = true; // Variabel penanda akses ditolak
} else {
    $access_denied = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="display: flex; min-height: 100vh;">

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
    <h2 class="mt-4">Tambah User</h2>

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
    <!-- Form Tambah User -->
    <form action="<?= site_url('user/add_action') ?>" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= isset($user['username']) ? $user['username'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="owner" <?= isset($user['role']) && $user['role'] == 'owner' ? 'selected' : '' ?>>Owner</option>
                <option value="kasir" <?= isset($user['role']) && $user['role'] == 'kasir' ? 'selected' : '' ?>>Kasir</option>
            </select>
        </div>
        <input type="hidden" name="user_id" value="<?= isset($user['user_id']) ? $user['user_id'] : '' ?>">
        <button type="submit" class="btn btn-primary">Simpan User</button>
        <a href="<?= site_url('user/main_user') ?>" class="btn btn-secondary">Kembali</a>
    </form>
    <?php endif; ?>
</div>

<!-- Modal Trigger Script -->
<?php if ($access_denied): ?>
<script>
    $(document).ready(function() {
        $('#accessDeniedModal').modal('show');
    });
</script>
<?php endif; ?>

</body>
</html>
