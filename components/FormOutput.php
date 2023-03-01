<?php

namespace Xitara\VoodooForms\Components;

use Cms\Classes\ComponentBase;
use Xitara\VoodooForms\Models\Form;
use Xitara\VoodooForms\Models\Field;
use Xitara\VoodooForms\Models\Settings;

class FormOutput extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'VoodooForm Output',
            'description' => ''
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties(): array
    {
        return [
            'formCode' => [
                'title'             => 'xitara.voodooforms::lang.component.formCode.title',
                'description'       => 'xitara.voodooforms::lang.component.formCode.description',
                'type'              => 'dropdown',
                'required'          => true,
            ],
        ];
    }

    /**
     * Get Form Code Options
     *
     * @return array
     */
    public function getFormCodeOptions(): array
    {
        return Form::all()->pluck('title', 'code')->toArray();
    }

    public function onRun()
    {
        // $this->addCss('assets/css/app.css');
    }

    public function onRender(): void
    {
        $settings = Settings::instance();
        $this->page['settings'] = $settings->attributes;

        $form = Form::where('code', $this->property('formCode'))->firstOrFail();
        $this->page['form'] = $form;

        $fields = $this->sortFields($form->id);
        $this->page['fields'] = $fields;
    }

    private function sortFields(int $id)
    {
        $fields = Field::where('form_id', $id)->orderBy('sort_order', 'asc')->get();

        foreach ($fields as $i => $field) {
            if ($field->type == 'radio' && isset($field->options['radio_group'])) {
                $_fields[$field->options['radio_group']][] = $field;
            } elseif ($field->type == 'checkbox' && isset($field->options['checkbox_group'])) {
                $_fields[$field->options['checkbox_group']][] = $field;
            } else {
                $_fields[$field->sort_order] = $field;
            }
        }

        return $_fields;

        // return $fields;
    }
}
