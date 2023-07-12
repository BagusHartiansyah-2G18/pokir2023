<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keuangan', function (Blueprint $table) {
            $table->string('kdUang');
            $table->string('kdPengirim',15);
            $table->string('kdPenerima',15);
            $table->string('nominal',50);
            $table->string('aktif',2)->default(1);
            $table->string('keterangan',200);
            $table->timestamps();
            $table->primary(['kdUang','kdPengirim']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keuangan');
    }
}
