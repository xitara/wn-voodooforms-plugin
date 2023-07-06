<?php

namespace Xitara\VoodooForms\Components;

use Cms\Classes\ComponentBase;
use Xitara\VoodooForms\Models\Form;
use Xitara\VoodooForms\Models\Field;
use Xitara\VoodooForms\Models\Settings;
use Request;
use Response;
use Illuminate\Http\JsonResponse;
use Input;

class FormOutput extends ComponentBase
{
    /**
     * @var Form The form to render
     */
    protected $form;

    /**
     * @var array<string,Field> List of Fields (values) accessible by Field codes (keys)
     */
    protected $fields = [];

    /**
     * @var Submission The current form submission entity
     */
    private $submission;

    /**
     * Gets the details for the component
     */
    public function componentDetails(): array
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
            'formId' => [
                'title'             => 'xitara.voodooforms::lang.component.formcode.title',
                'description'       => 'xitara.voodooforms::lang.component.formcode.description',
                'type'              => 'dropdown',
                'required'          => true,
            ],
        ];
    }

    public function onRun(): void
    {
        $this->addCss('assets/css/app.css');
        $this->addJs('assets/js/app.js');
    }

    public function onRender(): void
    {
        $settings = Settings::instance();
        $this->page['settings'] = $settings->attributes;

        $form = Form::find($this->property('formId'));
        $this->page['form'] = $form;

        $fields = $this->sortFields($form->id);
        $this->page['fields'] = $fields;
    }

    /**
     * Get Form Code Options
     *
     * @return array
     */
    public function getFormIdOptions(): array
    {
        return Form::orderBy('title', 'asc')->lists('title', 'id');
    }

    /**
     * Sort fields, group radios and checkboxes
     *
     * @autor   mburghammer
     * @date    2023-03-31T16:57:49+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @param   int         $id Form-id
     * @return  array          Sorted fields
     */
    private function sortFields(int $id): array
    {
        $fields = Field::where('form_id', $id)->orderBy('sort_order', 'asc')->get();
        $fieldList = [];

        foreach ($fields as $i => $field) {
            if ($field->type == 'radio' && isset($field->options['radio_group'])) {
                $fieldList[$field->options['radio_group']][] = $field;
            } elseif ($field->type == 'checkbox' && isset($field->options['checkbox_group'])) {
                $fieldList[$field->options['checkbox_group']][] = $field;
            } else {
                $fieldList[$field->sort_order] = $field;
            }
        }

        return $fieldList;
    }

    /**
     * Autoload the form using the form code with fields
     *
     * @autor   mburghammer
     * @date    2023-03-31T17:12:37+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @return  Form      Form model with given id
     */
    public function loadForm(): Form
    {
        return $this->form = Form::with([
            'fields' => function ($query) {
                return $query->orderBy('sort_order', 'asc');
            }
        ])->find($this->property('formId'));
    }

    /**
     * On Submit Ajax-handler
     *
     * @autor   mburghammer
     * @date    2023-03-31T16:52:02+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @return  JsonResponse      success or error
     */
    public function onSubmit(): JsonResponse
    {
        /**
         * Create new submission
         */
        if ($this->form->savesData()) {
            $this->submission = new Submission();
        }

        /**
         * Load form with fields
         */
        $this->loadForm();

        \Log::debug(Request::ip());
        // \Log::debug($this->property('formId'));
        \Log::debug($this->form->id);
        \Log::debug('/' . trim(Request::path(), '/'));

        /**
         * Get all form fields, rules and messages
         */
        list($fields, $rules, $messages) = $this->getFormValidation();

        /**
         * Get fields data from fields array
         */
        $data = $this->getInputFields($fields);

        /**
         * If no data was supplied, return
         */
        if (empty($data)) {
            return Response::json([
                'success' => false,
                'error' => Lang::get('abwebdevelopers.forms::lang.customForm.validation.noData')
            ], 400);
        }

        /**
         * Validate form-fields
         */
        $success = $this->validateFields($data, $rules, $messages);

        if ($success === false) {
            $errors = [];

            /**
             * Put multiple errors in one string per field
             */
            foreach ($validator->messages()->toArray() as $fieldName => $fieldErrors) {
                $errors[$fieldName] = implode(" \n", $fieldErrors);
            }

            /**
             * Send error messages
             */
            return Response::json([
                'success' => false,
                'errors' => $errors
            ], 400);
        }

        /**
         * Check recaptcha if is enabled
         */
        if ($this->form->recaptchaEnabled()) {
            $success = $this->checkReCaptcha();

            if ($success === false) {
                // TODO: Fails
                return Response::json([
                    'success' => false,
                    'errors' => [
                        'g-recaptcha-response' => 'Invalid ReCAPTCHA response'
                    ]
                ], 400);
            }
        }

        /**
         * Check for file fields and upload files
         */
        $this->uploadedFiles = $this->uploadFiles($data);

        /**
         * @todo Send mail(s) if possible
         */

        /**
         * Save model
         */
        if ($this->form->savesData()) {
            $this->saveSubmission($data);
        }

        /**
         * Return success message
         */
        $response = Response::json([
            'success' => true,
            'action' => $this->form->onSuccess(),
            'url' => $this->form->onSuccessRedirect(),
            'message' => $this->form->onSuccessMessage()
        ]);

        return $response;
    }

    /**
     * Retrieve all input fields
     *
     * @param array $fields
     * @return array
     */
    public function getInputFields(array $fields = null): array
    {
        $data = Input::only($fields);

        /**
         * Ensure checkboxes, radios and selects are dealt with as arrays
         * even if only accepting one value
         */
        foreach ($data as $code => $value) {
            if (!empty($this->fields[$code])) {
                $field = $this->fields[$code];
                if (in_array($field->type, ['checkbox', 'radio', 'select'])) {
                    $data[$code] = (array) $value;
                }
            }
        }

        return $data;
    }

    /**
     * Get all form fields, their rules, and their validation messages
     *
     * @return array
     */
    public function getFormValidation(): array
    {
        $fields = [];
        $rules = [];
        $messages = [];

        // Get a list of all fields, any validation rules and messages
        foreach ($this->form->fields as $field) {
            $fields[] = $field->code;

            // Create an easy-to-access array of fields
            $this->fields[$field->code] = $field;

            $fieldRules = $field->compiled_rules;
            if (!empty($fieldRules)) {
                $rules[$field->code] = $fieldRules;

                if (!empty($field->validation_messages)) {
                    $messages[$field->code] = $field->validation_messages;
                } else {
                    $messages[$field->code] = $field->name . ' is invalid';
                }
            }

            if (in_array($field->type, ['checkbox', 'radio', 'select'])) {
                $rules[$field->code . '.*'] = $field->option_rules;
            }
        }

        return [$fields, $rules, $messages];
    }

    /**
     * Get file fields
     *
     * @autor   mburghammer
     * @date    2023-04-02T13:24:14+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @return  array      Keys from file fields as array
     */
    private function getFileFields(): array
    {
        $files = [];
        if ($this->form->hasFileField()) {
            \Log::debug('file fields');
            foreach ($this->form->fields as $field) {
                if ($field->type === 'file' || $field->type === 'image') {
                    $files[] = $field->code;
                }
            }
        }

        \Log::debug($files);

        return $files;
    }

    /**
     * Validate fields
     *
     * @autor   mburghammer
     * @date    2023-04-02T13:29:00+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @param   array      $data     Submitted field datas
     * @param   array      $rules    Validation rules per field
     * @param   array      $messages Validation messages per field
     * @return  bool                true if all validations passes
     */
    private function validateFields($data, $rules, $messages): bool
    {
        $validator = Validator::make($data, $rules, $messages);

        if (!$validator->passes()) {
            /**
             * Put errors into one string
             */
            $errors = [];
            foreach ($validator->messages()->toArray() as $fieldName => $fieldErrors) {
                $errors[$fieldName] = implode(" \n", $fieldErrors);
            }

            return false;
        }

        return true;
    }

    /**
     * Check recapchta if is enabled
     *
     * @autor   mburghammer
     * @date    2023-04-02T13:41:30+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @return  bool      true or false
     */
    private function checkReCaptcha(): bool
    {
        if (!$this->passesRecaptcha($data['g-recaptcha-response'])) {
            return false;
        }

        return true;
    }

    /**
     * Upload all files
     *
     * @autor   mburghammer
     * @date    2023-04-02T13:50:42+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @param   array      $data  Array with field datas
     * @return  array             All uploaded files
     */
    private function uploadFiles($data): array
    {
        /**
         * Get fields with file-uploads
         *
         * @var array
         */
        $files = $this->getFileFields();

        $uploadedFiles = [];
        if (!empty($files)) {
            foreach ($files as $key) {
                if (!empty($data[$key])) {
                    $uploadedFiles[$key] = (new File())->fromPost($data[$key]);

                    // if ($this->form->savesData()) {
                    // $this->submission->attachment()->add($uploadedFiles[$key]);
                    // }
                }
            }
        }
        unset($files);

        /**
         * Write filedata into model
         */
        // if ($this->form->savesData()) {
        // $this->submission->attachments = $uploadedFiles;
        // }

        return $uploadedFiles;
    }

    /**
     * Store the submission in the database with the form field values
     *
     * @autor   mburghammer
     * @date    2023-04-02T13:50:42+02:00
     * @version 1.0.0
     * @since   1.0.0
     * @param array $data
     * @return Submission
     */
    private function saveSubmission($data)
    {
        /**
         * Save URL, datas and form_id to model
         *
         * @var string
         */
        $this->submission->url = '/' . trim(Request::path(), '/');
        $this->submission->data = $data;
        $this->submission->form_id = $this->form->id;

        /**
         * Bind files to model
         */
        foreach ($this->uploadedFiles as $file) {
            $this->submission->attachment()->add($file);
        }

        /**
         * Write filenames into model-data
         */
        $this->submission->attachments = $this->uploadedFiles;

        /**
         * Store IP from user if set in configs
         */
        if (Settings::get('store_ips', true)) {
            $this->submission->ip = Request::ip();
        }

        /**
         * Save model
         */
        $this->submission->save();
    }
}
