<?php

#interfaz base, usamos 2 por que me daba issue con el otro archivo, sepa por que
interface Personaje2 {
    public function atacar();
}

#designamos los personajes, 
class Guerrero implements Personaje2 {
    public function atacar() {
        return "Ataque basico de Guerrero";
    }
}

class Arquero implements Personaje2 {
    public function atacar(){
        return "Ataque basico de Arquero";
    }
}

#el decorador
abstract class ArmaDecorator implements Personaje2 {
    protected $Personaje2;

    public function __construct(Personaje2 $Personaje2) {
        $this->Personaje2 = $Personaje2;
    }

    public function atacar(): string {
        return $this->Personaje2->atacar();
    }
}

#decoradores de armas determinadas already
class EspadaDecorator extends ArmaDecorator {
    public function atacar(): string {
        return parent::atacar() . " + Ataque con Espada";
    }
}

class ArcoDecorator extends ArmaDecorator {
    public function atacar(): string {
        return parent::atacar() . " + Ataque con Arco";
    }
}
#jugador
$guerrero = new Guerrero();
$guerreroConEspada = new EspadaDecorator($guerrero);
$guerreroConEspadaYArco = new ArcoDecorator($guerreroConEspada);

$arquero = new Arquero();
$arqueroConArco = new ArcoDecorator($arquero);

echo "Guerrero: " . $guerrero->atacar() . "\n";
echo "Guerrero con Espada: " . $guerreroConEspada->atacar() . "\n";
echo "Guerrero con Espada y Arco: " . $guerreroConEspadaYArco->atacar() . "\n";
echo "Arquero con Arco: " . $arqueroConArco->atacar() . "\n";
echo "Arquero sin Arco: " . $arquero->atacar() . "\n"; #no se que chuchas hara un arquero sin arco, pero algo debe poder hacer JAJAJA

#PD: por lo previsto, los arqueros sin arco si podian pelear, pero pos, pa que, si son arqueros
#https://es.quora.com/Los-arqueros-de-un-ejército-servían-para-batallas-cuerpo-a-cuerpo
#PD: sep, estaban mamados, como podia pesar tanto esa madre
#https://www-quora-com.translate.goog/Do-archers-suck-at-melee-combat?_x_tr_sl=en&_x_tr_tl=es&_x_tr_hl=es&_x_tr_pto=tc

