class User {
    constructor(pass, nume){
        this.pass = pass;
        this.nume = nume;
    }

    static ceva(){
        console.log('caca');
    }

    static add(a, b){
        return a + b;
    }

    polyMorph(){
        console.log('I am User');
    }
}

class Person extends User{
    #watchPorn;
    constructor(pass, nume, toSet){

        super(pass, nume);
        this.toSet = toSet;
        this.#watchPorn = true;
    }
    
    static altceva(){
        return super.ceva();
    }

    get porn(){
        console.log(this.#watchPorn);
    }

    set porn(yeah){
        if(yeah === 'change'){
            this.#watchPorn = !this.#watchPorn;
        }
    }

    // POLYMORPHISM
    polyMorph(){
        super.polyMorph();
        console.log('I am Person');
    }

}


const filip = new User('Filip', 'iostiu');
const edy = new Person('bubu', 'altu', 5);

filip.polyMorph();
edy.polyMorph();
// edy.porn; // getter use
// edy.porn = 20 // setter use
// edy.porn = 'change';
// edy.porn; // getter use
// edy.porn = 'change';
// edy.porn;

// Person.ceva(); // static methods are on class
// Person.altceva(); // cannot be accessed from instance

// console.log(
//     User.add(1, 2),
// );
