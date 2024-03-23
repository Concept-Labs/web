<?php
namespace Ctl\Web\Response;

interface ResponseInterface
{
    const KEY_STATUS = 'status';
    const KEY_MESSAGE = 'message';
    const STATUS_OK = 'OK';
    const STATUS_ERROR = 'ERROR';
    

    public  function response(): ResponseInterface;

    public function setResponseBody(string $response): ResponseInterface;

    public function addResponseBody(string $response): ResponseInterface;

    public function getResponseBody(): string;

    public function sendResponse(): ResponseInterface;

    public function setResponseSent(bool $sent): ResponseInterface;
    
    public function isResponseSent(): bool;

    public function addHeaders(array $headers): ResponseInterface;

    public function addHeader(string $header, string $value): ResponseInterface;
    
    public function hasHeader(string $header): bool;

    
    public function getHeader(string $header);

    public function sendHeaders(): ResponseInterface;

    public function setHeadersSent(bool $sent): ResponseInterface;

    public function isHeadersSent(): bool;
}