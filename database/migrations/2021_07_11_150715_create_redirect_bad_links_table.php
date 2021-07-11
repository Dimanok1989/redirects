<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectBadLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirect_bad_links', function (Blueprint $table) {
            $table->id();
            $table->string('shortlink', 500)->nullable()->comment('Идентификатор переданной ссылки');
            $table->string('ip', 50)->nullable()->comment('IP адрес клиента');
            $table->string('user_agent', 500)->nullable();
            $table->json('query_data')->nullable()->comment('Все параметры запроса');
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
        Schema::dropIfExists('redirect_bad_links');
    }
}
