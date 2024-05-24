<?php

class PartidoFutbol extends Partido {

    // Atributos
    private $coefMenores;
    private $coefJuveniles;
    private $coefMayores;

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->coefMenores = 0.13;
        $this->coefJuveniles = 0.19;
        $this->coefMayores = 0.27;
    }

    // Getters
    public function getCoefMenores() {
        return $this->coefMenores;
    }
    public function getCoefJuveniles() {
        return $this->coefJuveniles;
    }
    public function getCoefMayores() {
        return $this->coefMayores;
    }

    // Setters
    public function setCoefMenores($coefMenores) {
        $this->coefMenores = $coefMenores;
    }
    public function setCoefJuveniles($coefJuveniles) {
        $this->coefJuveniles = $coefJuveniles;
    }
    public function setCoefMayores($coefMayores) {
        $this->coefMayores = $coefMayores;
    }

    
    // Métodos

    // Metodo coeficientePartido
    public function coeficientePartido()
    {
        $coeficienteBase = parent:: coeficientePartido();
        $categorias = $this->getObjEquipo1()->getObjCategoria()->getDescripcion();

        foreach ($categorias as $categoria) {
            if ($categoria == "Menores") {
                $coefCategoria = $this->getCoefMenores();
            } elseif ($categoria == "Juveniles") {
                $coefCategoria = $this->getCoefJuveniles();
            } elseif ($categoria == "Mayores") {
                $coefCategoria = $this->getCoefMayores();
            }
        }

        $coeficienteE1 = $coefCategoria * $this->getCantGolesE1() * $this->getObjEquipo1()->getCantJugadores();
        $coeficienteE2 = $coefCategoria * $this->getCantGolesE2() * $this->getObjEquipo2()->getCantJugadores();
        $coeficientePartidoFutbol = $coeficienteE1 + $coeficienteE2;
        
        return $coeficientePartidoFutbol;


    }






}


?>