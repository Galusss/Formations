<template>
  <div class="newArticle">
    <div class="ui form">
      <div class="centerDisplay">
        <h1>
          <img class="newAccountLogo" src="../assets/logo.png" alt="Logo de la société Groupomania" width="200" height="200">
        </h1>
      </div>
      <section>
        <div class="error"></div>
          <div class="required field">
            <label for="nom">Nom</label>
            <input type="text" placeholder="Nom de l'article..." name="nom" id="nom" v-model="articleName">
          </div>
        <div class="required field">
          <label for="description">Description</label>
          <textarea type="text" placeholder="Description de l'article..." name="description" id="description" v-model="article_description"></textarea>
        </div>
        <div class="field">
          <label for="source">Source(s)</label>
          <input type="text" placeholder="Sources utilisées sur l'article..." name="source" id="source" v-model="source_article">
        </div>
        <div class="centerDisplay btnNewArticle">
          <button class="ui blue button" @click="create()">Créer l'article</button>
        </div>
      </section>
    </div>
  </div>
</template>


<style scoped>
.newAccountLogo{
  margin: 40px 0px;
}

.error{
  color: red;
  margin: 10px 0px;
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

.ui.form input[type="text"], .ui.form textarea:not([rows]) {
  border: solid black 1px;
}

.centerDisplay{
  display: flex;
  justify-content: center;
}

.ui.button{
  border: solid black 1px;
  color: black;
}

.ui.blue.button {
    font-weight: bold;
    font-size: 18px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    min-width: 300px;
}

.ui.blue.button:hover{
    opacity: 0.6;
}

.btnNewArticle{
  margin: 60px 0px;
}

@media screen and (max-width: 900px) {
  img{
    width: 120px;
    height: 120px;
  }
  
  .ui.blue.button {
    min-width: 200px;
    font-size: 12px;
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
let firstnameAuthor = sessionStorage.getItem('userFirstname'); 
let lastnameAuthor = sessionStorage.getItem('userLastname'); 

export default {
  data: function () {
    return {
      articleName: "",
      article_description: "",
      source_article: "",
      userId: id,
      firstnameAuthor: firstnameAuthor,
      lastnameAuthor: lastnameAuthor
    };
  },
  methods: {
    create() {
      if (this.articleName.length > 0 && this.article_description.length > 0) {
        if (this.source_article >= 0) {
          this.source_article = "Pas de source renseignée"
        }
        const postData = { articleName: this.articleName, article_description: this.article_description, source_article: this.source_article, userId: this.userId, firstnameAuthor: this.firstnameAuthor, lastnameAuthor: this.lastnameAuthor };
        this.$http.post('http://localhost:5000/articles', postData, {
          headers: {
            Authorization: 'bearer ' + token
          }        
        })
        .then(res => {
          if (res.body.error) {
            document.querySelector(".btnNewArticle").addEventListener("click", function(event) {
              event.preventDefault()
            })  
            let error = document.querySelector(".error")
            error.innerHTML = "Erreur: Ce nom d'article est déjà utilisé."
          } else if (!res.body.error) {
            window.open('http://localhost:8080/articles', "_parent")
          }
        });
      } else {
          let error = document.querySelector(".error")
          error.style.backgroundColor = "#bfbfb8";
          error.style.border = "solid 1px black";
          error.style.margin = "10px 0px";
          error.innerHTML = "Erreur: Vous n'avez pas rempli tous les champs requis(*)."
      }
    }
  }
}
</script>
