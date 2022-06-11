const Sequelize = require("sequelize")
const db = require("../config/db")

const User = db.sequelize.define(
    'users', {
        id: {
            type: Sequelize.SMALLINT,
            primaryKey: true,
            autoIncrement: true,
            unique: true,
            allowNull : false
        },
        email: {
            type: Sequelize.STRING,
            unique: true,
            allowNull : false
        },
        password: {
            type: Sequelize.STRING,
            allowNull : false
        },
        nom: {
            type: Sequelize.STRING,
            allowNull : false
        },
        prenom: {
            type: Sequelize.STRING,
            allowNull : false
        },
        date_inscription: {
            type: Sequelize.DATE,
            defaultValue: Sequelize.NOW,
            allowNull : false
        },
        permission: {
            type: Sequelize.TINYINT,
            allowNull : false
        }
    }, 
    {
        timestamps: false
    }
)


module.exports = User;
