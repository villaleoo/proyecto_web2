# TRABAJO PRACTICO ESPECIAL WEB 2 - SEGUNDA ENTREGA 17/10

## Integrantes:
- Leopoldo Villa. villaleoo@hotmail.com 

## Tematica:
Se refactorizo la idea original de la primer entrega para hacer algo mas simple y sobre todo mas util. Apuntaremos realizar un sitio web orientado al analisis de estadisticas e informacion de clubes de futbol pertenecientes a determinadas ligas. Al ingresar a una determinada liga mostrara informacion de la liga en una determinada temporada y los clubes que la componen. Al ingresar a un club, detallara informacion del club en particular.

## Diagrama DER
Al diagrama lo componen las tablas Ligas y Clubes.
#### Entidades:
- Liga.
- Club.
#### Atributos:
Visibles en el archivo der.pdf.
#### Relaciones:
- Club -> Liga (varios clubes pertenecen a una liga, relacion muchos a 1).
#### Claves primarias y foraneas
Las dos tablas poseen la clave primaria id. La tabla Club incluye una 
clave foranea asociada al id de la liga a la cual pertenece.

- Todos los atributos fijados como PK (id's) se establecieron autoincrementales.
- Las imagenes almacenadas en la base de datos son los unicos datos que pueden ser nulos.

## Tipos de datos
 - Tabla ligas: int, varchar, varbinary para imagenes.
 - Tabla clubes: int, varchar, varbinary para imagenes.







