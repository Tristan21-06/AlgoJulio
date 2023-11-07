function number(){
    alert("Ecrire 'stop' pour arrêter");
    nombre = 0
    while(nombre != "stop"){
        nombre = prompt("Votre nombre : ");
    }
    alert("Arrêt du programme");
}

number();