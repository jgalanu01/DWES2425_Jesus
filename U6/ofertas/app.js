//Importar express
const express=require('express')

//Inicializar express
const app=express();

//Importar rutas
const rutaUsuario=require('./routes/usuarioR');
const rutaOferta=require('./routes/ofertaR');
//Asignar url base a la aplicacion
app.use('/api',rutaUsuario);
app.use('/api',rutaOferta);

//Exportar app para cargarla en index.js
module.exports=app;

