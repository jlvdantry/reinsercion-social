cat > $0.cmd << fin
{
    if (\$1==par) {
       print \$2
    }
}
fin
DB_HOST=`cat .env | awk -v par=DB_HOST -F = -f $0.cmd`
DB_DATABASE=`cat .env | awk -v par=DB_DATABASE -F = -f $0.cmd`
DB_USERNAME=`cat .env | awk -v par=DB_USERNAME -F = -f $0.cmd`
DB_PASSWORD=`cat .env | awk -v par=DB_PASSWORD -F = -f $0.cmd`
echo $DB_HOST
export PGPASSWORD=$DB_PASSWORD
##DB_DATABASE=template1
##DB_USERNAME=postgres
DB_HOST=localhost
cat > $0.sql << fin
--select * from users where email='joseluisvasquez55924@gmail.com';
--delete from users where email='joseluisvasquez55924@gmail.com';
--select * from perfiles_users where idusuario=20;
--select * from perfiles;
--delete from users where email='jlvdantry@hotmail.com';
--update boletas set estatus=0 where boleta_remision='4878748';
--update boletas set estatus=0 where boleta_remision='33233';
--select idjuzgado,boleta_remision,estatus,expediente,diahechos from boletas where boleta_remision='4878748';
--select * from infractores where idboleta=(select id from boletas where boleta_remision='4878748');
--select * from files where id=32;
--select descripcion from alcaldias alc left join juzgados juz on alc.id_cat_alcaldia=juz.idalcaldia where juz.id=5;
/*
update boletas set estatus=0,expediente=0 where boleta_remision='SDGBFGNDDFG';
select * from boletas where boleta_remision='SDGBFGNDDFG';
select * from infractores where idboleta=(select id from boletas where boleta_remision='SDGBFGNDDFG');
*/
--select idjuzgado,boleta_remision,estatus,expediente,diahechos from boletas where idjuzgado=5 and diahechos between '2019/01/01' and '2019/12/31' and estatus=1;
--select coalesce(max(expediente),0)+1 ultimo from boletas where idjuzgado=5 and diahechos between '2019/01/01' and '2019/12/31' and estatus=1
--select * from infracciones
--update boletas set estatus=0,expediente=0 where boleta_remision='456345634563';
--select * from boletas where boleta_remision='456345634563';
--select * from infractores where idboleta=(select id from boletas where boleta_remision='456345634563');
--delete from boletas where (select count(*) from infractores infra where  infra.idboleta=boletas.id)=0;
--select * from migrations
--select * from boletas;
update boletas set estatus=0,expediente=0 where boleta_remision='78787';
--select * from infracciones;
fin
psql -h $DB_HOST -d $DB_DATABASE -U $DB_USERNAME  < $0.sql
##psql -U $DB_USERNAME  < $0.sql     ## para crear la bse de datos
##pg_dump -s -t users -h $DB_HOST -U $DB_USERNAME $DB_DATABASE > database/migrations/users.dmp
##pg_dump -s -t inmuebles -h $DB_HOST -U $DB_USERNAME $DB_DATABASE >> database/migrations/inmuebles.dmp
##pg_dump -s -t users -h $DB_HOST -U $DB_USERNAME $DB_DATABASE >> database/migrations/users.dmp
##pg_dump -s -h $DB_HOST -U $DB_USERNAME $DB_DATABASE > esquema_pc.sql
rm $0.cmd
rm $0.sql
