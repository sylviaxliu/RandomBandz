SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Songs;
DROP TABLE IF EXISTS Albums;
DROP TABLE IF EXISTS Artists;
DROP TABLE IF EXISTS Artist_Lists;
DROP TABLE IF EXISTS Song_Stats;
DROP TABLE IF EXISTS Playlists;

CREATE TABLE Users (
	user_id char(20) NOT NULL,
	name varchar(20) NOT NULL,
	password varchar(20) NOT NULL,
	artist_id integer,
	date_joined date NOT NULL,
		PRIMARY KEY (user_id)
);

CREATE TABLE Songs (
	song_id integer NOT NULL,
	name varchar(20) NOT NULL,
	artist_list_id integer NOT NULL,
	length integer NOT NULL,
	genre varchar(20),
	album_id integer NOT NULL,
	release_date date NOT NULL,
		PRIMARY KEY (song_id)
);

CREATE TABLE Albums (
	album_id integer NOT NULL,
	name varchar(20) NOT NULL,
	artist_id integer NOT NULL,
	genre varchar(20),
	release_date date NOT NULL,
		PRIMARY KEY (album_id)
);

CREATE TABLE Artists (
	artist_id integer NOT NULL,
	name varchar(20) NOT NULL,
	date_joined date NOT NULL,
		PRIMARY KEY (artist_id)
);

CREATE TABLE Artist_Lists (
	artist_list_id integer NOT NULL,
	artist_id integer NOT NULL,
	main BOOLEAN NOT NULL,
		PRIMARY KEY (artist_list_id, artist_id)
);

CREATE TABLE Song_Stats (
	song_id integer NOT NULL,
	user_id varchar(20) NOT NULL,
	times_played integer NOT NULL,
	last_listen_to date NOT NULL,
		PRIMARY KEY (song_id, user_id)
);

CREATE TABLE Playlists (
	playlist_id integer NOT NULL,
	order_number integer NOT NULL,
	name varchar(20) NOT NULL,
	song_id integer,
		PRIMARY KEY (playlist_id, order_number)
);

SET FOREIGN_KEY_CHECKS=1;