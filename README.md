# TRABAJO PRACTICO ESPECIAL WEB 2 - PRIMER ENTREGA 26/9

## Integrantes:
- Leopoldo Villa. villaleoo@hotmail.com .
- Gabriel Andres Garcia. gabrielandgarcia.995@gmail.com

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
- Partido -> Liga (un partido pertenece a una unica liga, relacion muchos a 1).
- Partido -> Club (un partido involucra a dos clubes, relacion muchos a 2).
- Club -> Liga (cada club pertenece a una liga, relacion muchos a 1).
#### Claves primarias y foraneas
Las tres tablas poseen la clave primaria id. La tabla Partido incluye 3 claves foraneas que son los id de
los clubes que disputan un partido y el nombre del estadio del club local. La tabla Club incluye una 
clave foranea asociada al id de la liga perteneciente.
En el diagrama-der.pdf se marca como PK (primary key) a las claves primarias y como FK (foreigner key) a las claves foraneas.
- Todos los atributos fijados como PK (id's) se establecieron autoincrementales.
- En la tabla Partido hay 3 atributos que pueden ser declarados como nulos (goles_local, goles_visita, canal_televisa) para partidos que tengan fecha futura.

## Tipos de datos
 - Tabla partido: int, date (para fecha), timestamp (para horario), varchar.
 - Tabla liga: int, varchar.
 - Tabla club: int, varchar.






