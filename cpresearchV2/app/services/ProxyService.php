<?php

namespace App\Services;

class ProxyService
{
    private $proxyFile;

    public function __construct()
    {
        $this->proxyFile = storage_path('proxies/working_proxies.txt');

        // ตรวจสอบว่าโฟลเดอร์ proxy มีอยู่หรือไม่ ถ้าไม่มีให้สร้าง
        if (!is_dir(storage_path('proxies'))) {
            mkdir(storage_path('proxies'), 0777, true);
        }
    }

    public function getProxies()
    {
        // 1️⃣ ลองโหลด Proxy ที่ใช้งานได้จากไฟล์ก่อน
        $proxies = $this->loadWorkingProxies();

        // 2️⃣ ถ้าไม่มี Proxy ที่ใช้งานได้ → ดึงจากเว็บใหม่
        if (empty($proxies)) {
            $proxies = $this->fetchNewProxies();
        }

        return $proxies;
    }

    private function loadWorkingProxies()
    {
        if (!file_exists($this->proxyFile)) {
            return [];
        }

        $proxies = file($this->proxyFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // ตรวจสอบว่า Proxy ในไฟล์ยังใช้ได้อยู่หรือไม่
        $validProxies = [];
        foreach ($proxies as $proxy) {
            if ($this->isProxyWorking($proxy)) {
                $validProxies[] = $proxy;
            }
        }

        // อัปเดตไฟล์ Proxy ด้วยเฉพาะ Proxy ที่ใช้ได้
        file_put_contents($this->proxyFile, implode(PHP_EOL, $validProxies) . PHP_EOL);

        return $validProxies;
    }

    private function fetchNewProxies()
    {
        $url = "https://www.sslproxies.org/";
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $html = curl_exec($ch);
        curl_close($ch);

        preg_match_all('/<td>([\d\.]+)<\/td>\s*<td>(\d+)<\/td>/', $html, $matches, PREG_SET_ORDER);

        $proxies = [];
        foreach ($matches as $match) {
            $proxy = "{$match[1]}:{$match[2]}";

            // ตรวจสอบว่า Proxy ใช้ได้หรือไม่
            if ($this->isProxyWorking($proxy)) {
                $proxies[] = "http://{$proxy}";
            }
        }

        // บันทึก Proxy ที่ใช้ได้ลงไฟล์
        if (!empty($proxies)) {
            file_put_contents($this->proxyFile, implode(PHP_EOL, $proxies) . PHP_EOL);
        }

        return $proxies;
    }

    private function isProxyWorking($proxy)
    {
        $ch = curl_init("https://scholar.google.com");
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode == 200;
    }

    public function removeFailedProxy($proxy)
    {
        $proxies = $this->loadWorkingProxies();
        $updatedProxies = array_filter($proxies, fn($p) => $p !== $proxy);

        file_put_contents($this->proxyFile, implode(PHP_EOL, $updatedProxies) . PHP_EOL);
    }
}
