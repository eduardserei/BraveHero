<?php include 'classes.php';?>

<?php
$beast = new Character('Beast', rand(55, 80), rand(50, 80), rand(35, 55), rand(40, 60), areNoroc(25, 40));
$carl = new Hero('Carl', rand(65, 95), rand(60, 70), rand(40, 50), rand(40, 50), areNoroc(10, 30));

$STANCES = ['attacker', 'defender'];

function define_stance($character1, $character2) {

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

?>