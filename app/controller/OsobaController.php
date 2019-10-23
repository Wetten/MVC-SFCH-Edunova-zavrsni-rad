<?php

class OsobaController
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
        $this->view->render("privatno/osobe/index",
            ["osobe"=>Osoba::getOsobe()]);
    }



    public function pripremaNovi()
    {
        $this->view->render("privatno/osobe/novi");
    }


    public function novi()
    {  
       $this->viewGreska="privatno/osobe/novi";

      if(!$this->kontrole()){
          return;
      }

       $zadnji = Osoba::novi();

       $this->index();
    }



    public function pripremaPromjeni($id)
    {
      App::setParams(Osoba::read($id));
      $this->view->render("privatno/osobe/promjeni", ['id'=>$id]);
    }


    public function promjeni($id)
    {
        $this->viewGreska="privatno/osobe/promjeni";
        $this->id=$id;

        if(!$this->kontrole()){
            return;
        }
        $this->index();
    }



    public function brisanje($id)
    {  
       Osoba::brisi($id);
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