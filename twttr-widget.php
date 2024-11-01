<?php

/*
Plugin Name: Twttr Widget
Plugin URI: https://github.com/bjornjohansen/twttr-widget
Description: Twitter Widget for Embedded Timelines. Create one at https://twitter.com/settings/widgets first
Version: 0.1
Author: Bjørn Johansen
Author URI: https://bjornjohansen.no/
Text Domain: bj_twttr_widget
License: GPL2

    Copyright 2013 Bjørn Johansen  (email : post@bjornjohansen.no)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

function bj_twttr_widget_init() {
	register_widget( 'BJ_Twttr_Widget' );
}
add_action( 'widgets_init', 'bj_twttr_widget_init' );


class BJ_Twttr_Widget extends WP_Widget {

	function __construct() {

		parent::__construct(
			'bj_twttr_widget', 
			__('Twitter Widget', 'bj_twttr_widget'), 
			array( 'description' => __( 'Twitter Widget for Embedded Timelines. Create one at https://twitter.com/settings/widgets first', 'bj_twttr_widget' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );


		if ( isset( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}
		

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( ! isset( $instance['twitter_username'] ) || ! isset( $instance['twitter_widget_id'] ) ||  ! strlen( $instance['twitter_username'] ) || ! strlen( $instance['twitter_widget_id'] )  ) {
			echo sprintf( '<p>%s</p>', __( 'Please configure your Twitter username and Twitter Widget ID', 'bj_twttr_widget' ) );
		} else {
			echo sprintf( '<a class="twitter-timeline" href="%s" data-widget-id="%s">%s</a>', esc_url( 'https://twitter.com/' . $instance['twitter_username'] ), esc_attr( $instance['twitter_widget_id'] ), sprintf( __( 'Tweets from @%s', 'bj_twttr_widget' ), $instance['twitter_username'] ) );
			wp_enqueue_script( 'bj_twttr_widget', plugins_url( '/js/bj_twttr_widget.js' , __FILE__ ), array( 'jquery' ), filemtime( dirname( __FILE__ ) . '/js/bj_twttr_widget.js' ), true );
		}

		if ( isset( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
		
	}

	public function form( $instance ) {

		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Twitter Feed', 'bj_twttr_widget' );
		$twitter_username = isset( $instance[ 'twitter_username' ] ) ? $instance[ 'twitter_username' ] : '';
		$twitter_widget_id = isset( $instance[ 'twitter_widget_id' ] ) ? $instance[ 'twitter_widget_id' ] : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e( 'Twitter username:', 'bj_twttr_widget' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" type="text" value="<?php echo esc_attr( $twitter_username ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_widget_id' ); ?>"><?php _e( 'Twitter Widget ID:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_widget_id' ); ?>" name="<?php echo $this->get_field_name( 'twitter_widget_id' ); ?>" type="text" value="<?php echo esc_attr( $twitter_widget_id ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['twitter_username'] = ( ! empty( $new_instance['twitter_username'] ) ) ? strip_tags( $new_instance['twitter_username'] ) : '';
		if ( '@' == substr( $instance['twitter_username'], 0, 1 ) ) {
			$instance['twitter_username'] = substr( $instance['twitter_username'], 1 );
		}
		$instance['twitter_widget_id'] = ( ! empty( $new_instance['twitter_widget_id'] ) ) ? strip_tags( $new_instance['twitter_widget_id'] ) : '';
		return $instance;
	}

}
