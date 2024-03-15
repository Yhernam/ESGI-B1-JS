# Développement Web 

<u>B1 - BASE</u>

## INTRODUCTION ET STRUCTURES DE CONTROLE




## modifier des éléments 
changer le text : 
```js
document.getElementById("monId").textContent = "Nouveau texte !";
```
## Modifier les styles
changer le style d'un élément : 
```js
document.getElementById("monId").style.color = "red";
```
Ajouter ou Supprimer des classes : 


## Ecouter et Réagir aux événements
Ajouter un écouteur d'évenement : 

```js
document.getElementById("monBouton").addEventListener("click", fucntion () {
    alert("Bouton cliqué ! ");
});
```
## Tableau
<strong>Introduction au tableau :</strong>

```
utiliser le debuger dans la console du navigateur
```
<strong>Ajouter un élément à la fin du tableau : </strong>
```
.push()
```
<strong>Retirer le dernier élément du tableau et le retourner</strong>
```
.pop()
```
<strong>create a new row (<tr>)</strong>
```
insertRow()
```
<strong>remove a row</strong>
```
deleteRow()
```
<strong>create a new cell (<td>)</strong>
```
insertCell()
```
<strong>delete a cell</strong>
```
deleteCell()
```
se reperer avec ref
stocker des données et les recupérer

## Création d'un Timeout

```js

console.log("Début");

setTimeout(() => {
    console.log("Exécution asynchrone après 2 secondes");
}, 2000)

console.log(setTimeout)


```


## Création et utilisation de Promesses
### 3 état :

```pending ``` : 

```fulfiled``` :

```rejected``` :


```js
let promesse = new Promise((resolve, reject) => {
    //simulation d'une tache asynchrone
    let condition = true;
    if (condition){
        setTimeout(() => resolve("Opération réussi"),100);
    } else {
        reject("Opération échouée");
    }
})
```

## Syntraxe de bases de promesses: .then() .catch() .finally()

```.then() ``` s'éxecute si la prommesse est résolue avec succès
```js

```
```.catch()```  s'éxecute si la promesse est résolue et rejetée
permet de
```js

```
```.finally()```
```js

```

## Consommation d'une promesse
<p> Pour consommer/utiliser une promesse on utilise une méthode .then(), .catch(), .finally() </p>

```.then```
```js
```

```.catch() ```
```js
```



## note mot à chercher
```  
call back
fetch
headers 
```

```js
JSON.stringify()
```
