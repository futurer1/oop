<?php

namespace lib;

/**
 * This library realized base utility static methods for multiple applications.
 *
 * @author Futurer
 */
class LibMethods
{
    /**
     * 
     * @return string Method generates a random sequence of 16 characters long.
     */
    public static function getTmpCode()
    {
        $tmp=md5(uniqid(microtime(),1));
	$key_str=substr($tmp,0,16);
	return $key_str;
    }
}