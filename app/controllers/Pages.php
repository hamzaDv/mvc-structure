<?php

class Pages extends Controller{

    public function __construct(){
    }

    public function index(){
        
        // Redicrect authenticated users to Posts Page
        if(isLoggedIn()){ redirect('posts/index'); }

        $data = [
            'title' => 'SharedPosts',
            'description' => "Require means it needs it. Require_once means it will need it but only requires it once. Include means it will include a file but it doesn't need it to continue",
        ];


        $this->view('pages/index', $data );
    }

    public function about(){
        $data = [
            'title' => 'About Us',
            'description' => "What Makes a Great About Us Page? · Informative. · Contain social proof, testimonials, and some personal information that visitors can relate to.",

        ];

        $this->view('pages/about', $data );;
    }
}