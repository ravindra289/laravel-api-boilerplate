<?php
/**
 * Functions defined in this files are directly accessible throughout the project
 */
use Illuminate\Support\Str;

if (!function_exists('clientIp')) {
    /**
     * Return client IP address
     *
     * @return string(ip_address)
     */
    function clientIp()
    {
        $ip_address = 'UNKNOWN';
        $header_arr = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
        foreach ($header_arr as $header) {
            if (getenv($header))
                $ip_address = getenv($header);
        }
        return $ip_address;
    }
}

if (!function_exists('ipInfo')) {
    /**
     * Returns the details of the given IP address
     *
     * @param $ip
     * @return mixed
     */
    function ipInfo($ip)
    {
        $geoplugin_url = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
        $ip_details = unserialize(file_get_contents($geoplugin_url));
        return $ip_details;
    }
}

if (!function_exists('getUserBrowser')) {
    /**
     * Returns name of the user's browser
     *
     * @return mixed|string
     */
    function getUserBrowser()
    {
        $arr_browsers = ["Firefox", "Opera", "Edge", "OPR", "Chrome", "Safari", "MSIE", "Trident"];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $user_browser = 'Unknown';
        foreach ($arr_browsers as $browser) {
            if (strpos($agent, $browser) !== false) {
                $user_browser = $browser;
                break;
            }
        }

        switch ($user_browser) {
            case 'MSIE':
            case 'Trident':
                $user_browser = 'Internet Explorer';
                break;

            case 'OPR':
                $user_browser = 'Opera';
                break;
        }
        return $user_browser;
    }
}

if (!function_exists('api_dd')) {
    /*
     * Laravel dd() function along with 'Access-Control-Allow-Origin' header
     */
    function api_dd(...$args)
    {
        header('Access-Control-Allow-Origin:*');
        dd(...$args);
        die;
    }
}

if (!function_exists('generateRandomString')) {
    /*
     * Generate a random string upto provided length
     *
     * @return string
     */
    function generateRandomString($length = 32)
    {
        return Str::random($length);
    }
}

if (!function_exists('cleanFileName')) {
    /**
     * Remove special characters etc and clean the
     * provided string (fileName)
     *
     * @param $fileName
     * @return string
     */
    function cleanFileName($fileName)
    {
        // remove all special chars and keep only alphanumeric chars
        $fileName = preg_replace("/[^a-zA-Z0-9- .]/", "", trim($fileName));
        // replace multiple white spaces with single white space
        $fileName = preg_replace("/\s+/", " ", $fileName);
        // replace multiple dashes with single dash
        $fileName = preg_replace('/-+/', '-', $fileName);
        // again remove special chars from the beginning of the string in case it contains
        // special chars in the beginning after clean-up
        $fileName = preg_replace('/(^([^a-zA-Z0-9])*|([^a-zA-Z0-9])*$)/', '', $fileName);
        return $fileName;
    }
}

if (!function_exists('peakMemoryUsage')) {
    /**
     * Returns the peak of memory (in MB) allocated by PHP for respective script
     *
     * @return float
     */
    function peakMemoryUsage()
    {
        return memory_get_peak_usage(true) / 1024 / 1024;
    }
}
