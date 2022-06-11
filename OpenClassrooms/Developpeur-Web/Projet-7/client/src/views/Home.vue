<template>
  <div class="home">
    <div class="headerHome">
      <img src="../assets/logo.png" alt="Logo de la société Groupomania" width="200" height="200">
        <h1>Bienvenue sur le réseau social de Groupomania</h1>
    </div>
    <section>
      <div v-if="!this.$session.exists()">
        <div class="ui placeholder segment">
          <div class="ui two column very relaxed stackable grid">
            <div class="column">
              <div class="ui form">
                <div class="error"></div>
                <div class="field">
                  <label for="email">Email</label>
                  <div class="ui left icon input">
                    <input type="text" placeholder="Email..." name="email" id="email" v-model="email">
                    <i class="user icon"></i>
                  </div>
                </div>
                <div class="field">
                  <label for="password">Mot de passe</label>
                  <div class="ui left icon input">
                    <input type="password" placeholder="Mot de passe..." name="password" id="password" v-model="password">
                    <i class="lock icon"></i>
                  </div>
                </div>
                <div class="ui blue submit button" @click="login()">
                  Connexion
                </div>
                <div class="error"></div>
              </div>
            </div>
            <div class="middle aligned column">
              <div class="ui big button" @click="goToSignup()">
                <i class="signup icon"></i>
                Inscription
              </div>
            </div>
          </div>
          <div class="ui vertical divider">
            OU
          </div>
        </div>
      </div>
      <div class="btnHome" v-else>
        <button class="ui blue button" @click="goToArticle()">Voir tout les articles</button>
        <button class="ui blue button" @click="goToNewArticle()">Créer un article</button>
      </div>
    </section>
  </div>
</template>


<style scoped>
a{
  text-decoration: none;
}

h1{
  font-family: Georgia, 'Times New Roman', Times, serif;
  font-size: 40px;
  color: rgb(14, 14, 14);
}

h1:after{
  margin: 0;
  content: ' .';
  animation: dots 2s infinite;
}

@keyframes dots{
  0%, 20% {
    color: rgb(14, 14, 14);
    text-shadow: 0.25em 0 0 rgba(0, 0, 0, 0), 0.5em 0 0 rgba(0, 0, 0, 0);
  }
  40% {
    color: rgb(14, 14, 14);
    text-shadow: 0.25em 0 0 rgb(14, 14, 14), 0.5em 0 0 rgba(0, 0, 0, 0);
  }
  60% {
    text-shadow: 0.25em 0 0 rgb(14, 14, 14), 0.5em 0 0 rgba(0, 0, 0, 0);
  }
  80%, 100% {
    text-shadow: 0.25em 0 rgb(14, 14, 14), 0.5em 0 0 rgb(14, 14, 14);
  }
}

.headerHome{
  text-align: center;
  margin: 60px 0px;
}

.error{
  color: red;
  font-size: 18px;
  font-weight: 400;
}

div.ui.two.column.very.relaxed.stackable.grid, .ui.placeholder.segment{
  background-color: #bfbfb8;
  border-radius: .28571429rem;
}

.ui.form .field > label {
  font-size: 15px;
}

.ui.form input[type="text"], .ui.form input[type="password"]  {
  border: solid black 1px;
  border-radius: .28571429rem;
}

.btnHome{
  text-align: center;
}

.error{
  color: red;
  margin: 10px 0px;
  font-size: 18px;
  font-weight: 400;
  text-align: center;
}

.ui.placeholder.segment {
  margin: 90px;
}

.ui.button{
  margin: 30px;
  border: solid black 1px;
  color: black;
}

.ui.blue.button {
  margin-bottom: 70px;
  font-weight: bold;
  font-size: 20px;
  font-family: Georgia, 'Times New Roman', Times, serif;
  min-width: 300px;
}

.ui.blue.button:hover{
  opacity: 0.6;
}

@media screen and (max-width: 1200px) {
  h1{
    font-size: 28px;
  }
}

@media screen and (max-width: 900px) {
  h1{
    font-size: 20px;
  }

  img{
    width: 120px;
    height: 120px;
  }

  .ui.vertical.divider {
    display: none;
  }
  .ui.blue.submit.button {
    min-width: 150px;
  }

  .ui.form .field > label {
    font-size: 12px;
  }
}

@media screen and (max-width: 550px) {
  h1{
    font-size: 12px;
  }

  img{
    width: 80px;
    height: 80px;
  }

  .ui.blue.submit.button {
    font-size: 12px;
    min-width: 100px;
    margin-bottom: 20px;
  }

  .ui.big.button, .ui.big.buttons .button, .ui.big.buttons .or {
    font-size: 12px;
    margin: 0px;
    margin-bottom: 20px;
  }

  div.column{
    margin: 0px;
    padding: 0px;
  }

  .ui.input > input {
    height: 20px;
    font-size: 10px;
  }

  .button.ui.blue.button{
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 12px;
  }
}
</style>


<script>
export default {
  data: function () {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    login() {
      let email = document.getElementById("email");
      let password = document.getElementById("password");
      const postData = { email: this.email, password: this.password };
      if (email.value.length > 0 && password.value.length > 0) {
        this.$http
        .post('http://localhost:5000/users/login', postData)
        .then(function (response) {
          if (response.status === 200 && 'token' in response.body) {
            this.$session.start()
            this.$session.set('jwt', response.body.token)
            this.$http.headers.common['Authorization'] = 'Bearer ' + response.body.token
            window.open("http://localhost:8080/", "_parent");
            console.log(response)
            let dataUser = JSON.parse(response.bodyText)
            sessionStorage.setItem('userId', dataUser.userId)
            sessionStorage.setItem('userPermission', dataUser.userPermission)
            sessionStorage.setItem('userFirstname', dataUser.userFirstname)
            sessionStorage.setItem('userLastname', dataUser.userLastname)
          }
        })
      }else {
          let error = document.querySelector(".error")
          error.style.backgroundColor = "#bfbfb8";
          error.style.border = "solid 1px black";
          error.style.margin = "10px 0px";
          error.style.padding = "10px";
          error.innerHTML = "Erreur: Veuillez saisir une adresse email et un mot de passe valide."
      }
    },
    goToSignup() {
      window.open("http://localhost:8080/signup/", "_parent");
    },
    goToArticle() {
      window.open("http://localhost:8080/articles/", "_parent");      
    },
    goToNewArticle() {
      window.open("http://localhost:8080/article/new", "_parent");
    }
  }
}
</script>
