function rollDice() {
    const diceNumber = Math.floor(Math.random() * 6) + 1;
    return diceNumber;
}

export {rollDice};