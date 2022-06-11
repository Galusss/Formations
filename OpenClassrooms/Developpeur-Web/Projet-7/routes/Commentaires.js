const express = require("express")
const commentaires = express.Router()
const cors = require("cors")

commentaires.use(cors())

const auth = require('../middleware/auth');

const commentairesController = require("../controllers/Commentaires")


// get all commentaires
commentaires.get("/", auth, commentairesController.getAllCommentaire);

// create
commentaires.post("/", /*auth,*/ commentairesController.create);

// delete article with id 
commentaires.delete("/:id", /*auth,*/ commentairesController.delete);

module.exports = commentaires