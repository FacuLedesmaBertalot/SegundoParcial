<?php
include_once("Categoria.php");
include_once("Torneo.php");
include_once("Equipo.php");
include_once("Partido.php");
include_once("PartidoFutbol.php");
include_once("PartidoBasquetbol.php");

$catMayores = neW Categoria(1,'Mayores');
$catJuveniles = neW Categoria(2,'juveniles');
$catMenores = neW Categoria(1,'Menores');

$objE1 = neW Equipo("Equipo Uno", "Cap.Uno",1,$catMayores);
$objE2 = neW Equipo("Equipo Dos", "Cap.Dos",2,$catMayores);

$objE3 = neW Equipo("Equipo Tres", "Cap.Tres",3,$catJuveniles);
$objE4 = neW Equipo("Equipo Cuatro", "Cap.Cuatro",4,$catJuveniles);

$objE5 = neW Equipo("Equipo Cinco", "Cap.Cinco",5,$catMayores);
$objE6 = neW Equipo("Equipo Seis", "Cap.Seis",6,$catMayores);

$objE7 = neW Equipo("Equipo Siete", "Cap.Siete",7,$catJuveniles);
$objE8 = neW Equipo("Equipo Ocho", "Cap.Ocho",8,$catJuveniles);

$objE9 = neW Equipo("Equipo Nueve", "Cap.Nueve",9,$catMenores);
$objE10 = neW Equipo("Equipo Diez", "Cap.Diez",9,$catMenores);

$objE11 = neW Equipo("Equipo Once", "Cap.Once",11,$catMayores);
$objE12 = neW Equipo("Equipo Doce", "Cap.Doce",11,$catMayores);


// Creado objeto Torneo
$objTorneo = new Torneo([], 100000);


// crear 3 objetos partidos de Básquet
$objPartidoBasquetbol1 = new PartidoBasquetbol(11, "2024-05-05", $objE7, 80, $objE8, 120, 7);
$objPartidoBasquetbol2 = new PartidoBasquetbol(12, "2024-05-06", $objE9, 81, $objE10, 110, 8);
$objPartidoBasquetbol3 = new PartidoBasquetbol(13, "2024-05-07", $objE11, 115, $objE12, 85, 9);


// crear 3 objetos partidos de Fútbol
$objPartidoFutbol1 = new PartidoFutbol(14, "2024-05-07", $objE1, 3, $objE2, 2);
$objPartidoFutbol2 = new PartidoFutbol(15, "2024-05-08", $objE3, 0, $objE4, 1);
$objPartidoFutbol3 = new PartidoFutbol(16, "2024-05-09", $objE5, 2, $objE6, 3);




// ingresarPartido($objE5, $objE11, '2024-05-23', 'Futbol'); visualizar la respuesta y la cantidad de equipos del torneo.

$partidoA = $objTorneo->ingresarPartido($objE5, $objE11, '2024-05-23', 'Futbol');

if ($partidoA == null) {
    echo "No se pudo ingresar el partido de Futbol.\n";
} else {
    echo "Partido de Futbol ingresado:\n";
    echo $partidoA . "\n";
    echo "Cantidad de equipos en el torneo: " . $partidoA->getIdpartido() . "\n";
}

$partidoB = $objTorneo->ingresarPartido($objE11, $objE11, '2024-05-23', 'Basquetbol');
if ($partidoB == null) {
    echo "No se pudo ingresar el partido de Basquet.\n";
} else {
    echo "Partido de Basquet ingresado:\n";
    echo $partidoB . "\n";
    echo "Cantidad de equipos en el torneo: " . $partidoB->getIdpartido() . "\n";
}

$partidoC = $objTorneo->ingresarPartido($objE9, $objE10, '2024-05-25', 'Basquetbol');
if ($partidoB == null) {
    echo "No se pudo ingresar el partido de Basquet.\n";
} else {
    echo "Partido de Basquet ingresado:\n";
    echo $partidoB . "\n";
    echo "Cantidad de equipos en el torneo: " . $partidoC->getIdpartido() . "\n";
}

$ganadorBasquet = $objTorneo->darGanadores("Basquetbol");
echo "Ganadores de Basquet: \n";
foreach ($ganadorBasquet as $equipo) {
    echo $equipo->getNombre() . " con " . $equipo->getGoles() . " goles\n";
}



$ganadoresFutbol = $objTorneo->darGanadores("Futbol");
echo "Ganadores de Fútbol: \n";
foreach ($ganadoresFutbol as $equipo) {
    echo $equipo->getNombre() . " con " . $equipo->getGoles() . " goles\n";
}


echo "Premios para cada partido: \n";
$partidos = [$partidoA, $partidoB, $partidoC];
foreach ($partidos as $partido) {
    $premioPartido = $objTorneo->calcularPremioPartido($partido);
    echo "Equipo ganador: " . $premioPartido['equipoGanador']->getNombre() . "\n";
    echo "Premio del partido: " . $premioPartido['premioPartido'][0] . "\n";
}

?>
