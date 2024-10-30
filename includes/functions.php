<?php
defined( 'ABSPATH' ) or exit;

/**
 * Enqueues scripts and styles in admin
 */
function cvmh_catblock_admin_scripts() {
    wp_enqueue_style( 'cvmh-catblock-admin-style', CVMH_CATBLOCK_ASSETS_PATH . 'css/admin.css' );
    wp_enqueue_script( 'jquery-ui-tabs' );
}

/**
 * Enqueues scripts and styles for front end
 */
function cvmh_catblock_front_enqueues() {
        wp_register_style( 'cvmh-catblock-style', CVMH_CATBLOCK_ASSETS_PATH . 'css/front.css' );
        wp_register_script( 'cvmh-catblock-script', CVMH_CATBLOCK_ASSETS_PATH . 'js/front.js', array( 'jquery' ) );
}

/**
 * Default args for shortcode and widget
 * 
 * @return type
 */
function cvmh_catblock_default_args() {
    $defaults = array(
        'title'          => __( 'Category block', 'cat-block' ),
        'introduction'   => '',
        'category'       => array(),
        'count'          => 3,
        'offset'         => 0,
        'buttonall'      => true,
        'alltext'        => __( 'See all', 'cat-block' ),
        'posttype'       => 'post',
        'showimage'      => false,
        'imagesize'      => 'thumbnail',
        'showtitle'      => true,
        'titletag'       => 'h3',
        'titlelength'    => 45,
        'showexcerpt'    => false,
        'excerptlength'  => 50,
        'showdate'       => false,
        'dateformat'     => 'j F Y',
        'showreadmore'   => true,
        'readmoretext'   => __( 'Read more', 'cat-block' ),
        'readmoretype'   => 'anchor',
        'slideshow'      => true,
        'duration'       => 7000,
        'shownav'        => true );
        
    return apply_filters( 'cvmh_catblock_default_args', $defaults );
}

/**
 * Get posts
 * 
 * @param type $params
 * @return type
 */
function cvmh_cat_block_get_posts( $params ) {
    $args       = array(
        'posts_per_page'      => $params['count'],
        'orderby'             => 'post_date',
        'order'               => 'DESC',
        'post_type'           => $params['posttype'],
        'post_status'         => 'publish',
        'suppress_filters'    => false,
        'ignore_sticky_posts' => true,
    );
    if ( !empty( $params['offset'] ) ) :
        $args['offset'] = $params['offset'];
    endif;
    if ( !empty( $params['category'] ) ) :
        $args['category__in'] = $params['category'];
    endif;
    if ( !empty( $params['post_in'] ) ) :
        $post_in_array    = explode( ",", $params['post_in'] );
        $args['post__in'] = $post_in_array;
    endif;
    $posts = get_posts( apply_filters( 'cvmh_cat_block_get_posts_args', $args, $params ) );
    return $posts;
}

/**
 * Render category block
 * 
 * @global type $post
 * @param type $args
 * @return string
 */
