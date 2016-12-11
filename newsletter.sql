--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.1
-- Dumped by pg_dump version 9.6.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: maillist; Type: TABLE; Schema: public; Owner: raptor
--

CREATE TABLE maillist (
    id integer NOT NULL,
    email text,
    confirm boolean,
    token text,
    "timestamp" date
);


ALTER TABLE maillist OWNER TO raptor;

--
-- Name: maillist_id_seq; Type: SEQUENCE; Schema: public; Owner: raptor
--

CREATE SEQUENCE maillist_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE maillist_id_seq OWNER TO raptor;

--
-- Name: maillist_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: raptor
--

ALTER SEQUENCE maillist_id_seq OWNED BY maillist.id;


--
-- Name: maillist id; Type: DEFAULT; Schema: public; Owner: raptor
--

ALTER TABLE ONLY maillist ALTER COLUMN id SET DEFAULT nextval('maillist_id_seq'::regclass);


--
-- Data for Name: maillist; Type: TABLE DATA; Schema: public; Owner: raptor
--

COPY maillist (id, email, confirm, token, "timestamp") FROM stdin;
9	patrick@iotek.org	t	nixers_584d4235957366be420f5624e3c5c022c178f9f66949b	2016-12-11
\.


--
-- Name: maillist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: raptor
--

SELECT pg_catalog.setval('maillist_id_seq', 9, true);


--
-- Name: maillist maillist_pkey; Type: CONSTRAINT; Schema: public; Owner: raptor
--

ALTER TABLE ONLY maillist
    ADD CONSTRAINT maillist_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

