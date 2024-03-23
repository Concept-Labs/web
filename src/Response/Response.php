<?php
namespace Ctl\Web\Response;

class Response implements ResponseInterface
{
    

    protected array $responseBody = [];
    protected bool $responseSent = false;
    
    protected array $headers = [];
    protected bool $headersSent = false;

    public  function response(): ResponseInterface
    {
        $this->sendHeaders();
        $this->sendResponse();

        return $this;
    }

    public function setResponseBody(string $response): ResponseInterface
    {
        $this->responseBody = [$response];
        
        return $this;
    }

    public function addResponseBody(string $response): ResponseInterface
    {
        $this->responseBody[] = $response;

        return $this;
    }

    public function getResponseBody(): string
    {
        return join('', $this->responseBody);
    }

    public function sendResponse(): ResponseInterface
    {
        //if (false === $this->isResponseSent()) {

            echo $this->getResponseBody(); //@TODO: psr http message stream

            $this->setResponseSent(true);
        //}
        /**
         * Avoid sending headers after the response
         */
        $this->setHeadersSent(true);

        return $this;
    }

    public function setResponseSent(bool $sent): ResponseInterface
    {
        $this->responseSent = $sent;

        return $this;       
    }
    
    public function isResponseSent(): bool
    {
        return $this->responseSent;
    }

    public function addHeaders(array $headers): ResponseInterface
    {
        foreach ($headers as $key => $value) {
            $this->addHeader($key, $value);
        }

        return $this;
    }

    public function addHeader(string $header, string $value): ResponseInterface
    {
        $this->headers[$header] = $value;

        return $this;
    }
    
    public function hasHeader(string $header): bool
    {
        return array_key_exists($header, $this->headers);
    }

    
    public function getHeader(string $header)
    {
        $this->headers[$header];

        return $this;
    }

    public function sendHeaders(): ResponseInterface
    {
        if (false === $this->isHeadersSent()) {
            foreach ($this->headers as $key => $value) {
                header("$key: $value");
            }
        }

        return $this;
    }

    public function setHeadersSent(bool $sent): ResponseInterface
    {
        $this->headersSent = $sent;

        return $this;       
    }

    public function isHeadersSent(): bool
    {
        return $this->headersSent;
    }
}