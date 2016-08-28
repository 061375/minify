<?php
class Compress {
    
    private $devip = array('::1','192.168.1.157');
    
    private $isdev;
    
    private $filepath;
    
    private $workurl;

    function __construct($params)
    {
        $this->isdev = false;
        
        // if on a localhost or in another development environment - then compile
        // else die exporting a NO INDEX, NO FOLLOW for search engines
        if(!isset($_SERVER['REMOTE_ADDR']))die('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">');
        if(!in_array($_SERVER['REMOTE_ADDR'],$this->devip))die('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">');
        
        $this->isdev = true;
        
        
    }
    /**
     * Sends a page request using cURL
     * 
     * @param string $url
     * @param array $post
     * @param boolean $code
     * @param array $header
     *
     * @return string
     * */
    function simpleCurl($url,$post,$code = false,$header = array('Expect:'))
    {
        $postValuesString = '';
        foreach($post as $var => $val){
            if(strlen($postValuesString))$postValuesString.= "&";
                $postValuesString.= $var . "=" . urlencode($val);
        }
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
    
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POST,0);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$postValuesString);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // $output contains the output string 
        $output = curl_exec($ch);
        if($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            return "cURL error ({$errno}):\n {$error_message}";
        }
        if (true === $code) {
                return curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        // close curl resource to free up system resources 
        curl_close($ch);  
        return $output;
    }
    /**
     * Strips line breaks, white space and comments
     * 
     * @param string $in - the unminifiend input string
     * @param array $other - a list of other content to be removed (like the grunt reload script for example)
     * 
     * example array('<script src="http://localhost:35729/livereload.js"></script>');
     *
     * @return string
     * */
    function compress($in,$other = false)
    {
        $out = str_replace("\n",'',$in);
        $out = str_replace("\t",'',$out);
        $out = str_replace("\r",'',$out);
        $out = preg_replace('!\s+!', ' ', $out);
        $out = preg_replace('/<!--(.*)-->/Uis', '', $out);
        if(false !== $other) {
            foreach($other as $o) {
                $out = str_replace($o,'',$out);
            }
        }
        return $out;
    }
    /**
     * 
     * 
     * We dont want people coming across this page an compiling the homepage
     * True it (shouldn't make any difference),
     * its highly unlikely, and I don't plan on having this code on the live server....just in case
     *
     * @return void
     * */
    function export($other = false)
    {
        // run curl if it hasn't been run already
        if(!isset($_POST['chgfysfuygf54fg'])) {
            // this gets the current working filename to build the HTML based off of
            $file = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : false;
            if(false === $file)isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : false;
            // if the filename is not set then we will assume its index
            if(false === $file){
                $file = 'index.html';
            }else{
                $file = substr($file,strpos($file,'/php/')+5,strlen($file));
                $file_ = str_replace('.php','.html',$file);
            }
            $result = $this->compress(
                    simpleCurl(
                        $this->workurl.$file,
                        array('chgfysfuygf54fg'=>1)
                    )
            ,$other);
            if(false !== file_put_contents($this->filepath.$file_,$result)) {
                echo "<script>alert('error');</script>";
            }
        }   
    }
    /**
     * debug scripts vs live script
     * if minifying javascript using Grunt - during development its easier to debug unminified code
     * @param string $wpath physical path to scripts
     * @param string $wpath virtual path to scripts
     * @param string $script virtual path to scripts.js - the minified js file
     * @param array/bool $other if not false an array of paths to other script locations like jQuery or other libraries
     * */
    function script($wpath,$vpath,$script,$other = false)
    {
        // if before compress
        if(!isset($_POST['chgfysfuygf54fg'])) {
            // if directory exists
            if(true === is_dir($wpath)) {
                // loop directory
                $files = array_diff(scandir($wpath), array('..', '.'));
                foreach($files as $file) {
                    // export individual script files
                    // add ?c=[current timestamp] to force non-cached version
                    echo '<script src="'.$vpath.$file.'?c='.strtotime('now').'"></script>'."\n";
                }
            }
            if(false !== $other) {
                foreach($other as $o) {
                    // export individual script files
                    // add ?c=[current timestamp] to force non-cached version
                    echo '<script src="'.$o.'?c='.strtotime('now').'"></script>'."\n";
                }
            }
        }else{
            // add ?c=[current timestamp] to force non-cached version
            // remember that we will be making a static document so the first time the remote file is loaded it will
            // force the latest version of the script (once)
            echo '<script src="'.$script.'?c='.strtotime('now').'"></script>';
        }
    }
}
