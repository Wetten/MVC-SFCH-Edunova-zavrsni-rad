<?php

class Post
{


    public static function getPostovi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
                select t.id,t.naslov,t.sadrzaj,t.datum_objave,o.korisnicko_ime as osoba
                from post t
                inner join osoba o on t.osoba=o.id
        
        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from post where id=:id
        
        ");
        $izraz->execute(['id'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into post
        (id, naslov, sadrzaj, datum_objave, osoba)
        values
        (null,:naslov,:sadrzaj,:datum_objave,:osoba)
        
        ");
        $izraz->execute($_POST);
    }

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update post set
        naslov=:naslov,
        sadrzaj=:sadrzaj,
        datum_objave=:datum_objave,
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
        
        delete from post where id=:id
        
        ");
        $izraz->execute(['id'=>$id]);
    }

    
}