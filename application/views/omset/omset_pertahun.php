<?php
if ($this->session->userdata('role') !== 'owner') {
    $access_denied = true; 
} else {
    $access_denied = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omset Per Tahun</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </div>
</nav> 

<!-- Main Content -->
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
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0" style="color: #333;">Omset Per Tahun</h1>
        </div>

        <!-- Chart Card -->
        <div class="card mb-4" style="border-radius: 10px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); border: none;">
            <div class="card-body p-4">
                <div style="height: 400px;">
                    <canvas id="omsetTahunChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Table Card -->
        <div class="card" style="border-radius: 10px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); border: none;">
            <div class="card-header bg-white py-3" style="border-bottom: 1px solid #e3e6f0;">
                <h6 class="m-0 font-weight-bold" style="color: #dc3545;">Detail Omset Per Tahun</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr style="background-color: #f8f9fc;">
                                <th class="py-3" style="border-top: none;">Tahun</th>
                                <th class="py-3" style="border-top: none;">Total Omset</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($omset_pertahun)): ?>
                                <?php foreach ($omset_pertahun as $omset): ?>
                                    <tr>
                                        <td class="py-3"><?= htmlspecialchars($omset['tahun']); ?></td>
                                        <td class="py-3 font-weight-bold">Rp <?= number_format($omset['total_omset'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center py-4">Tidak ada data omset untuk ditampilkan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('omsetTahunChart').getContext('2d');
    
    // Chart gradient
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(220, 53, 69, 0.8)'); // Bootstrap danger color
    gradient.addColorStop(1, 'rgba(220, 53, 69, 0.2)');
    
    const omsetTahunChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php foreach ($omset_pertahun as $omset) : ?>
                    "<?= htmlspecialchars($omset['tahun']); ?>",
                <?php endforeach; ?>
            ],
            datasets: [{
                label: 'Omset Per Tahun',
                data: [
                    <?php foreach ($omset_pertahun as $omset) : ?>
                        <?= $omset['total_omset']; ?>,
                    <?php endforeach; ?>
                ],
                backgroundColor: gradient,
                borderColor: '#dc3545',
                borderWidth: 1,
                borderRadius: 5,
                barThickness: 50
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e3e6f0',
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return 'Omset: Rp ' + context.raw.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
});
</script>