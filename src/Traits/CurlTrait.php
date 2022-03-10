<?php
namespace Traits\CurlTrait;

trait CurlTrait
{
    public function post(array $data)
    {
        $url = "http://xeamerp.local/api/biometric-import";

        $serverKey = '2902621AH32';
        
        $json = json_encode($data);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: ' . $serverKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        if ($response === FALSE) {
            die('CURL Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        
        return $response;
    }
}