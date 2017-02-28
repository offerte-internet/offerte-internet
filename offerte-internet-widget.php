<?php
/*
Plugin Name: Offerte Internet Widget
Plugin URI:  https://www.offerteinternet.net
Description: Aggiunge un widget che mostra le migliori offerte internet per l'adsl e la fibra in Italia prese da OfferteInternet.net.
Version:     1.0.0
Author:      Offerte Internet
Author URI:  https://www.offerteinternet.net
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class offerte_internet_widget_class extends WP_Widget {
	public function __construct(){
		//initializes the whole thing
		parent::__construct(
		'offerte_internet_widget',
		'Offerte Internet',
		array( 'description' => __('Mostra le promozioni ADSL di OfferteInternet.net', 'offerteinternetwidget') )
		);
	}
	
	public function form( $instance ){
		//this is to enter widget options
		$title = (isset( $instance[ 'title' ] )) ? $instance[ 'title' ] : 'Offerte Internet';
		$qty = (isset( $instance[ 'qty' ] )) ? $instance[ 'qty' ] : '5';
		$optin = (isset( $instance[ 'optin' ] )) ? 'true' : 'false';
	?>
		<p>
    		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Titolo:', 'offerteinternetwidget'); ?></label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'qty' ); ?>"><?php _e('Quantità:', 'offerteinternetwidget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'qty' ); ?>" type="number" name="<?php echo $this->get_field_name( 'qty' ); ?>" value="<?php echo esc_attr( $qty ); ?>" min="1" />
		</p>
		<p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'optin' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'optin' ); ?>" name="<?php echo $this->get_field_name( 'optin' ); ?>" />
		    <label for="<?php echo $this->get_field_id( 'optin' ); ?>"><?php _e('Includi link alle recensioni delle offerte e alla home di OfferteInternet.net', 'offerteinternetwidget'); ?></label>
		</p>
	<?php
	}
	
	public function update( $new_instance, $old_instance ){
	    $qty = intval( $new_instance[ 'qty' ] ) === 0 ? 5 : intval( $new_instance[ 'qty' ] );
		//this is to process the form options
		$instance = array();
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'qty' ] = $qty;
		$instance[ 'optin' ] = $new_instance[ 'optin' ];
		return $instance;
	}
	
	public function widget( $args, $instance ){
		//this displays the widget
		extract( $args );
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$optin = $instance[ 'optin' ];
		$qty = $instance[ 'qty' ];
		echo $before_widget;
		if ( ! empty( $title) ) echo $before_title . $title . $after_title;?>
		
		<div class="offint-widget" data-optin="<?php echo $optin; ?>" data-qty="<?php echo $qty; ?>">
		    <?php if ( $optin ) { ?>
                <a href="https://www.offerteinternet.net" title="Offerte Internet e promozioni adsl. Scopri come risparmiare sull'adsl di casa">
            <?php } ?>
			
			    <h2 class="offint-widget__h2"><img src="https://www.offerteinternet.net/wp-content/themes/proreview/images/offerte-internet-logo.png" alt="Offerte Internet e promozioni adsl. Scopri come risparmiare sull'adsl di casa" class="offint-widget__logo" /><span>Offerte Internet</span></h2>
			<?php if ( $optin ) { ?>
			    </a>
			    <p>Queste sono le offerte internet al momento più allettanti sul mercato. Clicca sulle offerte per avere più informazioni o sul logo dell'operatore per vedere tutte le offerte.</p>
			<?php } ?>
			<div class="offint-widget__spinner"><span class="offint-widget__spinner__bounce1"></span><span class="bounce2"></span><span class="bounce3"></span></div>
			<ul class="offint-widget__ul"></ul>
		</div>
		
		<?php echo $after_widget;
	}
}
//register_widget( 'offerte_internet_widget_class' );
// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "offerte_internet_widget_class" );' ) );

// Enqueue appropriate styles
add_action( 'wp_enqueue_scripts', 'my_enqueued_assets' );

function my_enqueued_assets() {
    wp_register_script( 'offerte-internet-script', plugins_url( '/plugin.js', __FILE__ ) );
    wp_enqueue_script( 'offerte-internet-script' );
	wp_enqueue_style( 'offerte-internet-widget-styles', plugin_dir_url( __FILE__ ) . 'offerte-internet-widget.css' );
}