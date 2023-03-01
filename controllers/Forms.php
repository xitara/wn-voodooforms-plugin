<?php

namespace Xitara\VoodooForms\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Xitara\VoodooForms\Models\Field;
use Flash;

/**
 * Forms Backend Controller
 */
class Forms extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class,
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Xitara.VoodooForms', 'voodooforms', 'nexus.forms');
    }

    public function onMoveFieldUp()
    {
        $field = Field::findOrFail(post('field_id'));

        $fieldBefore = $field->form->fields()
            ->where('id', '<>', $field->id)
            ->where('sort_order', '<', $field->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if (empty($fieldBefore)) {
            return; // already first
        }

        $this->swapFieldOrder($field, $fieldBefore);

        Flash::success(trans('xitara.voodooforms::lang.models.all.sort_order.successful_up'));

        return $this->refreshFieldsRelation($field->form);
    }

    public function onMoveFieldDown()
    {
        $field = Field::findOrFail(post('field_id'));

        $fieldAfter = $field->form->fields()
            ->where('id', '<>', $field->id)
            ->where('sort_order', '>', $field->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if (empty($fieldAfter)) {
            return; // already last
        }

        $this->swapFieldOrder($field, $fieldAfter);

        Flash::success(trans('xitara.voodooforms::lang.models.all.sort_order.successful_down'));

        return $this->refreshFieldsRelation($field->form);
    }

    private function refreshFieldsRelation(\xitara\voodooForms\Models\Form $model)
    {
        $this->initForm($model);
        $this->initRelation($model, 'fields');

        return $this->relationRefresh('fields');
    }

    private function swapFieldOrder(Field $current, Field $other)
    {
        $current->setSortableOrder(
            [$current->id, $other->id],
            [$other->sort_order, $current->sort_order]
        );
    }
}
