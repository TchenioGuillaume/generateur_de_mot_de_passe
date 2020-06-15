
<?php
/*---------------------------------------------------------------*/
/*
Titre : Génère des mots de passe prononcable facile à retenir

URL   : https://phpsources.net/code_s.php?id=555
Auteur           : mercier133
Date édition     : 16 Jan 2010
Date mise à jour : 07 Aout 2019
Rapport de la maj:
- refactoring du code en PHP 7
- fonctionnement du code vérifié
*/
/*---------------------------------------------------------------*/

function generatePass( $nbr = 5 )  {


    //Liste de mots, pensez à choisir des mots avec des sons qui se prononcent
    // facilement !
    $mots = array("bleu","blanc","rouge","jaune","vert","violet","affichera",
    "chaine","genre","retourne","fonction","commentaire","lapin","renard","image",
    "mathematique","aleatoire","hasard","source","chat","souris","chapeau","langue",
    "arbre","generer","livre","supposon","tout","vecteur","construction","violon",
    "flute","fuite","zebre","zoro","xylophone","deux","trois","quatre","cinq","sept"

    ,"huit","neuf","douze","treize");
    //Prononcabilité :
    $p = 1;
    // c'est le nombre de lettre commune qu'il prendra en compte pour assembler 2
    // mots. 1 est conseiller, 2 risque de donner de temps en temps le même mot
    // (sauf
    // si la liste de $mots est longue et variée). 3,4... est à éviter !

    $m1 = $mots[rand(0,count($mots)-1)];
    $result=substr($m1,0,rand(2,strlen($m1)-1));
    for($i=0;$i<rand(3,4);$i++){ //boucle d'initialisation
        $pasOk=true;
        $x =0;
        while($pasOk && $x<100){

            $m = $mots[rand(0,count($mots)-1)];
            while($m==$m1){
                $m = $mots[rand(0,count($mots)-1)];
            }
            $result = substr($result,-$p);
            if(preg_match("#$result#",$m)){
                $pasOk=false;
                $result2 = substr($result,-1);
                $m2 =  preg_split("#$result2#",$m);
                $result .= substr($m2[1],0,rand(2,strlen($m2[1])-1));
            }
            $x++;
        } if($x==100){ return generatePass();}
        //si on n'y arrive pas on réessaye depuis le début ;)
    }
    if(strlen($result)<$nbr) return generatePass();
    return $result;

}
echo generatePass();
?>
