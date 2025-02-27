const express = require('express');

const rutas = express.Router();

const cLinea = require('../controladores/cLinea');

rutas.get('/recaudacion/:id', cLinea.obtenerRecaudacion);
rutas.delete('/borrar/:id', cLinea.borrar);

module.exports = rutas;
