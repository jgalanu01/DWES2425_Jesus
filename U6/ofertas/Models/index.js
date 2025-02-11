//Importar Sequelize
const { Sequelize } = require('sequelize');

//Importar configuración BD
const bd = require('../config/database');

//Importar el modelo de Usuario
const Usuario = require('./usuario');

//Definir relaciones

//Exportar conexion,modelos y relaciones
module.exports = {
    bd,
    Usuario
}