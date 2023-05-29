<ul class="list-unstyled trustslist">
    <?php
    $tax_query = [];
    if (isset($args['slugs'])) {
        $tax_query[] = [
            'taxonomy' => 'licensetax',
            'field' => 'slug',
            'terms' => $args['slugs'],
        ];
    } else {
        $term_current = get_term_current('licensetax');
        $tax_query[] = [
            'taxonomy' => 'licensetax',
            'field' => 'term_id',
            'terms' => $term_current->term_id,
        ];
    }
    $arg_posts = array(
        'post_type' => 'licensepost',
        'posts_per_page' => -1,
        'tax_query' => $tax_query,
        'meta_query' => array(
            'relation' => 'AND',
            'order_number' => array(
                'key' => 'order_number',
                'compare' => 'EXISTS',
            ),
        ),
        'meta_key' => 'order_number',
        'orderby' => 'meta_value_num title',
        'order' => 'ASC'
    );
    $query = new WP_Query($arg_posts);
    if ($query->have_posts()) : ?>
        
        <?php while ($query->have_posts()) : $query->the_post();
            ?>
        <li>
          <img src="<?php the_field('flag'); ?>" class="flagtrasts">
          <div class="trust-item-inner">
            <div class="card-img-category" style="background-image:url('<?php the_field('preview-image'); ?>');">
            </div>
            <h3><?= get_field('mini_title') ? get_field('mini_title') : get_the_title() ?></h3>
            <a href="<?php the_permalink(); ?>"
               class="trastbutton btn"><?php _e('More Detailes', 'prifinance') ?></a>
          </div>
        </li>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php endif;    // КОНЕЦ  ?>
</ul>
