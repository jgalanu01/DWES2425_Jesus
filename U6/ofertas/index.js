//Importar aplicación
const app = require('./app');


//Cargar dotenv para trabajar con variables .env
const dotenv= require('dotenv');
dotenv.config();

//Puerto de escucha del servidor
const puerto = process.env.APP_PORT;

//Cargar configuracion de BD
const {bd, Usuario, Oferta} = require('./Models/index');

//Conectar con la BD
bd.sync(
    {
        force:false, //¡¡CAMBIAR A FALSE CUANDO EL ESQUEMA DEL BD SEA DEFINITIVO!!
    })
    .then(()=>{
        console.log('BD sincronizada');
        //Lanzar la aplicación 
        app.listen(puerto, () => {
            console.log('Aplicación lanzada en http://localhost:3000')
        })
    })
    .catch((error)=>{
        console.log('Error al conectar con la BD',error);
    });
