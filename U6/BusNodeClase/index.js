const app=require('./app');

const {bd,Conductor,Linea,Billete}=require('./modelo/index'); //Aquí vamos a importar los modelos los module.exports de index.js de la carpeta modelo

//Sincronizamos la bd La primera vez ponemos el force a true para crearla, luego ya lo cambiamos a false
bd.sync({force:true})
.then(()=>{
    app.listen('3000',()=>{
        console.log('Aplicación disponible en http://localhost:3000');
    })
})
.catch((error)=>{
    console.error(error);
});

//Ahora ya ponemos npm run dev