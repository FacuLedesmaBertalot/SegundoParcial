<?php

class PartidoBasquetbol extends Partido {

    // Atributos
    private $cantInfracciones;
    private $coefPenalizacion;

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2, $cantInfracciones) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
        $this->coefPenalizacion = 0.75;
    }

    // Getters
    public function getCantInfracciones() {
        return $this->cantInfracciones;
    }
    public function getCoefPenalizacion() {
        return $this->coefPenalizacion;
    }

    // Setters
    public function setCantInfracciones($cantInfracciones) {
        $this->cantInfracciones = $cantInfracciones;
    }
    public function setCoefPenalizacion($coefPenalizacion) {
        $this->coefPenalizacion = $coefPenalizacion;
    }


    // Métodos

    // Metodo coeficientePartido() 
    public function coeficientePartido() {

        $coeficienteBase = parent::coeficientePartido();
        $coeficienteE1 = $coeficienteBase - ($this->getCoefPenalizacion() - $this->getCantInfracciones());
        $coeficienteE2 = $coeficienteBase -($this->getCoefPenalizacion() - $this->getCantInfracciones());
        $coeficientePartidoBasquetbol = $coeficienteE1 + $coeficienteE2;

        return $coeficientePartidoBasquetbol;
    }

}