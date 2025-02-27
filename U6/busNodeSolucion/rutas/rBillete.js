const express = require('express');

const rutas = express.Router();

const cBillete = require('../controladores/cBillete');

rutas.post('/billete', cBillete.store);

module.exports = rutas;
