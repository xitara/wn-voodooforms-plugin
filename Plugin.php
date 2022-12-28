<?php namespace Xitara\VoodooForms;

use Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;

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

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return []; // Remove this line to activate

        return [
            'Xitara\VoodooForms\Components\MyComponent' => 'myComponent',
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
        return []; // Remove this line to activate

        return [
            'voodooforms' => [
                'label'       => 'xitara.voodooforms::lang.plugin.name',
                'url'         => Backend::url('xitara/voodooforms/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['xitara.voodooforms.*'],
                'order'       => 500,
            ],
        ];
    }
}
