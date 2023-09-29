# TRABAJO PRACTICO ESPECIAL WEB 2 - PRIMER ENTREGA 26/9

## Integrantes:
- Leopoldo Villa. villaleoo@hotmail.com .
- Gabriel Andres Garcia. gabrielandgarcia.995@gmail.com .

## Tematica:
Sitio web con visualizacion de posiciones y resultados de futbol (similar www.promiedos.com.ar). La idea
es que un usuario administrador pueda agregar ligas al sitio con sus respectivos partidos 
y clubes, y los usuarios-cliente puedan consultar informacion sobre cuando se juegan los partidos, posiciones y demas informacion de una serie/lista de ligas/copas y eventualmente de una liga/copa en particular aplicando filtros, buscando clubes y ligas. Ademas que el usuario-cliente pueda ver la lista de partidos que hay en el dia de la fecha filtrando por fecha de partido (acorde a las ligas cargadas en el sistema). 

## Diagrama DER
Al diagrama lo componen las tablas Partido, Liga y Club.
#### Entidades:
- Partido.
- Liga.
- Club.
#### Atributos:
Visibles en el archivo diagrama-der.pdf (ej.: atributos de tabla partido: id_partido, fecha, hora, id_liga, id_club_local, etc.).
#### Relaciones:
- Liga -> Partido (una liga puede tener muchos partidos, relacion 1 a muchos).
- Partido -> Club (un partido involucra a dos clubes, doble relacion 1 a 1).
- Club -> Liga (varios clubes pertenecen a una liga, relacion muchos a 1).
#### Claves primarias y foraneas
Las tres tablas poseen la clave primaria id. La tabla Partido incluye 3 claves foraneas que son los id de
los dos clubes involucrados y la liga por la cual disputan el partido. La tabla Club incluye una 
clave foranea asociada al id de la liga a la cual pertenece.

- Todos los atributos fijados como PK (id's) se establecieron autoincrementales.
- En la tabla Partido hay atributos (5) que pueden ser nulos:
    - fecha, hora y canal_televisa_arg para partidos los cuales no se hayan definido estas variables.
    - goles_local y goles_visita para partidos con fecha futura, que no se hayan jugado.

## Tipos de datos
 - Tabla partido: int, date (para fecha), timestamp (para horario), varchar.
 - Tabla liga: int, varchar.
 - Tabla club: int, varchar.

## Posible crecimiento/mutacion de la web
Es posible la refactorizacion de la finalidad del sitio e incluir una tabla usuario para que los usuarios-cliente puedan iniciar sesion y colocar una apuesta
a un determinado partido. Para esto, hay ciertas cosas que no cambiarian en el sitio como el layout, la manera de enlistar/agrupar los partidos de cada liga y ciertas tablas como partido, liga y club. Esta refactorizacion seria para añadir mayor interaccion del usuario con la web y que pueda "hacer algo" similar a funcionalidades como agregar a favoritos o persistir algunos datos.  





