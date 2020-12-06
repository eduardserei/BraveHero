
class Character{
    stance;
    constructor(
        nume,
        viata = 100, 
        putere = 100, 
        aparare = 100, 
        viteza = 100, 
        noroc = {
            areNoroc: false,
            valoareNoroc: 0
        }
        
        ){
        this.nume = nume;
        this.viata = viata;
        this.putere = putere;
        this.aparare = aparare;
        this.viteza = viteza;
        this.noroc = noroc;

    }

    updateNoroc(){

        if(sansaProcentaj(this.noroc.valoareNoroc)){
            this.noroc.areNoroc = true
            checkDisplayMiss(this);
            return;
        }

        this.noroc.areNoroc = false
        updateNorocText(this)   

    }

    updateHealth(damage){
        if (this.viata - damage < 0) {
            
            console.log(`${this.nume} update health 1`);
            return this.viata = 0
        }
        if (this.viata - damage > 100) {
            
            console.log(`${this.nume} update health 2`);
            return this.viata = 100
        } else {
            
            console.log(`${this.nume} update health 3 ${damage}`);
            return this.viata -= damage
        }
    }

    takeDamage(oponent){
        const damage = oponent.putere - this.aparare;

        if(!this.noroc.areNoroc){ // daca nu are noroc
            this.updateHealth(damage) // va lua damage
        }

        updateDisplay(this, damage) // daca are noroc, se va afisa bkg color yellow
        console.log(`${oponent.nume} attacks ${this.nume};
                    ${this.nume} viata: ${this.viata}
                    damage taken: ${-damage}
                    putere: ${this.putere}
                    aparare: ${this.aparare}
                    viteza: ${this.viteza}
                    areNoroc: ${this.noroc.areNoroc}
                    valoareNoroc: ${this.noroc.valoareNoroc}
                    `)
    }
    
    attack(oponent){
        console.log(`${this.nume} attack`);
        
        oponent.defend(this) // oponent defends my attack 
    }

    defend(oponent){
        console.log(`${this.nume} defend`);
        this.takeDamage(oponent) // take damage from oponent 
    }

}

class Hero extends Character{

    scutActiv = false;
    
    fortaDragonului(value = 10){
        if(sansaProcentaj(value)){     // comment this out to test for FortaDragonului and // DEFAULT
        // if(sansaProcentaj(98)){ // uncomment this 

            document.querySelector('#dragon').style.filter = 'opacity(1)'
            this.putere *= 2;
        }
    }
    
    scutulFermecat(value = 20){
        if(sansaProcentaj(value)){  // comment this out to test for Scutul Fermecat and // DEFAULT
        // if(sansaProcentaj(98)){  // uncomment this
            document.querySelector('#scut').style.filter = 'opacity(1)' // display shield
            this.scutActiv = true;
        } else {
            this.scutActiv = false;
        }
    }

    attack(oponent){
        document.querySelector('#scut').style.filter = 'opacity(0)' // remove shield if displayed
        this.fortaDragonului() // check for doubling power when attacking
        oponent.defend(this) // oponent defends my attack 
        console.log(`${this.nume} attack`);
    }

    defend(oponent){
         // check for halfing oponent damage on attack
        this.takeDamage(oponent, this.scutActiv) // take damage when attacked
        console.log(`${this.nume} defend`);
    }

    takeDamage(oponent, scutActiv){
        
        let damage = oponent.putere - this.aparare;   // default damage calculation
        document.querySelector('#dragon').style.filter = 'opacity(0)' // remove dragon if displayed
        this.scutulFermecat() // incearca activarea scutului
        if(scutActiv){
            damage = (oponent.putere - this.aparare) / 2  // if shield is active, take half damage
        }
        console.log(`scut ${scutActiv}`);

        if(!this.noroc.areNoroc){ // daca nu are noroc
            this.updateHealth(damage) // va lua damage
        }

        updateDisplay(this, damage)
        console.log(`${oponent.nume} attacks ${this.nume};
        ${this.nume} viata: ${this.viata}
        damage taken: ${-damage}
        putere: ${this.putere}
        aparare: ${this.aparare}
        viteza: ${this.viteza}
        areNoroc: ${this.noroc.areNoroc}
        valoareNoroc: ${this.noroc.valoareNoroc}
        `)
    }


}

