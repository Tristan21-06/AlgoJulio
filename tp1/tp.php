<?php

/*    
answer = Random(0, 100)
tentatives = 0
Faire{
    Afficher(Devinez le nombre : )
    Lire(guess)
    Si(answer > guess) alors {
        Afficher(Plus grand)
    } ou Si (answer < guess) {
        Afficher(Plus petit)
    }
    tentatives = tentatives +1
} Tant que (guess != answer)

Afficher(Bravo vous avez trouvé)
 */

$answer = rand(0, 100);
$guesses = 0;
do {
    $guess = readline("Devinez le nombre : ");
    if ($guess > $answer) {
        print("Plus petit\n");
    } else if ($guess < $answer) {
        print("Plus grand\n");
    }
    $guesses++;
} while($guess != $answer);

print("Bravo vous avez trouvé en $guesses tentatives\n");

?>