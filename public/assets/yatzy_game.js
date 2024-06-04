import {rollDice} from './dice.js';

const values = [0,0,0,0,0];

function turn() {
    let roll = 0;
    for (let x = 0; x < values.length; x++) {
        values[x] = rollDice();
        roll += 1;
    }

    console.log(values)

}

turn();
