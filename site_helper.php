<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	if ( ! function_exists( 'post' ) ) {
		/**
		 * SHORTED post with secure return
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
		 * function tambahan untuk ion_auth supaya memudahkan memanggil userID yang sudah login
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



	if ( ! function_exists( 'userdata' ) ) {
	    
	    /**
	     * get data user support ion_auth dengan custom where
	     *
	     * @return jika data 1 baris return row(), jika banyak baris return result()
	     * @author Ayatulloh Ahad R [ayatulloh@idprogrammer.com]
	     **/
	    function userdata( $where_data = null )
	    {
	        $CI =& get_instance();
	        $return = false;
	        if ( $where_data != null ):
	            foreach ($where_data as $key => $value) :

	                $CI->db->where( $key , $value);

	            endforeach;
	        else:

	            $CI->db->where('id', userid() );

	        endif;

	        // $CI->db->join('tb_users_meta', 'tb_users_meta.um_user_id = tb_users.id', 'left');
	        $get    = $CI->db->get('tb_users');
	        if ( $get->num_rows() == 1 ) {
	            
	            $return = $get->row();
	            
	        } else if ( $get->num_rows() > 1 ) {

	            $return = $get->result();

	        }
	    
	        return $return;
	    }

	}




	if ( ! function_exists( 'user_picture' ) ) {
		
		/**
		 * undocumented function
		 *
		 * @return void
		 * @author Ayatulloh Ahad r
		 **/
		function user_picture( $gender 	= 'man' )
		{
			if ( $gender == 'man' ) {
				$image 	= 'default-man';
			} else {
				$image 	= 'default-woman';
			}

			$image_path = base_url('assets/images/users/'.$image.'.png');

			return $image_path;
		}

	}



	if ( ! function_exists('currency'))
	{
		/**
		 * helper untuk membuat format mata uang
		 *
		 * @return void
		 * @author Ayatulloh Ahad r
		 **/
		function currency( $string, $count = 2, $curency = '$' )
		{
			return $curency . number_format($string, $count, ',', '.');
		}

	}



	if ( ! function_exists('option'))
	{
		/**
		 * function untuk get value dari table option agar memudahkan ambil data settings
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


	if ( ! function_exists('script_tag'))
	{	

		/**
		 * function untuk membuat <script></script>
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