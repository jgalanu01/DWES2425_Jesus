const express = require('express');

const rutas = express.Router();

const cConductor = require('../controladores/cConductor');

rutas.post('/conductor', cConductor.store);
rutas.get('/billetes/:id', cConductor.obtenerTodosBilletes);
rutas.get('/billetesFecha/:id', cConductor.obtenerBilletesFecha);

module.exports = rutas;
