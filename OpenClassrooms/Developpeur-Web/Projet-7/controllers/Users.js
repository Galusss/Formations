const jwt = require("jsonwebtoken")
const bcrypt = require("bcrypt")

const User = require("../models/User")

require('dotenv').config()



// signup
exports.signup = function (req, res) {
    const today = new Date()
    const userData = {
        prenom: req.body.prenom,
        nom: req.body.nom,
        email: req.body.email,
        password: req.body.password,
        permission: 0,
        date_inscription: today
    }
    User.findOne({
        where: {
            email: req.body.email
        }
    })
    .then(user => {
        if (!user) {
            bcrypt.hash(req.body.password, 10, (err, hash) => {
                userData.password = hash
                User.create(userData)
                .then(user => {
                    res.json({
                        status: user.email + ' registered'
                    })
                })
                .catch(err => {
                    res.send('error: ' + err)
                })
            })
        }else {
            res.json({
                error: 'User already exists'
            })
        }
    })
    .catch(err => {
        res.send('error: ' + err)
    })
};


// login
exports.login = function (req, res) {
    User.findOne({
        where: {
            email: req.body.email
        }
    })
    .then(user => {
        if (user) {
            if (bcrypt.compareSync(req.body.password, user.password)) {
                let token = jwt.sign(user.dataValues, process.env.TOKEN_KEY, {
                    expiresIn: '24h'
                })
                res.send({
                    status: 'Connection successfully',
                    token: token,
                    userId: user.id,
                    userPermission: user.permission,
                    userFirstname: user.prenom,
                    userLastname: user.nom
                })
            }else {
                res.status(400).json({
                    error: 'User does not exist'
                })
            }
        }
    })
    .catch(err => {
        res.status(400).json({
            error: err
        })
    })
};


// get one user with id
exports.getOneUser = function (req, res) {
    User.findOne({
        where: {
            id: req.params.id
        }
    })
    .then(user => {
        if(!user) {
            res.json({
                status: 'User not found'
            })
            res.send(err)
        }else {
            res.json(user)
        }
    })
};


// update a user with id
exports.update = function (req, res) {
    User.findOne({
        where: {
            email: req.body.email
        }
    })
    .then(article => {
        if (!article) {
            User.findOne({
                where: {
                    id: req.params.id
                }
            })
            .then(async user => {
                if (!user) {
                    res.json({
                        status: 'User not updated'
                    })
                    throw Error('User not updated');
                }else {
                    user.email = req.body.email;
                    user.nom = req.body.nom;
                    user.prenom = req.body.prenom;
                    await user.save();
                    res.json({
                        status: 'User successfully updated'
                    })
                }
            })
        }else {
            res.json({
                error: 'Email already exists'
            })            
        }
    })

};


// delete a user with id
exports.delete = function (req, res) {
    User.findOne({
        where: {
            id: req.params.id
        }
    })
    .then(async user => {
        if(!user) {
            res.json({
                status: 'User not deleted'
            })
            throw Error('User not deleted')
        }else {
            await user.destroy()
            res.json({
                status: 'User successfully deleted'
            })
        }   
    })
};