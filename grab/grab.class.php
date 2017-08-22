<?php
class Grab {
    protected static $URL = "";
    protected static $CACHEPATH = "cache/";
    protected static $CACHEFILE = "";
    protected static $CACHETIME = 10800;
    
    function grabbing($url, $cache_file = "", $is_overwrite_cache = true) 
    {
        #check cache file
        if ( $cache_file )
            static::$CACHEFILE = static::$CACHEPATH.$cache_file;
            
        if( static::isCacheExist(static::$CACHEFILE) ) 
        {
            #fetch from cache file
            $grabtext = static::fetchCacheFile(static::$CACHEFILE);
        }
        else {
            #fetch from url
            $grabtext = static::fetchURL($url, $is_overwrite_cache);
        }
        
        return $grabtext;
    }
    
    function isCacheExist( $cache_file ) 
    {
        if( file_exists($cache_file) ) 
        {
            $mtime = filemtime($cache_file);
            $age = time() - $mtime;
            
            if( static::$CACHETIME > $age and filesize($cache_file) > 0 )
                return true;
            else
                return false;
        }
        
        return false;
    }
    
    function fetchCacheFile($cache_file)
    {
        #read cache file
        $fp = fopen($cache_file, "r");
        $cresults = fread($fp, filesize($cache_file));
        fclose($fp);
        
        return $cresults;
    }
    
    function fetchURL($url, $is_overwrite_cache = true) 
    {
        #fetch url with curl
        if(function_exists('curl_init'))
        {
            $data = curl_init();
            curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($data, CURLOPT_URL, $url);
            $result = curl_exec($data);
            curl_close($data);
            
            if( $is_overwrite_cache ) 
            {
                unlink(static::$CACHEFILE);

                if( $result )
                {
                    static::createCacheFile(static::$CACHEFILE, $result);

                    return $result;            
                }
                else
                    return false;
            } 
            else {
                return $result;    
            }
        }
        else{
            return false;
        }
    }
    
    function createCacheFile($cache_file, $data)
    {
        $fp = fopen($cache_file, "w");
        fwrite ($fp, $data);
        fclose($fp);
        
        return true;
    } 
    
    function createResultFile($result_file, $data) 
    {
        $fp = fopen(static::$CACHEPATH.$result_file, "w");
        fwrite ($fp, $data);
        fclose($fp);
        
        return true;    
    }       
}
?>