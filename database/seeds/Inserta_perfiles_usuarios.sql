truncate "public"."perfiles_users";
INSERT INTO "public"."perfiles_users" (idperfil,idusuario) VALUES ((select id from public.perfiles where descripcion='Administrador'),(select id from public.users where email='admon@hotmail.com'));

