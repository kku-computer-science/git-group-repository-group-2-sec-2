<?php

namespace App\Services;

class ProxyService
{
    public function getProxies()
    {
        $url = "https://www.sslproxies.org/";
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $html = curl_exec($ch);
        curl_close($ch);

        // ดึงเฉพาะตาราง Proxy
        preg_match_all('/<td>([\d\.]+)<\/td>\s*<td>(\d+)<\/td>/', $html, $matches, PREG_SET_ORDER);

        $proxies = [];
        foreach ($matches as $match) {
            $proxy = "{$match[1]}:{$match[2]}";
            $proxies[] = "http://{$proxy}"; // ใช้ HTTP Proxy
        }

        return $proxies;
    }
}
