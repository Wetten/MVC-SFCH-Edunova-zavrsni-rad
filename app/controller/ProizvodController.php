<?php

class ProizvodController

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
        $this->view->render("privatno/proizvodi/index",
            ["proizvodi"=>Proizvod::getProizvodi()]);
    }

    public function pripremaNovi()
    {
        $this->view->render("privatno/proizvodi/novi");
    }



    public function novi()
    {  
       $this->viewGreska="privatno/proizvodi/novi";

      if(!$this->kontrole()){
          return;
      }

       $zadnji = Proizvod::novi();
       $this->index();
    }

    

    public function pripremaPromjeni($id)
    {
      App::setParams(Proizvod::read($id));
      $this->view->render("privatno/proizvodi/promjeni", ['id'=>$id]);
    }


    public function promjeni($id)
    {
        $this->viewGreska="privatno/proizvodi/promjeni";
        $this->id=$id;

        if(!$this->kontrole()){
            return;
        }
  
        Proizvod::promjeni($id);
        $this->index();
    }


    public function brisanje($id)
    {  

       Proizvod::brisi($id);
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