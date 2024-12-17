<?php

#interfaz para personaje
interface Personaje {
    public function atacar();
    public function obtenerVelocidad();
}

# implementacion de esqueleto
class Esqueleto implements Personaje {
    public function atacar(){
        return "Ataque con arco y flecha";
    }

    public function obtenerVelocidad() {
        return 5;
    }
}

#implementacion de Zombiee
class Zombie implements Personaje {
    public function atacar() {
        return "Ataque con mordisco, ñam";
    }

    public function obtenerVelocidad() {
        return 3;
    }
}

#vamos a hacerle facotry de personajes aca
class PersonajeFactory {
    public function crearPersonaje($nivel) {#esta wea es de topo personaje
        switch($nivel) {
            case 'facil':
                return new Esqueleto();
            case 'dificil':
                return new Zombie();
            default:
                throw new Exception("Nivel de juego no valido");
        }
    }
}

#aca tas vos, aca me lo toma como un color verde muy bonito
$factory = new PersonajeFactory();
$personajeFacil = $factory->crearPersonaje('facil');
$personajeDificil = $factory->crearPersonaje('dificil');

echo "Personaje facil - Ataque: " . $personajeFacil->atacar() . 
     ", Velocidad: " . $personajeFacil->obtenerVelocidad() . "\n";
echo "Personaje dificil - Ataque: " . $personajeDificil->atacar() . 
     ", Velocidad: " . $personajeDificil->obtenerVelocidad() . "\n";
