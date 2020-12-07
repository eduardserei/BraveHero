<?php include 'calcule.php'; ?>

<?php 

// my browser logging function 
function console_log($whatToLog){
    echo '<script>console.log('. json_encode($whatToLog, JSON_HEX_TAG) .')</script>';
}

class Character{
    public $stance;

    public function __construct(
        $nume,
        $viata = 100, 
        $putere = 100, 
        $aparare = 100, 
        $viteza = 100, 
        $noroc = [
            'areNoroc' => false,
            'valoareNoroc' => 0
        ]
        
        ){
        $this->nume = $nume;
        $this->viata = $viata;
        $this->putere = $putere;
        $this->aparare = $aparare;
        $this->viteza = $viteza;
        $this->noroc = $noroc;

    }
    
    public function attack($oponent){
        // console_log("$this->nume is attacking $oponent->nume");
        $this->logStats();

        $oponent->defend($this);
    }

    public function defend($oponent){
        // console_log("$this->nume is defending");
        $this->take_damage($oponent);
    }

    public function take_damage($oponent){
        $damage = $oponent->putere - $this->aparare;

        if(!$this->noroc['areNoroc']){
            $this->update_health($damage);
        }

        // console_log("$this->nume is taking damage: -$damage");
        $this->logStats();
    }

    public function logStats(){
        $areNoroc = $this->noroc['areNoroc'];
        $valoareNoroc = $this->noroc['valoareNoroc'];
        console_log("
        === $this->nume stats === 
        stance: $this->stance;
        viata: $this->viata;
        putere: $this->putere;
        aparare: $this->aparare;
        viteza: $this->viteza;
        are noroc: $areNoroc;
        valoare noroc: $valoareNoroc;
        ");
    }

    public function update_health($damage){
        
        if ($this->viata - $damage < 0) {

            $this->viata = 0;
        } elseif ($this->viata - $damage > 100) {

            $this->viata = 100;
        } else {

            $this->viata -= $damage;
        }
    }

    public function update_noroc(){

        if(sansa_procentaj($this->noroc['valoareNoroc'])){
        // if(sansa_procentaj(95)){ // test noroc
            $this->noroc['areNoroc'] = true;
        } else {
            $this->noroc['areNoroc'] = false;
        }
    }
}

class Hero extends Character{
    private $scut_activ = true;

    public function take_damage($oponent){
        $damage = $oponent->putere - $this->aparare;

        // console_log("damage inainte de activarea Scutului Fermecat: $damage"); // log pt test damage inainte de activarea scutului
        
        $this->scutul_fermecat(); // incercare activare scut - argument = procentaj dorit pt test
        
        if($this->scut_activ){
            $damage /= 2;   // daca e scutul activ, damage ul e injumatatit
        }
        
        if(!$this->noroc['areNoroc']){ // daca nu are noroc
            $this->update_health($damage);   // va lua damage
        }

        console_log($this->scut_activ ? "$this->nume si-a activat Scutul Fermecat!" : 'Scut Fermecat inactiv...');
        // console_log("$this->nume is taking damage: -$damage");
        $this->logStats();
    }
    
    private function scutul_fermecat($value = 20){
        
        if(sansa_procentaj($value)){
            $this->scut_activ = true;
        } else {
            $this->scut_activ = false;
        }

    }
    
    private function forta_dragonului($value = 10){
        
        if(sansa_procentaj($value)){
            $this->putere *= 2;
            // console_log("$this->nume a activat Forta Dragonului!");
            // console_log("putere dupa activare Forta Dragonului $this->putere");
        }

    }

    public function attack($oponent){
        // console_log("$this->nume is attacking $oponent->nume");
        $this->logStats();

        $this->forta_dragonului(); // incercare activare forta dragonului

        $oponent->defend($oponent);
    }
}

// === Character Functions === //

$STANCES = ['attacker', 'defender'];

function define_stance($character1, $character2) {
    
    global $STANCES;

    if ($character1->viteza !== $character2->viteza) {
        
        if($character1->viteza > $character2->viteza){
            $character1->stance = $STANCES[0];
            $character2->stance = $STANCES[1];
        } else {
            $character1->stance = $STANCES[1];
            $character2->stance = $STANCES[0];
        }
    } else {
        if($character1->valoareNoroc > $character2->valoareNoroc){
            $character1->stance = $STANCES[0];
            $character2->stance = $STANCES[1];
        } else {
            $character1->stance = $STANCES[1];
            $character2->stance = $STANCES[0];
        }
    }

}

function switch_stance($character1, $character2) {
    $STANCES = ['attacker', 'defender'];
    
    if($character1->stance === 'attacker'){
        $character1->stance = $STANCES[1];
        $character2->stance = $STANCES[0];
    } else {
        $character1->stance = $STANCES[0];
        $character2->stance = $STANCES[1];
    }

}

// === Display functions ==== //

// update display variable to show stats for each round
function update_display($character1, $character2){
    global $display_result, $character1_display, $character2_display;
    
    array_push($display_result, $character1, $character2);
    console_log($display_result);

    $areNoroc1 = $character1->noroc['areNoroc'] ? 'DA' : 'NU';
    $valoareNoroc1 = $character1->noroc['valoareNoroc'];

    $obj_display1 = [
        $character1->nume,
        $character1->stance,
        $character1->viata,
        $character1->viteza,
        $character1->putere,
        $character1->aparare,
        $areNoroc1,
        $valoareNoroc2,
    ];

    

    $areNoroc2 = $character2->noroc['areNoroc'] ? 'DA' : 'NU';
    $valoareNoroc2 = $character2->noroc['valoareNoroc'];

    $obj_display2 = [
        $character2->nume,
        $character2->stance,
        $character2->viata,
        $character2->viteza,
        $character2->putere,
        $character2->aparare,
        $areNoroc2,
        $valoareNoroc2
    ];

    array_push($character1_display, $obj_display1);
    array_push($character2_display, $obj_display2);
}


// === Gameplay Functions === //


function _round($character1, $character2){

    if($character1->stance === 'attacker'){
        $character1->attack($character2);
    } else {
        $character2->attack($character1);
    }

    $character1->update_noroc();
    $character2->update_noroc();
    update_display($character1, $character2);
    switch_stance($character1, $character2);
}

function fight($character1, $character2){
    
    global $winner;
    
    $round_count = 1;
    
    
    while($round_count <= 20 && ($character1->viata && $character2->viata)){

        _round($character1, $character2);
        $round_count++;
    }
    
    $winner = $character1->viata > $character2->viata ? $character1->nume : $character2->nume;
    console_log("::: WINNER IS $winner ::::");
}



// === Inital Setup === 


$beast = new Character('Beast', rand(55, 80), rand(50, 80), rand(35, 55), rand(40, 60), areNoroc(25, 40));
$carl = new Hero('Carl', rand(65, 95), rand(60, 70), rand(40, 50), rand(40, 50), areNoroc(10, 30));

define_stance($beast, $carl);
$display_result = [];
$character1_display = [];
$character2_display = [];
$winner = '';
fight($beast, $carl);

?>






