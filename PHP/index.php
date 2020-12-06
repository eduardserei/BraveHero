
<?php include 'classes.php'; ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Brave Hero</title>
</head>

<body>
    
    <section class="scene container">
        <h1 class="title">CARL - VS - BEAST</h1>

        <h1 style="color: red; text-align: center;" class="counter">Get set!</h1>
        <h1 style="text-align: center;" class="winner-h1">Winner is <span id="winner">let's see who wins</span>!</h1>

        <div class="damage container">Damage: 
            <span id="carl-damage">0</span>
            <span style="float: right;" id="beast-damage">0</span>
        </div>
        <div class="health container">
            <div class="health-bar">
                <div class="health-bar__carl"></div>
                <div class="health-bar__middle"></div>
                <div class="health-bar__beast"></div>
                <p class="health-bar__carl__health">100</p>
                <p class="health-bar__beast__health">100</p>
            </div>
        </div>

        <div class="characters container">
            <div class="character container">
                <img id="carl" src="./assets/Carl.png" alt="" srcset="">
                <div class="carl-powers__container">
                    <img id="dragon" src="./assets/DragonForce.png" alt="">
                    <img id="scut" src="./assets/magicShield.png" alt="">
                </div>
                <h3 class="pun">I may be black but at least I can get a job!</h3>
                <button onclick="carl.attack(beast)">Ataca</button>
                <button onclick="carl.noroc.areNoroc = !carl.noroc.areNoroc">Make Me Lucky</button>
                <button onclick="carl.fortaDragonului(100)">Activeaza Forta Dragonului</button>
                <button onclick="carl.scutulFermecat(100)">Activeaza Scutul Fermecat</button>


                <div class="carl stats">
                    <div >Putere: <span class="carl-putere"><?php echo $carl->putere; ?></span></div>
                    <div >Aparare: <span class="carl-aparare"><?php echo $carl->aparare;?></span></div>
                    <div>Viteza: <span class="carl-viteza"><?php echo $carl->viteza; ?></span></div>
                    <div>Are Noroc? : <span class="carl-areNoroc"> <?php echo $carl->noroc['areNoroc']; ?></span></div>
                    <div>Valoare Noroc: <span class="carl-valoareNoroc"><?php echo $carl->noroc['valoareNoroc']; ?></span></div>
                </div>
            </div>

            <div class="display container">
                <h1> Round: <span id="round">1</span></h1>
                <div class="game-btns" >
                    <button onclick="fight()">FIGHT</button>
                    <button onclick="location.reload()">RELOAD</button>
                </div>

            </div>

            <div class="character container">
                <img id="beast" src="./assets/Beast.png" alt="" srcset="">
                <h3 class="pun">I may be blue, but I'll beat the crap out of you!</h3>
                <button onclick="beast.attack(carl)">Ataca</button>
                <button onclick="beast.noroc.areNoroc = !beast.noroc.areNoroc">Make Me Lucky</button>

                <div class="beast stats">
                    <div >Putere: <span class="beast-putere"><?php echo $beast->putere; ?></span></div>
                    <div >Aparare: <span class="beast-aparare"><?php echo $beast->aparare;?></span></div>
                    <div>Viteza: <span class="beast-viteza"><?php echo $beast->viteza; ?></span></div>
                    <div>Are Noroc? : <span class="beast-areNoroc"> <?php echo $beast->noroc['areNoroc']; ?></span></div>
                    <div>Valoare Noroc: <span class="beast-valoareNoroc"><?php echo $beast->noroc['valoareNoroc']; ?></span></div>
                </div>
            </div>


        </div>


    </section>

<script src="./refactor.js"></script>
</body>
</html> -->

<div class="stats-container" style="display: flex; justify-content: space-between">

    <div class="stats-container__beast" >
        <h1>Beast</h1>
        <?php foreach ($character1_display as $key => $value): ?>
                <h2>Round <?php echo $key + 1; ?> </h2>     
            <ul> 
                <li>Pozitie: <?php echo $value[1]; ?></li>
                <li>Viata: <?php echo $value[2]; ?></li>
                <li>Viteza: <?php echo $value[3]; ?></li>
                <li>Putere: <?php echo $value[4]; ?></li>
                <li>Aparare: <?php echo $value[5]; ?></li>
                <li>Are Noroc? <?php echo $value[6]; ?></li>
            </ul>
        <?php endforeach ?>
    </div>
    
    <h1>Winner is <span style="color: green"><?php echo $winner ?></span></h1>
    
    <div class="stats-container__carl">
            <h1>Carl</h1>
        <?php foreach ($character2_display as $key => $value): ?>
            <h2>Round <?php echo $key + 1; ?> </h2> 
            <ul> 
                <li>Pozitie: <?php echo $value[1]; ?></li>
                <li>Viata: <?php echo $value[2]; ?></li>
                <li>Viteza: <?php echo $value[3]; ?></li>
                <li>Putere: <?php echo $value[4]; ?></li>
                <li>Aparare: <?php echo $value[5]; ?></li>
                <li>Are Noroc? <?php echo $value[6]; ?></li>
            </ul>
        <?php endforeach ?>
    </div>

</div>

