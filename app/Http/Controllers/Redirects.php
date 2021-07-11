<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShortLink;
use App\Models\RedirectLink;
use App\Models\RedirectBadLink;

class Redirects extends Controller
{

    /**
     * Ссылка перенаправелния на страницу ошибки
     * 
     * @var string
     */
    protected $url_error;

    /**
     * Создание контроллера перенаправления
     * 
     * @return void
     */
    public function __construct() {

        $this->url_error = env('APP_URL_ERROR', '');

    }

    /**
     * Перенавпраление по ссылке
     * 
     * @param Illuminate\Http\Request $request
     * @param string $link
     * @return redirect
     */
    public function redirect(Request $request, String $link = "")
    {

        if (!$id = $this->linkToDec($link)) {
            $this->badRedirect($request, $link);
            return redirect($this->url_error);
        }

        if (!$shortlink = ShortLink::find($id)) {
            $this->badRedirect($request, $link);
            return redirect($this->url_error . "?link={$link}");
        }

        RedirectLink::create([
            'shortlink_id' => $id,
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'query_data' => \json_encode($request->all(), JSON_UNESCAPED_UNICODE),
        ]);

        $shortlink->redirects++;
        $shortlink->save();

        return redirect($shortlink->url);

    }

    /**
     * Переход на несуществующую ссылку
     * 
     * @param Illuminate\Http\Request $request
     * @param string $link
     * @return App\Models\RedirectBadLink Экземпляр модели
     */
    public function badRedirect($request, $link)
    {

        return RedirectBadLink::create([
            'shortlink' => $link,
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'query_data' => \json_encode($request->all(), JSON_UNESCAPED_UNICODE),
        ]);

    }

}