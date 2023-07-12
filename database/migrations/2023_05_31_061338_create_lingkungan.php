<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLingkungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lingkungan', function (Blueprint $table) {
            $table->string('kdLing',5);
            $table->string('kdDesa',10);
            $table->string('kdKec',10);
            $table->string('nmLing',100);
            $table->timestamps();
            $table->primary(['kdLing','kdDesa','kdKec']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lingkungan');
    }
}
