<!-- Hero Section -->
<section class="hero-section" style="background-image: url('https://images.immediate.co.uk/production/volatile/sites/3/2023/03/goku-dragon-ball-guru-824x490-11b2006-e1697471244240.jpg');">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Hero section will go here</h1>
        </div>
        <div class="hero-form">
            <form id="landing-page-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first_name" required>
                </div>
                
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" required>
                </div>
                
                <div class="form-group">
                    <label for="email-address">Email Address</label>
                    <input type="email" id="email-address" name="email_address" required>
                </div>
                
                <div class="form-group">
                    <label for="marketing-consent">
                        <input type="checkbox" id="marketing-consent" name="marketing_consent">
                        I agree to receive marketing communications
                    </label>
                </div>
                
                <input type="hidden" name="action" value="submit_landing_page_form">
                <input type="hidden" name="landing_page_id" value="<?php echo get_the_ID(); ?>">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</section>
