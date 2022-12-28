<?php namespace Xitara\VoodooForms\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Fields Backend Controller
 */
class Fields extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Xitara.VoodooForms', 'voodooforms', 'fields');
    }
}
