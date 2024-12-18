<?php

declare(strict_types=1);

namespace App\Shared\Application\DTO;

use Symfony\Component\HttpFoundation\Response;

readonly class ResponseDTOTransformer
{
    public function buildResponseData(Response $response): ResponseDTO
    {
        $result = new ResponseDTO(
            'error',
            $response->getStatusCode(),
            null,
            $this->getMessageFromContent($response->getContent())
        );
        if ($response->getStatusCode() < 400) {
            $result = new ResponseDTO(
                'success',
                $response->getStatusCode(),
                json_decode($response->getContent(), true),
                null
            );
        }
        if ($response->getStatusCode() === 422) {
            $result = new ResponseDTO(
                'error',
                $response->getStatusCode(),
                null,
                $this->getMessageFromContent($response->getContent())
            );
        }
        if ($response->getStatusCode() >= 500) {
            $result = new ResponseDTO(
                'error',
                $response->getStatusCode(),
                null,
                'Internal server error.'
            );
        }

        return $result;
    }

    private function getMessageFromContent(string $string): ?string
    {
        $data = json_decode($string, true);
        return $data['message'] ?? str_replace('"', '', $string);
    }
}
