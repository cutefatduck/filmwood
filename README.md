## ¿Cómo instalar Filmwood?

### Clonar Repositorio

``` bash
git clone (repositorio)
```

### Instalar vía Composer

``` bash
composer install
``` 
### Copiar el fichero .env.example a .env edita las credenciales y la url

### Generar Application Key

``` bash
php artisan key:generate
``` 
### Migrar base de datos

``` bash
php artisan migrate
``` 
### Lanzar Seeders

``` bash
php artisan db:seed
``` 
### Instalar las dependencias de Node

``` bash
npm install  npm run dev
``` 
### Lanzar a producción

``` bash
npm run build or yarn build
``` 
## ¿Cómo poner en marcha?

Primero, deberemos abrir nuestro XAMPP e iniciar los servicios de:

*Apache*

*MySQL*

Dentro de nuestro Visual Studio Code, indicaremos las siguientes comandas:

``` bash
php artisan serve
```

``` bash
npm run dev
```
## ¿Cómo conectar la BDD?

Deberemos fijarnos en el archivo ".env", ya que este es el que define todos los parámetros de la base de datos, es aquí donde debemos indicar la base de datos.

Deberemos editar los siguientes parámetros:

``` 
DB_CONNECTION=mysql` 
`DB_HOST=127.0.0.1` 
`DB_PORT=3306` 
`DB_DATABASE=Filmwood` 
`DB_USERNAME=root` 
`DB_PASSWORD=
```
## Controllers:

### CountryController:

Este controlador se encarga de gestionar los países de origen de las media shows.

- **view**: Muestra todos los países disponibles.

### FavoriteController:

Este controlador se encarga de gestionar las media shows añadidas a favoritos por cada usuario.

- **getCheckFavorites**: Busca las favoritas para el usuario en concreto.

### GenreController:

Este controlador se encarga de gestionar los géneros disponibles para las media shows.

- **view**: Muestra todos los géneros disponibles.

- **getMediaShowByGenre**: Consigue buscando por género todas las media shows. 

### ImageController:

Este controlador se encarga de gestionar las imágenes para las media shows.

- **store**: Esta función nos permite almacenar correctamente una imagen en un modelo.

### MediaShowController:

Este controlador se encarga de gestionar las media shows y todas las acciones que podemos manejar con ellas.

- **getMediaShowValorations**: Obtenemos todas las valoraciones de una media show en conreto.
- **getMediaShowFavorites**: Obtenemos todas las media shows guardadas en favoritos de un usuario en concreto.
- **getMediaShowVisualizated**: Obtenemos todas las media shows guardadas en visualizadas de un usuario en concreto.
- **checkIfValuated**: Verificar si el usuario ha creado una valoración para un medio específico.
- **addValorations**: Agregamos un nuevo objeto "valoracion" recogido.
- **manageToFavorites**: Administramos el tener una media show en favoritos para eliminar el registro o de lo contrario agregarlo a la base de datos.
- **checkIfVisualizated**: Verificar si el usuario ha agregado la media show a visualizadas con el objetivo de mostrar una imagen u otra.
- **manageToVisualizated**: Administramos el tener una media show en visualizadas para eliminar el registro o de lo contrario agregarlo a la base de datos.
- **getMediaShowByMediaShowType**: Obtenemos los media shows por el tipo de este (Serie o Película).
- **index**: Devuelve todos los datos de una media show con información adicional que no se encuentra en el mismo modelo,
- **indexNew**: Devuelve las últimas 9 media shows agregadas en la base de datos.
- **show**: Mostramos por ID cada media show.
- **search**: Devolvemos la búsqueda de una media show incluido si es película o serie.
- **store**: Esta función nos sirve para crear una nueva media show en el panel de administrador.
- **update**: Esta función nos sirve para modificar una nueva media show en el panel de administrador.
- **destroy**: Esta función nos sirve para eliminar una nueva media show en el panel de administrador.
- **viewByGenreID**: Busca los registros de la tabla intermedia donde el ID coincida con el ID indicado por el usuario.

### PemiController:

Este controlador se encarga de gestionar los pemis para las media shows.

- **view**: Muestra todos los pemis disponibles.

### TypeMediaShowController:

Este controlador se encarga de gestionar los tipos de media shows disponibles para estas.

