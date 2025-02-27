const express=require('express');

const rutas=express.Router();

const billete = require('../controlador/cBillete');

rutas.post('/billete',billete.store);

module.exports=rutas;

//rutas y luego modelos