const express = require("express")
const users = express.Router()
const cors = require("cors")

users.use(cors())

const auth = require('../middleware/auth');

const usersController = require("../controllers/Users")


// signup
users.post("/signup", usersController.signup);

// login
users.post("/login", usersController.login);

// get a user with id 
users.get('/:id', usersController.getOneUser);

// update a user with id
users.put('/account/:id', auth, usersController.update);

// delete a user with id
users.delete('/account/:id', auth, usersController.delete);


module.exports = users