function cvmh_catblock_front_render( $args ) {
    wp_enqueue_script( 'cvmh-catblock-script' );
    wp_enqueue_style( 'cvmh-catblock-style' );
    
    $random = wp_rand( 0, 25 );
    $posts = cvmh_cat_block_get_posts( $args );
    $nb_posts = count( $posts );

    if ( !empty( $posts ) ) :
        global $post;
        $html = '';

        $navigation = '';
        if ( $nb_posts > 1 and $args['slideshow'] and $args['shownav'] ) :
            $navigation.= '<ul class="catblock-nav">';
            for ( $i = 1; $i <= $nb_posts; $i++ ):
                $navigation.= '<li id="catblock-item-' . $random . '-' . $i . '" data-slide="' . $i . '"';
                if ( $i == 1 ) :
                    $navigation.=' class="active"';
                endif;
                $navigation.= '>' . $i . '</li>';
            endfor;
            $navigation.= '</ul>';
        endif;

        $i = 0;
        foreach ( $posts as $post ) :
            setup_postdata( $post );
            $i++;

            $html .= '<li class="item-' . $i . ( $i == 1 ? ' active' : '' ) . apply_filters( 'cvmh_catblock_item_class', '', get_the_ID() ) . '">';

            $link = apply_filters( 'cvmh_catblock_link', get_permalink(), get_the_ID() );

            if ( $args['showimage'] ) :
                $thumbnail = get_the_post_thumbnail( $post->ID, $args['imagesize'], array( 'class' => 'catblock-img catblock-goto', 'data-url' => $link ) );
                if ( ! empty( $thumbnail ) ) :
                    $html .= apply_filters( 'cvmh_catblock_before_img', '', get_the_ID() ) . $thumbnail . apply_filters( 'cvmh_catblock_after_img', '', get_the_ID() );
                endif;
            endif;

            $html .= apply_filters( 'cvmh_catblock_before_title', '', get_the_ID() );
            
            if ( $args['showtitle'] ) :
                $title = get_the_title();
                if ( ! empty( $args['titlelength'] ) and strlen( $title ) > $args['titlelength'] ) :
                    $title = substr( $title, 0, $args['titlelength'] ) . '...';
                endif;
                $html .= '<' . $args['titletag'] . '><a href="' . $link . '">' . apply_filters( 'cvmh_catblock_item_title', $title, get_the_ID() ) . '</a></' . $args['titletag'] . '>';
            endif;

            $html .= apply_filters( 'cvmh_catblock_after_title', '', get_the_ID() );
            
            if ( $args['showdate'] ) :
                $html .= '<span class="catblock-date">' . get_the_date( $args['dateformat'] ) . '</span>';
            endif;

            $html .= '<div class="catblock-content">';
            
            if ( $args['showexcerpt'] ) :
                $html .= '<div class="catblock-excerpt">' . catblock_excerpt( $args['excerptlength'] ) . '</div>';
            endif;

            if ( $args['showreadmore'] and ! empty( $args['readmoretext'] ) ) :
                if ( $args['readmoretype'] === 'button' ) :
                    $readmore = '<button class="catblock-read-more catblock-goto" data-url="' . $link . '">' . $args['readmoretext'] . '</button>';
                else :
                    $readmore = '<a class="catblock-read-more" href="' . $link . '">' . $args['readmoretext'] . '</a>';
                endif;
                $html .= $readmore;
            endif;

            $html .= '</div>';
            
            $html .= apply_filters( 'cvmh_catblock_after_content', '', get_the_ID() );
            
            $html .= '</li>';
        endforeach;
        wp_reset_postdata();

        $title = '';
        if ( ! empty( $args['plugintitle']  ) ) :
            $title = '<' . apply_filters( 'cvmh_catblock_widget_title_tag', 'h2' ) . ' class="widget-title decorate">' . $args['plugintitle'] . '</' . apply_filters( 'cvmh_catblock_widget_title_tag', 'h2' ) . '>';
        endif;

        $after_widget_title = apply_filters( 'cvmh_catblock_after_widget_title', '' );
        
        $introduction = '';
        if ( ! empty( $args['introduction']  ) ) :
            $introduction = '<div class="catblock-intro">' . $args['introduction'] . '</div>';
        endif;

        $buttonall = '';
        if ( $args['buttonall'] and ! empty( $args['alltext'] ) and count( $args['category'] ) === 1 ) :
            $buttonall = '<a class="catblock-all" href="' . get_category_link( $args['category'][0] ) . '">' . $args['alltext'] . '</a>';
        endif;

        $cat_block = '<div>' . $title . $after_widget_title . $introduction . $navigation . '<div class="catblock-wrapper" id="catblock_' . $random . '"';
        $class_slideshow = '';
        if ( $args['slideshow'] ) :
            $cat_block .= ' data-slideshow="1"';
            $class_slideshow = ' is-slideshow';
        endif;
        $cat_block .= ' data-duration="' . $args['duration'] . '"><ul class="catblock-list' . $class_slideshow . '">' . $html . '</ul>' . $buttonall . '</div></div>';
    endif;

    return $cat_block;   
}

/*
 * Excerpt
 */
function catblock_excerpt( $length ) {
    global $post;
    $text = $post->post_excerpt;

    if ( $text == '' )
        $text = get_the_content();
    else
        $text = '<p>' . nl2br( $text ) . '</p>';
    
    $text = strip_shortcodes( $text );

    $text = apply_filters( 'the_content', $text );
    $text = str_replace( ']]>', ']]&gt;', $text );

    $text = strip_tags( $text, apply_filters( 'cvmh_catblock_excerpt_allowed_tags', '<p><a><strong><em><br>' ) );

    $words = preg_split( "/[\n\r\t ]+/", $text, $length + 1, PREG_SPLIT_NO_EMPTY );
    if ( count( $words ) > $length ) :
        array_pop( $words );
        $text = implode( ' ', $words );
        $text = $text . apply_filters( 'cvmh_catblock_excerpt_resized_addendum', ' [...]' );
    else :
        $text = implode( ' ', $words );
    endif;

    return force_balance_tags( $text );
}