function score(diceValue) {
  return diceValue.filter((value) => value === 1).length;
}

function score_two(diceValue) {
  return diceValue.filter((value) => value === 2).length * 2;
}

function updateScore(game, scores) {
  let counter = 0;

  switch (scores) {
    case "ones":
      counter = score(game.diceValue);
      break;
    case "twos":
      counter = score_two(game.diceValue);
      break;
  }
  game.counter += counter;
}

