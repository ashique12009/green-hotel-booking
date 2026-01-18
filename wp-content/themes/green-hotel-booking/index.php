<?php get_header(); ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Experience Luxury<br>Like Never Before</h1>
            <p class="hero-subtitle">Discover the perfect blend of comfort, elegance, and world-class hospitality at Azure Haven Hotel</p>
        </div>

        <!-- Booking Form -->
        <div class="booking-card">
            <div class="booking-header">
                <span class="price-badge">Best Price Guarantee</span>
            </div>
            <form class="booking-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="checkin">Check-in</label>
                        <input type="date" id="checkin" name="checkin">
                    </div>
                    <div class="form-group">
                        <label for="checkout">Check-out</label>
                        <input type="date" id="checkout" name="checkout">
                    </div>
                </div>
                <div class="form-group">
                    <label for="guests">Guests</label>
                    <select id="guests" name="guests">
                        <option value="1">1 Guest</option>
                        <option value="2" selected>2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                    </select>
                </div>
                <button type="submit" class="btn-reserve">Check Availability</button>
                <p class="booking-note">Free cancellation within 24 hours</p>
            </form>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-grid">

                <?php
                $features = new WP_Query(array(
                    'post_type'      => 'feature',
                    'posts_per_page' => 3
                ));

                if ($features->have_posts()) :
                    while ($features->have_posts()) : $features->the_post();
                ?>

                    <div class="feature-card">
                        <div class="feature-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>

                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?></p>
                    </div>

                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    <section class="amenities" id="amenities">
        <div class="container">
            <div class="section-header">
                <h2>What We Offer</h2>
                <p>Everything you need for an unforgettable stay</p>
            </div>

            <div class="amenities-grid">
                <?php
                $amenities = new WP_Query([
                    'post_type'      => 'amenity',
                    'posts_per_page' => -1,
                ]);

                if ($amenities->have_posts()) :
                    while ($amenities->have_posts()) : $amenities->the_post();
                        $icon = get_post_meta(get_the_ID(), 'amenity_icon', true);
                        ?>
                        <div class="amenity-item">
                            <span class="amenity-icon"><?php echo esc_html($icon); ?></span>
                            <span><?php the_title(); ?></span>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <button class="btn-secondary">
                View All Amenities
            </button>
        </div>
    </section>

    <!-- Rooms Section -->
    <section class="rooms" id="rooms">
        <div class="container">
            <div class="section-header">
                <h2>Our Rooms & Suites</h2>
                <p>Choose your perfect retreat</p>
            </div>

            <div class="rooms-grid">

                <?php
                $rooms = new WP_Query(array(
                    'post_type'      => 'room',
                    'posts_per_page' => 3
                ));

                if ($rooms->have_posts()) :
                    while ($rooms->have_posts()) : $rooms->the_post();

                    $badge     = get_post_meta(get_the_ID(), '_room_badge', true);
                    $details   = get_post_meta(get_the_ID(), '_room_details', true);
                    $old_price = get_post_meta(get_the_ID(), '_room_old_price', true);
                    $new_price = get_post_meta(get_the_ID(), '_room_new_price', true);
                ?>

                <div class="room-card">
                    <div class="room-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>

                        <?php if ($badge) : ?>
                            <span class="room-badge"><?php echo esc_html($badge); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="room-content">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html($details); ?></p>

                        <div class="room-footer">
                            <div class="room-price">
                                <?php if ($old_price) : ?>
                                    <span class="price-old">$<?php echo esc_html($old_price); ?></span>
                                <?php endif; ?>

                                <span class="price-new">$<?php echo esc_html($new_price); ?></span>
                                <span class="price-unit">/night</span>
                            </div>

                            <button class="btn-book">Book Now</button>
                        </div>
                    </div>
                </div>

                <?php endwhile; wp_reset_postdata(); endif; ?>

            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials" id="reviews">
        <div class="container">
            <div class="section-header">
                <h2>Guest Experiences</h2>
                <p>What our guests say about their stay</p>
            </div>

            <div class="testimonials-grid">
                <?php
                $testimonials = new WP_Query([
                    'post_type'      => 'guest-exp',
                    'posts_per_page' => 3,
                ]);

                if ($testimonials->have_posts()) :
                    while ($testimonials->have_posts()) : $testimonials->the_post();

                        $stars    = (int) get_post_meta(get_the_ID(), 'guest_stars', true);
                        $review   = get_post_meta(get_the_ID(), 'guest_review', true);
                        $location = get_post_meta(get_the_ID(), 'guest_location', true);
                        $image    = get_post_meta(get_the_ID(), 'guest_image', true);
                        ?>
                        <div class="testimonial-card">

                            <div class="stars">
                                <?php echo str_repeat('★', $stars); ?>
                            </div>

                            <p class="testimonial-text">
                                "<?php echo esc_html($review); ?>"
                            </p>

                            <div class="testimonial-author">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                                <div>
                                    <strong><?php the_title(); ?></strong>
                                    <span><?php echo esc_html($location); ?></span>
                                </div>
                            </div>

                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Experience Luxury?</h2>
            <p>Book your stay today and receive 20% off your first booking</p>
            <form class="cta-form">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit" class="btn-primary">Get Started</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php get_footer(); ?>
</body>
</html>