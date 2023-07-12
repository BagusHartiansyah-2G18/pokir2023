<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamusUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamus_usulan', function (Blueprint $table) {
            $table->id();
            $table->string('nmUsulan',150); 
            $table->string('satuan',50);
            $table->string('harga',50);
            $table->string('kdDinas',25);
            $table->string('jenis',50);
            $table->timestamps(); 
        });
    }

    /**
     * jenis ( fisik,uang,umum)
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamus_usulan');
    }
}
