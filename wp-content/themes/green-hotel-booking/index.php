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
                <div class="feature-card">
                    <div class="feature-image">
                        <img src="/placeholder.svg?height=200&width=300" alt="Swimming Pool">
                    </div>
                    <h3>Stunning Pool & Spa</h3>
                    <p>Relax by our infinity pool or rejuvenate at our world-class spa</p>
                </div>
                <div class="feature-card">
                    <div class="feature-image">
                        <img src="/placeholder.svg?height=200&width=300" alt="Luxury Rooms">
                    </div>
                    <h3>Elegant Accommodations</h3>
                    <p>Spacious rooms with breathtaking views and premium amenities</p>
                </div>
                <div class="feature-card">
                    <div class="feature-image">
                        <img src="/placeholder.svg?height=200&width=300" alt="Fine Dining">
                    </div>
                    <h3>Award-Winning Dining</h3>
                    <p>Savor exquisite cuisines crafted by our Michelin-star chefs</p>
                </div>
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
                <div class="amenity-item">
                    <span class="amenity-icon">🏊</span>
                    <span>Infinity Pool</span>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">📶</span>
                    <span>Free WiFi</span>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🍽️</span>
                    <span>Fine Dining</span>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">💆</span>
                    <span>Spa & Wellness</span>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🏋️</span>
                    <span>Fitness Center</span>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🚗</span>
                    <span>Valet Parking</span>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🛎️</span>
                    <span>24/7 Concierge</span>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">✈️</span>
                    <span>Airport Transfer</span>
                </div>
            </div>
            <button class="btn-secondary">View All 38 Amenities</button>
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
                <div class="room-card">
                    <div class="room-image">
                        <img src="/placeholder.svg?height=280&width=400" alt="Deluxe Room">
                        <span class="room-badge">Most Popular</span>
                    </div>
                    <div class="room-content">
                        <h3>Deluxe Room</h3>
                        <p>45 sq m • King Bed • City View</p>
                        <div class="room-footer">
                            <div class="room-price">
                            <span class="price-old">$280</span>
                            <span class="price-new">$199</span>
                            <span class="price-unit">/night</span>
                            </div>
                            <button class="btn-book">Book Now</button>
                        </div>
                    </div>
                </div>
                <div class="room-card">
                    <div class="room-image">
                        <img src="/placeholder.svg?height=280&width=400" alt="Premium Suite">
                    </div>
                    <div class="room-content">
                        <h3>Premium Suite</h3>
                        <p>65 sq m • King Bed • Ocean View</p>
                        <div class="room-footer">
                            <div class="room-price">
                            <span class="price-old">$420</span>
                            <span class="price-new">$349</span>
                            <span class="price-unit">/night</span>
                            </div>
                            <button class="btn-book">Book Now</button>
                        </div>
                    </div>
                </div>
                <div class="room-card">
                    <div class="room-image">
                        <img src="/placeholder.svg?height=280&width=400" alt="Penthouse">
                    </div>
                    <div class="room-content">
                        <h3>Penthouse</h3>
                        <p>120 sq m • 2 Bedrooms • Panoramic View</p>
                        <div class="room-footer">
                            <div class="room-price">
                            <span class="price-old">$850</span>
                            <span class="price-new">$699</span>
                            <span class="price-unit">/night</span>
                            </div>
                            <button class="btn-book">Book Now</button>
                        </div>
                    </div>
                </div>
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
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"An absolutely magical experience. The staff went above and beyond to make our anniversary unforgettable."</p>
                    <div class="testimonial-author">
                        <img src="/placeholder.svg?height=48&width=48" alt="Sarah M.">
                        <div>
                            <strong>Sarah M.</strong>
                            <span>New York, USA</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"The ocean view suite exceeded all expectations. Impeccable service and stunning amenities throughout."</p>
                    <div class="testimonial-author">
                        <img src="/placeholder.svg?height=48&width=48" alt="James L.">
                        <div>
                            <strong>James L.</strong>
                            <span>London, UK</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Perfect getaway! The spa treatments were divine and the restaurant served the best seafood I've ever had."</p>
                    <div class="testimonial-author">
                        <img src="/placeholder.svg?height=48&width=48" alt="Emma K.">
                        <div>
                            <strong>Emma K.</strong>
                            <span>Sydney, Australia</span>
                        </div>
                    </div>
                </div>
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