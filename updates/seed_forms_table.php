<?php

namespace Xitara\VoodooForms\Updates;

use Winter\Storm\Database\Updates\Seeder;
use Xitara\VoodooForms\Models\Form;
use Xitara\VoodooForms\Models\Field;

class SeedFormTable extends Seeder
{
    public function run()
    {
        $form = Form::create([
            'title' => 'Contact Form',
            'code' => 'contact_form',
            'description' => 'FooBar',
            'auto_reply' => true
        ]);

        $name = Field::create([
            'form_id' => $form->id,
            'name' => 'Name',
            'type' => 'text',
            'code' => 'name',
            'description' => 'Full Name',
            'sort_order' => 1
        ]);

        $email = Field::create([
            'form_id' => $form->id,
            'name' => 'Email',
            'type' => 'email',
            'code' => 'email',
            'description' => 'Email Address',
            'sort_order' => 2
        ]);

        $comment = Field::create([
            'form_id' => $form->id,
            'name' => 'Comment',
            'type' => 'textarea',
            'code' => 'comment',
            'description' => 'User\'s Comments',
            'sort_order' => 3
        ]);

        $form->auto_reply_email_field_id = $email->id;
        $form->auto_reply_name_field_id = $name->id;
        $form->save();
    }
}
