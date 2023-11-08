<?php

//score pour carre, brelan et full
/* Algo fonction categoryComplex
    fonction calculCategorie(tabDesAGarder, taillesAutorisée, categorieChoisie) {
        score = 0
        tabDes = array
        Pour chaque (tabDesAGarder en tant que de) {
            ajoutTab = filtrer($tabDesAGarder, element == de)
            Si (!inArray(ajoutTab, tabDes)) alors {
                tabDes[] = ajoutTab
            }
        }

        estCategorie = true
        Pour chaque (tabDes en tant que tab) {
            estCategorie = estCategorie && InArray(taille(tab), taillesAutorisée)
        }

        Si (estCategorie) alors {
            Si (categorieChoisie == "Brelan" OU categorieChoisie == "Carre") alors {
                Si (categorieChoisie == "Brelan") alors {
                    nbAutorise = 3
                } Sinon {
                    nbAutorise = 4
                }
                Pour chaque (tabDes en tant que tab) {
                    Si (taille(tab) >= nbAutorise) alors {
                        Pour chaque (tab en tant que de) {
                            score += de
                        }
                    }
                }
            } Sinon Si (categorieChoisie == "Full") alors {
                score = 25
            }
        }

        retourner score
    }
*/
function categoryComplex($dices, $countAllowed, $category){
    $score = 0;
    $diceArrays = array();
    foreach ($dices as $dice) {
        $addArray = array_filter($dices, function($v) use ($dice) {
             return $v == $dice ;
        });
        if (!in_array($addArray, $diceArrays)) {
            $diceArrays[] = $addArray;
        }
    }

    $isCategory = true;
    foreach ($diceArrays as $array) {
        $isCategory = $isCategory && in_array(count($array), $countAllowed);
    }

    if ($isCategory) {
        if ($category == 'Brelan' || $category == 'Carre') {
            if ($category == 'Brelan') {
                $nbAllowed = 3;
            } else {
                $nbAllowed = 4;
            }
            foreach ($diceArrays as $array) {
                if (count($array) >= $nbAllowed) {
                    foreach ($array as $dice) {
                        $score += $dice;
                    }
                }
            }
        } else if ($category == 'Full') {
            $score = 25;
        }
    }

    return $score;
}

//retourne la valeur de la fonction categoryComplex
/* Algo fonction brelan
    fonction brelan (tabDesAGarder, categorieChoisie) {
        taillesAutorisée = array(3,1)

        retourner calculCategorie(tabDesAGarder, taillesAutorisée, categorieChoisie)
    }
*/
function brelan($dices, $category){
    $countAllowed = array(3,1);

    return categoryComplex($dices, $countAllowed, $category);
}

//retourne la valeur de la fonction categoryComplex
/* Algo fonction carre
    fonction carre (tabDesAGarder, categorieChoisie) {
        taillesAutorisée = array(4,1)

        retourner calculCategorie(tabDesAGarder, taillesAutorisée, categorieChoisie)
    }
*/
function carre($dices, $category){
    $countAllowed = array(4,1);

    return categoryComplex($dices, $countAllowed, $category);
}

//retourne la valeur de la fonction categoryComplex
/* Algo fonction full
    fonction full (tabDesAGarder, categorieChoisie) {
        taillesAutorisée = array(3,2)

        retourner calculCategorie(tabDesAGarder, taillesAutorisée, categorieChoisie)
    }
*/
function full($dices, $category){
    $countAllowed = array(3,2);

    return categoryComplex($dices, $countAllowed, $category);
}

//score pour petite suite
/* Algo fonction petitesuite
    fonction petitesuite (tabDesAGarder, categorieChoisie) {
        score = 0
        Si (taille(uniques(tabDesAGarder)) >= 4) alors {
            score = 30
        }

        retourner score
    }
*/
function petitesuite($dices, $category){
    $score = 0;
    if (count(array_unique($dices)) >= 4) {
        $score = 30;
    }

    return $score;
}

