function guessNumber(max){
    let answer = Math.floor(Math.random()*max);
    let guess, stop = false;
    do {
        guess = prompt('Votre nombre : ');
        try {
            parseInt(guess);
            if(guess > answer){
                alert('Plus petit');
            } else if (guess < answer) {
                alert('Plus grand');
            }
        } catch ( e ) {
            if(guess != 'stop'){
                alert('Entrée invalide');
            } else {
                stop = true
            }
        }
    } while (guess != answer && !stop);

    if(stop){
        alert('Arrêt du programme (demande utilisateur)');
    } else {
        alert('Bravo vous avez trouvé');
    }
}

guessNumber(100);