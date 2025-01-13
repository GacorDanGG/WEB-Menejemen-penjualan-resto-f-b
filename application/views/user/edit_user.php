<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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

    <div class="container mt-5">
    <h3>Edit Pengguna</h3>
    <!-- Form untuk mengedit user -->
    <form action="<?= site_url('user/edit_action') ?>" method="post">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']); ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="owner" <?= $user['role'] == 'owner' ? 'selected' : ''; ?>>Owner</option>
                <option value="kasir" <?= $user['role'] == 'kasir' ? 'selected' : ''; ?>>Kasir</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= site_url('user/batal') ?>" class="btn btn-secondary">Batal</a>
    </form>
    </div>

</body>
</html>
