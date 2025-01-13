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
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: flex; min-height: 100vh;">

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

<div class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
    <h2>Edit Product</h2>
    
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('error'); ?> </div>
    <?php endif; ?>

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

    <form action="<?= site_url('product/edit_action'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['product_id']; ?>">

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars($product['price']); ?>" required>
        </div>

        <div class="form-group">
            <label for="image">Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control">
            <?php if (!empty($product['image_url'])): ?>
                <div class="mt-2">
                    <img src="<?= base_url($product['image_url']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" style="max-width: 150px; height: auto;">
                    <input type="hidden" name="old_image" value="<?= $product['image_url']; ?>">
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="<?= site_url('product'); ?>" class="btn btn-secondary">Cancel</a>
    </form>
    <?php endif; ?>
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
