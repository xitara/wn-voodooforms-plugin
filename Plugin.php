<?php

namespace Xitara\VoodooForms;

use App;
use Backend;
use BackendMenu;
use Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;

/**
 * VoodooForms Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'xitara.voodooforms::lang.plugin.name',
            'description' => 'xitara.voodooforms::lang.plugin.description',
            'author'      => 'Xitara',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {
        if (PluginManager::instance()->exists('Xitara.Nexus') === true) {
            BackendMenu::registerContextSidenavPartial(
                'Xitara.VoodooForms',
                'voodooforms',
                '$/xitara/nexus/partials/_sidebar.htm'
            );
        }
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {
        /**
         * Check if we are currently in backend module.
         */
        if (!App::runningInBackend()) {
            return;
        }

        /**
         * get sidemenu if nexus-plugin is loaded
         */
        if (PluginManager::instance()->exists('Xitara.Nexus') === true) {
            Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
                $namespace = (new \ReflectionObject($controller))->getNamespaceName();

                if ($namespace == 'Xitara\VoodooForms\Controllers') {
                    \Xitara\Nexus\Plugin::getSideMenu('Xitara.VoodooForms', 'voodooforms');
                }
            });
        }
    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return [
            'Xitara\VoodooForms\Components\FormOutput' => 'formOutput',
        ];
    }
    public function registerPageSnippets(): array
    {
        return [
            'Xitara\VoodooForms\Components\FormOutput' => 'formOutput',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return []; // Remove this line to activate

        return [
            'xitara.voodooforms.some_permission' => [
                'tab' => 'xitara.voodooforms::lang.plugin.name',
                'label' => 'xitara.voodooforms::lang.permissions.some_permission',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        $label = 'xitara.voodooforms::lang.plugin.name';

        if (PluginManager::instance()->exists('Xitara.Nexus') === true) {
            $label .= '::hidden';
        }

        return [
            'voodooforms' => [
                'label' => $label,
                'url'         => Backend::url('xitara/voodooforms/forms'),
                'icon' => 'icon-leaf',
                'permissions' => ['xitara.voodooforms.*'],
                'order' => 500,
            ],
        ];
    }

    public static function injectSideMenu()
    {
        $i = 0;
        return [
            'voodooforms.forms' => [
                'label' => 'xitara.voodooforms::lang.submenu.forms',
                'url' => Backend::url('xitara/voodooforms/forms'),
                'icon' => 'icon-archive',
                'permissions' => ['xitara.voodooforms.*'],
                'attributes' => [ // can be extendet if you need, no limitations
                    'group' => 'xitara.voodooforms::lang.submenu.label',
                ],
                'order' => \Xitara\Nexus\Plugin::getMenuOrder('xitara.voodooforms') + $i++,
            ],
            'voodooforms.submissions' => [
                'label' => 'xitara.voodooforms::lang.submenu.submissions',
                'url' => Backend::url('xitara/voodooforms/submissions'),
                'icon' => 'icon-archive',
                'permissions' => ['xitara.voodooforms.*'],
                'attributes' => [ // can be extendet if you need, no limitations
                    'group' => 'xitara.voodooforms::lang.submenu.label',
                ],
                'order' => \Xitara\Nexus\Plugin::getMenuOrder('xitara.voodooforms') + $i++,
            ],
        ];
    }

    public function registerSettings()
    {
        $category = 'xitara.voodooforms::lang.settings.label';

        if (PluginManager::instance()->exists('Xitara.Nexus') === true) {
            if (($category = \Xitara\Nexus\Models\Settings::get('menu_text')) == '') {
                $category = 'xitara.nexus::core.settings.name';
            }
        }

        return [
        'settings' => [
            'category' => $category,
            'label' => 'xitara.voodooforms::lang.submenu.label',
            'description' => 'xitara.voodooforms::lang.submenu.description',
            'icon' => 'icon-wpforms',
            'class' => 'Xitara\VoodooForms\Models\Settings',
            'order' => 20,
        ],
    ];
    }
}
