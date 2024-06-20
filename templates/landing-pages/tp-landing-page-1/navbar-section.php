<!-- Navbar Section -->
<?php
// Get the initial number of queries
$initial_queries = get_num_queries();

// Fetch the selected navbar background color key from the post meta
$navbar_bg_color_key = get_post_meta(get_the_ID(), 'navbar_section_background_color', true);

// Retrieve the actual color value from the brand colors array or default to an empty string if not set
$navbar_bg_color = isset($brand_colors[$navbar_bg_color_key]) ? $brand_colors[$navbar_bg_color_key] : '';

// Output the navbar section with the dynamic background color
?>
<section class="navbar-section" style="background-color: <?php echo esc_attr($navbar_bg_color); ?>;">
    <img src="<?php echo esc_url($brand_logo_url); ?>" alt="<?php echo esc_attr($brand_logo_alt); ?>">
</section>

<h5 style="text-align: center;">
    <?php
    // Get the final number of queries
    $final_queries = get_num_queries();
    // Calculate the number of queries the navbar section is responsible for
    $navbar_section_queries = $final_queries - $initial_queries;
    echo "Navbar Section Queries: $navbar_section_queries";
    ?>
</h5>
