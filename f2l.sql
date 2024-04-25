CREATE TABLE IF NOT EXISTS failed_jobs (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  uuid varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  connection text COLLATE utf8mb4_unicode_ci NOT NULL,
  queue text COLLATE utf8mb4_unicode_ci NOT NULL,
  payload longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  exception longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  failed_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY failed_jobs_uuid_unique (uuid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 
CREATE TABLE IF NOT EXISTS messages (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  nom varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  message text COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table gestion_contrat. migrations
CREATE TABLE IF NOT EXISTS migrations (
  id int unsigned NOT NULL AUTO_INCREMENT,
  migration varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  batch int NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table gestion_contrat. notifications
CREATE TABLE IF NOT EXISTS notifications (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  path varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  message varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table gestion_contrat. password_resets
CREATE TABLE IF NOT EXISTS password_resets (
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  token varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table gestion_contrat. personal_access_tokens
CREATE TABLE IF NOT EXISTS personal_access_tokens (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  tokenable_type varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  tokenable_id bigint unsigned NOT NULL,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  token varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  abilities text COLLATE utf8mb4_unicode_ci,
  last_used_at timestamp NULL DEFAULT NULL,
  expires_at timestamp NULL DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY personal_access_tokens_token_unique (token),
  KEY personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type,tokenable_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table gestion_contrat. users
CREATE TABLE IF NOT EXISTS users (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  first_name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  last_name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  registration_number varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  phone varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  is_valid tinyint(1) NOT NULL DEFAULT '0',
  email_verified_at timestamp NULL DEFAULT NULL,
  password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  is_admin tinyint(1) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contrats (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  creation_date date NOT NULL,
  user_id bigint unsigned NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY contrats_user_id_foreign (user_id),
  CONSTRAINT contrats_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS documents (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  titre varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  path varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  type varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  contrat_id bigint unsigned NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY documents_contrat_id_foreign (contrat_id),
  CONSTRAINT documents_contrat_id_foreign FOREIGN KEY (contrat_id) REFERENCES contrats (id) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;