// ===== Functii Caractere ===== //

function areNoroc(value) {

    const sansaNoroc = sansaProcentaj(value);
    const valoareNoroc = value;
    const areNoroc = valoareNoroc === 1; 
    return { areNoroc, valoareNoroc };
    
}

function updateDisplay(character, damage) {
    showDamage(character, damage) // show damage taken
    updateHealthBar(character) // update health bar
    checkDisplayMiss(character)// update background color if missed
}


// ===== Functii calcule ===== //

function checkNumIsInRange(lowestNumber, highestNumber, valueToCheck){
    return lowestNumber <= valueToCheck && highestNumber >= valueToCheck
}

function sansaProcentaj(procentajSansa){
    if(procentajSansa || procentajSansa === 0){

        if(!checkNumIsInRange(0, 100, procentajSansa)){
            console.error("ERROR! Va rog inserati valoarea procentajului intre 0 si 100")
            return "ERROR! Va rog inserati valoarea procentajului intre 0 si 100";
        }

        const result = Math.floor(Math.random() * ( 100 - procentajSansa ) + 1)

        return result === 1;
        
    } else {
    console.error("ERROR! Va rog inserati valoarea procentajului")
    return "ERROR! Va rog inserati valoarea procentajului";
    }
}

function randomNumInRange(lowestNumber, highestNumber){

    if((typeof lowestNumber === 'number' && typeof highestNumber === 'number')){
        return Math.floor(Math.random() * ( highestNumber - lowestNumber ) + lowestNumber);
    } else {
        console.error("EROARE! Va rog introduceti atat < cel mai mic numar > cat si < cel mai mare numar > ca si argumente pentru functia randomNumInRange")
        return "";
    } 
}

// ====== Functii Display ===== //


function stancesFlash(character1, character2) {
    if(!(character1 && character2)) return 'Pls inserati atacator si aparator ca argumente ale functiei action flashes'
    let atacator;
    let aparator;
    if(character1.stance === STANCES[0]){
        atacator = character1;
        aparator = character2;
    } else {
        atacator = character2;
        aparator = character1;
    }
    const atacatorImage = document.querySelector(`#${atacator.nume.toLowerCase()}`)
    const aparatorImage = document.querySelector(`#${aparator.nume.toLowerCase()}`)

    atacatorImage.classList.add('attack'); 
    atacatorImage.classList.remove('defend'); 
    atacatorImage.classList.remove('miss'); 
    
    aparatorImage.classList.add('defend');
    aparatorImage.classList.remove('attack');
    checkDisplayMiss(aparator);
    
}

function checkDisplayMiss(character) {

    updateNorocText(character)

    if(character && character.noroc.areNoroc){

        // update miss background color yellow
        // document.querySelector(`#${character.nume.toLowerCase()}`).classList.remove('attack'); 
        document.querySelector(`#${character.nume.toLowerCase()}`).classList.remove('defend'); 
        document.querySelector(`#${character.nume.toLowerCase()}`).classList.add('miss'); 
    }
}

function showDamage(aparator, damage = 0) {
    const damageDisplay = document.querySelector(`#${aparator.nume.toLowerCase()}-damage`)
    damageDisplay.innerText = -damage;
}

function readyFight() {
    const counter = document.querySelector('.counter');
    counter.innerText = 'Ready?'
    setTimeout(() => {
        counter.innerText = 'FIGHT!'
    }, 1000);
}

function statsDisplay(character) {
    updateHealthBar(character)
    document.querySelector(`.${character.nume.toLowerCase()}-putere`).innerText = character.putere;
    document.querySelector(`.${character.nume.toLowerCase()}-aparare`).innerText = character.aparare;
    document.querySelector(`.${character.nume.toLowerCase()}-viteza`).innerText = character.viteza;
    updateNorocText(character)
    document.querySelector(`.${character.nume.toLowerCase()}-valoareNoroc`).innerText = character.noroc.valoareNoroc;    

}

function updateNorocText(character) {
    document.querySelector(`.${character.nume.toLowerCase()}-areNoroc`).innerText = character.noroc.areNoroc ? 'DA' : 'NU';    
}

