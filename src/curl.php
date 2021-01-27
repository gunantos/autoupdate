<?php
class curl {

    protected static $url;
    protected static $headers;
    protected static $query;
    protected static $responses;

    /**
     * @param $url
     * @param $headers
     * @param $query
     */
    public static function prepare($url, $query, $headers = array()) {
        self::$url = $url;
        self::$headers = $headers;
        self::$query = http_build_query($query);
    }

    /**
     * Create curl
     * @param methode GET, POST, PUT, PATH, DELETE
     */
    private static function _curl($methode, $encode = true) {
        $curl = curl_init();
        if ($methode == 'get') {
            $full_url = self::$url.'?'.self::$query;
            curl_setopt($curl, CURLOPT_URL,$full_url);
        }else{
            curl_setopt($curl, CURLOPT_URL,self::$url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, self::$query);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$headers);
        self::$responses = curl_exec($curl);
        curl_close($curl);
        return ($encode ? json_decode(self::$responses, true) : self::$responses); 
    }

    /**
     *  Execute post method curl request
     * @param encode default true
     */
    public static function post($encode = true) {
        return self::_curl('post', $encode);   
    }

     /**
     *  Execute get method curl request
     * @param encode default true
     */
    public static function get($encode = true) {
         return self::_curl('get', $encode);   
    }

     /**
     *  Execute put method curl request
     * @param encode default true
     */
    public static function put($encode = true) {
         return self::_curl('put', $encode);   
    }

     /**
     *  Execute patch method curl request
     * @param encode default true
     */
    public static function patch($encode = true) {
         return self::_curl('patch', $encode);    
    }

    /**
     *  Execute delete method curl request
     * @param encode default true
     */
    public static function delete($encode = true) {
         return self::_curl('delete', $encode);   
    }
}
?>