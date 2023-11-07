<?php

/*
maxTentatives = 10

Afficher(Choisir un mot)
Lire(mot)

motTab = toArray(mot)
tentativeTab = array
trouveLettre = array
Pour ( i = 0 ; i < taille(motTab) ; i++ ) {
    tentativeTab[i] = '_'
    trouveLettre[i] = False
}

motTrouve = False
Tant que ( not motTrouve ET maxTentatives > 0) {
    pasErreur = False
    Afficher(Proposez une lettre : )
    Lire(tentative)
    Pour chaque ( motTab en tant que (clé, lettre) ) {
        dejaTrouvé = trouveLettre[clé]
        Si (lettre == tentative) alors{
            tentativeTab[clé] = lettre
            trouveLettre[clé] = True
        }
        pasErreur = pasErreur OU lettre == tentative
        Si (dejaTrouvé) alors {
            pasErreur = False
        }
    }

    touteLettres = true
    Pour chaque (trouveLettre en tant que trouve){
        touteLettres = touteLettres ET trouve
    }

    if (!pasErreur){
        maxTentatives--
        Afficher(Il vous reste maxTentatives essais, voici ce que vous avez trouvé : join(motTab))
    } else {
        Afficher(Voici ce que vous avez trouvé : join(motTab))
    }

    motTrouve = touteLettres
}

Si (motTrouve) alors {
    Afficher("Vous avez gagné ! Le mot était " + mot)
} Sinon {
    Afficher("Vous avez perdu ! le mot était " + mot)
}

*/

header('Content-type: text/plain; charset=utf-8');

$ch = curl_init("https://openlexicon.fr/datasets-info/Liste-de-mots-francais-Gutenberg/liste.de.mots.francais.frgut.txt");

curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$allWords = curl_exec($ch);

curl_close($ch);

$allWords = preg_split('/\r\n|\r|\n/', $allWords);
$indexWord = rand(0, count($allWords)-1);

foreach ($allWords as $key => $word) {
    $word = utf8_decode($word);
    $word = str_replace('?', '', $word);
    $allWords[$key] = $word;
}

$maxTries = 10;

$word = $allWords[$indexWord];

$wordArray = str_split($word);
$attemptsArray = array();
$foundLetter = array();
for ($i = 0; $i < count($wordArray); $i++) {
    $attemptsArray[$i] = "_";
    $foundLetter[$i] = false;
}

$foundWord = false;
while (!$foundWord && $maxTries > 0) {
    $noError = false;
    $try = readline("Proposer une lettre : ");

    foreach ( $wordArray as $key => $letter ) {
        $alreadyFound = $foundLetter[$key];
        if ($letter == $try){
            $attemptsArray[$key] = $letter;
            $foundLetter[$key] = true;
        }
        $noError = $noError || $letter == $try;
        if($alreadyFound && $letter == $try){
            $noError = false;
        }
    }

    $allLetters = true;
    foreach ($foundLetter as $found){
        $allLetters = $allLetters && $found;
    }

    if (!$noError){
        $maxTries--;
        print("Il vous reste $maxTries essais. Voici ce que vous avez trouvé : " . join(' ', $attemptsArray) . " (" . count($attemptsArray) . " lettres)\n");
    }else{
        print("Voici ce que vous avez trouvé : " . join(' ', $attemptsArray) . " (" . count($attemptsArray) . " lettres)\n");
    }

    $foundWord = $allLetters;
}

if ($foundWord) {
    print("Vous avez gagné ! Le mot était $word\n");
} else {
    print("Vous avez perdu ! le mot était $word\n");
}

?>