//score pour grande suite
/* Algo fonction grandesuite
    fonction grandesuite (tabDesAGarder, categorieChoisie) {
        score = 0
        Si (taille(uniques(tabDesAGarder)) == 5) alors {
            score = 40
        }

        retourner score
    }
*/
function grandesuite($dices, $category){
    $score = 0;
    if (count(array_unique($dices)) == 5) {
        $score = 40;
    }

    return $score;
}

//score pour yams
/* Algo fonction yams
    fonction yams (tabDesAGarder, categorieChoisie) {
        score = 0
        Si (taille(uniques(tabDesAGarder)) == 1) alors {
            score = 50
        }

        retourner score
    }
*/
function yams($dices, $category){
    $score = 0;
    if (count(array_unique($dices)) == 1) {
        $score = 50;
    }

    return $score;
}

// score pour chance ou cases 1,2,3,4,5,6
/* Algo fonction other
    fonction autres (tabDesAGarder, categorieChoisie) {
        score = 0
        chance = categorie == 'Chance'
        Pour chaque (tabDesAGarder en tant que de) {
            Si (de == categorie OU chance) alors {
                score += de
            }
        }

        retourner score
    }
*/
function other($dices, $category){
    $score = 0;
    $chance = $category == 'Chance';
    foreach ($dices as $dice) {
        if ($dice == $category || $chance) {
            $score += $dice;
        }
    }

    return $score;
}


/* Algo programme de base
    grille = array
    catégorie = array(...)

    Pour (tour = 1 ; tour <= 13 ; tour++){
        Afficher(Tour n°<tour>)
        lancers = 0

        listedes = ''
        tabDesAGarder = array

        premierLancer = true

        Faire{
            Si(queDesChiffres(listedes) OU premierLancer OU taille(listedes) < 1) alors {
                tabListedes = filtrer(séparer(listedes))
                Pour chaque (tabListedes en tant que de) {
                    tabDesAGarder[] = des[de-1]
                }

                des = array;
                Pour (i = 0 ; i < 5 - taille(tabDesAGarder) ; i++) {
                    des[i] = Random(1, 6)
                }

                Afficher(Résultat des dés : <des>)
                lancers++
                Si (lancers < 3) alors {
                    Afficher (1,2,3,4,5 ou all pour tout garder. Par exemple, 134 garde le dé 1, 3 et 4.)
                    Afficher (Lancer <lancers> - Quels dés voulez-vous garder ? )
                    Lire(listedes)
                } Sinon {
                    Pour chaque (des en tant que de) {
                        tabDesAGarder[] = de
                    }
                }
                premierLancer = False
            } Sinon Si (listedes != 'all) {
                Afficher (Vous avez entré une valeur incorrecte. Veuillez rentrer une suite de 1 à 5 (par exemple, 134) ou all pour tout garder)
            }

            Si (listedes == 'all) {
                Pour chaque (des en tant que de) {
                    tabDesAGarder[] = de
                }
            }
        } Tant que (lancers < 3 ET listedes != 'all')

        Afficher (Résultat final : <tabDesAGarder>)
        Afficher (Choisissez une catégorie (catégories disponibles): <categories>)

        Faire {

        } Tant que (!inArray($categorieChoisie, categories) OU cleExiste(categorieChoisie, grille))

        appelFonction = remplacer(' ', '', categorieChoisie)
        Si (nimeric(categorieChoisie) OU categorieChoisie == 'Chance) alors {
            grille[categorieChoisie] = autres(tabDesAGarder, categorieChoisie)
        } Sinon {
            grille[appelFonction] = tolowercase(appelFonction)(tabDesAGarder, appelFonction)
        }

    }

    Afficher(Grille finale : )
    Pour chaque (grille en tant que (categorie, score)) {
        Afficher(<categorie>: <score>)
    }
*/
// initialisation grille vide
$grid = array();
// initialisation des catégories disponibles
$categories = array(
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5',
    '6' => '6',
    'b' => 'Brelan',
    'c' => 'Carre',
    'f' => 'Full',
    'ps' => 'Petite suite',
    'gs' => 'Grande suite',
    'y' => 'Yams',
    'ch' => 'Chance'
);

