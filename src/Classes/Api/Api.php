<?php

declare(strict_types=1);

namespace Inter\Classes\Api;

class Api
{
    private const BASE_URL = 'http://api.nbp.pl/api/exchangerates/tables/';

    public function __construct(
        private ApiResponse $apiResponse,
    ) {
    }

    public function getExchangeRates(): ApiResponse
    {
        return $this->request(self::BASE_URL . 'A');
    }

    private function request(string $url): ApiResponse
    {
        try {
            $res = null;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);

            $res = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('CURL Error: ' . curl_error($ch));
            }

            $info = curl_getinfo($ch);

            if (200 !== $info['http_code']) {
                throw new \Exception('Invalid HTTP Response Code');
            }

            return $this->apiResponse->successResponse($res);
        } catch (\Throwable $th) {
            return $this->apiResponse->errorResponse($th->getMessage());
        }
    }
}
