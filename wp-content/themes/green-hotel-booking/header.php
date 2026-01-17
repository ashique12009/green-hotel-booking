<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class() ;?>>
    <!-- Navigation -->
    <header class="header">
        <nav class="nav">
            <a href="#" class="logo">
                <span class="logo-icon">◈</span> Green Hotel Booking
            </a>
            <ul class="nav-links">
                <li><a href="#rooms">Rooms</a></li>
                <li><a href="#amenities">Amenities</a></li>
                <li><a href="#reviews">Reviews</a></li>
                <li><a href="#location">Location</a></li>
            </ul>
            <div class="nav-actions">
                <a href="#" class="btn-text">Login</a>
                <a href="#" class="btn-primary">Book Now</a>
            </div>
            <button class="mobile-menu-btn" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>