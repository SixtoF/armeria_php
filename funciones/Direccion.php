<?php
require_once 'Persona.php';
class Direccion extends Persona
{
    private $calle;
    private $numeroPortal;
    private $codigoPostal;
    private $poblacion;
    private $provincia;
    private $nota;

    public function __construct($dni, $nombre, $apellido, $telefono, $calle, $numeroPortal, $codigoPostal, $poblacion, $provincia, $nota){
        //se llama al constructor de la clase Persona para asignar los datos
        parent::__construct($dni, $nombre, $apellido, $telefono);
        $this->calle = $calle;
        $this->numeroPortal = $numeroPortal;
        $this->codigoPostal = $codigoPostal;
        $this->poblacion = $poblacion;
        $this->provincia = $provincia;
        $this->nota = $nota;
    }

    //metodos getters
    public function getCalle(){
        return $this->calle;
    }

    public function getNumeroPortal(){
        return $this->numeroPortal;
    }

    public function getCodigoPostal(){
        return $this->codigoPostal;
    }

    public function getPoblacion(){
        return $this->poblacion;
    }

    public function getProvincia(){
        return $this->provincia;
    }

    public function getNota(){
        return $this->nota;
    }

    //metodos setters
    public function setCalle($calle){
        $this->calle = $calle;
    }

    public function setNumeroPortal($numeroPortal){
        $this->numeroPortal = $numeroPortal;
    }

    public function setCodigoPostal($codigoPostal){
        $this->codigoPostal = $codigoPostal;
    }

    public function setPoblacion($poblacion){
        $this->poblacion = $poblacion;
    }

    public function setProvincia($provincia){
        $this->provincia = $provincia;
    }

    public function setNota($nota){
        $this->nota = $nota;
    }

    //metodo para convertir el objeto en un array
    //añadiendo los datos de la herencia Persona
    public function toArray()
    {
        //combina los datos heredados de Persona con los especificos de direccion
        return array_merge(
            parent::toArray(),//se incluyen los datos de Persona
        [
            'calle' => $this->calle,
            'numeroPortal' => $this->numeroPortal,
            'codigoPostal' => $this->codigoPostal,
            'poblacion' => $this->poblacion,
            'provincia' => $this->provincia,
            'nota' => $this->nota
        ]);
    }
}