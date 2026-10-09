<?php
require_once "filma.php";
require_once "filmak.php";

$filmak = new Filmak();
$mezua = "";
$emaitzak = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $filmak->gehitu(new Filma("Superman", "12345678", "1978", "5"));
    $filmak->gehitu(new Filma("Batman", "23456789", "2022", "4"));
    $filmak->gehitu(new Filma("Batman vs. Superman", "34567890", "2016", "3"));
    $filmak->gehitu(new Filma("Superman & Lois", "45678901", "2021", "4"));
} else {
    if (isset($_POST["filmak"])) {
        foreach ($_POST["filmak"] as $f) {
            $filmak->gehitu(new Filma($f["izena"], $f["ISAN"], $f["urtea"], $f["puntuazioa"]));
        }
    }

    $izena = isset($_POST["izena"]) ? $_POST["izena"] : "";
    $ISAN = isset($_POST["ISAN"]) ? $_POST["ISAN"] : "";
    $urtea = isset($_POST["urtea"]) ? $_POST["urtea"] : "";
    $puntuazioa = isset($_POST["puntuazioa"]) ? $_POST["puntuazioa"] : "";


    if ($izena == "" && $ISAN == "") {
        $mezua = "Abisua: sartu izena edo ISAN zenbakia";
    } else if ($ISAN == "" && $izena != "") {
        $emaitzak = $filmak->bilatuIzenez($izena);

        if (count($emaitzak) == 0) {
            $mezua = "Ez da filmik aurkitu";
        }
    } else if ($izena == "" && $ISAN != 0) {
        if ($filmak->ezabatu($ISAN)) {
            $mezua = "Filma ezabatu da.";
        } else {
            $mezua = "Ez dago filmik aukeratutako ISANarekin";
        }
    } elseif ($filmak->bilatuISAN($ISAN) != null) {
        if ($urtea != "" && $puntuazioa != "") {
            $filmak->eguneratu($ISAN, $izena, $puntuazioa);
            $mezua = "Filma eguneratu da.";
        } else {
            $mezua = "Abisua: bete eremu guztiak.";
        }
    } else {
        if ($izena != "" && $ISAN != "" && $urtea != "" && $puntuazioa != "") {
            if (strlen($ISAN) == 8) {
                $filmak->gehitu(new Filma($izena, $ISAN, $urtea, $puntuazioa));
                $mezua = "Filma gehitu da";
            } else {
                $mezua = "ISANak 8 karaktere izan behar ditu.";
            }
        } else {
            $mezua = "Eremu guztiak bete behar dituzu.";
        }
    }

}



// Formularioan idatzitakoa mantendu $izena = isset($_POST["izena"]) ? $_POST["izena"] : ""; $ISAN =
isset($_POST["ISAN"]) ? $_POST["ISAN"] : "";
$urtea = isset($_POST["urtea"]) ? $_POST["urtea"] : "";
$puntuazioa =
    isset($_POST["puntuazioa"]) ? $_POST["puntuazioa"] : "0"; ?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <title>TOP MOVIES</title>
</head>

<body>
    <h1>TOP MOVIES</h1>
    <h2>Film zerrenda</h2>
    <table border="1">
        <tr>
            <th>Izena</th>
            <th>ISAN</th>
            <th>Urtea</th>
            <th>Puntuazioa</th>
        </tr> <?php foreach ($filmak->getFilmak() as $filma) { ?>
            <tr>
                <td><?php echo $filma->getIzena(); ?></td>
                <td><?php echo $filma->getISAN(); ?></td>
                <td><?php echo $filma->getUrtea(); ?></td>
                <td><?php echo $filma->getPuntuazioa(); ?></td>
            </tr> <?php } ?>
    </table>
    <p><?php echo $mezua; ?></p> <?php if (count($emaitzak) > 0) { ?>
        <h2>Bilaketaren emaitzak</h2> <?php foreach ($emaitzak as $filma) { ?>
            <p> <?php echo $filma->getIzena(); ?> (<?php echo $filma->getUrtea(); ?>) </p> <?php } ?> <?php } ?>
    <h2>Filma gehitu, bilatu, eguneratu edo ezabatu</h2>
    <form method="POST" action="index.php"> <!-- Film guztiak ezkutuko eremuetan bidali -->
        <?php foreach ($filmak->getFilmak() as $filma) { ?>
            <input type="hidden" name="filmak[<?php echo $filma->getISAN(); ?>][izena]"
                value="<?php echo $filma->getIzena(); ?>">
            <input type="hidden" name="filmak[<?php echo $filma->getISAN(); ?>][ISAN]"
                value="<?php echo $filma->getISAN(); ?>">
            < input type="hidden" name="filmak[<?php echo $filma->getISAN(); ?>][urtea]"
                value="<?php echo $filma->getUrtea(); ?>">
                <input type="hidden" name="filmak[<?php echo $filma->getISAN(); ?>][puntuazioa]"
                    value="<?php echo $filma->getPuntuazioa(); ?>">
            <?php } ?> <label>Izena:</label> <input type="text" name="izena" value="<?php echo $izena; ?>"> <br><br>
            <label>ISAN:</label> <input type="text" name="ISAN" value="<?php echo $ISAN; ?>"> <br><br>
            <label>Urtea:</label>
            <input type="text" name="urtea" value="<?php echo $urtea; ?>"> <br><br> <label>Puntuazioa:</label> <select
                name="puntuazioa">
                <?php for ($i = 0; $i <= 5; $i++) { ?>
                    <option value="<?php echo $i; ?>" <?php if ($puntuazioa == $i)
                           echo "selected"; ?>> <?php echo $i; ?>
                    </option> <?php } ?>
            </select> <br><br> <input type="submit" value="Bidali">
    </form>
</body>

</html>