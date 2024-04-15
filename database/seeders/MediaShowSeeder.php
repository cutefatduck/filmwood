<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\p_media_show;

class MediaShowSeeder extends Seeder
{
    public function run()
    {
        $p_media_show = [

            [
                "id_country" => 65,
                "id_media_show_type" => 2,
                "id_pemi" => "[11,2]",
                "nombre" => "American Horror Story",
                "duracion" => "00:45:00",
                "actores" => "Evan Peters, Emma Roberts, Denis O'Hare, Sarah Paulson, Jessica Lange, Taissa Farmiga, Lily Rabe",
                "sinopsis_corta" => "Es una serie de antología creada por Ryan Murphy y Brad Falchuk, donde cada temporada presenta una historia independiente con un elenco cambiante.",
                "portada_img" => "http://localhost:8000/images/portada_american_horror_story.jpg",
                "idioma" => "Castellano, Inglés",
                "directores" => "Ryan Murphy, Brad Falchuk",
                "sinopsis" => "Es una serie de televisión creada por Ryan Murphy y Brad Falchuk que se caracteriza por su formato antológico, donde cada temporada presenta una historia independiente con nuevos personajes, escenarios y tramas, aunque algunos actores recurrentes interpretan diferentes roles en cada entrega. La serie abarca una amplia gama de temas del horror, desde casas encantadas y asilos psiquiátricos hasta brujería, circo de fenómenos y apocalipsis, entre otros. Con un estilo visual único y un enfoque en lo grotesco y lo surrealista, 'American Horror Story' ha ganado seguidores por su capacidad para sorprender, asustar y provocar reflexión sobre los miedos más profundos de la humanidad.",
                "fecha_media_show" => "2011-11-05",
                "trailer" => "http://localhost:8000/videos/trailer_american_horror_story.mp4",
                "saga" => null,
                "episodios" => 12,
                "temporadas" => 128
            ],
            

            [
                
                "id_country" => 185,
                "id_media_show_type" => 3,
                "id_pemi" => 2,
                "nombre" => "Star Wars: Clone Wars",
                "duracion" => "00:25:00",
                "actores" => "Matt Lanter, James Arnold Taylor, Ashley Drane, Dee Bradley Baker",
                "sinopsis_corta" => "Es una serie de televisión animada ambientada entre los sucesos de Star Wars: Episodio II El Ataque de los Clones y Star Wars: Episodio III La Venganza de los Sith.",
                "portada_img" => "http://localhost:8000/images/portada_clone_wars.jpg",
                "idioma" => "Castellano, Inglés",
                "directores" => "George Lucas, Dave Filoni, Henry Gilroy",
                "sinopsis" => "Cada vez más Sistemas caen bajo el poder del Lado Oscuro y los jedis van perdiendo terreno frente a esta temible amenaza. Anakin Skywalker y su Padawan y joven aprendiz, Ahsoka Tano, son enviados a una peligrosa misión para intentar resolver este problema y eliminar de una vez por todas el poder del Lado Oscuro. Sin embargo, el Conde Dooku y sus siniestros agentes no se lo pondrán nada fácil y harán todo lo posible por detenerlos.",
                "fecha_media_show" => "2008-10-03",
                "trailer" => "http://localhost:8000/videos/trailer_clone_wars.mp4",
                "saga" => null,
                "episodios" => 7,
                "temporadas" => 133
            ],

            [
                "id_country" => 64,
                "id_media_show_type" => 6,
                "id_pemi" => 2,
                "nombre" => "Cuentame Como Paso",
                "duracion" => "00:45:00",
                "actores" => "Imanol Arias, Ana Duato, Maria Gailiana, Ricardo Gomez, Pablo Rivero, Irene Visedo, Paula Gallego",
                "sinopsis_corta" => "Un retrato de la vida de la familia Alcantara quien emigro a Madrid desde su pueblo natal en la Mancha, Sagrillas, en los años 50. Una de las series mas longevas y populares de Espana.",
                "portada_img" => "http://localhost:8000/images/portada_cuentame.jpg",
                "idioma" => "Castellano",
                "directores" => "Miguel Angel Bernardeau, Eduardo Ladron de Guevara, Patrick Buckley",
                "sinopsis" => "Un retrato de la vida de la familia Alcantara quien emigro a Madrid desde su pueblo natal en la Mancha, Sagrillas, en los años 50.",
                "fecha_media_show" => "2001-01-13",
                "trailer" => "http://localhost:8000/videos/trailer_cuentame.mp4",
                "saga" => null,
                "episodios" => 23,
                "temporadas" => 422
            ],

            [
                "id_country" => 65,
                "id_media_show_type" => 6,
                "id_pemi" => 2,
                "nombre" => "El Principe de Bel-Air",
                "duracion" => "00:45:00",
                "actores" => "Will Smith, Alfonso Ribeiro, James Avery, Karyn Parsons, Joseph Marcell",
                "sinopsis_corta" => "Will Smith interpreta a un joven de Philadelphia que se traslada a vivir con sus ricos",
                "portada_img" => "http://localhost:8000/images/portada_principe_bel_air.jpg",
                "idioma" => "Latino, Castellano, Ingles",
                "directores" => "Andy Borowitz, Susan Borowitz, Shelley Jensen",
                "sinopsis" => "Will Smith interpreta a un joven de Philadelphia que se traslada a vivir con sus ricos parientes al lujoso barrio de Bel-Air, en California. La familia la forman sus tíos y sus primos Carlton, Hilary y Ashley; además está el mayordomo Geoffrey. El incorregible y avispado Will deberá adaptarse a su nueva familia, a un nivel de vida al que no estaba acostumbrado y a las reglas de convivencia impuestas por su tío Phil, un juez muy preocupado por su reputación.",
                "fecha_media_show" => "1990-09-10",
                "trailer" => "http://localhost:8000/videos/trailer_principe_bel_air.mp4",
                "saga" => null,
                "episodios" => 6,
                "temporadas" => 148
            ],

            [
                "id_country" => 65,
                "id_media_show_type" => 2,
                "id_pemi" => 5,
                "nombre" => "The X files",
                "duracion" => "00:45:00",
                "actores" => "Gillian Anderson, David Duchovny, William B. Davis, Mitch Pileggi, Robert Patrick",
                "sinopsis_corta" => "Centrada en los casos que investigan dos agentes del FBI, clasificados como expedientes X: fenómenos paranormales, avistamiento de ovnis, criaturas extrañas, etcétera.",
                "portada_img" => "http://localhost:8000/images/portada_the_x_files.png",
                "idioma" => "Inglés",
                "directores" => "Chris Carter",
                "sinopsis" => "Fox Mulder y Dana Scully son dos investigadores del FBI que investigan casos sin resolución ni explicación, ya sea por razones paranormales (espíritus, criaturas extrañas, aliens...) ya porque el gobierno se ha encargado de ocultar todo tipo de pruebas. Cuando Mulder tenía 12 años, su hermana pequeña fue secuestrada por unos desconocidos, aunque él está convencido de que fue abducida por extraterrestres. Tras acabar sus estudios en la Universidad de Oxford, ingresó en la Academia de Quantico, donde se ganó el apodo de 'siniestro'. Empezó entonces su prometedora carrera como agente del FBI encargado de investigar los 'Expedientes X'. En 1993 le fue asignada como compañera la agente Dana Scully, una médico cuya misión consistía en vigilar y en gran medida poder desacreditar su trabajo. Sin embargo, con el tiempo los informes de la agente Scully empiezan a ser favorables para la cruzada personal del Mulder.",
                "fecha_media_show" => "1993-09-10",
                "trailer" => "http://localhost:8000/videos/trailer_the_x_files.mp4",
                "saga" => null,
                "episodios" => 11,
                "temporadas" => 218
            ],

            [
                "id_country" => 65,
                "id_media_show_type" => 2,
                "id_pemi" => 3,
                "nombre" => "Los Simpsons",
                "duracion" => "00:25:00",
                "actores" => "Harry Shearer, Dan Castellaneta, Hank Azaria",
                "sinopsis_corta" => "Los Simpsons es una serie de comedia animada que sigue las aventuras y desventuras de la familia Simpson, compuesta por Homer, Marge, Bart, Lisa y Maggie, quienes viven en Springfield.",
                "portada_img" => "http://localhost:8000/images/portada_los_simpsons.png",
                "idioma" => "Castellano, Latino",
                "directores" => "Matt Groening",
                "sinopsis" => "Los Simpsons es una serie de comedia animada que sigue las aventuras y desventuras de la familia Simpson, compuesta por Homer, Marge, Bart, Lisa y Maggie, quienes viven en la ficticia ciudad de Springfield. La serie está llena de humor satírico y parodias de la cultura pop, explorando temas sociales, políticos y familiares a través de sus diversos personajes y situaciones.",
                "fecha_media_show" => "1989-12-17",
                "trailer" => "http://localhost:8000/videos/trailer_los_simpsons.mp4",
                "saga" => null,
                "episodios" => 36,
                "temporadas" => 772
            ],

            [
                "id_country" => 65,
                "id_media_show_type" => 3,
                "id_pemi" => 5,
                "nombre" => "South Park",
                "duracion" => "00:25:00",
                "actores" => "Trey Parker, Matt Stone, Mary Kay Bergman",
                "sinopsis_corta" => "Serie de animación con mucho humor negro que narra las aventuras de cuatro chicos muy gamberros que viven en la peculiar ciudad de South Park, Colorado.",
                "portada_img" => "http://localhost:8000/images/portada_south_park.jpg",
                "idioma" => "Castellano, Ingles",
                "directores" => "Trey Parker, Matt Stone",
                "sinopsis" => "South Park es una serie animada creada por Trey Parker y Matt Stone que se centra en las vidas y aventuras de cuatro niños preadolescentes: Stan Marsh, Kyle Broflovski, Eric Cartman y Kenny McCormick, quienes residen en el pueblo ficticio de South Park, Colorado. La serie es conocida por su humor irreverente, satírico y políticamente incorrecto, así como por abordar una amplia gama de temas sociales, políticos y culturales de manera provocativa.",
                "fecha_media_show" => "1997-08-13",
                "trailer" => "http://localhost:8000/videos/trailer_south_park.mp4",
                "saga" => null,
                "episodios" => 26,
                "temporadas" => 325
            ],

            [
                "id_country" => 185,
                "id_media_show_type" => 2,
                "id_pemi" => 5,
                "nombre" => "Spartacus Sangre y Arena",
                "duracion" => "00:45:00",
                "actores" => "Andy Whitfield, Lucy Lawless, John Hannah, Manu Bennett, Peter Mensah",
                "sinopsis_corta" => "Espartaco protagoniza un cuento sobre el esclavo que provocó una revuelta en la antigua Roma, haciéndose eco hasta nuestros días.",
                "portada_img" => "http://localhost:8000/images/portada_spartacus.jpg",
                "idioma" => "Castellano",
                "directores" => "Steven S. DeKnight, Rick Jacobson, Michael Hurst",
                "sinopsis" => "Traicionado por su país. Convertido en esclavo. Renacido como guerrero. Spartacus protagoniza la historia más gráfica y visceral del gladiador más famoso de Roma. Con un reparto estelar, asistimos a una mezcla única de acción, efectos gráficos y brutales batallas. Separado del amor de su vida, Spartacus tendrá que luchar por su supervivencia, participando en un espectáculo, donde el principal entretenimiento es la muerte. En un mundo de corrupción, violencia, sexo y fama acabará interviniendo en política y vivirá atormentado por el deseo de venganza.",
                "fecha_media_show" => "2010-01-22",
                "trailer" => "http://localhost:8000/videos/trailer_spartacus.mp4",
                "saga" => null,
                "episodios" => 3,
                "temporadas" => 33
            ],

            [
                "id_country" => 185,
                "id_media_show_type" => 5,
                "id_pemi" => 4,
                "nombre" => "The Walking Dead",
                "duracion" => "00:45:00",
                "actores" => "Andrew Lincoln, Norman Reedus, Lauren Cohan, Jeffrey Dean, Melissa McBride",
                "sinopsis_corta" => "Herido en acto de servicio, Rick Grimes, el sheriff de un pequeño pueblo de Georgia, se despierta de un coma en un mundo infestado de 'caminantes' zombis.",
                "portada_img" => "http://localhost:8000/images/portada_the_walking_dead.jpg",
                "idioma" => "Castellano, Ingles",
                "directores" => "Robert Kirkman, Frank Darabont, Charlie Adlard",
                "sinopsis" => "The Walking Dead está basada en un mundo post-apocalíptico repleto de zombis, llamados caminantes, en el que un grupo de supervivientes debe de luchar por su vida frente a la plaga de estos y los peligros de otros grupos de humanos hostiles.",
                "fecha_media_show" => "2010-10-31",
                "trailer" => "http://localhost:8000/videos/trailer_the_walking_dead.mp4",
                "saga" => null,
                "episodios" => 10,
                "temporadas" => 177
            ],

            [
                "id_country" => 185,
                "id_media_show_type" => 2,
                "id_pemi" => 4,
                "nombre" => "Vikings",
                "duracion" => "00:45:00",
                "actores" => "Travis Fimmel, Katheryn Winnick, Gustaf Skarsgard, Alexander Ludwig, Clive Standen",
                "sinopsis_corta" => "Narra las aventuras del héroe Ragnar Lothbrok, de sus hermanos vikingos y su familia, cuando él se subleva para convertirse en el rey de las tribus vikingas.",
                "portada_img" => "http://localhost:8000/images/portada_vikings.jpg",
                "idioma" => "Castellano, Ingles",
                "directores" => "Michael Hirst, Ken Girotti, Ciaran Donnelly",
                "sinopsis" => "Narra las aventuras del héroe Ragnar Lothbrok, de sus hermanos vikingos y su familia, cuando él se subleva para convertirse en el rey de las tribus vikingas. Además de ser un guerrero valiente, Ragnar encarna las tradiciones nórdicas de la devoción a los dioses. Según la leyenda era descendiente directo del dios Odin.",
                "fecha_media_show" => "2013-03-03",
                "trailer" => "http://localhost:8000/videos/trailer_vikings.mp4",
                "saga" => null,
                "episodios" => 6,
                "temporadas" => 89
            ],

            [
                "id_country" => 185,
                "id_media_show_type" => 1,
                "id_pemi" => 3,
                "nombre" => "El imperio del fuego",
                "duracion" => "01:40:00",
                "actores" => "Matthew McConaughey, Christian Bale, Izabella Scorupco, Gerard Butler",
                "sinopsis_corta" => "En Londres, Quinn, un niño de doce años, despierta sin querer a un enorme dragón de su letargo de siglos. Veinte años más tarde, pueden apreciarse las devastadoras consecuencias de la bestia.",
                "portada_img" => "http://localhost:8000/images/portada_imperio_fuego.jpg",
                "idioma" => "Ingles",
                "directores" => "Rob Bowman",
                "sinopsis" => "En Londres, Quinn, un niño de doce años, despierta sin querer a un enorme dragón de su letargo de siglos. Veinte años más tarde, pueden apreciarse las devastadoras consecuencias del paso de la bestia y de sus vástagos por todo el planeta. Los dragones son seres extremadamente inteligentes que no tienen ninguna intención de compartir la Tierra con los seres humanos. Quinn (Christian Bale) es ahora Jefe de Bomberos. Su trabajo consiste en mantener alejadas a las bestias para garantizar la supervivencia de una pequeña población. En medio de este caos aparece Van Zan (Matthew McConaughey), un norteamericano que asegura saber cómo acabar con los dragones y salvar a la humanidad.",
                "fecha_media_show" => "2002-07-12",
                "trailer" => "http://localhost:8000/videos/trailer_imperio_del_fuego.mp4",
                "saga" => null,
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 64,
                "id_media_show_type" => 1,
                "id_pemi" => 4,
                "nombre" => "REC 2",
                "duracion" => "01:24:00",
                "actores" => "Manuela Velasco, Oscar Zafra, Alejandro Casaseca, Juli Fabregas, Javier Botet, Jonathan Mellor",
                "sinopsis_corta" => "Un grupo de policías entra en un edificio acompañado por un doctor para conseguir la sangre de los infectados y encontrar así una cura.",
                "portada_img" => "http://localhost:8000/images/portada_rec_2.jpg",
                "idioma" => "Castellano",
                "directores" => "Jaume Balagueró, Paco Plaza",
                "sinopsis" => "Secuela de la película [REC] (2006), con el mismo formato de falso documental. Quince minutos después del final de la primera parte, un grupo de policías entra en el edificio acompañados por un doctor con tal de conseguir la sangre de los infectados, en especial la de la infectada inicial que habitaba el ático, para encontrar una cura. A su vez, tres adolescentes, un bombero y un antiguo inquilino entran por el alcantarillado. Lo que ninguno sabe es que van a pasar el peor momento de su vida en cuanto se crucen con los infectados.",
                "fecha_media_show" => "2009-10-02",
                "trailer" => "http://localhost:8000/videos/trailer_rec_2.mp4",
                "saga" => "REC",
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 185,
                "id_media_show_type" => 1,
                "id_pemi" => 2,
                "nombre" => "Shrek",
                "duracion" => "01:27:00",
                "actores" => "Mike Myers, Eddie Murphy, Cameron Diaz, John Lithgow",
                "sinopsis_corta" => "En un intento por recuperar su paz, Shrek se embarca en un viaje para confrontar a Farquaad, pero termina descubriendo el verdadero significado de la amistad y el amor en el camino.",
                "portada_img" => "http://localhost:8000/images/portada_shrek.jpeg",
                "idioma" => "Castellano",
                "directores" => "Andrew Adamson, Vicky Jenson",
                "sinopsis" => "Hace mucho tiempo, en una lejanísima ciénaga, vivía un feroz ogro llamado Shrek. De repente, un día, su soledad se ve interrumpida por una invasión de sorprendentes personajes. Hay ratoncitos ciegos en su comida, un enorme y malísimo lobo en su cama, tres cerditos sin hogar y otros seres que han sido deportados de su tierra por el malvado Lord Farquaad. Para salvar su territorio, Shrek hace un pacto con Farquaad y emprende viaje para conseguir que la bella princesa Fiona acceda a ser la novia del Lord. En tan importante misión le acompaña un divertido burro, dispuesto a hacer cualquier cosa por Shrek: todo, menos guardar silencio.",
                "fecha_media_show" => "2001-04-22",
                "trailer" => "http://localhost:8000/videos/trailer_shrek.mp4",
                "saga" => "Shrek 2",
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 64,
                "id_media_show_type" => 1,
                "id_pemi" => 4,
                "nombre" => "REC",
                "duracion" => "01:16:00",
                "actores" => "Manuela Velasco, Ferran Terraza, Jorge Serrano, Pablo Rosso, David Vert",
                "sinopsis_corta" => "Una reportera y su camarógrafo graban la terrible epidemia de una enfermedad que transforma a los humanos en caníbales en un edificio de vecinos que ha sido puesto en cuarentena.",
                "portada_img" => "http://localhost:8000/images/portada_rec.jpeg",
                "idioma" => "Castellano",
                "directores" => "Paco Plaza, Jaume Balagueró",
                "sinopsis" => "Cada noche, Ángela (Manuela Velasco), una joven reportera de una televisión local, sigue con su cámara a un grupo profesional distinto. Esta noche le toca entrevistar a los bomberos y tiene la secreta esperanza de poder asistir en directo a un impactante incendio. Pero la noche transcurre tranquilamente. Y cuando, por fin, reciben la llamada de una anciana que se ha quedado encerrada en su casa, no le queda otro remedio que seguirlos durante la misión de rescate. En el edificio donde vive la anciana, los vecinos están muy asustados. La mujer, encerrada en su piso, lanza unos gritos desgarradores... Es solo el comienzo de una larga pesadilla y de un dramático reportaje único en el mundo.",
                "fecha_media_show" => "2007-11-23",
                "trailer" => "http://localhost:8000/videos/trailer_rec.mp4",
                "saga" => "REC 2",
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 185,
                "id_media_show_type" => 1,
                "id_pemi" => 2,
                "nombre" => "Shrek 2",
                "duracion" => "01:33:00",
                "actores" => "Mike Myers, Eddie Murphy, Cameron Diaz, Antonio Banderas",
                "sinopsis_corta" => "Shrek, nuestro ogro favorito, debe enfrentarse al mayor de los problemas que se podía imaginar: conocer a sus suegros. Secuela de la exitosa película: Shrek.",
                "portada_img" => "http://localhost:8000/images/portada_shrek_2.jpg",
                "idioma" => "Aleman",
                "directores" => "Andrew Adamson, Kelly Asbury, Conrad Vernon",
                "sinopsis" => "Cuando Shrek y la princesa Fiona regresan de su luna de miel, los padres de ella los invitan a visitar el reino de Muy Muy Lejano para celebrar la boda. Para Shrek, al que nunca abandona su fiel amigo Asno, esto constituye un gran problema. Los padres de Fiona, por su parte, no esperaban que su yerno tuviera un aspecto semejante y, mucho menos, que su hija hubiera cambiado tanto. Todo esto trastoca los planes del rey respecto al futuro del reino. Pero entonces entran en escena la maquiavélica Hada Madrina, su arrogante hijo el Príncipe Encantador y un minino muy especial: el Gato con Botas, experto cazador de ogros.",
                "fecha_media_show" => "2004-06-30",
                "trailer" => "http://localhost:8000/videos/trailer_shrek_2.mp4",
                "saga" => "Shrek",
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 124,
                "id_media_show_type" => 1,
                "id_pemi" => 8,
                "nombre" => "El último Samurai",
                "duracion" => "02:24:00",
                "actores" => "Tom Cruise, Ken Watanabe, Billy Connolly, Tony Goldwyn, Timothy Spall, Koyuki",
                "sinopsis_corta" => "El capitán Nathan Algren es un hombre que vive atormentado por los recuerdos de la guerra, pero el mundo ha cambiado y el pragmatismo ha reemplazado a los valores de las personas.",
                "portada_img" => "http://localhost:8000/images/portada_ultimo_samurai.png",
                "idioma" => "Castellano, Ingles",
                "directores" => "Edward Zwick",
                "sinopsis" => "Año 1876. El capitán Nathan Algren es un hombre que sobrevive atormentado por los recuerdos de la Guerra Civil (1861-1865) y de las campañas contra los indios, en las que participó arriesgando su vida. Desde entonces, el mundo ha cambiado radicalmente: el pragmatismo ha reemplazado al valor, el interés personal ha ocupado el lugar del sacrificio, y el sentido del honor ha desaparecido. En un país muy lejano, otro soldado ve también como su modo de vida está a punto de desintegrarse. Es Katsumoto, el último líder de un antiguo linaje de guerreros, los venerados samuráis, que dedicaron sus vidas a servir al emperador y a preservar el espíritu de la milenaria cultura japonesa.",
                "fecha_media_show" => "2004-01-09",
                "trailer" => "http://localhost:8000/videos/trailer_imperio_del_fuego.mp4",
                "saga" => null,
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 122,
                "id_media_show_type" => 1,
                "id_pemi" => 10,
                "nombre" => "El bueno, el feo y el malo",
                "duracion" => "02:41:00",
                "actores" => "Clint Eastwood, Lee Van Cleef, Eli Wallach Aldo Giuffre, Rada Rassimov",
                "sinopsis_corta" => "Los protagonistas son tres cazadores de recompensas que buscan un tesoro que ninguno de ellos puede encontrar sin la ayuda de los otros dos. Los tres colaboran entre sí, al menos en apariencia.",
                "portada_img" => "http://localhost:8000/images/portada_bueno_feo_malo.jpg",
                "idioma" => "Italiano",
                "directores" => "Sergio Leone",
                "sinopsis" => "Los protagonistas son tres cazadores de recompensas que buscan un tesoro que ninguno de ellos puede encontrar sin la ayuda de los otros dos. Así que los tres colaboran entre sí, al menos en apariencia.",
                "fecha_media_show" => "1968-08-07",
                "trailer" => "http://localhost:8000/videos/trailer_bueno_feo_malo.mp4",
                "saga" => "Por un puñado de dólares, La muerte tenía un precio",
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 122,
                "id_media_show_type" => 1,
                "id_pemi" => 10,
                "nombre" => "Por un puñado de dólares",
                "duracion" => "01:35:00",
                "actores" => "Clint Eastwood, Marianne Koch, Gian Maria Volonte, Sieghardt Rupp",
                "sinopsis_corta" => "Tras la muerte de Juarez, en México dominan la injusticia y el terror. Joe, un pistolero vagabundo, llega al pueblo de San Miguel, donde dos familias se disputan el control del territorio.",
                "portada_img" => "http://localhost:8000/images/portada_por_un_punado_de_dolares.jpg",
                "idioma" => "Italiano",
                "directores" => "Sergio Leone",
                "sinopsis" => "Tras la muerte de Juarez, en México dominan la injusticia y el terror. Joe (Clint Eastwood), un pistolero vagabundo, llega al pueblo fronterizo de San Miguel, donde dos familias se disputan el control del territorio, y entra al servicio del clan Rojo. Una noche, es testigo del intercambio de oro por armas entre mexicanos y soldados de la Unión. Remake en clave de western de 'Yojimbo', de Akira Kurosawa.",
                "fecha_media_show" => "1965-09-27",
                "trailer" => "http://localhost:8000/videos/trailer_por_un_punado_de_dolares.mp4",
                "saga" => "El bueno, el feo y el malo, La muerte tenía un precio",
                "episodios" => null,
                "temporadas" => null
            ],

            [
                "id_country" => 122,
                "id_media_show_type" => 1,
                "id_pemi" => 10,
                "nombre" => "La muerte tenía un precio",
                "duracion" => "02:15:00",
                "actores" => "Clint Eastwood, Lee Van Cleef, Gian Maria Volonte, Mara Krupp",
                "sinopsis_corta" => "Dos cazarrecompensas, Monco y Col, persiguen al líder de una banda de forajidos que está aterrorizando la zona. En un principio rivales, acabarán colaborando para dar caza a este criminal.",
                "portada_img" => "http://localhost:8000/images/portada_la_muerte_tenia_un_precio.jpeg",
                "idioma" => "Italiano",
                "directores" => "Sergio Leone",
                "sinopsis" => "Dos cazadores de recompensas que buscan al mismo hombre deciden unir sus fuerzas para encontrarlo, aunque las razones que los mueven son completamente diferentes... Su título original ('Per qualche dollaro in più') ya sugiere que es la continuación natural de 'Por un puñado de dólares' ('Per un pugno di dollari'), dirigida por Leone un año antes.",
                "fecha_media_show" => "1966-09-05",
                "trailer" => "http://localhost:8000/videos/trailer_la_muerte_tenia_un_precio.mp4",
                "saga" => "El bueno, el feo y el malo, Por un puñado de dólares",
                "episodios" => null,
                "temporadas" => null
            ]

        ];

        foreach ($p_media_shows as $p_media_show){
            
            p_media_show::create($p_media_show);
        }
        
    }
}
