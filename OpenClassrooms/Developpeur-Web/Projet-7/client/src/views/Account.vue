<template>
    <div class="account">
        <div class="ui form">
            <div class="centerDisplay">
                <h1>
                    <img class="accountLogo" src="../assets/logo.png" alt="Logo de la société Groupomania" width="200" height="200">
                </h1>
            </div>
            <section>
                <div class="error"></div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" v-model="email" v-on:change="isEmailValid">
                </div>
                <div class="field">
                    <label for="prenom">Prenom</label>
                    <input name="prenom" id="prenom" type="text">
                </div>
                <div class="field">
                    <label for="nom">Nom</label>
                    <input name="nom" id="nom" type="text">
                </div>
                <div class="centerDisplay btnAccount">
                    <button class="ui blue button" @click="edit()">Modifier les informations</button>
                    <button class="ui blue button" @click="destroy()">Supprimer le compte</button>
                </div>
            </section>
        </div>
    </div>
</template>


<style scoped>
.accountLogo{
    margin: 40px 0px;
}

.error{
  color: red;
  margin: 10px 0px;
  font-size: 18px;
  font-weight: 400;
  text-align: center;
}

.ui.form{
    width: 50%;
    margin: auto;
    margin-top: 30px;
}

.ui.form .field > label {
  font-size: 15px;
}

.ui.form input[type="text"] {
    border: solid black 1px;
}

.centerDisplay{
    display: flex;
    justify-content: center;
}

.btnAccount{
    margin: 40px 0px;
}

.ui.button{
    margin: 30px;
    border: solid black 1px;
    color: black;
}

.ui.blue.button{
    font-weight: bold;
    font-size: 18px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    min-width: 300px;
}

.ui.red.button:hover, .ui.green.button:hover{
    opacity: 0.6;
}

@media screen and (max-width: 1200px) {
    .ui.red.button, .ui.green.button{
        font-size: 12px;
    }
}

@media screen and (max-width: 900px) {
    img{
        width: 120px;
        height: 120px;
    }

    .ui.red.button, .ui.green.button{
        min-width: 210px;
    }

    .btnAccount{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
}

@media screen and (max-width: 550px) {
    img{
        width: 80px;
        height: 80px;
    }
}
</style>


<script>
let id = sessionStorage.getItem("userId");
let data = JSON.parse(sessionStorage.getItem('vue-session-key')); 
let token = data.jwt;
export default {
    mounted () {
        this.$http.get("http://localhost:5000/users/" + id)    
        .then(response => {   
            let userData = JSON.parse(response.bodyText);
            let email = document.getElementById("email");
            email.value = userData.email;
            let prenom = document.getElementById("prenom");
            prenom.value = userData.prenom;
            let nom = document.getElementById("nom");
            nom.value = userData.nom;        
        }, (response) => {
            console.log('erreur', response)
        });  
    },
    methods: {
        edit: function () {
            let email = document.getElementById("email");
            let prenom = document.getElementById("prenom");
            let nom = document.getElementById("nom");
            let emailValid = sessionStorage.getItem("emailValid");
            const postData = { email: email.value, prenom: prenom.value, nom: nom.value };
            if (email.value.length != 0 && prenom.value.length  !=  0 && nom.value  !=  0) {
                if (emailValid == "true") {
                    this.$http.put("http://localhost:5000/users/account/" + id, postData, {
                        headers: {
                            Authorization: 'bearer ' + token
                        }
                    })
                    .then(response => {
                        response.json().then((data) => {
                            if (data.error == "Email already exists") {
                                let error = document.querySelector(".error")
                                error.style.backgroundColor = "#bfbfb8";
                                error.style.border = "solid 1px black";
                                error.style.margin = "10px 0px";
                                error.style.padding = "10px";
                                error.innerHTML = "Erreur: Cette adresse est déjà utiliser."    
                            } else {
                                this.postData = data
                                let error = document.querySelector(".error")
                                if (error) {
                                    error.style.display = "none";
                                }
                                window.location.reload()
                                sessionStorage.setItem('userFirstname', prenom.value)
                                sessionStorage.setItem('userLastname', nom.value)
                            }
                        }) 
                    }, (response) => {
                        console.log('erreur', response)
                    })        
                }else  {
                    let error = document.querySelector(".error")
                    error.style.backgroundColor = "#bfbfb8";
                    error.style.border = "solid 1px black";
                    error.style.margin = "10px 0px";
                    error.style.padding = "10px";
                    error.innerHTML = "Erreur: Vous devez utiliser une adresse email valide."
                }
            } else {
                let error = document.querySelector(".error")
                error.style.backgroundColor = "#bfbfb8";
                error.style.border = "solid 1px black";
                error.style.margin = "10px 0px";
                error.style.padding = "10px";
                error.innerHTML = "Erreur: Vous n'avez pas rempli tous les champs requis(*)."
            }
        },
        isEmailValid() {
            const emailRe = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (emailRe.test(this.email)) {
                sessionStorage.setItem("emailValid", 'true');
            } else {
                sessionStorage.setItem("emailValid", 'false');
            }
        },
        destroy: function () {
            this.$http.delete("http://localhost:5000/users/account/" + id, {
                headers: {
                    Authorization: 'bearer ' + token
                }
            })  
            .then(response => {   
                response.json().then((data) => {
                    console.log('success', data)
                    this.$session.destroy()
                    sessionStorage.clear();
                    window.open("http://localhost:8080/", "_parent");
                })       
            }, (response) => {
                console.log('erreur', response)
            }); 
        }
    }
}
</script>