<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Este helper gera os elementos do bootstrap 3 usando PHP
| ao invés de HTML puro.
|
| Foi desenvolvido para ser usado no FrameWork CodeIgniter em conjunto
| com o helper HTML e URL.
| 
| @author Eliel de Paula <elieldepaula@gmail.com>
| @since 20/10/2014
|--------------------------------------------------------------------------
*/

if ( ! function_exists('getMondaysInRange') ) {
	
	/**
	 * mencari hari setiap hari senin
	 *
	 * @return void
	 * @author Ayatulloh Ahad R - ayatulloh@idprogrammer.com
	 **/
	function getMondaysInRange($dateFromString, $dateToString)
	{
	    $dateFrom = new \DateTime($dateFromString);
	    $dateTo = new \DateTime($dateToString);
	    $dates = [];

	    if ($dateFrom > $dateTo) {
	        return $dates;
	    }

	    if (1 != $dateFrom->format('N')) {
	        $dateFrom->modify('next monday');
	    }

	    while ($dateFrom <= $dateTo) {
	        $dates[] = $dateFrom->format('Y-m-d');
	        $dateFrom->modify('+1 week');
	    }

	    return $dates;
	}

}



if ( ! function_exists( 'generateWallet' ) ) {

	/**
	* undocumented function
	*
	* @return void
	* @author
	**/
	function generateWallet()
	{

		//format: afb8032a-4b09-41ab-be96-cf4f50b9f202
		$random_1 	= strtolower(
			substr( hash('sha256', random_string( 'alnum', 64 ) ) , 0, 8 )
		);

		$random_2 	= strtolower(
			substr( hash('sha256', random_string( 'alnum', 64 ) ) , 0, 4 )
		);

		$random_3 	= strtolower(
			substr( hash('sha256', random_string( 'alnum', 64 ) ) , 0, 4 )
		);

		$random_4 	= strtolower(
			substr( hash('sha256', random_string( 'alnum', 64 ) ) , 0, 4 )
		);

		$random_5 	= strtolower(
			substr( hash('sha256', random_string( 'alnum', 64 ) ) , 0, 12 )
		);


		return $random_1 . '-' . $random_2 . '-' . $random_3 . '-' . $random_4 . '-' .$random_5;

	}

}

if ( ! function_exists( 'post' ) ) {
	/**
	 * undocumented function
	 *
	 * @return void
	  * @author Ayatulloh Ahad R [ayatulloh@idprogrammer.com]
	 **/
	function post( $key = null )
	{
	    $return     = null;
	    if( $key != null ){

	        $CI =& get_instance();
	        $return     = $CI->input->post( $key );
	    
	    }

	    return $return;
	    
	}
}

if ( ! function_exists( 'userid' ) ) {
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function userid()
	{
		$CI =& get_instance();
		return $CI->session->userdata('user_id');
	}

}


if ( ! function_exists( 'sekarang' ) ) {

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function sekarang()
	{
		return date('Y-m-d H:i:s');
	}

}


if ( ! function_exists( 'userdata' ) ) {
    
    /**
     * undocumented function
     *
     * @return object jika data cuma 1 row, dan array object jika data lebih dari 1 data dan bernilai false jika tidak menemukan user nya
     * @author Ayatulloh Ahad R [ayatulloh@idprogrammer.com]
     **/
    function userdata( $where_data = null )
    {
        $CI =& get_instance();
        $return = false;
        if ( $where_data != null ):
            
        	if( is_array( $where_data ) ){
        		foreach ($where_data as $key => $value) :
	                $CI->db->where( $key , $value);
	            endforeach;
        	}else{
        		$CI->db->where( $where_data );
        	}

        else:
            $CI->db->where('id', userid() );
        endif;

        // $CI->db->join('tb_users_wallet', 'wallet_user_id = id', 'left');
        $get    = $CI->db->get('tb_users');
        if ( $get->num_rows() == 1 ) {            
            $return = $get->row();
        } else if ( $get->num_rows() > 1 ) {
            $return = $get->result();
        }
    
        return $return;
    }

}



