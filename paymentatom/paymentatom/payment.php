<?php

class payment {

	var $url = null;

	function sendInfo($data){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_PORT , 443); 
//                curl_setopt($ch, CURLOPT_SSLVERSION,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$returnData = curl_exec($ch);

                curl_close($ch);
                        return $returnData;

		/*
		$returnData = curl_exec($ch);
		var_dump($ch);
		echo "++++++++";
		var_dump($data);
		echo "-------------";
		var_dump($returnData);
		curl_close($ch);
			return $returnData;
		*/

	}
}
