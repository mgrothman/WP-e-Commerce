<?php

class WPSC_Payment_Gateway_Manual extends WPSC_Payment_Gateway
{
	/**
	 * Constructor of Manual Payment Gateway
	 *
	 * @access public
	 * @since 3.9
	 */
	public function __construct() {
		parent::__construct();
		$this->title = __( 'Manual Payment Gateway 3.0', 'wpsc' );
	}
	
	/**
	 * Displays the setup form
	 *
	 * @access public
	 * @since 3.9
	 * @uses WPSC_Checkout_Form::get()
	 * @uses WPSC_Checkout_Form::field_drop_down_options()
	 * @uses WPSC_Checkout_Form::get_field_id_by_unique_name()
	 * @uses WPSC_Payment_Gateway_Setting::get()
	 *
	 * @return void
	 */
	public function setup_form() {
		?>
		<tr>
			<td colspan="2">
				<p>
					<label for="wpsc-manual-gateway-setup"><?php _e( 'Instructions', 'wpsc' ); ?></label><br />
					<textarea id="wpsc-manual-gateway-setup" cols='' rows='10' name='<?php echo esc_attr( $this->setting->get_field_name( 'payment_instructions' ) ); ?>'><?php echo esc_html( $this->setting->get( 'payment_instructions' ) ); ?></textarea><br />
					<small><?php _e('Enter the payment instructions that you wish to display to your customers when they make a purchase.', 'wpsc'); ?></small><br />
					<small><?php _e('For example, this is where you the Shop Owner might enter your bank account details or address so that your customer can make their manual payment.', 'wpsc'); ?></small>
				</p>
			</td>
		</tr>
		<tr class='update_gateway' >
			<td colspan='2'>
				<div class='submit'>
					<input type='submit' value='<?php _e( 'Update &raquo;', 'wpsc' ); ?>' name='updateoption' />
				</div>
			</td>
		</tr>
		<?php
		parent::setup_form();
	}
	
	public function process() {
		$this->purchase_log->set( 'processed', WPSC_PAYMENT_STATUS_RECEIVED )->save();
		$this->go_to_transaction_results();
	}
}