<?php

class Torneo{

    // Atributos
    private $colPartidos;
    private $importePremio;

    public function __construct($colPartidos, $importePremio)
    {
        $this->colPartidos = $colPartidos;
        $this->importePremio = $importePremio;
    }

    // Getters
    public function getColPartidos() {
        return $this->colPartidos;
    }
    public function getImportePremio() {
        return $this->importePremio;
    }

    // Setters
    public function setColPartidos($colPartidos) {
        $this->colPartidos = $colPartidos;
    }
    public function setImportePremio($importePremio) {
        $this->importePremio = $importePremio;
    }

    
    // Métodos
    
    // Metodo ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en la clase Torneo el cual recibe por parámetro 2 equipos, la fecha en la que se realizará el partido y si se trata de un partido de futbol o basquetbol . El método debe crear y retornar la instancia de la clase Partido que corresponda y almacenarla en la colección de partidos del Torneo. Se debe chequear que los 2 equipos tengan la misma categoría e igual cantidad de jugadores, caso contrario no podrá ser registrado ese partido en el torneo.
    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) {

        $equipo1idCategoria = $OBJEquipo1->getObjCategoria()->getIdcategoria();
        $equipo2idCategoria = $OBJEquipo2->getObjCategoria()->getIdcategoria();
        $partido = null;

        if ($equipo1idCategoria == $equipo2idCategoria && $OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()) {
            $idpartido = $this->obtenerUltimoIdPartido();

            if ($tipoPartido == "Futbol") {
                $partido = new PartidoFutbol($idpartido + 1, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0);
            } elseif ($tipoPartido == "Basquetbol") {
                $partido = new PartidoBasquetbol($idpartido + 1, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0, 0);
            } 
        } 
        return $partido;
    }


    // Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro si se trata de un partido de fútbol o de básquetbol y en base al parámetro busca entre esos partidos los equipos ganadores (equipo con mayor cantidad de goles). El método retorna una colección con los objetos de los equipos encontrados.

    public function darGanadores($deporte) {
        $ganadores = [];
        $colPartidos = $this->getColPartidos();

        foreach ($colPartidos as $partido) {

            if ($partido instanceof $deporte) {
                $equiposGanadores = $partido->darEquipoGanador();

                if ($equiposGanadores != null) {
                    array_push($ganadores, $equiposGanadores);
                }
            }
        }

        return $ganadores;
    }


    // Implementar el método calcularPremioPartido($OBJPartido) que debe retornar un arreglo asociativo donde una de sus claves es ‘equipoGanador’ y contiene la referencia al equipo ganador; y la otra clave es ‘premioPartido’ que contiene el valor obtenido del coeficiente del Partido por el importe configurado para el torneo. (premioPartido = Coef_partido * ImportePremio)
    public function calcularPremioPartido($OBJPartido) {

        $coeficientePartido = $OBJPartido->coeficientePartido();
        $importePremio = $this->getImportePremio();

        $equipoGanador = $OBJPartido->darEquipoGanador();

        if ($equipoGanador != null) {
            $premioPartidoEquipo1 = $coeficientePartido * $importePremio / 2;
        } else {
            $premioPartidoEquipo1 = $coeficientePartido * $importePremio;
            $premioPartidoEquipo2 = 0; 
        }

        return ['equipoGanador' => $equipoGanador, 'premioPartido' => [$premioPartidoEquipo1, $premioPartidoEquipo2]];
    }


    public function obtenerUltimoIdPartido() {
        $ultimoId = 0;
        foreach ($this->getColPartidos() as $partido) {
            if ($partido->getIdpartido() > $ultimoId) {
                $ultimoId = $partido->getIdPartido();
            }
        }
        return $ultimoId;
    }



    // __toString
    public function __toString()
    {
        
    }




}