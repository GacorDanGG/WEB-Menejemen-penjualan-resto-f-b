<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Order</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Order Baru</h2>
        <form action="<?= site_url('order/add_order_action') ?>" method="post">
            <div class="form-group">
                <label for="order_number">Nomor Order:</label>
                <input type="text" id="order_number" name="order_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" id="total_amount" name="total_amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="order_date">Tanggal Order:</label>
                <input type="date" id="order_date" name="order_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
