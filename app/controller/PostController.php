<?php

class PostController

{
  
    private $viewGreska="";
    private $id=0;

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
       

    public function index()
    {  
        $this->view->render("privatno/postovi/index",
            ["postovi"=>Post::getPostovi()]);
    }



    public function pripremaNovi()
    {
        $this->view->render("privatno/postovi/novi");
    }




    public function novi()
    {  
       $this->viewGreska="privatno/postovi/novi";

      if(!$this->kontrole()){
          return;
      }

       $zadnji = Post::novi();

       $this->index();
    }



    public function pripremaPromjeni($id)
    {
      App::setParams(Post::read($id));
      $this->view->render("privatno/postovi/promjeni", ['id'=>$id]);
    }


    public function promjeni($id)
    {
        $this->viewGreska="privatno/proizvodi/promjeni";
        $this->id=$id;

        if(!$this->kontrole()){
            return;
        }
  
        Post::promjeni($id);
        $this->index();
    }



    public function brisanje($id)
    {  

       Post::brisi($id);
       $this->index();
    }

    private function kontrole()
    {
        
    return true;
    }



    private function greska($polje,$poruka)
    {
        $this->view->render($this->viewGreska,
            ['greska'=>
                ['polje'=>$polje,
                 'poruka'=>$poruka],
             'id'=>$this->id
            ]);
    }


}