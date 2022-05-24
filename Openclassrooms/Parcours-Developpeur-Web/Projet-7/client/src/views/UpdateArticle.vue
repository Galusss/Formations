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
            <input type="text" placeholder="Nom de l'article..." name="nom" id="nom">
          </div>
        <div class="required field">
          <label for="description">Description</label>
          <textarea type="text" placeholder="Description de l'article..." name="description" id="description"></textarea>
        </div>
        <div class="field">
          <label for="source">Source(s)</label>
          <input type="text" placeholder="Sources utilisées sur l'article..." name="source" id="source">
        </div>
        <div class="centerDisplay btnNewArticle">
          <button class="ui blue button" id="test" @click="edit()">Modifier l'article</button>
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
let data = JSON.parse(sessionStorage.getItem('article'));
let dataToken = JSON.parse(sessionStorage.getItem('vue-session-key')); 
let token = dataToken.jwt;
export default {
    mounted () {
        let data = JSON.parse(sessionStorage.getItem('article'));
        let nom = document.getElementById("nom");
        nom.value = data.articleName;
        let description = document.getElementById("description");
        description.value = data.article_description;
        let source = document.getElementById("source");
        source.value = data.source_article;
    },
    methods: {
        edit: function () {
            let nom = document.getElementById("nom");
            let description = document.getElementById("description");
            let source = document.getElementById("source");
            if (source.value.length == 0) {
                source.value = "Pas de source renseignée"
            }
            const postData = { articleName: nom.value, article_description: description.value, source_article: source.value };
            if (nom.value.length != 0 && description.value.length  !=  0) {
                this.$http.put("http://localhost:5000/articles/" + data.article_id, postData, {
                    headers: {
                        Authorization: 'bearer ' + token
                    }
                })
                .then(response => {
                  response.json().then((data) => {
                    if (data.error == "Article name already exists") {  
                      let error = document.querySelector(".error")
                      error.style.backgroundColor = "#bfbfb8";
                      error.style.border = "solid 1px black";
                      error.style.margin = "10px 0px";
                      error.style.padding = "10px";
                      error.innerHTML = "Erreur: Ce nom d'article est déjà utiliser."           
                    }else {
                      this.postData = data
                      let error = document.querySelector(".error")
                      if (error) {
                        error.style.display = "none";
                      }
                      window.open("http://localhost:8080/articles", "_parent"); 
                    }
                  }) 
                }, (response) => {
                  console.log('erreur', response)
                })
            }else {
              let error = document.querySelector(".error")
              error.style.backgroundColor = "#bfbfb8";
              error.style.border = "solid 1px black";
              error.style.margin = "10px 0px";
              error.style.padding = "10px";
              error.innerHTML = "Erreur: Vous n'avez pas rempli tous les champs requis(*)."
            }
        }
    }
}
</script>
