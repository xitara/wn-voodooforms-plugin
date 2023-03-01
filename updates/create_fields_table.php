<?php

namespace Xitara\VoodooForms\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xitara_voodooforms_fields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->string('name');
            $table->string('code', 80);
            $table->string('type');
            $table->mediumtext('description')->default('');
            $table->integer('sort_order')->unsigned()->default(1);
            $table->boolean('is_required')->default(0);
            $table->string('placeholder')->default('');
            $table->string('validation_rules')->default('');
            $table->string('validation_message')->default('');
            // $table->string('row_class')->nullable();
            // $table->string('group_class')->nullable();
            // $table->string('label_class')->nullable();
            // $table->string('field_class')->nullable();
            // $table->boolean('show_in_email_autoreply')->default(true);
            // $table->boolean('show_in_email_notification')->default(true);
            $table->mediumtext('options');
            // $table->boolean('show_description')->default(false);
            $table->text('default')->nullable();
            $table->text('html_attributes')->nullable();
            $table->timestamps();

            // Add indexes
            $table->index('form_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xitara_voodooforms_fields');
    }
};
