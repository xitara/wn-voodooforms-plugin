<?php namespace Xitara\VoodooForms\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Submissions Backend Controller
 */
class Submissions extends Controller
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

        BackendMenu::setContext('Xitara.VoodooForms', 'voodooforms', 'submissions');
    }
}
