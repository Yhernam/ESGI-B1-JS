console.log("Début");

setTimeout(() => {
    console.log("Exécution asynchrone après 2 secondes");
}, 2000)

console.log(setTimeout)


let promesse = new Promise((resolve, reject) => {
    //simulation d'une tache asynchrone
    let condition = true;
    if (condition){
        setTimeout(() => resolve("Opération réussi"),100);
    } else {
        reject("Opération échouée");
    }
})



const promise = fetch("https..........")

//promise.then()
promise 
    .then((response)=>{
        console.log("response body:",response.body);
        return response.json();
    })
    .then ((data)=>{
            console.log("data:",data);
    })
    .catch((error)=>{
        console.log("error: ",error);
    });

    async function fetchData(){
        const response = await fetch ("htpps.........")
        const data = await response.json();
    }