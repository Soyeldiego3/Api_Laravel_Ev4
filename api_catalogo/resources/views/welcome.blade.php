<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApiEV4</title>
</head>
<body>
    <h1>API EV4</h1>
    <br>

    <h2>Rutas disponibles:</h2>
    <ul>
        <li><strong>GET</strong> /api/catalogos - Listar todos</li>
        <li><strong>GET</strong> /api/catalogos/1 - Ver ID uno</li>
        <li><strong>POST</strong> /api/catalogos - Crear nuevo</li>
        <li><strong>PUT</strong> /api/catalogos/1 - Actualizar ID uno</li>
        <li><strong>DELETE</strong> /api/catalogos/1 - Eliminar ID uno</li>
    </ul>

    <h2>Ejemplo JSON para POST (Crear):</h2>
    <pre>
{
    "nombre": "Notebook Lenovo",
    "descripcion": "Notebook de 15 pulgadas",
    "precio": 1000000,
    "stock": 15,
    "estado": "activo"
}
    </pre>

    <h2>Ejemplo JSON para PUT (Actualizar):</h2>
    <pre>
{
    "nombre": "Notebook Lenovo",
    "descripcion": "Notebook de 15 pulgadas",
    "precio": 800000,
    "stock": 10,
    "estado": "inactivo"
}
    </pre>

    <style>
        body {
            background-color: #ecf0f1;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            font-size: 50px;
        }
    </style>
</body>
</html>