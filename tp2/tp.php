<?php

/*  
answer = Random(0, 100)
IATab = ['min' => 0, 'max' => 100]
tentatives = 0
Faire{
    Si(tentatives%2 == 0) alors {
        Afficher(Devinez le nombre : )
        Lire(guess)
        player = "utilisateur"
    } Sinon {
        guess = Random(IATab[min]+1, IATab[max])
        player = "ordinateur"
    }

    Afficher(L'<player> rentré est <guess>)

    Si(answer > guess) alors {
        Afficher(Plus grand)
        IATab['min'] = guess
    } ou Si (answer < guess) {
        Afficher(Plus petit)
        IATab['max'] = guess
    }
    tentatives = tentatives +1
} Tant que (guess != answer)

Afficher(L'<winner> a trouvé en <tentatives> tentatives)
 */

$min = 1;
$max = 100;

$answer = rand($min, $max);
$iaTab = array('min' => $min, 'max' => $max);
$guesses = 0;
do {
    if ($guesses%2 == 0) {
        $guess = readline("Devinez le nombre : ");
        $player = 'utilisateur';
    } else {
        $guess = rand($iaTab['min'], $iaTab['max']);
        $player = 'ordinateur';
    }

    print("L'$player rentré est $guess\n");

    if ($guess > $answer) {
        print("Plus petit\n");
        if($iaTab['max'] > $guess){
            $iaTab['max'] = $guess;
        }
    } else if ($guess < $answer) {
        print("Plus grand\n");
        if($iaTab['min'] < $guess){
            $iaTab['min'] = $guess+1;
        }
    }
    $guesses++;
} while($guess != $answer);

$guesses = $guesses/2;
print("L'$player trouvé en $guesses tentatives\n");

?>