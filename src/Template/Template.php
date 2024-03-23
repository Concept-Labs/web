<?php
namespace Ctl\Web\Template;

use Ctl\Web\Template\Renderer\RendererInterface;

class Template implements TemplateInterface
{

    /**
     * @var RendererInterface renderer the rtemplate renderer
     */
    protected ?RendererInterface $renderer = null;

    /**
     * @var string The path to template
     */
    protected ?string $template = null;

    /**
     * @var bool The render enabled flag
     */
    protected bool $renderEnabled = true;


    /**
     * The template data
     */
    protected array $data = [];

    /**
     * The constructor
     * 
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->setRenderer($renderer);
        $this->init();
    }

    /**
     * The init method
     * For use in child classes to initialize the instance
     * 
     * @return void
     */
    protected function init(): void
    {
    }

    /**
     * The __toString() alias
     * 
     * @return string
     */
    public function render(): string
    {
        if (null === $this->template) {
            throw new \RuntimeException('Template is not specified');
        }

        $this->beforeRender();
        
        $render = ($this->getRenderer())->render($this->template, $this);

        $this->afterRender($render);

        return $render;
    }

    /**
     * {@inheritDoc}
     */
    public function setRenderer(RendererInterface $renderer): TemplateInterface
    {
        $this->renderer = $renderer;

        return $this;
    }
    
    /**
     * Get the renderer
     * 
     * @return RendererInterface
     */
    protected function getRenderer(): RendererInterface
    {
        return $this->renderer;
    }

    /**
     * Before render handler
     * 
     * @return void
     */
    protected function beforeRender(): void
    {
    }
    /**
     * After render handler
     * 
     * @return void
     */
    protected function afterRender(&$render): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {   
        return $this->render();
    }

    /**
     * {@inheritDoc}
     */
    public function setTemplate(string $template) : TemplateInterface
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get a template file path
     * 
     * @return string The compiled template string
     */

    protected function getTemplate() : string
    {
        return $this->template;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, $value): TemplateInterface
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function setMultiple(array $data): TemplateInterface
    {
        foreach ($data as $key=>$value) {
            $this->set($key, $value);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function disableRender(): void
    {
        $this->renderEnabled = false;
    }

    /**
     * {@inheritDoc}
     */
    public function enableRender(): void
    {
        $this->renderEnabled = true;
    }

    /**
     * {@inheritDoc}
     */
    public function isRenderEnabled(): bool
    {
        return $this->renderEnabled;
    }
}