<?php
namespace Ctl\Web\Action;

interface ActionInterface
{
    /**
     * Entry point
     * 
     * @return void
     */
    public function exec();
}