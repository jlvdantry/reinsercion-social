truncate "public"."perfiles_menus";
INSERT INTO "public"."perfiles_menus" (idperfil,idmenu,mdefault) VALUES ((select id from public.perfiles where descripcion='Administrador'),(select id from public.menus where componente='expedientes'),0);
INSERT INTO "public"."perfiles_menus" (idperfil,idmenu,mdefault) VALUES ((select id from public.perfiles where descripcion='Administrador'),(select id from public.menus where componente='usuarios-registrados'),1);
INSERT INTO "public"."perfiles_menus" (idperfil,idmenu,mdefault) VALUES ((select id from public.perfiles where descripcion='Administrador'),(select id from public.menus where descripcion='Catálogos'),0);
INSERT INTO "public"."perfiles_menus" (idperfil,idmenu,mdefault,idmenupadre) VALUES ((select id from public.perfiles where descripcion='Administrador'),(select id from public.menus where componente='horarios'),0,(select id from public.menus where descripcion='Catálogos'));
INSERT INTO "public"."perfiles_menus" (idperfil,idmenu,mdefault,idmenupadre) VALUES ((select id from public.perfiles where descripcion='Administrador'),(select id from public.menus where componente='actividades'),0,(select id from public.menus where descripcion='Catálogos'));
INSERT INTO "public"."perfiles_menus" (idperfil,idmenu,mdefault,idmenupadre) VALUES ((select id from public.perfiles where descripcion='Administrador'),(select id from public.menus where componente='gruposactividades'),0,(select id from public.menus where descripcion='Catálogos'));

