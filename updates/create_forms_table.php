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
            $table->string('code', 80);
            $table->string('description')->default('');

            // Caching
            $table->boolean('enable_caching')->nullable()->default(null);
            $table->integer('cache_lifetime')->unsigned()->nullable()->default(null);

            // Action
            $table->string('on_success')->nullable()->default(null);
            $table->string('on_success_message')->nullable()->default(null);
            $table->string('on_success_redirect')->nullable()->default(null);

            // Styling
            $table->string('form_class')->nullable()->default(null);
            $table->string('field_class')->nullable()->default(null);
            $table->string('row_class')->nullable()->default(null);
            $table->string('group_class')->nullable()->default(null);
            $table->string('label_class')->nullable()->default(null);
            $table->string('submit_class')->nullable()->default(null);
            $table->string('submit_text')->nullable()->default(null);
            // ---
            $table->boolean('enable_cancel')->nullable()->default(null);
            $table->string('cancel_class')->nullable()->default(null);
            $table->string('cancel_text')->nullable()->default(null);

            // Anti-spam
            $table->boolean('enable_recaptcha')->nullable()->default(null);
            $table->boolean('enable_ip_restriction')->nullable()->default(null);
            $table->integer('max_requests_per_day')->nullable()->default(null);
            $table->string('throttle_message')->nullable()->default(null);

            // Privacy
            $table->boolean('saves_data')->nullable()->default(null);

            // Emailing
            $table->boolean('auto_reply')->nullable()->default(null);
            $table->integer('auto_reply_name_field_id')->unsigned()->nullable()->default(null);
            $table->integer('auto_reply_email_field_id')->unsigned()->nullable()->default(null);
            $table->string('auto_reply_template')->nullable()->default(null);
            // ---
            $table->boolean('send_notifications')->nullable()->default(null);
            $table->string('notification_template')->nullable()->default(null);
            $table->string('notification_recipients')->nullable()->default(null);

            $table->boolean('notif_replyto')->nullable()->default(null);
            $table->integer('notif_replyto_name_field_id')->unsigned()->nullable()->default(null);
            $table->integer('notif_replyto_email_field_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            // Add indexes
            $table->index('auto_reply_name_field_id');
            $table->index('auto_reply_email_field_id');
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
