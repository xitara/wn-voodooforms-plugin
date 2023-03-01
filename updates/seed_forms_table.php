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
            'subtitle' => 'Subtitle for Contact Form',
            'description' => 'Dolphin corporation geodesic computer stimulate dissident sign urban rebar hotdog nodality. Long-chain hydrocarbons man hacker dissident geodesic hotdog cardboard RAF range-rover assault shrine augmented reality monofilament beef noodles sunglasses systema. Receding disposable wristwatch garage smart-shanty town artisanal.-ware long-chain hydrocarbons digital numinous woman urban order-flow 3D-printed towards. Wristwatch assault courier augmented reality plastic stimulate DIY numinous. Digital boy market lights vehicle beef noodles nodal point claymore mine dolphin grenade nodality gang tattoo cyber-bomb engine tiger-team. City shrine footage face forwards knife media digital Tokyo vehicle table pistol systema. Physical rain nano-order-flow free-market girl concrete. ',
            'code' => 'contact_form',
            'options' => [
                'auto_reply' => true
            ],
        ]);

        $name = Field::create([
            'form_id' => $form->id,
            'name' => 'Name',
            'type' => 'text',
            'code' => 'name',
            'description' => 'Full Name',
            'sort_order' => 1,
            'options' => [
                'is_show_description' => 0,
                'override_field_class' => 0,
                'override_row_class' => 0,
                'override_group_class' => 0,
                'override_label_class' => 0,
                'show_in_email_autoreply' => 0,
                'show_in_email_notification' => 0,
                'field_options' => []
            ],
        ]);

        $email = Field::create([
            'form_id' => $form->id,
            'name' => 'Email',
            'type' => 'email',
            'code' => 'email',
            'description' => 'Email Address',
            'sort_order' => 2,
            'options' => [
                'is_show_description' => 0,
                'override_field_class' => 0,
                'override_row_class' => 0,
                'override_group_class' => 0,
                'override_label_class' => 0,
                'show_in_email_autoreply' => 0,
                'show_in_email_notification' => 0,
                'field_options' => []
            ],
        ]);

        $comment = Field::create([
            'form_id' => $form->id,
            'name' => 'Comment',
            'type' => 'textarea',
            'code' => 'comment',
            'description' => 'User\'s Comments',
            'sort_order' => 3,
            'options' => [
                'is_show_description' => 0,
                'override_field_class' => 0,
                'override_row_class' => 0,
                'override_group_class' => 0,
                'override_label_class' => 0,
                'show_in_email_autoreply' => 0,
                'show_in_email_notification' => 0,
                'field_options' => []
            ],
        ]);

        $options = $form->options;

        $options['auto_reply_email_field_id'] = $email->id;
        $options['auto_reply_name_field_id'] = $name->id;

        $form->options = $options;
        $form->save();
    }
}
