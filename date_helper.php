<?php 


	if ( ! function_exists( 'time_span' ) ) {
	    
	    /**
	     * custom time span dengan > 5 hari berubah menjadi date biasa
	     *
	     * @return void
	     * @author Ayatulloh Ahad R - ayatulloh@idprogrammer.com
	     **/
	    function time_span( $post_date = null, $distance = 2 )
	    {
	        
	    	$post_date 	= ( is_numeric( $post_date ) )? date('Y-m-d H:i:s', $post_date) : $post_date;

	        $date1 = new DateTime( $post_date );
	        $date2 = new DateTime( date('Y-m-d H:i:s') );
	        $interval = $date1->diff($date2);
	        

	        if( $interval->days >= 5 ){
	            $show_date  = date('d F Y H:i', strtotime( $post_date ));
	        } else {
	            $show_date  = timespan( strtotime( $post_date ), time(), $distance ). ' ago';
	        }

	        return $show_date;

	    }

	}


	if ( ! function_exists( 'howdy' ) ) {
		
		/**
		 * undocumented function
		 *
		 * @return void
		 * @author Ayatulloh Ahad R - ayatulloh@idprogrammer.com
		 **/
		function howdy( $string = 'Guest' )
		{
			$get_hour 		= date('H');
			if ( ($get_hour >= 0) && ($get_hour < 10) ) {
				
				$output_string 		= 'Morning';

			} elseif ( ($get_hour >= 10) && ($get_hour < 21) ) {

				$output_string 		= 'Afternoon';

			} elseif ( $get_hour >= 21 ) {

				$output_string 		= 'Evening';

			}

			return ucwords('Good ' .$output_string. ', ' .$string );

		}

	}