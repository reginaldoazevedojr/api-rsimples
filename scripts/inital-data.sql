INSERT INTO db_rsimples.public.oauth_users (username, created_by, created_at, password) VALUES ('system', 'system', current_timestamp, 'NOT LOGIN');

INSERT INTO db_rsimples.public.person (person_id, created_by, created_at, first_name, last_name, mail) values (nextval('person_person_id_seq'), 'system', current_timestamp, 'Reginaldo', 'Azevedo Junior', 'reginaldoazevedojr@gmail.com');
INSERT INTO db_rsimples.public.oauth_users (username, created_by, created_at, password, person_id) VALUES ('reginaldoazevedojr@gmail.com', 'system', current_timestamp, 'NOT LOGIN', currval('person_person_id_seq'));

INSERT INTO db_rsimples.public.oauth_clients (client_id, created_by, updated_by, created_at, updated_at, client_secret, redirect_uri, grant_types, scope, user_id) VALUES ('rsimples', 'system', DEFAULT, '2018-09-10 02:24:30', DEFAULT, 'rsimples', 'http://localhost:4200', DEFAULT, DEFAULT, DEFAULT);