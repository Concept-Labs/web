<?php
namespace Ctl\Web\Request;

class Request implements RequestInterface
{
    protected array $server = [];
    protected array $request = [];
    protected array $get = [];
    protected array $post = [];
    protected array $files = [];

    

    public function __construct()
    {
        $this->server = $_SERVER;
        $this->request = $_REQUEST;
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        //$this->initFiles();

    }

    /**
     * @return array
     */
    public function getServer(): array
    {
        return $this->server;
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function getGet(): array
    {
        return $this->get;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Get a request parameter
     *
     * @param string $key The key
     * @return string|array|null The parameter value
     */
    public function getParam(string $key)
    {
        return $this->hasParam($key) ? $this->request[$key] : null;
    }

    /**
     * @param string $key
     * 
     * @return bool
     */
    public function hasParam(string $key): bool
    {
        return array_key_exists($key, $this->request);
    }

    /**
     * Get a file parameter
     *
     * @param string $key The key
     * @return array|null The file value
     */
    public function getFile(string $key)
    {
        if (!array_key_exists($key, $this->files)) {
            return null;
        }
        //@TODO:VG psr/http-message
        return $this->files[$key];
    }
}