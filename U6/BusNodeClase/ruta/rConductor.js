const express=require('express');

const rutas=express.Router();
const conductor = require('../controlador/cConductor');

rutas.post('/conductor',conductor.store);
rutas.get('/conductor/:id',conductor.obtenerBilletes); //Pone en el examen que hay que pasarle el id

module.exports=rutas;


//rutas y luego modelos