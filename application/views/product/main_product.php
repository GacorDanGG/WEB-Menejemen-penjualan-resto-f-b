<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        nav {
            min-height: 100vh;
        }
        .table img {
            max-width: 80px;
            height: auto;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

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
<div class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
<h2>Produk List</h2>
    <a href="<?= site_url('product/add_product'); ?>" class="btn btn-primary mb-3">Tambah Produk</a>
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success"><?= $this->session->flashdata('message'); ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Kelola</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($product)): ?>
                <?php foreach ($product as $key => $item): ?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td><?= 'Rp ' . number_format($item['price'], 0, ',', '.'); ?></td>
                        <td>
                            <img src="<?= base_url($item['image_url']); ?>" alt="<?= htmlspecialchars($item['name']); ?>" width="150">
                        </td>
                        <td>
                            <a href="<?= site_url('product/edit/' . $item['product_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('product/hapus/' . $item['product_id']); ?>" 
                            class="btn btn-danger btn-sm" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada produk yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Flash message -->
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
