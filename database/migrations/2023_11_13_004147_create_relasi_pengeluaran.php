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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pemasukan_id')->references('id')->on('pemasukans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->dropforeign('pengeluarans_user_id_foreign');
            $table->dropforeign('pengeluarans_kategori_id_foreign');
            $table->dropforeign('pengeluarans_pemasukan_id_foreign');
         });
    }
};
