-- version 5.2.0
-- https://www.phpmyadmin.net/
--




--
--

-- --------------------------------------------------------

--
-- Table structure for table cache
--

CREATE TABLE cache (
  key varchar(255) NOT NULL,
  value text NOT NULL,
  expiration int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table cache_locks
--

CREATE TABLE cache_locks (
  key varchar(255) NOT NULL,
  owner varchar(255) NOT NULL,
  expiration int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table failed_jobs
--

CREATE TABLE failed_jobs (
  id bigserial  NOT NULL,
  uuid varchar(255) NOT NULL,
  connection text NOT NULL,
  queue text NOT NULL,
  payload text NOT NULL,
  exception text NOT NULL,
  failed_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table jobs
--

CREATE TABLE jobs (
  id bigserial  NOT NULL,
  queue varchar(255) NOT NULL,
  payload text NOT NULL,
  attempts smallint  NOT NULL,
  reserved_at int  DEFAULT NULL,
  available_at int  NOT NULL,
  created_at int  NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table job_batches
--

CREATE TABLE job_batches (
  id varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  total_jobs int NOT NULL,
  pending_jobs int NOT NULL,
  failed_jobs int NOT NULL,
  failed_job_ids text NOT NULL,
  options text,
  cancelled_at int DEFAULT NULL,
  created_at int NOT NULL,
  finished_at int DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table ktp_pengambilan
--

CREATE TABLE ktp_pengambilan (
  id bigserial  NOT NULL,
  nama_pemohon varchar(255) NOT NULL,
  kecamatan varchar(255) NOT NULL,
  no_hp_pengambil varchar(255) DEFAULT NULL,
  foto_bukti varchar(255) NOT NULL,
  keterangan text,
  keterangan_ikd varchar(255) DEFAULT NULL,
  tanggal_ambil timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

--
--


-- --------------------------------------------------------

--
-- Table structure for table ktp_prr
--

CREATE TABLE ktp_prr (
  id bigserial  NOT NULL,
  nama_pemohon varchar(255) NOT NULL,
  no_hp varchar(255) NOT NULL,
  kecamatan varchar(255) NOT NULL,
  keterangan varchar(255) NOT NULL,
  keterangan_pengambilan varchar(255) NOT NULL,
  nama_pengambil varchar(255) DEFAULT NULL,
  status varchar(255) NOT NULL DEFAULT 'Diproses',
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

--
--


-- --------------------------------------------------------

--
-- Table structure for table migrations
--

CREATE TABLE migrations (
  id serial  NOT NULL,
  migration varchar(255) NOT NULL,
  batch int NOT NULL
);

--
--


-- --------------------------------------------------------

--
-- Table structure for table password_reset_tokens
--

CREATE TABLE password_reset_tokens (
  email varchar(255) NOT NULL,
  token varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table sessions
--

CREATE TABLE sessions (
  id varchar(255) NOT NULL,
  user_id bigint  DEFAULT NULL,
  ip_address varchar(45) DEFAULT NULL,
  user_agent text,
  payload text NOT NULL,
  last_activity int NOT NULL
);

--
--


-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  id bigserial  NOT NULL,
  username varchar(255) NOT NULL,
  role varchar(255) NOT NULL DEFAULT 'user',
  password varchar(255) NOT NULL,
  remember_token varchar(100) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

--
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table cache
--
ALTER TABLE cache
  ADD PRIMARY KEY (key);

--
-- Indexes for table cache_locks
--
ALTER TABLE cache_locks
  ADD PRIMARY KEY (key);

--
-- Indexes for table failed_jobs
--
ALTER TABLE failed_jobs
  ADD PRIMARY KEY (id),
  ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);

--
-- Indexes for table jobs
--
ALTER TABLE jobs
  ADD PRIMARY KEY (id);
CREATE INDEX jobs_queue_index ON jobs (queue);

--
-- Indexes for table job_batches
--
ALTER TABLE job_batches
  ADD PRIMARY KEY (id);

--
-- Indexes for table ktp_pengambilan
--
ALTER TABLE ktp_pengambilan
  ADD PRIMARY KEY (id);

--
-- Indexes for table ktp_prr
--
ALTER TABLE ktp_prr
  ADD PRIMARY KEY (id);

--
-- Indexes for table migrations
--
ALTER TABLE migrations
  ADD PRIMARY KEY (id);

--
-- Indexes for table password_reset_tokens
--
ALTER TABLE password_reset_tokens
  ADD PRIMARY KEY (email);

--
-- Indexes for table sessions
--
ALTER TABLE sessions
  ADD PRIMARY KEY (id);
CREATE INDEX sessions_user_id_index ON sessions (user_id);
CREATE INDEX sessions_last_activity_index ON sessions (last_activity);

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD CONSTRAINT users_username_unique UNIQUE (username);

--
