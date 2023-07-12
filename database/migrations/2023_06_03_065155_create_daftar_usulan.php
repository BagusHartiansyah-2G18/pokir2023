<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_usulan', function (Blueprint $table) {
            $table->string('kdUsulan',15);
            $table->string('kdUser',15);
            $table->string('idKusulan',50);
            $table->string('kdLing',50);
            $table->string('hargaT',50);
            $table->string('satuanT',50);
            $table->string('rt',15);
            $table->string('rw',15);
            $table->timestamps();
            $table->primary(['kdUsulan','kdUser','idKusulan','kdLing']);
        });
    }

    /** kdLing / kdLingkungan ling|desa|kec
     * hargaT / harga tampung
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_usulan');
    }
}
