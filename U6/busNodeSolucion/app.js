const express = require('express');

const app = express();

const rutasB = require('./rutas/rBillete');
const rutasC = require('./rutas/rConductor');
const rutasL = require('./rutas/rLineas');

app.use(express.json());

app.use('/api',rutasB);
app.use('/api',rutasL);
app.use('/api',rutasC);

module.exports = app;