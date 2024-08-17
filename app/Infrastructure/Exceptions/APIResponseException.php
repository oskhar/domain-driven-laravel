<?php

namespace App\Infrastructure\Exceptions;

use App\Infrastructure\API\Enums\APIStatusEnum;

class APIResponseException extends \Exception
{
    protected array $data;
    protected APIStatusEnum $status;

    public function __construct(array $data, APIStatusEnum $status = APIStatusEnum::BAD_REQUEST)
    {
        $this->data = $data;
        $this->status = $status;
        parent::__construct('', 0, null);
    }

    public function getAllMessage()
    {
        return $this->data;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
