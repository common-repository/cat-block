<?php
defined( 'ABSPATH' ) or exit;

class CVMH_CatBlock_Widget extends WP_Widget {

    //register our widget
    public static function register() {
        register_widget( __CLASS__ );
    }
    
    public function __construct() {
        $widget_ops = array(
            'classname' => 'cvmh-catblock', 
            'description' => __( 'A block which lists the posts in a category.', 'cat-block' ),
        );
        parent::__construct( 'cvmh_catblock_widget', 'Cat Block', $widget_ops );
    }

    public function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['introduction']   = strip_tags( $new_instance['introduction'] );
        $instance['category']       = $new_instance['category'];
        $instance['count']          = (int) $new_instance['count'];
        $instance['offset']         = (int) $new_instance['offset'];
        $instance['buttonall']      = isset( $new_instance['buttonall'] ) ? (bool) $new_instance['buttonall'] : false;
        $instance['alltext']        = strip_tags( $new_instance['alltext'] );
        $instance['posttype']       = strip_tags( $new_instance['posttype'] );
        $instance['showtitle']      = isset( $new_instance['showtitle'] ) ? (bool) $new_instance['showtitle'] : false;
        $instance['titletag']       = strip_tags( $new_instance['titletag'] );
        $instance['titlelength']    = (int) $new_instance['titlelength'];
        $instance['showexcerpt']    = isset( $new_instance['showexcerpt'] ) ? (bool) $new_instance['showexcerpt'] : false;
        $instance['excerptlength']  = (int) $new_instance['excerptlength'];
        $instance['showimage']      = isset( $new_instance['showimage'] ) ? (bool) $new_instance['showimage'] : false;
        $instance['imagesize']      = strip_tags( $new_instance['imagesize'] );
        $instance['showdate']       = isset( $new_instance['showdate'] ) ? (bool) $new_instance['showdate'] : false;
        $instance['dateformat']     = strip_tags( $new_instance['dateformat'] );
        $instance['showreadmore']   = isset( $new_instance['showreadmore'] ) ? (bool) $new_instance['showreadmore'] : false;
        $instance['readmoretext']   = strip_tags( $new_instance['readmoretext'] );
        $instance['slideshow']      = isset( $new_instance['slideshow'] ) ? (bool) $new_instance['slideshow'] : false;
        $instance['duration']       = (int) $new_instance['duration'];
        $instance['shownav']        = isset( $new_instance['shownav'] ) ? (bool) $new_instance['shownav'] : false;
        
        return $instance;
    }
    
    public function form( $instance ) {
        $instance  = wp_parse_args( ( array ) $instance, cvmh_catblock_default_args() );
        extract( $instance );
        include( CVMH_CATBLOCK_INC_PATH . 'form.php' );
    }

    function widget( $args, $instance ) {
        extract( $args );

        echo $before_widget;
        
        $title = apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base );
        
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
        
        echo cvmh_catblock_front_render( $instance );
        
        echo $after_widget;
    }
    
}