// boucle pour 13 tours (nombre de catégories)
for ($turn = 1; $turn <= 13; $turn++) {
    print("Tour n°$turn :\n");
    $throws = 0;

    // variables pour garder les dés
    $keep = '';
    $keptDices = array();

    // premier lancer
    $firstThrow = true;

    do {
        // rentre si l'utilisateur garde des dés ou si il garde rien
        if (is_numeric($keep) || $firstThrow || !strlen($keep)) {
            // si l'utilisateur a entré des dés à garder, les ajoute au tableau de dés à afficher a la fin du tour
            $arrayKeeps = array_filter(str_split($keep));
            foreach ($arrayKeeps as $dice) {
                $keptDices[] = $dices[intval($dice)-1];
            }
            

            // lancer de dés
            $dices = array();
            for ($i = 0; $i < 5 - count($keptDices); $i++) {
                $dices[$i] = rand(1, 6);
            }

            print("Résultat des dés : " . implode(", ", $dices) . "\n");

            $throws++;
            if ($throws < 3) {
                // affiche que sur les 2 derniers lancers
                print("1,2,3,4,5 ou all pour tout garder. Par exemple, 134 garde le dé 1, 3 et 4. \n");
                $keep = readline("Lancer $throws - Quels dés voulez-vous garder ? ");
            } else {
                // ajoute les dés si c'est le dernier lancer 
                foreach ($dices as $dice) {
                    $keptDices[] = $dice;
                }
            }
            $firstThrow = false;
        } else if($keep != 'all') {
            //erreur si texte mais différente de all
            print("Vous avez entré une valeur incorrecte. Veuillez rentrer une suite de 1 à 5 (par exemple, 134) ou all pour tout garder");
        }

        // si all est entré, ajoute les dés restants
        if ($keep == 'all') {
            foreach ($dices as $dice) {
                $keptDices[] = $dice;
            }
        }
    } while($throws < 3 && $keep != 'all'); // boucle jusqu'au troisiéme lancer ou jusqu'à ce que l'utilisateur garde tout

    
    
    // affiche les catégorie pour le joueur
    print("Résultat final : " . implode(", ", $keptDices) . "\n");
    print("Choisissez une catégorie (catégories disponibles): ");
    foreach ($categories as $key => $value) {
        print("$value");
        if ($value == end($categories)) {
            print("\n");
        } else {
            print(", ");
        }
    }
    
    do {

        if (count($grid)) {
            // affiche la grille pour ce tour
            ksort($grid);
            print("Grille actuelle :\n");
            foreach ($grid as $categorie => $valeur) {
                print("$categorie : $valeur\n");
            }
        }

        // ajoute un élément au tableau avec le nom de la catégorie
        $entry = readline("Catégorie choisie : ");
        $categoryChosen = $entry;

        if(array_key_exists($categoryChosen, $grid)){
            // vérifier si la catégorie est déjà remplie
            print("Cette catégorie est déjà remplie. Choisissez une autre catégorie.\n");
        }

        if(!strlen($categoryChosen)){
            // vérifier si l'utilisateur a entrer du texte
            print("Veuillez entrer une catégorie valide.\n");
        }
    } while (!in_array($categoryChosen, $categories) || array_key_exists($categoryChosen, $grid));

    // enleve les espace sur la catégorie pour l'appel de la fonction
    $callToFunction = str_replace(' ', '', $categoryChosen);
    
    // calculer le score pour la catégorie choisie
    if (is_numeric($categoryChosen) || $categoryChosen == "Chance") {
        $grid[$categoryChosen] = other($keptDices, $categoryChosen);
    } else {
        $grid[$categoryChosen] = strtolower($callToFunction)($keptDices, $categoryChosen);
    }
    
}

// Afficher le résultat final
print("Grille finale :\n");
foreach ($grid as $categorie => $score) {
    print("$categorie : $score\n");
}
