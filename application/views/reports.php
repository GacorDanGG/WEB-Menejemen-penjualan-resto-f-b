<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report List</title>
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
        <h2>Reports List</h2><br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order Item ID</th>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reports)): ?>
                    <?php foreach ($reports as $report): ?>
                        <tr>
                            <td><?= $report['order_item_id']; ?></td>
                            <td><?= $report['order_id']; ?></td>
                            <td><?= $report['product_id']; ?></td>
                            <td><?= $report['quantity']; ?></td>
                            <td><?= $report['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Tidak ada data order items</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
