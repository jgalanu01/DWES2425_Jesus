const app = require('./app');

const puerto = 3000;

const {bd, Conductor, Billete, Linea} = require('./Modelos')


bd.sync({force:false})

    .then(()=>{
        app.listen(puerto, ()=>{
            console.log('Servidor iniciado http://localhost:3000');
        });
    })
    .catch((error)=>{
        console.error('Error al sincronizar:'+error);
    });
