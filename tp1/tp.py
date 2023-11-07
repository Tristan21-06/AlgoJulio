from random import random
import math

answer = math.floor(random()*1000)
guess = 0
stop = False
while not stop and int(guess) != answer :
    guess = input("Devinez le nombre : ")
    if guess.isdigit() :
        if int(guess) < answer :
            print("Plus grand")
        elif int(guess) > answer :
            print("Plus petit")
    elif guess != 'stop' :
        print("Entrée invalide")
    else :
        stop = True
 
if stop :
    print("Arrêt du programme (demande utilisateur)")
else :
    print("Bravo vous avez trouvé")
