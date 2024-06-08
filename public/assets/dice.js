// five dice, so function to roll each one and store results
function rollDice(numDice) {
  let results = [];
  for (let i = 0; i < numDice; i++) {
    results.push(Math.floor(Math.random() * 6) + 1);
  }

  return results;
}

