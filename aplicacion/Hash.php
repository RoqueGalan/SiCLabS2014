<?php

class Hash
{
    
    /**
     *
     * @param string $algoritmo The algorithm (md5, sha1, whirlpool, etc)
     * @param string $datos The data to encode
     * @param string $salt The salt (This should be the same throughout the system probably)
     * @return string The hashed/salted data
     */
    public static function getHash($algoritmo, $datos, $key)
    {
        
        $contexto = hash_init($algoritmo, HASH_HMAC, $key);
        hash_update($contexto, $datos);
        
        return hash_final($contexto);
        
    }
    
   
    
}