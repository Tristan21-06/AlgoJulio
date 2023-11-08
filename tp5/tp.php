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

// récupère les mots depuis le fichier disponible sur internet
$ch = curl_init("https://openlexicon.fr/datasets-info/Liste-de-mots-francais-Gutenberg/liste.de.mots.francais.frgut.txt");

curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$allWords = curl_exec($ch);

curl_close($ch);

// sépare par saut de ligne dans un tableau
$allWords = preg_split('/\r\n|\r|\n/', $allWords);
// récupère un index du tableau au hasard
$indexWord = rand(0, count($allWords)-1);

//enlève les accent ou les caractères spéciaux des accents
$word = $allWords[$indexWord];
$word = utf8_decode($word); // dépréciée mais marche encore pour l'instant
$word = str_replace('?', '', $word);

// maximum d'essais
$maxTries = 10;

// sépare le mot dans un tableau de caractère
$wordArray = str_split($word);
// tableau de "_" avec autant d'éléments que de lettre dans le mot
$attemptsArray = array();
// tableau de booléen avec autant de booléen que de lettre dans le mot qui précise si la lettre est trouvée ou non
$foundLetter = array();
// assignation des valeurs des tableaux
for ($i = 0; $i < count($wordArray); $i++) {
    $attemptsArray[$i] = "_";
    $foundLetter[$i] = false;
}

// booléen qui dit si le mot à été trouvé
$foundWord = false;
// boucle pour trouver le mot
while (!$foundWord && $maxTries > 0) {
    // booléen qui est utilisé si jamais l'utilisateur fait une erreur de proposition
    $noError = false;
    $try = readline("Proposer une lettre : ");

    foreach ( $wordArray as $key => $letter ) {
        // booléen qui prévient si il a déjà fait la proposition de lettre
        $alreadyFound = $foundLetter[$key];
        // si c'est la bonne lettre, l'ajoute au tableau à l'endroit prévu et set true dans le tableau de booléen à l'index de la lettre
        if ($letter == $try){
            $attemptsArray[$key] = $letter;
            $foundLetter[$key] = true;
        }
        //test si l'utilisateur a fait une erreur
        $noError = $noError || $letter == $try;
        // si il a déjà proposé la lettre, force le booléen a être false
        if ($alreadyFound && $letter == $try) {
            $noError = false;
        }
    }

    //booléen qui définit si l'utilisateur a trouvé toutes les lettres
    $allLetters = true;
    // boucle sur tous les élément du tableau de booléen foundLetter pour savoir si toutes les lettres on été trouvées
    foreach ($foundLetter as $found){
        $allLetters = $allLetters && $found;
    }

    // si noError est true, baisse le nombre de tentatives disponible, sinon affiche le statut de ce qui a été trouvé
    if (!$noError){
        $maxTries--;
        print("Il vous reste $maxTries essais. Voici ce que vous avez trouvé : " . join(' ', $attemptsArray) . " (" . count($attemptsArray) . " lettres)\n");
    }else{
        print("Voici ce que vous avez trouvé : " . join(' ', $attemptsArray) . " (" . count($attemptsArray) . " lettres)\n");
    }

    // change la valeur de foundWord si toutes les lettres ont été trouvéess
    $foundWord = $allLetters;
}

// si la boucle s'arrête quand l'utilisateur a trouvé le mot, affiche vous avez gagné. sinon c'est le nombre de tentatives qui est à 0
if ($foundWord) {
    print("Vous avez gagné ! Le mot était $word\n");
} else {
    print("Vous avez perdu ! le mot était $word\n");
}

?>