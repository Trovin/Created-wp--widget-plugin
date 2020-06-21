<?php
/*
    Plugin Name: Simple widget plugin
    Description: This plugin adds a custom widget.
    Version: 1.0
    Author: Ruslan Trovin

    Copyright 2019  Ruslan_Trovin  (email: webtrovin@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// The widget class
class My_Custom_Widget extends WP_Widget {
    // Main constructor
    public function __construct() {
        parent::__construct(
            'my_custom_widget',
            __( 'My Custom Widget', 'text_domain' ),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend )
    public function form( $instance ) {
        // Set widget defaults
        $defaults = array(
            'title'    => '',
            'person_image' => '',
            'person_name'     => '',
            'person_postition' => '',
            'person_contact_number' => '',
            'person_contact_email' => '',
            'person_contact_website' => '',
        );

        // Parse current settings with defaults
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

        <?php // Display widget variable on frontend admin part ?>
        <?php // Widget title ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php // Person image ?>
        <p>
            <label for="<?= $this->get_field_id( 'person_image' ); ?>">Image</label>
            <img class="<?= $this->id ?>_img" src="<?= (!empty($instance['person_image'])) ? $instance['person_image'] : ''; ?>" style="margin:0;padding:0;max-width:100%;display:block"/>
            <input type="text" class="widefat <?= $this->id ?>_url" name="<?= $this->get_field_name( 'person_image' ); ?>" value="<?= $instance['person_image']; ?>" style="margin-top:5px;" />
            <input type="button" id="<?= $this->id ?>" class="button button-primary clear__upload-image" value="Remove Image" style="margin-top:5px;" />
            <input type="button" id="<?= $this->id ?>" class="button button-primary upload_image_button" value="Upload Image" style="margin-top:5px;" />
        </p>

        <?php // Person name ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'person_name' ) ); ?>"><?php _e( 'Person name:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'person_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'person_name' ) ); ?>" type="text" value="<?php echo esc_attr( $person_name ); ?>" />
        </p>

        <?php // Person position ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'person_postition' ) ); ?>"><?php _e( 'Person position:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'person_postition' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'person_postition' ) ); ?>" type="text" value="<?php echo esc_attr( $person_postition ); ?>" />
        </p>

        <?php // Person person_contact_number ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'person_contact_number' ) ); ?>"><?php _e( 'Person number:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'person_contact_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'person_contact_number' ) ); ?>" type="text" value="<?php echo esc_attr( $person_contact_number ); ?>" />
        </p>

        <?php // Person person_contact_email ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'person_contact_email' ) ); ?>"><?php _e( 'Person email:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'person_contact_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'person_contact_email' ) ); ?>" type="text" value="<?php echo esc_attr( $person_contact_email ); ?>" />
        </p>

        <?php // Person person_contact_website ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'person_contact_website' ) ); ?>"><?php _e( 'Person website:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'person_contact_website' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'person_contact_website' ) ); ?>" type="text" value="<?php echo esc_attr( $person_contact_website ); ?>" />
        </p>
    <?php }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';

        $instance['person_image'] = ( ! empty( $new_instance['person_image'] ) ) ? strip_tags( $new_instance['person_image'] ) : '';
        $instance['person_name']     = isset( $new_instance['person_name'] ) ? wp_strip_all_tags( $new_instance['person_name'] ) : '';
        $instance['person_postition']     = isset( $new_instance['person_postition'] ) ? wp_strip_all_tags( $new_instance['person_postition'] ) : '';
        $instance['person_contact_number']     = isset( $new_instance['person_contact_number'] ) ? wp_strip_all_tags( $new_instance['person_contact_number'] ) : '';
        $instance['person_contact_email']     = isset( $new_instance['person_contact_email'] ) ? wp_strip_all_tags( $new_instance['person_contact_email'] ) : '';
        $instance['person_contact_website']     = isset( $new_instance['person_contact_website'] ) ? wp_strip_all_tags( $new_instance['person_contact_website'] ) : '';
        return $instance;
    }

    // Display the widget on user frontend page (callback this function)
    public function widget( $args, $instance ) {
        extract( $args );
        // Check the widget options
        $title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $person_image     = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $person_name     = isset( $instance['person_name'] ) ? $instance['person_name'] : '';
        $person_postition = isset( $instance['person_postition'] ) ?$instance['person_postition'] : '';
        $person_contact_number   = isset( $instance['person_contact_number'] ) ? $instance['person_contact_number'] : '';
        $person_contact_email   = isset( $instance['person_contact_email'] ) ? $instance['person_contact_email'] : '';
        $person_contact_website   = isset( $instance['person_contact_website'] ) ? $instance['person_contact_website'] : '';

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';

        // Display widget title if defined
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        if($person_image)
            echo '<img src="('. $person_image .') ; ?>">';

        if ( $person_name ) {
            echo '<p>' . $person_name . '</p>';
        }

        if ( $person_postition ) {
            echo '<p>' . $person_postition . '</p>';
        }

        if ( $person_contact_number ) {
            echo '<p>' . $person_contact_number . '</p>';
        }

        if ( $person_contact_email ) {
            echo '<p>' . $person_contact_email . '</p>';
        }

        if ( $person_contact_website ) {
            echo '<p>' . $person_contact_website . '</p>';
        }

        echo '</div>';
        // WordPress core after_widget hook (always include )
        echo $after_widget;
    }
}


// connect script in frontend part
//function custom_widget_frontend_script() {
//    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . '/assets/js/upload_image.js', array('jquery'), '1.0.0', false );
//}
//add_action('wp_enqueue_scripts', 'custom_widget_frontend_script');

// connect script in admin part
function custom_widget_admin_script() {
    wp_enqueue_media();
    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . '/assets/js/upload_image.js', array('jquery'), '1.0.0', false );
}
add_action('admin_enqueue_scripts', 'custom_widget_admin_script');


// Register the widget
function my_register_custom_widget() {
    register_widget( 'My_Custom_Widget' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );


