<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('produk_nama')->index();
            $table->string('produk_slug')->index()->unique();
            $table->unsignedInteger('produk_stok')->default(0);
            $table->unsignedSmallInteger('produk_diskon')->default(0);
            $table->unsignedDecimal('produk_harga', 10, 0)->default(0);
            $table->text('produk_deskripsi')->nullable();
            $table->string('produk_gambar')->nullable();
            $table->boolean('produk_disembunyikan')->default(false);
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
        Schema::dropIfExists('produk');
    }
}
