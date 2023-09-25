# TRABAJO PRACTICO ESPECIAL WEB 2 - PRIMER ENTREGA 26/9

## Integrantes:
- Leopoldo Villa. villaleoo@hotmail.com .
- Gabriel Andres Garcia. gabrielandgarcia.995@gmail.com

## Tematica:
Sitio web con visualizacion de posiciones y resultados de futbol (similar www.promiedos.com.ar). La idea
es en principio que un usuario administrador pueda agregar ligas al sitio con sus respectivos partidos 
y clubes. El usuario-cliente podra consultar informacion de una lista de ligas/copas o de una liga/copa en particular.Podra ver la lista de partidos que hay en el dia de la fecha (acorde a las ligas cargadas en el sistema). 

## Diagrama DER
Al diagrama lo componen las tablas Partido, Liga y Club.
#### Entidades:
- Partido.
- Liga.
- Club.
#### Atributos:
Visibles en el archivo diagrama-der.pdf (ej. Partido: id_partido, fecha, hora, etc.).
#### Relaciones:
- Partido -> Liga (un partido pertenece a una unica liga, relacion muchos a 1).
- Partido -> Club (un partido involucra a dos clubes, relacion muchos a 2).
- Club -> Liga (cada club pertenece a una liga, relacion muchos a uno).
#### Claves primarias y foraneas
Las tres tablas poseen la clave primaria id. La tabla Partido incluye 3 claves foraneas que son los id de
los clubes que disputan un partido y el nombre del estadio del club local. La tabla Club incluye una 
clave foranea asociada al id de la liga perteneciente.
En el diagrama-der.pdf se marca como PK (primary key) a las claves primarias y como FK (foreigner key) a las claves foraneas.
## Tipos de datos




