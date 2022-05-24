<template>
  <div class="signup">
    <div class="ui form">
      <div class="centerDisplay">
        <h1>
          <img class="signupLogo" src="../assets/logo.png" alt="Logo de la société Groupomania" width="200" height="200">
        </h1>
      </div>
      <section>
        <div class="error"></div>
        <div class="required field">
          <label for="prenom">Prénom</label>
          <input type="text" placeholder="Prénom..." name="prenom" id="prenom" v-model="prenom">
        </div>
        <div class="required field">
          <label for="nom">Nom</label>
          <input type="text" placeholder="Nom..." name="nom" id="nom" v-model="nom">
        </div>
        <div class="required field">
          <label for="email">Email</label>
          <input type="text" placeholder="Email..." name="email" id="email" v-model="email" v-on:change="isEmailValid">
        </div>
        <div class="required field">
          <label for="password">Mot de passe</label>
          <input type="password" placeholder="Mot de passe..." name="password" id="password" v-model="password">
        </div>
        <div class="centerDisplay btnSignup">
          <button class="ui blue button" @click="signup">Je m'inscris</button>
        </div>
      </section>
    </div>
  </div>
</template>


<style scoped>
.signupLogo{
  margin: 40px 0px;
}

.error{
  color: red;
  font-size: 18px;
  font-weight: 400;
}

.ui.form{
  width: 50%;
  margin: auto;
  margin-top: 30px;
}

.ui.form .field > label {
  font-size: 15px;
}

.ui.form input[type="text"], .ui.form input[type="password"]  {
  border: solid black 1px;
  border-radius: .28571429rem;
}

.centerDisplay{
  display: flex;
  justify-content: center;
}

.ui.button{
  color: black;
}

.ui.blue.button {
  border: solid black 1px;
  margin: 50px;
  font-weight: bold;
  font-size: 18px;
  font-family: Georgia, 'Times New Roman', Times, serif;
  min-width: 300px;
}

.ui.blue.button:hover{
    opacity: 0.6;
}

@media screen and (max-width: 900px) {
  img{
    width: 120px;
    height: 120px;
  }
}

@media screen and (max-width: 550px) {
  img{
    width: 80px;
    height: 80px;
  }

  .ui.blue.button {
    font-size: 12px;
    min-width: 150px;
  }
}
</style>


<script>
export default {
  data: function () {
    return {
      prenom: "",
      nom: "",
      email: "",
      password: ""
    };
  },
  methods: {
    signup() {
      let emailValid = sessionStorage.getItem("emailValid");
      const postData = { prenom: this.prenom, nom: this.nom, email: this.email, password: this.password };
      if (this.prenom.length > 0 && this.nom.length > 0 && this.email.length > 0 && this.password.length > 0) {
        if (emailValid == "true") {
          this.$http
          .post('http://localhost:5000/users/signup', postData)
          .then(res => {
            if (res.body.error) {
              document.querySelector(".btnSignup").addEventListener("click", function(event) {
                event.preventDefault()
              }) 
              let error = document.querySelector(".error")
              error.style.backgroundColor = "#bfbfb8";
              error.style.border = "solid 1px black";
              error.style.margin = "10px 0px";
              error.style.padding = "10px";
              error.innerHTML = "Erreur: Cette adresse email est déjà utilisé." 
            } else if (!res.body.error) {
              sessionStorage.clear("emailValid");
              window.open("http://localhost:8080/", "_parent");
            } 
          });
        } else {
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
    }
  }
}
</script>
