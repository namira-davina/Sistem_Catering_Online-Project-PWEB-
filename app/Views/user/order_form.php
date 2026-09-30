<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Order Form - DeliziaHome</title>
    <link rel="stylesheet" href="/css/order_form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">DELIZIAHOME</div>
    <nav>
        <a href="<?= base_url('user/home') ?>">Home</a>
        <a href="<?= base_url('user/menu') ?>">Menu</a>
        <a href="<?= base_url('user/profile') ?>">Profile</a>
        <button onclick="location.href='<?= base_url('logout') ?>'">Log Out</button>
    </nav>
</header>

<div class="container-wrapper">
    <a href="<?= base_url('user/menu') ?>" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Menu
    </a>

    <div class="form-wrapper">
        <div class="form-header">
            <h2><i class="fas fa-clipboard-list"></i> Order Form</h2>
            <p class="subtitle">Please fill in your details to complete the order</p>
        </div>

        <form action="<?= base_url('user/order/create') ?>" method="post">
            <?= csrf_field() ?>
            
            <input type="hidden" name="menu_id" value="<?= esc($menu_id) ?>">

            <div class="form-content">
                <div class="form-section">
                    <h3><i class="fas fa-user"></i> Customer Information</h3>
                    
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user-circle"></i> Full Name *
                        </label>
                        <?php $user = session()->get('user_data'); ?>
                        <input type="text" id="name" name="name" value="<?= esc($user['username']) ?>" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="mobile">
                            <i class="fas fa-phone"></i> Phone Number *
                        </label>
                        <input type="text" id="mobile" name="mobile" placeholder="08xxxxxxxxxx" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="address">
                            <i class="fas fa-map-marker-alt"></i> Delivery Address *
                        </label>
                        <input type="text" id="address" name="address" placeholder="Enter complete delivery address" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="jumlah_paket">
                            <i class="fas fa-box"></i> Number of Packages *
                        </label>
                        <input type="number" id="jumlah_paket" name="jumlah_paket" value="1" min="1" required placeholder="Enter number of packages" class="form-input number-input">
                    </div>

                    <div class="form-group">
                        <label for="catatan">
                            <i class="fas fa-sticky-note"></i> Special Instructions
                        </label>
                        <textarea id="catatan" name="catatan" placeholder="Any special requests, allergies, or delivery instructions..." rows="3" class="form-textarea">
                        </textarea>
                    </div>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-credit-card"></i> Payment Method</h3>
                    <p class="section-subtitle">Choose your preferred payment method</p>
                    
                    <div class="payment-options">
                        <label class="payment-option">
                            <div class="payment-radio">
                                <input type="radio" name="payment_method" value="QRIS" checked required id="payment-qris">
                                <span class="radio-checkmark"></span>
                            </div>
                            <div class="payment-icon">
                                <img src="<?= base_url('images/qris.png') ?>" alt="QRIS" width="50">
                            </div>
                            <div class="payment-info">
                                <h4>QRIS</h4>
                                <p>Scan QR code to pay instantly</p>
                            </div>
                        </label>

                        <label class="payment-option">
                            <div class="payment-radio">
                                <input type="radio" name="payment_method" value="COD" required id="payment-cod">
                                <span class="radio-checkmark"></span>
                            </div>
                            <div class="payment-icon">
                                <img src="<?= base_url('images/cod.png') ?>" alt="COD" width="50">
                            </div>
                            <div class="payment-info">
                                <h4>Cash on Delivery</h4>
                                <p>Pay when your order arrives</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="form-actions-section">
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            Place Order
                        </button>
                        <a href="<?= base_url('user/menu') ?>" class="btn-cancel">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<footer class="page-footer">
    <p>&copy; <?= date('Y') ?> DeliziaHome Catering. All rights reserved.</p>
</footer>

</body>
</html>