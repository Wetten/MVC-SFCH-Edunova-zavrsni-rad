<?php

class Proizvod
{


    public static function getProizvodi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
               select p.id,p.naziv,p.opis,p.kolicina,o.korisnicko_ime as osoba
                    from proizvod p
                    inner join osoba o on p.osoba=o.id
        
        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from proizvod where id=:id
        
        ");
        $izraz->execute(['id'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into proizvod 
        (id, naziv, opis, kolicina, osoba)
        values
        (null, :naziv, :opis, :kolicina, :osoba)
        
        ");
        $izraz->execute($_POST);
    }

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update proizvod set
        naziv=:naziv,
        opis=:opis,
        kolicina=:kolicina,
        osoba=:osoba
        where id=:id
        
        ");
        $_POST['id']=$id;
        $izraz->execute($_POST);
    }


    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from proizvod where id=:id
        
        ");
        $izraz->execute(['id'=>$id]);
    }
    
}