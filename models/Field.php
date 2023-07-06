<?php

namespace Xitara\VoodooForms\Models;

use Model;

/**
 * Field Model
 */
class Field extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    use \Winter\Storm\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'xitara_voodooforms_fields';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'form_id',
        'code',
        'type',
        'description',
        'placeholder',
        'required',
        'validation_rules',
        'validation_message',
        // 'field_class',
        // 'row_class',
        // 'group_class',
        // 'label_class',
        'options',
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        // 'name' => 'required|string|min:1|max:191',
        // 'code' => 'required|string|min:1|max:80|regex:/^[a-z_-]+[a-z0-9]*$/',
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [
        'options',
        'html_attributes',
    ];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'form' => Form::class,
    ];

    /**
     * list of fields saved as NULL on empty string
     */
    // private $nullable = [
    //     'description',
    //     'placeholder',
    //     'validation_rules',
    //     'validation_message',
    //     'options',
    //     'default',
    //     'html_attributes',
    // ];

    /**
     * @var array List of fields which have an occumpanied "Override" checkbox configuration
     */
    // private $overrides = [
    //     'field_class',
    //     'row_class',
    //     'group_class',
    //     'label_class',
    // ];

    /**
     * After fetching the Field event
     * Create override_{field} Fields which represent the fields' states on whether or not
     * to inherit the setting value - used in the forms.
     *
     * @return void
     */
    // public function afterFetch()
    // {
    //     if (!empty($this->overrides)) {
    //         $options = $this->options;

    //         foreach ($this->overrides as $field) {
    //             // $override = 'override_' . $field;
    //             // $this->{$override} = ($this->{$field} !== null);


    //             // if ($options['override_' . $field]) {

    //             // }

    //         }

    //         $this->options = $options;
    //     }
    // }

    /**
     * Before the Field's Save event.
     * Dynamically set the required field if "required" is in the validation rules
     * Remove override_{field} Fields
     *
     * @return void
     */
    public function beforeSave(): void
    {
        /**
         * change hyphen to underscore in code
         */
        $this->code = str_replace('-', '_', $this->code);

        /**
         * set empty strings to null
         */
        // if (!empty($this->nullable)) {
        //     foreach ($this->nullable as $field) {
        //         if ($this->{$field} == '' || empty($this->{$field})) {
        //             $this->{$field} = null;
        //         }
        //     }
        // }

        // foreach ($this->options as $key => $option) {
        // if (!is_array($option))            \Log::debug($key . ': ' . $option);
        // }

        // if (!empty($this->overrides)) {
        //     // Convert inherited values to null
        //     foreach ($this->overrides as $field) {
        //         $override = 'override_' . $field;
        //         if (!$this->{$override}) {
        //             $this->{$field} = null;
        //         }
        //         unset($this->{$override});
        //     }
        // }

        // If validation rules are present, but the field is not required..
        if (!empty($this->validation_rules) && !$this->required) {
            // Set required to whether or not required is in the validation rules
            $this->required = (bool) in_array('required', explode('|', $this->validation_rules));
        }
    }

    /**
     * Get the field's validation rules, and add dynamic rules based on the field
     * type, required flag, etc.
     *
     * @return string
     */
    public function getCompiledRulesAttribute(): string
    {
        // Get array of validation rules
        $fieldRules = (!empty($this->validation_rules)) ? explode('|', $this->validation_rules) : [];

        // If no 'email' rule, but field is email, add it
        if (!in_array('email', $fieldRules) && $this->type === 'email') {
            $fieldRules[] = 'email';
        }

        // If no 'numeric' rule, but field is numeric, add it
        if (!in_array('numeric', $fieldRules) && $this->type === 'number') {
            $fieldRules[] = 'numeric';
        }

        // If no 'required' rule, but field is required, add it
        if (!in_array('required', $fieldRules) && $this->required) {
            $fieldRules[] = 'required';
        }

        // Return compiled list of rules
        return implode('|', $fieldRules);
    }

    /**
     * Retrieve the option rules for validation (i.e value must be in a list of keys)
     *
     * @return string
     */
    public function getOptionRulesAttribute(): string
    {
        $fieldRules = [];

        if (in_array($this->type, ['checkbox', 'radio', 'select'])) {
            $keys = $this->getOptionKeys();

            if (empty($keys)) {
                $fieldRules[] = 'accepted';
            } else {
                $fieldRules[] = 'in:' . implode(',', $this->getOptionKeys());
            }
        }

        // Return compiled list of rules
        return implode('|', $fieldRules);
    }

    /**
     * Get the 'type' field's dropdown options
     *
     * @return array
     */
    public function getTypeOptions(): array
    {
        return [
            'text' => 'xitara.voodooforms::lang.controller.options.text',
            'email' => 'xitara.voodooforms::lang.controller.options.email',
            'number' => 'xitara.voodooforms::lang.controller.options.number',
            'date' => 'xitara.voodooforms::lang.controller.options.date',
            'textarea' => 'xitara.voodooforms::lang.controller.options.textarea',
            'select' => 'xitara.voodooforms::lang.controller.options.select',
            'checkbox' => 'xitara.voodooforms::lang.controller.options.checkbox',
            'radio' => 'xitara.voodooforms::lang.controller.options.radio',
            'taglist' => 'xitara.voodooforms::lang.controller.options.taglist',
            'url' => 'xitara.voodooforms::lang.controller.options.url',
            'tel' => 'xitara.voodooforms::lang.controller.options.tel',
            'file' => 'xitara.voodooforms::lang.controller.options.file',
            'image' => 'xitara.voodooforms::lang.controller.options.image',
            'password' => 'xitara.voodooforms::lang.controller.options.password',
            'color' => 'xitara.voodooforms::lang.controller.options.color',
            'plaintext' => 'xitara.voodooforms::lang.controller.options.plaintext',
            // 'submit' => 'xitara.voodooforms::lang.controller.options.submit',
        ];
    }

    /**
     * Get the Field's unique ID
     *
     * @param Form $form
     * @return string
     */
    public function getId(Form $form): string
    {
        return 'form_' . $form->code . '_' . $this->code;
    }

    /**
     * Retrieve the list of available options (in object form, not assoc array)
     *
     * @return array
     */
    public function getOptions(): array
    {
        return (array) json_decode(json_encode($this->options));
    }

    /**
     * Retrieve the list of option keys (for validation rule `in:`)
     *
     * @return array
     */
    public function getOptionKeys(): array
    {
        $keys = [];

        $options = $this->getOptions();
        foreach ($options as $option) {
            if (!empty($option->is_optgroup)) {
                foreach ($option->options as $option2) {
                    $keys[] = $option2->option_code;
                }
            } else {
                $keys[] = $option->option_code;
            }
        }

        return $keys;
    }

    /**
     * Retrieve an option label by code
     *
     * @param string $key
     * @return string|null The option label
     */
    public function getOption(string $key): ?string
    {
        foreach ($this->options as $option) {
            if ($option['is_optgroup'] ?? false) {
                foreach ($option['options'] ?? [] as $opt) {
                    if ($opt['option_code'] === $key) {
                        return $opt['option_label'];
                    }
                }
            }

            if ($option['option_code'] === $key) {
                return $option['option_label'];
            }
        }

        return null;
    }
}
