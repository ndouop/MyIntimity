<?php
namespace App\Http\Controllers;
class LanguageController extends Controller
{  
    protected $languages = ['en','fr'];
    /**
     * Change language.
     *
     * @param  string $lang
     * @return \Illuminate\Http\Response
     */
    public function __invoke($lang)
    {

        $language = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
        
        \Session::put('locale', request()->getPreferredLanguage($this->languages));

        app()->setLocale(\Session::get('locale'));

        return back();
    }


    public function switchLang($lang)
    {
        if (array_key_exists($lang, \Config::get('languages'))) {
            \Session::put('applocale', $lang);
        }
        return \Redirect::back();
    }
}