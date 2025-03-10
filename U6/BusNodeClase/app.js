const express=require('express');
const app=express();


//Le pasamos las rutas de la app 
const rutaC=require('./ruta/rConductor');
const rutaL=require('./ruta/rLinea');
const rutaB=require('./ruta/rBillete');

app.use(express.json());


//El /api será comun a todas
app.use('/api',rutaC);
app.use('/api',rutaL);
app.use('/api',rutaB);

//Exportamos ya para llamarla desde el index.js de la carpeta principal
module.exports=app;