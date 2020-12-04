<?php 
require_once "config.php";
require_once "sql_lauseet.php";
require_once "kieli.php";
require_once "leiska.php";
?>

    <body>
  
        <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="index.php"><?php echo $breadcrumb["eka_sivu"]?></a></li>    
            <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb["toka_sivu"]?></li>
           
            </ol>
        </nav>
            <table class="table">
            <thead class="thead-dark">
                <th>Nimikelista</th>
            </thead>   
        <?php
        $sql = new sql_lauseet();
        $listaa_nimikkeet = $sql->tulostaNimikkeet();
        foreach ($listaa_nimikkeet as $l){
            echo "<tr>";
            echo "<td><a href='rajapintahaku.php?nimi=".$l['nimi']."'>".$l['nimi']."</a></td>";            
            echo "<td>".$l['nimike_nimi']."</td>";
            echo "</tr>";
            
        }
        ?>
                  
           <table>
        </div>
    </body>
</html>
