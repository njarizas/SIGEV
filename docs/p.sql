ALTER SEQUENCE preguntas_seq restart 1;
ALTER SEQUENCE respuestas_seq restart 1;

select * from preguntas;
select * from respuestas;

delete from respuestas;
delete from preguntas;

create view vistapreguntas as
select enunciado, respuesta from preguntas p
inner join respuestas r
on p.valorpregunta=r.idrespuesta;

select * from vistapreguntas;