<?php

declare(strict_types=1);

namespace Inter\Classes\Api;

use Exception;

class ApiResponse
{
    private bool $success = false;
    private string $message = '';
    private array $data = [];

    public function setDataFromResponse(string $result)
    {
        $decode = json_decode($result, true);
        if (empty($decode)) {
            throw new Exception(json_last_error_msg());
        }

        if (! isset($decode[0]['rates'])) {
            throw new Exception('Unknown response format');
        }

        $this->data = $decode[0]['rates'];
    }

    public function successResponse(string $response)
    {
        $this->setSuccess(true);
        $this->setDataFromResponse($response);

        return $this;
    }

    public function errorResponse(string $message)
    {
        $this->setSuccess(false);
        $this->setMessage($message);

        return $this;
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message = ''): self
    {
        $this->message = $message;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
