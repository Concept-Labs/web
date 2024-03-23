<?php
namespace Ctl\Web\Action;

use Ctl\EventDispatcher\EventDispatcherAwareTrait;
use Ctl\Web\Route\Router;
use Ctl\Web\Request\RequestInterface;
use Ctl\Web\Response\ResponseInterface;

/*
* The Action class
*/
class Action implements ActionInterface
{
    use EventDispatcherAwareTrait;
    
    /**
     * @var RequestInterface|null The Request instance
     */
    protected ?RequestInterface $request = null;
    /**
     * @var ResponseInterface|null The Response instance
     */
    protected ?ResponseInterface $response = null;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->init();
    }

    /**
     * Out of constructor initialization for children instances
     * 
     * @return void
     */
    protected function init(): void
    {
    }

    /**
     * Entry point for the router
     * 
     * @return void
     */
    public function exec(): void
    {
        /**
         * Give the ability to handle action for children instances
         */
        $handlerResult = $this->handle();

        /**
         * Send the response
         */
        $this->sendResponse($handlerResult);
    }
    
    /**
     * The actual action logic
     * 
     * @return string|null
     */
    protected function handle(): ?string
    {
        /**
         * Placeholder for the actual action logic
         */
        return null;
    }

    /**
     * Send the response
     * 
     * @param string|null $body   The optional body
     * @param array|null $headers The optional headers
     * 
     * @return void
     */
    protected function sendResponse(?string $body = null, ?array $headers = null): void
    {
        $this->getResponse()
            ->addHeaders($headers ?? [])
            ->addResponseBody($body ?? '')
            ->response();
    }

    /**
     * Get the request instance
     * 
     * @return RequestInterface
     */
    protected function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Get the response instance
     * 
     * @return ResponseInterface| null
     */
    protected function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * Experimental: do not use for long term support
     * 
     * @return string
     */
    static public function getActionString(): string
    {
        $namespace = 'Nltuning'; //@TODO 
        return Router::getActionString(static::class, $namespace);
    }
}