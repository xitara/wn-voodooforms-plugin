<?php

namespace Xitara\VoodooForms\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xitara_voodooforms_submissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->string('ip', 40)->nullable();
            $table->string('url')->nullable();
            $table->mediumtext('data')->nullable();
            $table->mediumtext('attachments')->nullable();
            $table->timestamps();

            // Add indexes
            $table->index('form_id');

            // Add foreign keys
            $table->foreign('form_id')->references('id')->on('xitara_voodooforms_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('xitara_voodooforms_submissions');
        Schema::enableForeignKeyConstraints();
    }
};
