<?php
namespace Ctl\Web\Request;

interface RequestInterface
{

    public function getServer(): array;
    public function getRequest(): array;
    public function getGet(): array;
    public function getPost(): array;
    public function getFiles(): array;
    /**
     * Get a request parameter
     *
     * @param string $key The key
     * @return string|null The parameter value
     */
    public function getParam(string $key);
    public function hasParam(string $key): bool;

    /**
     * Get a file parameter
     *
     * @param string $key The key
     * @return array|null The file value
     */
    public function getFile(string $key);


}