<?php


namespace Opeepl\BackendTest\lib;


use Opeepl\BackendTest\Exceptions\ApiNotRespondingException;

class HttpClient
{
    /**
     * @param string $url
     * @return array<mixed>
     * @throws ApiNotRespondingException
     */
    public function get(string $url): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        if($response === false)
            throw new ApiNotRespondingException();

        return json_decode($response, true);;
    }
}