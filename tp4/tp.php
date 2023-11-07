<?php

/*
nbBatonnets = 20
tours = 0
dernierCoup = [valeur => 0, joueur => "utilisateur"]

Faire {
    Si(tours%2 == 0) alors {
        Afficher(Entrer un nombre de batonnets a prendre (1 à 3) : )
        Lire(take)
        joueur = 'utilisateur'
    } Sinon {
        take = 4 - dernierCoup['valeur']
        joueur = 'ordinateur'
    }

    Si(take > 0 && take < 4) alors {
        dernierCoup['valeur'] = take
        dernierCoup['joueur'] = joueur

        nbBatonnets = nbBatonnets - take

        Afficher(Le <player> a pris <take> batonnets, il en reste <nbBatonnets>)

        tours = tours + 1
    } Sinon {
        Afficher(Valeur interdite, veuillez réessayer)
    }
    
}Tant que (nbbatonnets>0)

Afficher(L'<dernierCoup['joueur']> a gagné)
*/

$nbSticks = 20;
$turns = 0;
$lastPlay = array('value' => 0, 'player' => "utilisateur");

do{
    if ($turns%2 == 0) {
        $take = readline("Entrer un nombre de batonnets a prendre (1 à 3) : ");
        $player = 'utilisateur';
    } else {
        $take = 5 - $lastPlay['value'];
        $player = 'ordinateur';
    }

    if($take > 0 && $take < 4){
        $lastPlay['value'] = $take;
        $lastPlay['player'] = $player;

        $nbSticks -= $take;

        print("L'$player a pris $take bâtonnets, il en reste $nbSticks\n");

        $turns++;
    } else {
        print("Valeur interdite, veuillez réessayer...\n");
    }
} while($nbSticks);

print("L'" . $lastPlay['player'] . " a gagné\n");

?>