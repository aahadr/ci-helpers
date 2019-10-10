<?php 


	if ( ! function_exists( 'userlog' ) ) {
		/**
		 * undocumented function
		 *
		 * @return void
		 * @author Ayatulloh Ahad Robanie [ayatulloh@idprogrammer.com]
		 **/
		function userlog( $value = '', $userid = null )
		{

			$userid 		= ( $userid == null )? userid() : $userid;

			$CI =& get_instance();
			$CI->db->insert('tb_users_logs',[
				'log_user_id' 		=> $userid,
				'log_value' 		=> $value,
				'log_date_added' 	=> sekarang(),
			]);

			return true;

		}
	}