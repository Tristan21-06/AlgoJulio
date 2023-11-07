<?php

/*  
alphabetUp = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
alphabetLow = "abcdefghijklmnopqrstuvwxyz";

low = toArray(alphabetLow)
up = toArray(alphabetUp)

Faire {
    Afficher(0 - arreter )
    Afficher(1 - chiffrer )
    Afficher(2 - déchiffrer )
    Lire(choix)

    switch(choix){
        case 1 :
            Afficher(chaine a chiffrer)
            Lire(chaine)
            Afficher(pas pour chiffrer)
            Lire(pas)

            tab = toArray(chaine)

            Pour chaque (tab en tant que (clé, el)) {
                Si(el == tolowercase(el)) alors {
                    index = trouve dans tableau (el, low) +1
                    target = ($index+pas)%26-1;
                    tab[clé] = low[target];
                }else{
                    index = trouve dans tableau (el, up) +1
                    target = (index+pas)%26-1;
                    tab[clé] = low[target];
                }
            }

            newchaine = toString(tab)
            Afficher(Chaine chiffrée : <newchaine>)

        case 2 :
            Afficher(chaine a déchiffrer)
            Lire(chaine)
            Afficher(pas pour déchiffrer)
            Lire(pas)

            tab = toArray(chaine)

            Pour chaque (tab en tant que (clé, el)) {
                Si (el == tolowercase(el)) alors {
                    index = array_search(el, low)+1;
                    target = (index-pas)-1;

                    Si (target < 0){
                        target = 26 - abs(target);
                    }

                    tab[clé] = low[target];
                } else {
                    index = array_search(el, up)+1;
                    target = (index-pas)-1;

                    Si (target < 0) alors {
                        target = 26 - abs(target);
                    }

                    tab[clé] = up[target];
                }
            }

            newchaine = toString(tab)
            Afficher(Chaine déchiffrée : <newchaine>)
        default :
            Afficher(Arret du programme)
            break
    }
} Tant que (choix != 0)
 */

$alphabetUp = "ABCDEFGHIJKLMNOPKRSTUVWXYZ";
$alphabetLow = "abcdefghijklmnopqrstuvwxyz";

$low = str_split($alphabetLow);
$up = str_split($alphabetUp);

do {
    print("0 - Arrêt du programme\n");
    print("1 - Chiffrer\n");
    print("2 - Déchiffrer\n");
    $choice = readline('Votre choix : ');

    switch ($choice) {
        case 1:
            $string = readline('Chaîne à chiffrer : ');
            $pace = readline('Pas pour chiffrer : ');

            $tab = str_split($string);

            foreach ($tab as $key => $el) {
                if ($el == strtolower($el)) {
                    $index = array_search($el, $low)+1;
                    $target = ($index+$pace)%26-1;
                    $tab[$key] = $low[$target];
                } else {
                    $index = array_search($el, $up)+1;
                    $target = ($index+$pace)%26-1;
                    $tab[$key] = $up[$target];
                }
            }

            $newchaine = join($tab);
            print("Chaine chiffrée : $newchaine\n");

            break;
        case 2:
            $string = readline('Chaîne à déchiffrer : ');
            $pace = readline('Pas pour déchiffrer : ');

            $tab = str_split($string);

            foreach ($tab as $key => $el) {
                if ($el == strtolower($el)) {
                    $index = array_search($el, $low)+1;
                    $target = ($index-$pace)-1;

                    if($target < 0){
                        $target = 26 - abs($target);
                    }

                    $tab[$key] = $low[$target];
                } else {
                    $index = array_search($el, $up)+1;
                    $target = ($index-$pace)-1;

                    if($target < 0){
                        $target = 26 - abs($target);
                    }

                    $tab[$key] = $up[$target];
                }
            }

            $newchaine = join($tab);
            print("Chaine déchiffrée : $newchaine\n");
            
            break;
        default:
            print("Arrêt du programme");
            break;
    }

} while($choice != 0);

?>