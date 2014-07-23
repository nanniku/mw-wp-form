<?php
/**
 * Name: MW Validation Rule Numeric
 * URI: http://2inc.org
 * Description: 値が数値
 * Version: 1.0.0
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created : July 21, 2014
 * Modified:
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_Validation_Rule_Numeric extends mw_validation_rule {

	/**
	 * バリデーションルール名を指定
	 */
	protected $name = 'numeric';

	/**
	 * rule
	 * @param mw_wp_form_data $Data
	 * @param string $key name属性
	 * @param array $option
	 * @return string エラーメッセージ
	 */
	public function rule( mw_wp_form_data $Data, $key, $options = array() ) {
		$value = $Data->get( $key );
		if ( !is_null( $value ) && !$this->isEmpty( $value ) ) {
			if ( !preg_match( '/^[0-9]+$/', $value ) ) {
				$defaults = array(
					'message' => __( 'Please enter with a half-width number.', MWF_Config::DOMAIN )
				);
				$options = array_merge( $defaults, $options );
				return $options['message'];
			}
		}
	}

	/**
	 * admin
	 * @param numeric $key バリデーションルールセットの識別番号
	 * @param array $value バリデーションルールセットの内容
	 */
	public function admin( $key, $value ) {
		?>
		<label><input type="checkbox" <?php checked( $value[$this->name], 1 ); ?> name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( $this->name ); ?>]" value="1" /><?php esc_html_e( 'Numeric', MWF_Config::DOMAIN ); ?></label>
		<?php
	}
}