- **view**: Muestra todos los tipos de media shows disponibles.

### UserController:

Este controlador se encarga de gestionar los usuarios.

- **store**: Esta función nos sirve para crear un nuevo usuario.
- **update**: Esta función nos sirve para modificar un usuario ya existente.
- **destroy**: Esta función nos sirve para eliminar un usuario ya existente.

## Models:

### Country:

Este modelo hace referencia a la tabla "Country" de la base de datos y consta de los siguientes atributos: "Nomenclature" y "Name" (además del propio "ID").

### Favorite:

Este modelo hace referencia a la tabla "favorites" de la base de datos y consta de los siguientes atributos: "id_user" y "id_media_show" (además del propio "ID"). Cuenta con dos claves foráneas, que son id_users, para ligarlo con el usuario en cuestión y id_media_show para relacionarlo con la media show.

### Genres:

Este modelo hace referencia a la tabla "genres" de la base de datos y consta de los siguientes atributos: "name_genre"  (además del propio "ID"). Cuenta con una clave foránea, que es mediaShows, para ligarlo con la media show en particular.

### Image:

Este modelo hace referencia a la tabla "images" de la base de datos y consta de los siguientes atributos: "url" y (además del propio "ID").

### Media_Show_Genres:

Este modelo hace referencia a la tabla "media_show_genres" de la base de datos y consta de los siguientes atributos: "Nomenclature" y "Name" (además del propio "ID").

### Media_Show_Type:

Este modelo hace referencia a la tabla "Media_Show_Type" de la base de datos, nos sirve para diferenciar entre película o serie, además consta de los siguientes atributos: "type" (además del propio "ID").

### Media_Show:

Este modelo hace referencia a la tabla "media_shows" de la base de datos y consta de los siguientes atributos: "id_country", "id_media_show_type", "id_pemi", "nombre", "duracion", "actores", "sinopsis_corta", "sinopsis", "portada_img", "idioma", "directores", "trailer", "fecha_media_show", "saga", "episodios" y "temporadas"  (además del propio "ID"). Es la tabla con más claves foráneas, ya que es la más importante de la base de datos, consta de los siguientes: "country" para ligarlo con el país de origen, "mediaShowType", para saber si es película o serie, "pemi" para saber que restricción de edad y genres para conocer los géneros.

### Pemi:

Este modelo hace referencia a la tabla "pemis" de la base de datos, sirve para saber que restricción de edad tiene la media show, consta de los siguientes atributos: "number_pemi" (además del propio "ID").

### User:

Este modelo hace referencia a la tabla "users" de la base de datos y consta de los siguientes atributos: "name", "email", "password", "name_user" (además del propio "ID").

### Valorations:

Este modelo hace referencia a la tabla "valorations" de la base de datos y consta de los siguientes atributos: "id_user", "id_media_show", "valoracion", "puntuacion", "recomendacion" (además del propio "ID"). Consta de dos claves foráneas, "user" para ligarlo con el usuario en cuestión que ha realizado la valoración y con "id_media_show", para ligarlo con la media_show valorada.

### Visualized:

Este modelo hace referencia a la tabla "visualzed" de la base de datos y consta de los siguientes atributos: "id_user" y "id_media_show" (además del propio "ID"). Consta de dos claves foráneas, "id_user" para ligarlo con el usuario que ha añadido la media show a visualizadas y "mediaShow" para ligarlo con la media show marcada como visualizada.

## Views

### Media - Create:

Utilizaremos esta vista para crear una nueva media show.

### Media - Edit:

Utilizaremos esta vista para editar una nueva media show.

### Media - Index:

Utilizaremos esta vista para mostrar todas las media shows.

### Media - View:

Utilizaremos esta vista para mostrar los datos de una nueva media show.

### Home - Index:

Esta es la vista de la página principal, donde mostramos distintas secciones.

### Login - Login:

Esta es la vista para acceder a la plataforma con tu usuario.

### Media - MediaShows:

Esta es la vista donde se muestran todas las media shows junto con sus filtros.

### Media - View:

Esta es la vista individual por media show, donde podemos valorarla, añadirla a favoritos, a visualizadas, compartirla con los demás, ver su tráiler y las valoraciones que han realizado todos los usuarios.

### Register - Register:

Esta es la vista para crearte una cuenta para poder realizar las acciones sobre una media show.
