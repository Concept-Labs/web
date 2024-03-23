<?php
namespace Ctl\Web\Template\Renderer;


interface RendererInterface
{
    /**
     * Render a file
     * 
     * @param string $filename The filename
     * @param object $scope    The scope to bind
     * 
     * @return string Thye rendered text
     */
    public function render(string $filename, object $scope): string;
}