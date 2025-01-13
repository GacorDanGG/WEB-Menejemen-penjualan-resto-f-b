<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Order</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
<div class="container col-md-9 col-lg-10 px-md-4" style="background-color: #f8f9fa;">

    <div class="d-flex justify-content-between align-items-center py-4 mb-3">
        <h2>Tambah Order</h2>
    </div>

    <form method="POST" action="<?= site_url('order_input/add_order') ?>">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="border-radius: 15px; border: none; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="height: 200px; overflow: hidden; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                            <img src="<?= base_url($product['image_url']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 style="object-fit: cover; height: 100%; width: 100%;">
                        </div>
                        
                        <div class="card-body" style="background: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                            <h5 class="card-title font-weight-bold mb-3" style="color: #333;">
                                <?= $product['name'] ?>
                            </h5>
                            
                            <div class="price-tag mb-3" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 20px; display: inline-block;">
                                <i class="fas fa-tag mr-1"></i>
                                Rp <?= number_format($product['price'], 2, ',', '.') ?>
                            </div>
                            
                            <div class="form-group mt-3">
                                <label class="font-weight-bold mb-2" style="color: #555;">Jumlah Pesanan:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #dc3545; color: white; border: none;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                    </div>
                                    <input type="number" 
                                           class="form-control" 
                                           name="quantity[<?= $product['product_id'] ?>]" 
                                           min="0" 
                                           placeholder="0"
                                           style="border-radius: 0 5px 5px 0; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            
                            <input type="hidden" name="product_id[]" value="<?= $product['product_id'] ?>">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mb-5">
            <button type="submit" 
                    class="btn btn-lg" 
                    style="background-color: #dc3545; 
                           color: white; 
                           padding: 12px 40px;
                           border-radius: 30px;
                           font-weight: bold;
                           box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);
                           transition: all 0.3s ease;">
                <i class="fas fa-cart-plus mr-2"></i>
                TAMBAH ORDER
            </button>
        </div>
    </form>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
