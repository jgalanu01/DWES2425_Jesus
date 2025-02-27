const express=require('express');

const rutas=express.Router();

const linea = require('../controlador/cLinea');

rutas.get('/linea/:id',linea.recaudacion); //Pone en el examen que hay que pasarle el id
rutas.delete('/linea',linea.destroy);

module.exports=rutas;


//rutas y luego modelos