
<?php
require_once "config.php";
require_once "sql_lauseet.php";
if (!empty($_POST['esittaja'])){
    $esittaja = $_POST['esittaja'];
}
else{
    echo "Tarkista nimi";
}
//$esittaja = 1;
if (!empty($_POST['nimike'])){
    $nimike =$_POST['nimike'];
}
else{
    echo "Tarkista nimike";
}
if (!empty($_POST['tyyppi'])){
    $tyyppi =$_POST['tyyppi'];
}
else{
    echo "Tarkista tyyppi";
}
$sql = new sql_lauseet();
$tarkista_nimi = $sql->haeTekija();
if ($tarkista_nimi){
    foreach ($tarkista_nimi as $t){
        if ($t['nimi'] == $esittaja){
        //$esittaja = $t['nimi'];
            $esittaja_id = $t['id'];
            $tallenna_kantaan_nimike = $sql->tallennaKantaanNimike($esittaja_id, $tyyppi, $nimike);
//        $tallenna_kantaan = $sql->tallennaKantaanEsittaja($esittaja
         }
         else{
            $esittaja = $esittaja;
            $tallenna_kantaan = $sql->tallennaKantaanEsittaja($esittaja);
            $esittaja_id = $tallenna_kantaan; 
            $tallenna_kantaan_esittaja = $sql->tallennaKantaanNimike($esittaja_id, $tyyppi, $nimike);
        //die();
        }
    }
}
else{
        $esittaja = $esittaja;
        $tallenna_kantaan = $sql->tallennaKantaanEsittaja($esittaja);
        $esittaja_id = $tallenna_kantaan; 
        $tallenna_kantaan_esittaja = $sql->tallennaKantaanNimike($esittaja_id, $nimike);
}

/*    echo $t['nimi'];
}*/
/*echo $esittaja;
echo $esittaja_id;
*/
die();
$sql->tallennaKantaanEsittaja($esittaja);
/*$sql->haeNimike();
$vastaus = $sql->naytaTulokset();
foreach($vastaus as $v){
    echo $v['id'];
    echo "<br>";
    echo $v['nimi'];
}*/

die();

  ?>


