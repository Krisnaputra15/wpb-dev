<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $bg;

    function __construct() {
        $this->bg = Content::where('type', 'gallery')->select('cover')->inRandomOrder()->first();
    }

    public function index(){
        $latestNews = Content::where('type', 'article')->where('is_active', 1)->orderBy('created_at', 'desc')->limit(4)->get() ?? [];
        $latestAgenda= Agenda::where('is_active', 1)->orderBy('created_at', 'desc')->limit(4)->get() ?? [];
        $galleryLatest = Content::where('type', 'gallery')->where('is_active', 1)->limit(4)->get() ?? [];
        return view('front.home', compact('latestNews','latestAgenda','galleryLatest'));
    }

    public function faq(){
        $faqs = Content::where('type', 'faq')->where('is_active', 1)->get();
        $bg = Content::where('type', 'gallery')->select('cover')->inRandomOrder()->first();
        return view('front.faq', compact('faqs', 'bg'));
    }

    public function news(){
        $latestNews = Content::where('type', 'article')->where('is_active', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        $news = Content::where('type', 'article')->where('is_active', 1)->orderBy('created_at', 'desc')->paginate(10);
        $bg = $this->bg;
        return view('front.news', compact('news', 'latestNews', 'bg'));
    }

    public function detailNews($slug){
        $latestNews = Content::where('type', 'article')->where('is_active', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        $news = Content::where('slug', $slug)->where('type', 'article')->first();
        $bg = $this->bg;
        return view('front.newsDetail', compact('news','latestNews', 'bg'));
    }

    public function agenda() {
        $agendas = Agenda::where('is_active', 1)->paginate(10);
        $bg = $this->bg;
        return view('front.agenda', compact('agendas', 'bg'));
    }

    public function detailAgenda($slug){
        $agenda = Agenda::where('slug', $slug)->where('is_active', 1)->first();
        $bg = $this->bg;
        return view('front.agendaDetail', compact('agenda', 'bg'));
    }

    public function gallery(){
        $gallery = Content::where('type', 'gallery')->where('is_active', 1)->paginate(12);
        $bg = $this->bg;
        return view('front.gallery', compact('gallery', 'bg'));
    }
}
