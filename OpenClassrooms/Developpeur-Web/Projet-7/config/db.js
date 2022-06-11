const Sequelize = require("sequelize")
require('dotenv').config()

const db = {}

const sequelize = new Sequelize(process.env.DB_NAME, process.env.DB_USER, process.env.DB_PASS, {
    host: process.env.DB_HOST,
    dialect: 'mysql',
    operatorAliases: false,
    pool: {
        max: 5,
        min: 0,
        acquire: 30000,
        indle: 10000
    }
})

sequelize.sync().then(function(){
  console.log('DB connection sucessful.');
}, function(err){
  // catch error here
  console.log('Error DB connection:' + " " + err);
  console.log(err);
});

//sequelize.sync({ force: true })

db.sequelize = sequelize
db.Sequelize = Sequelize

module.exports = db