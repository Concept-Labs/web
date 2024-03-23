<?php
namespace Ctl\Web\Action\Template;

use Ctl\Web\Action\Action;
use Ctl\Web\Request\RequestInterface;
use Ctl\Web\Response\ResponseInterface;
use Ctl\Web\Template\TemplateInterface;

 class TemplateAction extends Action implements TemplateActionInterface
{
    /**
     * @var TemplateInterface|null The template instance
     */
    protected ?TemplateInterface $template = null;
 
    /**
     * {@inheritDoc}
     */
    public function __construct(RequestInterface $request, ResponseInterface $response, TemplateInterface $template)
    {
        $this->setTemplate($template);

        parent::__construct($request, $response);
    }

    /**
     * {@inheritDoc}
     */
    protected function sendResponse(?string $body = null, ?array $headers = null): void
    {
        parent::sendResponse($body ?? $this->renderTemplate(), $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function setTemplate(TemplateInterface $template): TemplateActionInterface
    {
        $this->template = $template;

        return $this;
    }

    
    /**
     * Get the template instance
     * 
     * @return TemplateInterface|null
     */
    public function getTemplate(): ?TemplateInterface
    {
        return $this->template;
    }

    
    /**
     * Get rendered template text
     * 
     * @return string
     */
    protected function renderTemplate(): string
    {
        return (string)$this->getTemplate();
    }
   
}