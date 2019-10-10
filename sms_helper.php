<?php 


if ( ! function_exists('kirim_sms') ) {
	
	/**
	
	Note!
	Beberapa operator memblokir kata-kata tertentu diantaranya adalah http://, https://, www. , kode verifikasi, code verification, otp, akun, dana, dan jika terdapat Nomor Handphone sms tidak sampai ke nomor tujuan 

	Info OTP!
	Telkomsel, Indosat dan Three memblokir konten SMS OTP, SMS Auth, SMS Verfication
	Telkomsel juga memblokir kalimat yang sama dikirimkan ratusan kali, sehingga pada SMS OTP tidak boleh menambahkan kata lain

	Maka dari itu pengiriman SMS OTP diharuskan menggunakan API OTP.
	dengan menggunakan API OTP. maka sistem kami akan merandom kata tambahan pada kode OTP yg dikirimkan.
	misal menjadi :
	a: 27856
	x: 8372323
	2*4*5*7*3*7
	6=5=8=3=0=4
	OTP: dua tiga enam tujuh tujuh

	Jika menginginkan SMS OTP tanpa batasan konten, silahkan gunakan layanan masking.


	status Deskiripsi 
	0 	= Success SMS telah berhasil disubmit ke server. 1 Nomor tujuan tidak valid. 
	5 	= Userkey / Passkey salah. 
	6 	= Konten SMS rejected. 
	89 	= Pengiriman SMS berulang-ulang ke satu nomor dalam satu waktu. 
	99 	= Credit tidak mencukupi. 
	
	Perintah: 
	https://reguler.zenziva.net/apps/smsapi.php?userkey=xxx&passke y=xxx&nohp=xxx&pesan=xxx

	Cek Credit 
	Perintah: 
	https://reguler.zenziva.net/apps/smsapibalance.php?userkey=xxx &passkey=xxx 

	
	 *
	 * @return void
	 * @author Ayatulloh Ahad R - ayatulloh@idprogrammer.com
	 **/
	
	function kirim_sms($nohp, $isi_pesan, $return = true )
	{
		$CI =& get_instance();

		if ( ! option('sms_server') ) {
			return false;
		}

		$userkey 			= 'bzkre1';
		$passkey 			= 'c3lc0mt3k';

		$message 			= urlencode($isi_pesan);

		$elementapi			= '/apps/smsapi.php';
		$parameterapi 		= $elementapi.'?userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$nohp.'&pesan='.$message;

		$smsgatewayurl 		= 'https://reguler.zenziva.net/';
		$url 				= $smsgatewayurl . $parameterapi;

		$ch=curl_init();
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output=curl_exec($ch);
		if (!$output) {

			$output=file_get_contents($url);

		}

		if ( $return ) {

			$XMLdata 	= new SimpleXMLElement($output); 
			$result 	= $XMLdata->message;

			/*----------  logs ke table sms logs  ----------*/
			$CI->db->insert('tb_logs_sms', [
				'l_sms_code'  	=> $result->status,
				'l_sms_message' => $result->text,
				'l_sms_date'  	=> sekarang(),
			]);


			/*----------  kirim webmaster email jika saldo habis  ----------*/
			if( $result->status == 99 ){
				$CI->emailmodel->send( WEBMASTER_EMAIL, 'Saldo SMS Gatewai Telah Habis', 'Pemberitahuan untuk Admin Saldo SMS Gateway udah mau habis' );
			}
			
			
			return $result;

		} else {

			return true;

		}
	}

}