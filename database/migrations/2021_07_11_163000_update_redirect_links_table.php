<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRedirectLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('redirect_links', function (Blueprint $table) {
            $table->string('referer_host', 250)->nullable()->comment('Хост реферальной ссылки')->after('shortlink_id');
            $table->string('referer_url', 1000)->nullable()->comment('Реферальная ссылка')->after('referer_host');
            $table->json('referer_query')->nullable()->comment('Параметры реферальной ссылки')->after('referer_url');
            $table->json('headers')->nullable()->comment('Заголовки запроса')->after('query_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('redirect_links', function (Blueprint $table) {
            $table->dropColumn('referer_host');
            $table->dropColumn('referer_url');
            $table->dropColumn('referer_query');
            $table->dropColumn('headers');
        });
    }
}
