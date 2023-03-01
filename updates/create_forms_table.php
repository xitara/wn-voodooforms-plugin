<?php

namespace Xitara\VoodooForms\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xitara_voodooforms_forms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('code', 80);
            $table->mediumtext('description')->nullable();

            // Caching
            $table->boolean('enable_caching')->nullable();
            $table->integer('cache_lifetime')->unsigned()->nullable();

            // Action
            // $table->string('on_success')->nullable();
            // $table->string('on_success_message')->nullable();
            // $table->string('on_success_redirect')->nullable();

            // Styling
            // $table->string('form_class')->nullable();
            // $table->string('field_class')->nullable();
            // $table->string('row_class')->nullable();
            // $table->string('group_class')->nullable();
            // $table->string('label_class')->nullable();
            // $table->string('submit_class')->nullable();
            // $table->string('submit_text')->nullable();
            // ---
            // $table->boolean('enable_cancel')->nullable();
            // $table->string('cancel_class')->nullable();
            // $table->string('cancel_text')->nullable();

            // Anti-spam
            // $table->boolean('enable_recaptcha')->nullable();
            // $table->boolean('enable_ip_restriction')->nullable();
            // $table->integer('max_requests_per_day')->nullable();
            // $table->string('throttle_message')->nullable();

            // Privacy
            // $table->boolean('saves_data')->nullable();

            // Emailing
            // $table->boolean('auto_reply')->nullable();
            // $table->integer('auto_reply_name_field_id')->unsigned()->nullable();
            // $table->integer('auto_reply_email_field_id')->unsigned()->nullable();
            // $table->string('auto_reply_template')->nullable();
            // ---
            // $table->boolean('send_notifications')->nullable();
            // $table->string('notification_template')->nullable();
            // $table->string('notification_recipients')->nullable();

            // $table->boolean('notif_replyto')->nullable();
            // $table->integer('notif_replyto_name_field_id')->unsigned()->nullable();
            // $table->integer('notif_replyto_email_field_id')->unsigned()->nullable();

            $table->mediumtext('options')->nullable();
            $table->timestamps();

            // Add indexes
            // $table->index('auto_reply_name_field_id');
            // $table->index('auto_reply_email_field_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xitara_voodooforms_forms');
    }
};
