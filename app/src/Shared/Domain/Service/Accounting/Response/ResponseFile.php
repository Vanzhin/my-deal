<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\Response;

use Psr\Http\Message\StreamInterface;

class ResponseFile implements \JsonSerializable
{
    public function __construct(
        private StreamInterface $file,
        private string          $file_name,
        private string          $contentType
    )
    {
    }

    /**
     * @return StreamInterface
     */
    public function getFile(): StreamInterface
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->file_name;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function jsonSerialize()
    {

    }
}