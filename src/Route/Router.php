<?php
namespace Ctl\Web\Route;

use Ctl\App\App;
use Ctl\Web\Action\Action;
use Ctl\Web\Action\ActionInterface;
use Ctl\Web\Request\Request;
use Ctl\Web\Request\RequestInterface;

class Router implements RouterInterface
{
    
    
    protected string $namespace = '';
    protected RequestInterface $request;

    public function __construct(RequestInterface $request, string $namespace = '')
    {
        $this->request = $request;
        $this->namespace = ucfirst($namespace);
    }

    /**
     * Do route and execute an action
     *
     * @return void
     */
    public function route()
    {
        $action = $this->getAction();
        $action->exec();
    }

    /**
     * Get a request
     *
     * @return Request The request
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Get an action
     *
     * @return Action The action
     */
    public function getAction(): ActionInterface
    {
        $actionClass = $this->getActionClass(
            $this->getRequest()->getParam(self::CONTROLLER_KEY)
        );

        if (!class_exists($actionClass)) {
            throw new \RuntimeException(sprintf(_('Action class "%s" was not found'), $actionClass));
        }
        
        /**
         * @var Action $action
         */
        //$action = new $actionClass($this->getRequest());
        $action = App::getService($actionClass);

        return $action;
    }

    /**
     * Generate an action class name
     *
     * @param string $ctl The request controller string
     * 
     * @return string The Action class name
     */
    protected function getActionClass(string $ctl): string
    {
        //if (preg_match($ctl, $this->)
        $ctl = explode('/', $ctl);

        /** 
         * Inject Controller part, 
         * Replace first letters with upper case
         * Replace "-" characters with next char upper case
         * e.g. "catalog/evotech-performance/import" => "Catalog/Controller/EvotechPerformance/Import"
         */
        array_walk(
            $ctl, 
            function (&$item) {
                $itemParts = explode('-', $item);
                array_walk(
                    $itemParts,
                    function (&$part) {
                        $part = ucfirst($part);
                });
                $item = join('', $itemParts);
                $item = ucfirst($item);
        });

        $mod = array_shift($ctl);
        array_unshift($ctl, $this->getNamespace(), $mod, self::CONTROLLER_NAMESPACE);

        return join('\\', $ctl);
    }

   /**
    * Transform action classname into url path
    * @param string $class     The Name of the action class
    * @param mixed $namespace  The namespace which will be removed from the action
    * 
    * @return string
    */
    static function getActionString(string $class, $namespace): string
    {
        /**
         * !Experimantal stuff with no guaranties
         */
        $classParts = explode('\\', $class);
        $namespaceParts = explode('\\', $namespace);
        $action = array_diff($classParts, $namespaceParts);
        $mod = array_shift($action);
        array_shift($action);
        array_unshift($action, $mod);

        return join('/', $action);
    }
}