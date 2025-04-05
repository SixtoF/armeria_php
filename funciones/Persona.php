<?php

class Persona
{
    private $dni;
    private $nombre;
    private $apellido;
    private $telefono;

    public function __construct($dni, $nombre, $apellido, $telefono){
        //validar y asignar el dni
        try{
            $this->setDni($dni);
        }catch(Exception $e){
            //se muestra un mensaje de error si el dni no es valido
            echo "Error al asignar DNI: " . $e->getMessage() . "<br>";
        }

        $this->nombre = $nombre;
        $this->apellido = $apellido;

        //validar y asignar telefono
        try{
            $this->setTelefono($telefono);
        }catch(Exception $e){
            //mensaje de error si el telefono no es valido
            echo "Error al asignar telefono: " . $e->getMessage() . "<br>";
        }

    }

    //metodos getters
    public function getDni(){
        return $this->dni;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    //metodos setters para validar y asignar los valores a los atributos
    public function setDni($dni){
        //formato del DNI: 8 numero seguidos de una letra mayuscula
        if(preg_match('/^\d{8}[A-Z]$/', $dni)){
            //si cumple con el formato de validacion se asigna el valor a dni
            $this->dni = $dni;
        }else{
            //sino es valido
            throw new Exception("DNI NO valido!, DEBE tener 8 numeros seguidos de 1 letra mayuscula");
        }

    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setTelefono($telefono){
        if(preg_match('/^\d{9}$/', $telefono)){
            //si es valido se le asigna el telefono
            $this->telefono = $telefono;
        }else{
            throw  new Exception("Telefono no valido!.Debe tener 9 digitos numeros");
        }

    }

    //metodo para serializar los datos del objeto a un formato
    //que se pueda almacenar en un archivo
    public function toArray()
    {
        return [
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'telefono' => $this->telefono];
    }
}