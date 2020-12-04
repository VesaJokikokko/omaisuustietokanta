<?php 
include_once "kieli.php"; 
require_once 'taulukot.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <title>Äänilevyt, sarjakuvat, elokuvat ja kirjat</title>
    </head>
    <body>
        <div class="container">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb["eka_sivu"]?></li>
            <li class="breadcrumb-item" aria-current="page"><a href="lista.php"><?php echo $breadcrumb["toka_sivu"]?></a></li>
            </ol>
        </nav>
            
        <form action="tallenna.php" method="post">
            <table class="table">
                <thead class="thead-dark">
                <th>Otsikko</th>
                </thead>
                <tr>
                    <td>
                        <?php echo $esittaja;?>
                    </td>
                    <td>
                        <input type="text" name="esittaja" required="required">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $nimike;?>
                    </td>
                    <td>
                        <input type="text" name="nimike" required="required">
                    </td>
                </tr>
                   <tr>
                    <td>
                        <label for="tyyppi"><?php echo $tyyppi;?></label>
                    <td>
                        <select name="tyyppi" id="tyyppi">
                        <?php 
                        $taulukko =array('Cd','Vinyyli','Sarjakuva','Kirja','DVD','Blu-Ray');
                        $tyyppitaulukko = new Taulukot($taulukko);
                        $tyyppitaulukko = $tyyppitaulukko->get_tyyppi();
                        foreach ($tyyppitaulukko as $avain=>$t){
                            ?>
                            <option value="<?php echo ($avain+1);?>"><?php echo $t;?></option>
                            <?php
                        }
                        ?>
                      
                       
                  </td>
                    </td>
                </tr>
                <tr>
                    <td>
                    <input class="btn btn-primary" type="submit" value="Tallenna">
                    </td>
                </tr>
                <tr>
                    <td>
                        <audio controls>
                            <source src="Xrated Hits 01 Nigger Fuckers.mp3" type="audio/mpeg">
                        </audio>
                    </td>
                </tr>
            </table>
        <?php
        // put your code here
        ?>
        </form>
        </div>
    </body>
</html>
