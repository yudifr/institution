<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sekolah')->nullable();
            $table->string('nama')->unique()->nullable();
            $table->string('tipe')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kab_kota')->nullable(); 
            $table->string('provinsi')->nullable();
            $table->string('no_telp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');
    }
}
