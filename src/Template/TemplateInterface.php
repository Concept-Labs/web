<?php
namespace Ctl\Web\Template;

use Ctl\Web\Template\Renderer\RendererInterface;

interface TemplateInterface
{

    /**
     * Get a rendered text
     * 
     * @return string
     */
    public function render(): string;

    /**
     * Get a rendered text
     * @see static::render()
     * 
     * @return string
     */
    public function __toString(): string;

    /**
     * Set a template file path
     * @param string $template The path to templlate file
     * 
     * @return TemplateInterface The self instanse
     */
    public function setTemplate(string $template): TemplateInterface;

    /**
     * Set a renderer
     * 
     * @param RendererInterface $renderer
     * 
     * @return TemplateInterface
     */
    public function setRenderer(RendererInterface $renderer): TemplateInterface;
    
    /**
     * Disable text rendering
     * 
     * @return void
     */
    public function disableRender(): void;
    
    /**
     * Enable text rendering
     * 
     * @return void
     */
    public function enableRender(): void;

    /**
     * Check if text rendering is enabled
     * 
     * @return bool
     */
    public function isRenderEnabled(): bool;

    /**
     * Set a template data item value
     * 
     * @param string $key   The key of the data item
     * @param mixed  $value The value of the data item
     * 
     * @return TemplateInterface The self instancce
     */
    public function set(string $key, $value): TemplateInterface;

    /**
     * Get a template data item value
     * 
     * @param string $key The key of the data item
     * 
     * @return mixed The value of the data item
     */
    public function get(string $key);

    /**
     * Check if data has an item with the specified key
     * @param string $key The key of the data
     * 
     * @return bool true if the data has an item with the specified key
     */
    public function has(string $key): bool;

    /**
     * Set a template multiple items 
     * 
     * @param array<string,string> $data The data to set. An array of key-value pairs
     * 
     * @return TemplateInterface The self instance
     */
    public function setMultiple(array $data): TemplateInterface;

}