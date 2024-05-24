<?php 

namespace App\Config;

class Config 
{
    public function get(string $key, $default = null): mixed 
    {
        [$file, $key] = explode('.', $key);
        
        $configPath = __DIR__ . '/../../config/' . $file . '.php';
        
        if (! file_exists($configPath)) {
            return $default;
        }

        $config = require $configPath;

        return $config[$key] ?? $default;
    }
}