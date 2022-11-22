<?php

namespace App\Validator;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait ValidateRequestHeader
{
    /**
     * @param string|null $xApiKey
     * @return void
     */
    protected function hasValidRequestHeader(string|null $xApiKey): void
    {
        if(empty($xApiKey)) {
            $this->throwError('Expecting header parameter `x-api-key`.');
        }

        if($xApiKey != $this->getParameter('x_api_key')) {
            $this->throwError('Expecting valid header parameter `x-api-key` value.');
        }
    }

    /**
     * @param string $message
     * @return void
     */
    private function throwError(string $message): void
    {
        throw new BadRequestHttpException($message);
    }

}