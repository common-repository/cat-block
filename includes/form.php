<?php defined( 'ABSPATH' ) or exit; ?>

<script>
    jQuery( function( $ ) {

        var $form = $( ".cvmh-widget-form-tabs" );

        $form.tabs().addClass( "ui-tabs-vertical" );

        // Add custom class
        $form.closest( ".widget-inside" ).addClass( "cvmh-bg" );
    });
</script>

<div class="cvmh-widget-form-tabs">

    <ul class="cvmh-tabs">
        <li><a href="#tab-1"><?php _e( 'General', 'cat-block' ); ?></a></li>
        <li><a href="#tab-2"><?php _e( 'Posts', 'cat-block' ); ?></a></li>
        <li><a href="#tab-3"><?php _e( 'Thumbnail', 'cat-block' ); ?></a></li>
        <li><a href="#tab-4"><?php _e( 'Content', 'cat-block' ); ?></a></li>
        <li><a href="#tab-5"><?php _e( 'Slideshow', 'cat-block' ); ?></a></li>
    </ul>

    <div class="cvmh-tabs-content">

        <div id="tab-1" class="cvmh-tab-content">
            <p>
                <?php _e( 'Title:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'title' ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $instance['title'] ); ?>" />

            </p>
            <p>
                <?php _e( 'Introduction:', 'cat-block' ); ?>
                <textarea class="widefat" name="<?php echo $this->get_field_name( 'introduction' ); ?>"><?php echo esc_attr( $instance['introduction'] ); ?></textarea>
            </p>
        </div><!-- #tab-1 -->

        <div id="tab-2" class="cvmh-tab-content">
            <p>
                <?php _e( 'Post Type:', 'cat-block' ); ?>
                <select class="widefat" id="<?php echo $this->get_field_id( 'posttype' ); ?>" name="<?php echo $this->get_field_name( 'posttype' ); ?>">
                        <?php foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) { ?>
                                <option value="<?php echo esc_attr( $post_type->name ); ?>" <?php selected( $instance['posttype'], $post_type->name ); ?>><?php echo esc_html( $post_type->labels->singular_name ); ?></option>
                        <?php } ?>
                </select>
            </p>
            <div class="cvmh-multiple-check-form">
                <?php _e( 'Category:', 'cat-block' ); ?>
                <ul>
                    <?php foreach ( get_terms( 'category', array( 'hide_empty' => false ) ) as $category ) : ?>
                        <li>
                            <input type="checkbox" value="<?php echo (int) $category->term_id; ?>" id="<?php echo $this->get_field_id( 'category' ) . '-' . (int) $category->term_id; ?>" name="<?php echo $this->get_field_name( 'category' ); ?>[]" <?php checked( is_array( $instance['category'] ) && in_array( $category->term_id, $instance['category'] ) ); ?> />
                            <label for="<?php echo $this->get_field_id( 'category' ) . '-' . (int) $category->term_id; ?>">
                                <?php echo esc_html( $category->name ); ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <p>
                <?php _e( 'Number of posts to show:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'count' ); ?>"
                       type="number" step="1" min="-1"
                       value="<?php echo (int) ( $instance['count'] ); ?>" />
                <small>-1 <?php _e( 'to show all posts.', 'cat-block' ); ?></small>
            </p>
            <p>
                <?php _e( 'Offset:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'offset' ); ?>"
                       type="number" step="1" min="0"
                       value="<?php echo (int) ( $instance['offset'] ); ?>" />
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['buttonall'] ); ?> id="<?php echo $this->get_field_id( 'buttonall' ); ?>" name="<?php echo $this->get_field_name( 'buttonall' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'buttonall' ); ?>">
                        <?php _e( 'Display "all posts" link', 'cat-block' ); ?>
                </label><br />
                <small><?php _e( 'Not displayed if more than one category is selected.', 'cat-block' ); ?></small>
            </p>
            <p>
                <?php _e( '"All posts" link text:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'alltext' ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $instance['alltext'] ); ?>" />
            </p>
        </div><!-- #tab-2 -->

        <div id="tab-3" class="cvmh-tab-content">
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['showimage'] ); ?> id="<?php echo $this->get_field_id( 'showimage' ); ?>" name="<?php echo $this->get_field_name( 'showimage' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'showimage' ); ?>">
                        <?php _e( 'Display thumbnail', 'cat-block' ); ?>
                </label>
            </p>
            <p>
                <?php _e( 'Thumbnail size:', 'cat-block' ); ?><br />
                <select name="<?php echo $this->get_field_name( 'imagesize' ); ?>">
                    <?php $sizes = get_intermediate_image_sizes(); ?>
                    <?php foreach ( $sizes as $size ) : ?>
                        <option value="<?php echo $size; ?>" <?php selected( $instance['imagesize'], $size ); ?>><?php echo $size; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div><!-- #tab-3 -->

        <div id="tab-4" class="cvmh-tab-content">
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['showtitle'] ); ?> id="<?php echo $this->get_field_id( 'showtitle' ); ?>" name="<?php echo $this->get_field_name( 'showtitle' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'showtitle' ); ?>">
                        <?php _e( 'Display post title', 'cat-block' ); ?>
                </label>
            </p>
            <p>
                <?php _e( 'Title length:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'titlelength' ); ?>"
                       type="number" step="1" min="0"
                       value="<?php echo (int) ( $instance['titlelength'] ); ?>" />
                <small><?php _e( 'Number of characters.', 'cat-block' ); ?></small>
            </p>
            <p>
                <?php _e( 'Title tag:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'titletag' ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $instance['titletag'] ); ?>" />
                <small><?php _e( 'eg. h3 for &lt;h3&gt;.', 'cat-block' ); ?></small>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['showexcerpt'] ); ?> id="<?php echo $this->get_field_id( 'showexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'showexcerpt' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'showexcerpt' ); ?>">
                        <?php _e( 'Display post excerpt', 'cat-block' ); ?>
                </label>
            </p>
            <p>
                <?php _e( 'Excerpt length:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'excerptlength' ); ?>"
                       type="number" step="1" min="0"
                       value="<?php echo (int) ( $instance['excerptlength'] ); ?>" />
                <small><?php _e( 'Number of words.', 'cat-block' ); ?></small>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['showdate'] ); ?> id="<?php echo $this->get_field_id( 'showdate' ); ?>" name="<?php echo $this->get_field_name( 'showdate' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'showdate' ); ?>">
                        <?php _e( 'Display date', 'cat-block' ); ?>
                </label>
            </p>
            <p>
                <?php _e( 'Date format:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'dateformat' ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $instance['dateformat'] ); ?>" />
                <small><?php _e( 'See <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Formatting Date and Time</a> for some of the formats available.', 'cat-block' ); ?></small>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['showreadmore'] ); ?> id="<?php echo $this->get_field_id( 'showreadmore' ); ?>" name="<?php echo $this->get_field_name( 'showreadmore' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'showreadmore' ); ?>">
                        <?php _e( 'Display "read more" link', 'cat-block' ); ?>
                </label>
            </p>
            <p>
                <?php _e( '"Read more" link tag:', 'cat-block' ); ?>
                <br />
                <input type="radio" 
                       name="<?php echo $this->get_field_name( 'readmoretype' ); ?>" 
                       value="anchor" <?php checked( $instance['readmoretype'], 'anchor' ); ?> ><?php _e( 'Anchor', 'cat-block' ); ?>
                &nbsp;&nbsp;&nbsp;
                <input type="radio" 
                       name="<?php echo $this->get_field_name( 'readmoretype' ); ?>" 
                       value="button" <?php checked( $instance['readmoretype'], 'button' ); ?> ><?php _e( 'Button', 'cat-block' ); ?>
                &nbsp;&nbsp;&nbsp;
            </p>
            <p>
                <?php _e( '"Read more" link text:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'readmoretext' ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $instance['readmoretext'] ); ?>" />
            </p>
        </div><!-- #tab-4 -->

        <div id="tab-5" class="cvmh-tab-content">
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['slideshow'] ); ?> id="<?php echo $this->get_field_id( 'slideshow' ); ?>" name="<?php echo $this->get_field_name( 'slideshow' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'slideshow' ); ?>">
                        <?php _e( 'Slideshow', 'cat-block' ); ?>
                </label>
            </p>
            <p>
                <?php _e( 'Duration:', 'cat-block' ); ?>
                <input class="widefat"
                       name="<?php echo $this->get_field_name( 'duration' ); ?>"
                       type="number" step="1" min="0"
                       value="<?php echo (int)( $instance['duration'] ); ?>" />
                <small><?php _e( 'Slide duration in ms', 'cat-block' ); ?></small>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $instance['shownav'] ); ?> id="<?php echo $this->get_field_id( 'shownav' ); ?>" name="<?php echo $this->get_field_name( 'shownav' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'shownav' ); ?>">
                        <?php _e( 'Show navigation', 'cat-block' ); ?>
                </label>
            </p>
        </div><!-- #tab-4 -->
    </div><!-- .cvmh-tabs-content -->
</div><!-- .cvmh-widget-form-tabs -->