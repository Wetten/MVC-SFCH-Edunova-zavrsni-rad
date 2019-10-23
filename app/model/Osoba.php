<?php

class Osoba
{


    public static function getOsobe()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
                select
                    o.id,
                    o.korisnicko_ime,
                    o.ime,
                    o.prezime,
                    o.email,
                    o.lozinka,
                    o.datum_izrade_racuna,
                    o.uloga
                from osoba o
        
        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from osoba
        where id=:id
        
        ");
        $izraz->execute(['id'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into osoba 
        (id, korisnicko_ime, ime, prezime, email, lozinka, datum_izrade_racuna, uloga)
        values
        (null,:korisnicko_ime,:ime,:prezime,:email,:lozinka,:datum_izrade_racuna,uloga)
        
        ");
        $izraz->execute($_POST);
    }

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update osoba set
        korisnicko_ime=:korisnicko_ime,
        ime=:ime,
        prezime=:prezime,
        email=:email,
        lozinka=:lozinka,
        datum_izrade_racuna=:datum_izrade_racuna,
        uloga=:uloga
        where id=:id
        
        ");
        $_POST['id']=$id;
        $izraz->execute($_POST);
    }


    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from osoba where id=:id
        
        ");
        $izraz->execute(['id'=>$id]);
    }

    
}