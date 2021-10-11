<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

/**
 * Class CustomJSPlugin
 * @package Grav\Plugin
 */
class MatrixCMSPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onAssetsInitialized' => ['onAssetsInitialized', 0]
        ]);
    }

    public function onAssetsInitialized()
    {
        $assets_path = 'plugin://matrixCMS/matrixSimpleCMS/';
        $meta['js'] = [$assets_path.'lib/browser-matrix.min.js', $assets_path . 'matrix-cms.js'];
        $meta['css'] = [$assets_path . 'matrix-cms.css'];

        if (!empty($meta)) {
            foreach ($meta['js'] as $js) {
            $this->grav['assets']->addJs($js);
            }
            foreach ($meta['css'] as $css) {
            $this->grav['assets']->addCss($css);
            }
        }


    }
}
