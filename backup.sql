--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2 (Debian 17.2-1.pgdg120+1)
-- Dumped by pg_dump version 17.2 (Debian 17.2-1.pgdg120+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: delete_user_cascade(); Type: FUNCTION; Schema: public; Owner: docker
--

CREATE FUNCTION public.delete_user_cascade() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    DELETE FROM category WHERE id_cat IN (SELECT id_bud FROM budgets WHERE login = OLD.login);
    DELETE FROM budgets WHERE login = OLD.login;
    RETURN OLD;
END;
$$;


ALTER FUNCTION public.delete_user_cascade() OWNER TO docker;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: budgets; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.budgets (
    login character varying(100) NOT NULL,
    title character varying(100),
    budget_amount integer,
    id_bud integer NOT NULL
);


ALTER TABLE public.budgets OWNER TO docker;

--
-- Name: budgets_id_bud_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.budgets_id_bud_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.budgets_id_bud_seq OWNER TO docker;

--
-- Name: budgets_id_bud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.budgets_id_bud_seq OWNED BY public.budgets.id_bud;


--
-- Name: category; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.category (
    title_payment character varying(100),
    to_pay integer,
    pay_date date,
    id_cat integer,
    category_name character varying(100)
);


ALTER TABLE public.category OWNER TO docker;

--
-- Name: user; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public."user" (
    login character varying(100) NOT NULL,
    password character varying(255),
    email character varying(100),
    role character varying(100)
);


ALTER TABLE public."user" OWNER TO docker;

--
-- Name: budgets id_bud; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.budgets ALTER COLUMN id_bud SET DEFAULT nextval('public.budgets_id_bud_seq'::regclass);


--
-- Data for Name: budgets; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.budgets (login, title, budget_amount, id_bud) FROM stdin;
user	BUDŻET 1	2000	79
user	BUDŻET 1	2000	80
\.


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.category (title_payment, to_pay, pay_date, id_cat, category_name) FROM stdin;
Netflix	40	2025-02-13	80	Subskrypcje
Disney	30	2025-02-16	80	Subskrypcje
Czynsz	1200	2025-02-23	79	Wydatki Domowe
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public."user" (login, password, email, role) FROM stdin;
adm	$2y$10$OYcvVxJ6P8J97YqWXzp0K.fBxNEL0D60RC1gomCCLY.5p0fwygpou	admin@wp.pl	admin
user	$2y$10$OLNFXJHT9vMzd7/tkuTSFOYNtXiEXtx28YmDQtFy80nzQeVVA1Rfi	jsnow@gmail.com	user
\.


--
-- Name: budgets_id_bud_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.budgets_id_bud_seq', 80, true);


--
-- Name: budgets id_bud; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.budgets
    ADD CONSTRAINT id_bud PRIMARY KEY (id_bud);


--
-- Name: user login; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT login PRIMARY KEY (login);


--
-- Name: user delete_user_trigger; Type: TRIGGER; Schema: public; Owner: docker
--

CREATE TRIGGER delete_user_trigger BEFORE DELETE ON public."user" FOR EACH ROW EXECUTE FUNCTION public.delete_user_cascade();


--
-- Name: category id_cat; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.category
    ADD CONSTRAINT id_cat FOREIGN KEY (id_cat) REFERENCES public.budgets(id_bud) NOT VALID;


--
-- Name: budgets login; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.budgets
    ADD CONSTRAINT login FOREIGN KEY (login) REFERENCES public."user"(login) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

