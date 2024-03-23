<?php
namespace Ctl\Web\Action\Template;

use Ctl\Web\Action\ActionInterface;
use Ctl\Web\Template\TemplateInterface;

interface TemplateActionInterface extends ActionInterface
{
    /**
     * Set a template instance
     * 
     * @param TemplateInterface $template
     * 
     * @return ActionInterface
     */
    public function setTemplate(TemplateInterface $template): TemplateActionInterface;

    /**
     * Get the template instance
     * 
     * @return TemplateInterface
     */
    public function getTemplate(): ?TemplateInterface;
}