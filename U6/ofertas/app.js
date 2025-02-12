//Importar express
const express=require('express')

//Inicializar express
const app=express();
//Añadir middleware para manejar datos de solicitudes en body con JSON
app.use(express.json());

//Importar rutas
const rutaUsuario=require('./routes/usuarioR');
const rutaOferta=require('./routes/ofertaR');
//Asignar url base a la aplicacion
app.use('/api',rutaUsuario);
app.use('/api',rutaOferta);

//Exportar app para cargarla en index.js
module.exports=app;

