# Github command

-   Cette commande est utilisée pour créer un nouveau dépôt GIT :
```js
    git init
```

-   La commande git add peut être utilisée pour ajouter des fichiers à l’index. Par exemple, la commande suivante ajoutera un fichier nommé temp.txt dans le répertoire local de l’index:
```js
    git add temp.txt
```

-   La commande git commit permet de valider les modifications apportées au HEAD. Notez que tout commit ne se fera pas dans le dépôt distant.
```js
    git commit –m “Description du commit”
```

-   La commande git status affiche la liste des fichiers modifiés ainsi que les fichiers qui doivent encore être ajoutés ou validés. Usage:
```js
    git status
```

-   Git push est une autre commandes GIT de base. Un simple push envoie les modifications locales apportées à la branche principale associée :
```js
    git push origin master
```

-   Cette commande remote permet à un utilisateur de se connecter à un dépôt distant. La commande suivante répertorie les dépôts distants actuellement configurés:
```js
    git remote -v
```

-   Pour fusionner toutes les modifications présentes sur le dépôt distant dans le répertoire de travail local, la commande pull est utilisée. Usage:
```js
    git pull
```
