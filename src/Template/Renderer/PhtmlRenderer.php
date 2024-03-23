<?php
namespace Ctl\Web\Template\Renderer;

class PhtmlRenderer implements RendererInterface
{
    /**
     * {@inheritDoc}
     */
    public function render(string $filename, object $scope): string
    {
        try {
            /**
             * Wrap and bind to the scope
             * Exec immidiatelly
             */
            $text = (\Closure::bind(
                    function($filename) {
                        /**
                         * Simple observe output
                         */
                        ob_start();
                        
                        /**
                         * Simple include
                         */
                        include $filename;

                        return ob_get_clean();
                    },
                    $scope
                ))($filename);

        } catch (\Throwable $e) {
            return $e->getMessage()."\n".$e->getTraceAsString();
        }

        return $text;
    }
    
}