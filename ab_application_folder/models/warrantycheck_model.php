<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warrantycheck_model extends CI_Model
{
    public function index($serial_num = '', $part_num = '')
	{
        // Example 1 - Normal Check
        $hp_warranty_check = new warrantycheck_model();
        try
		{
            $checkwarranty = $hp_warranty_check->check("gb", $serial_num, $part_num) === true ? "Has Expired" : "Not Expired";
            
            return $checkwarranty;
        }
		catch(Exception $e)
		{
            
            return "notfound";
        }
    }

    private $_url = "http://h10025.www1.hp.com/ewfrf/wc/weResults";
    private $_warranty_status_string = "<span class=\"bold\">Warranty Status</span>";
    private $_expired_string = "Warranty has expired";
 
    /**
     * Internal function to get the warranty page data
     *
     * @param string $country Country code
     * @param string $serial Serial Number
     * @param string $product Product Number
     * 
     * @return string HP warranty HTML
     */

    private function _send_post_data($country,$serial,$product)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_make_post_string($country,$serial,$product));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_REFERER, "http://h10025.www1.hp.com/ewfrf/wc/weInput?cc=us&lc=en");  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }
 
    /**
     * Internal function to generate the post data required for the warranty page
     *
     * @param string $country Country code
     * @param string $serial Serial Number
     * @param string $product Product Number
     * 
     * @return string Post data in string format for cURL
     */

    private function _make_post_string($country,$serial,$product)
    {
        $post_data = array("tmp_weCountry"=>$country,"tmp_weSerial"=>$serial,"tmp_weProduct"=>$product,"tmp_weDest"=>"","tmp_track_link"=>"ot_we/submit/en_uk/entitlement/loc:0","lc"=>"en","dlc"=>"en","cc"=>"uk");
        $post_string = "";
        foreach($post_data as $key=>$value)
		{
			$post_string .= "{$key}={$value}&";
        }
        return rtrim($post_string,"&");
    }
 
    /**
     * Internal function to check the validity of a warranty
     *
     * @param string $page_data HP Website HTML
     * 
     * @return bool Return true/false depending on if warranty is valid
     */

    private function _is_expired($page_data)
    {
        // firstly check we have a valid product loaded
        if(strpos($page_data,$this->_warranty_status_string) !== false)
		{
            // check to see if we get an expired message
            return strpos($page_data,$this->_expired_string) !== false ? true : false;
        }
		else
		{
            throw new Exception("Product not found.");
        }
    }
 
    /**
     * Check to see if the product has a valid warranty or not
     *
     * @param string $country Country code
     * @param string $serial Serial Number
     * @param string $product Product Number
     * 
     * @return bool Return true/false depending on if warranty is valid
     */

    public function check($country,$serial,$product)
    {
        $page_data = $this->_send_post_data($country,$serial,$product);
        return $this->_is_expired($page_data);
    }
    
}
