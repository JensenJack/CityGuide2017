<?php  

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class HotelEncryption extends Model{


	public static function encode($value){ 
        
        if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256,config('app.key'), $text, MCRYPT_MODE_ECB, $iv);
        return trim(HotelEncryption::safe_b64encode($crypttext)); 
    }
    public static function decode($value){
        
        if(!$value){return false;}
        $crypttext = HotelEncryption::safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, config('app.key'), $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

    protected static function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
    protected static function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

     public static function mab_mac_hash($sOID,$Amount,$message)
    {   
        $sMID = config('payment.mab.MID');
        $ShareKey = config('payment.mab.ShareKey');
        $Amount = intval($Amount);

        $cbtext = $sMID.$sOID.$Amount.$ShareKey;

        $key = HotelEncryption::this_xor($cbtext);
        $encrypt = HotelEncryption::encrypt($message,$key);
        $encrypt = HotelEncryption::SafeEncrypt($encrypt);
        $mac = HotelEncryption::this_xor($encrypt);
        return $mac;
    }

      public static function this_xor($str,$len = 16)
    {
        $str = HotelEncryption::addpadding($str);
        $result = substr($str,0,$len);
       
        for ($i =  $len; $i < strlen($str); $i = $i + $len)
        {
            $xor = substr($str,$i,$len);
            $result = $result ^ $xor;
            
        }
        return HotelEncryption::SafeEncrypt(substr(base64_encode($result),0,$len));
    }
      public static function addpadding($string, $blocksize = 16)
    {
        $len = strlen($string); 
        $pad = $blocksize - ($len % $blocksize); 
        $string .= str_repeat('F', $pad); 
        return $string; 
    }
     public static function encrypt($string,$key)
    {
        $iv = "0000000000000000";   
        return HotelEncryption::SafeEncrypt(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, HotelEncryption::pkcs7pad($string,16), MCRYPT_MODE_ECB, $iv)));
    }
     public static function SafeEncrypt($en)
    {           
        $en = str_replace('+', '_',$en);
        $en = str_replace ('/', '-',$en);
        $en = str_replace ('=', '$',$en);
        return $en;
    }
      public static function pkcs7pad($plaintext, $blocksize)
    {
        $padsize = $blocksize - (strlen($plaintext) % $blocksize);
        return $plaintext . str_repeat(chr($padsize), $padsize);
    }
}

?>