if ( ! function_exists( 'howdy' ) ) {
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function howdy( $string = 'Guest' )
	{
		$get_hour 		= date('H');
		if ( ($get_hour >= 0) && ($get_hour < 10) ) {
			
			$output_string 		= 'Pagi';

		} elseif ( ($get_hour >= 10) && ($get_hour < 21) ) {

			$output_string 		= 'Siang';

		} elseif ( $get_hour >= 21 ) {

			$output_string 		= 'Malang';

		}

		return ucwords('Selamat ' .$output_string. ', ' .$string );

	}

}


if ( ! function_exists( 'user_picture' ) ) {
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function user_picture( $image 	= 'no-images.jpg' )
	{

		$image_path = base_url( 'uploads/users/'.$image );
		return $image_path;
	}

}



if ( ! function_exists('currency'))
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function currency( $string, $count = 0, $currency = null )
	{
		
		$currency 		= ( $currency == null )? 'Rp.' : $currency;
		return $currency . number_format($string, $count, ',', '.');
		// return floatval($string) . ' ' . $currency;
	}

}



if ( ! function_exists('option'))
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function option($option_name ='null')
	{
		$CI 	=& get_instance();
		$get 	= $CI->db->get_where('tb_options', array('opt_name' => $option_name) );
		if ( $get->num_rows() == 1 ) {
			return $get->row()->opt_value;
		}
	}

}


if ( ! function_exists('set_option'))
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function set_option($option_name ='null', $option_value = null)
	{
		$CI 	=& get_instance();
		
		$do_set 	= $CI->db->update('tb_options', [
			'opt_value' 	=> $option_value
		], [
			'opt_name'		=> $option_name
		]);

		return $do_set;
	}

}


if ( ! function_exists('script_tag'))
{	

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad r
	 **/
	function script_tag($src = '', $type = 'text/javascript', $index_page = FALSE)
    {
        $CI =& get_instance();

        $link = '';
        if (is_array($src))
        {
            foreach ($src as $v)
            {
                $link .= script_tag($v,$type,$index_page);
            }

        }
        else
        {
            $link = '<script ';
            if ( strpos($src, '://') !== FALSE)
            {
                $link .= 'src="'.$src.'" ';
            }
            elseif ($index_page === TRUE)
            {
                $link .= 'src="'.$CI->config->site_url($src).'" ';
            }
            else
            {
                $link .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
            }

            $link .= " type='{$type}'></script>";
        }
        return $link;
    }
}


if ( ! function_exists( 'time_span' ) ) {
    
    /**
     * undocumented function
     *
     * @return void
     * @author 
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
            $show_date  = timespan( strtotime( $post_date ), time(), $distance ). ' lalu';
        }

        return $show_date;

    }

}


if ( ! function_exists( 'random_avatar' ) ) {
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad Robanie [ayatulloh@idprogrammer.com]
	 **/
	function random_avatar()
	{

		$curl 		= file_get_contents( 'https://randomuser.me/api/' );
		$result 	= json_decode( $curl );
		return $result->results[0]->picture->large;

	}
}

if ( ! function_exists( 'user_avatar' ) ) {

    function user_avatar( $filename = 'null', $attr = array() )
    {
        
        $user_path 		= 'assets/images/user/';
    	$image_default 	= $user_path . 'user-default.png';

    	if ( file_exists( $user_path . $filename ) ) {
    		$image_default 	= $user_path . $filename;
    	}

    	$attr['src'] 	= $image_default;


        return img( $attr );
    }

}



if ( ! function_exists('indo_phone_format') ) {
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function indo_phone_format( $string = '' )
	{
		$output = preg_replace( '/(0|\+?\d{2})(\d{7,8})/', '$2', $string);

		//replace jika terdapat string +62085
		$split_detect 	= explode('+620', $string);
		if ( isset( $split_detect[1] ) ) {
			$output 	= str_replace('+620', '', $string);
		}

		return '+62' . $output;
	}
}
