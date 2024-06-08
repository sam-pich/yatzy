class yatzyGame {
  constructor() {
    this.rollCounter = 0;
    this.diceValue = [0, 0, 0, 0, 0]; // five dices, init at 0
    this.rerollBool = [false, false, false, false, false];
  }

  // if rolls are less than 3 then for every 5 dice roll them all and update array
  rollDice() {
    if (this.rollCounter < 3) {
      for (let i = 0; i < 5; i++) {
        if (!this.rerollBool[i]) {
          this.diceValue[i] = Math.floor(Math.random() * 6) + 1;
        }
      }
      this.rollCounter++;
    }
  }

  rerollDie(x) {
    if (x >= 0 && x < 5) {
      this.rerollBool[x] = !this.rerollBool[x];
    }
  }

  turnReset() {
    this.rollCounter = 0;
    this.diceValue = [0, 0, 0, 0, 0]; // five dices, init at 0
    this.rerollBool = [false, false, false, false, false];
  }
}

