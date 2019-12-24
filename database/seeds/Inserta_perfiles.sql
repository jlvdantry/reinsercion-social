truncate "public"."perfiles" RESTART IDENTITY;
INSERT INTO "public"."perfiles" (id,descripcion) VALUES (0,'Sin perfil');
INSERT INTO "public"."perfiles" (descripcion) VALUES ('Beneficiario');
INSERT INTO "public"."perfiles" (descripcion) VALUES ('Administrador');
INSERT INTO "public"."perfiles" (descripcion) VALUES ('Tallerista');
INSERT INTO "public"."perfiles" (descripcion) VALUES ('Operador técnico');

