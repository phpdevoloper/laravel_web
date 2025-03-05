<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login_id');
            $table->string('application_id')->nullable();
            $table->text('education_serial');
            $table->text('experience_serial');

            $table->text('education_doc');
            $table->text('experience_doc');

            $table->text('upload_photo');
            $table->text('upload_sign');
            // $table->string('application_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_documents');
    }
};
