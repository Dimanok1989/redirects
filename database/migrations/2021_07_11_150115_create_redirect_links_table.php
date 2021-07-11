<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirect_links', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shortlink_id')->nullable()->comment('Идентификатор созданной ссылки');
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
        Schema::dropIfExists('redirect_links');
    }
}
