const express = require("express")
const articles = express.Router()
const cors = require("cors")

articles.use(cors())

const auth = require('../middleware/auth');

const articlesController = require("../controllers/Articles")


// get all articles
articles.get("/", auth, articlesController.getAllArticle);

// get one article with id
articles.get("/:id", auth, articlesController.getOneArticle);

// create
articles.post("/", auth, articlesController.create);

// update article with id
articles.put("/:id", auth, articlesController.update);

// delete article with id 
articles.delete("/:id", auth, articlesController.delete);


module.exports = articles