function updateHealthBar(character) {
    const characterHealthBar = document.querySelector(`.health-bar__${character.nume.toLowerCase()}`)
    const characterHealthText = document.querySelector(`.health-bar__${character.nume.toLowerCase()}__health`)
    
    characterHealthBar.style.transform = `scaleX(${character.viata / 100})`
    characterHealthText.innerText = `${character.viata}`

    // console.log(`character.viata from updateHealthBar:  ${character.nume} ${character.viata}`); 
}

function showWinner(character1, character2){
    const winner = document.querySelector('#winner')
    
    if(character1.viata > character2.viata){
        winner.innerText = character1.nume
    } else {
        winner.innerText = character2.nume
    }
    winner.classList.add('flashWinner');
}

// ===== Initializare valori caractere ===== //

    // DEFAULT - uncomment from here to Test for 20 rounds for testing purposes
const carl = new Hero(
    'Carl',                    // Nume
    randomNumInRange(65, 95),  // Viata
    randomNumInRange(60, 70),  // Putere
    randomNumInRange(40, 50),  // Aparare
    randomNumInRange(40, 50),  // Viteza
    areNoroc(randomNumInRange(10, 30))  // Noroc 
)

const beast = new Character(
    'Beast',                   // Nume             
    randomNumInRange(55, 80),  // Viata
    randomNumInRange(50, 80),  // Putere
    randomNumInRange(35, 55),  // Aparare
    randomNumInRange(40, 60),  // Viteza
    areNoroc(randomNumInRange(25, 40))  // Noroc
)

    // --- Test for 20 rounds --- //

    // const carl = new Hero(
    //     'Carl', // Nume
    //     100,  // Viata
    //     100,  // Putere
    //     100,  // Aparare
    //     100,  // Viteza  // carl attacks first if 98
    //     areNoroc(randomNumInRange(10, 30))  // Noroc //comment out and match Viteza carl === Viteza beast -- check for noroc first attack
    //     // { areNoroc: false, valoareNoroc: 99 } // uncomment to check first attack
    // )
    
    // const beast = new Character(
    //     'Beast', // Nume             
    //     100,  // Viata
    //     99,  // Putere
    //     99,  // Aparare
    //     100,  // Viteza         // change to 100 to make beast attack first 
    //     areNoroc(randomNumInRange(25, 40))  // Noroc //comment out and match Viteza carl === Viteza beast -- check for noroc first attack
    //     // { areNoroc: false, valoareNoroc: 100 } // uncomment to check first attack
    // )

// ---- Initializare Valori Display ---- //
statsDisplay(carl);
statsDisplay(beast);
    
// ==== GAMEPLAY === //


const STANCES = ['attacker', 'defender'];

function defineStance(character1, character2) {

    if (character1.viteza !== character2.viteza) {
        if(character1.viteza > character2.viteza){
            character1.stance = STANCES[0];
            character2.stance = STANCES[1];
        } else {
            character1.stance = STANCES[1];
            character2.stance = STANCES[0];
        }
    } else {
        if(character1.valoareNoroc > character2.valoareNoroc){
            character1.stance = STANCES[0];
            character2.stance = STANCES[1];
        } else {
            character1.stance = STANCES[1];
            character2.stance = STANCES[0];
        }
    }

    stancesFlash(character1, character2) // display
}

function switchStance(character1, character2) {
    if(character1.stance === 'attacker'){
        character1.stance = STANCES[1]
        character2.stance = STANCES[0]
    } else {
        character1.stance = STANCES[0]
        character2.stance = STANCES[1]
    }

    stancesFlash(character1, character2) // display
}

function round(character1, character2) {
    if(character1.stance === 'attacker'){
        character1.attack(character2)
    } else {
        character2.attack(character1)
    }

    character1.updateNoroc()
    character2.updateNoroc()
    switchStance(character1, character2)
}

function fight() {

    function checkGameOver(character1, character2) {
        if(roundCount === 20 || character1.viata <= 0 || character2.viata <= 0){
            clearInterval(intervalKey);
            showWinner(character1, character2)
        }
    }
    
    let roundCount = 0;

    readyFight() 
    defineStance(carl, beast);

    const intervalKey = setInterval(() => {
        roundCount++;
        document.querySelector('#round').innerText = roundCount;
        
        round(carl, beast);
        checkGameOver(carl, beast);
    }, 1500); // round duration miliseconds

}