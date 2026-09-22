PRAGMA foreign_keys = ON;

CREATE TABLE IF NOT EXISTS profile (
    id INTEGER PRIMARY KEY CHECK (id = 1),
    name TEXT NOT NULL,
    role TEXT NOT NULL,
    intro TEXT NOT NULL,
    about TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT,
    location TEXT,
    education TEXT
);

CREATE TABLE IF NOT EXISTS skills (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    category TEXT NOT NULL,
    description TEXT NOT NULL,
    position INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    type TEXT NOT NULL,
    description TEXT NOT NULL,
    technologies TEXT NOT NULL,
    position INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS experiences (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    label TEXT NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    period TEXT NOT NULL,
    position INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    message TEXT NOT NULL,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT OR IGNORE INTO profile (id, name, role, intro, about, email, phone, location, education)
VALUES (1, 'Saliou Pouye', 'Etudiant en informatique - Developpement web & mobile',
        'Je conçois des experiences digitales simples, fluides et accessibles.',
        'Passionné par le développement et la création numérique, j’aime transformer un besoin concret en une solution claire, fonctionnelle et agréable à utiliser.',
        'salioup283@gmail.com', '+221 77 280 27 24', 'Diourbel, Sénégal', 'Licence en Informatique');

INSERT INTO skills (category, description, position)
SELECT 'Front-end', 'HTML, CSS, JavaScript, Angular, interfaces responsives', 1
WHERE NOT EXISTS (SELECT 1 FROM skills);
INSERT INTO skills (category, description, position)
SELECT 'Back-end & données', 'Laravel, logique applicative, bases de données, APIs', 2
WHERE (SELECT COUNT(*) FROM skills) = 1;
INSERT INTO skills (category, description, position)
SELECT 'CMS & outils', 'WordPress, conception mobile, algorithmique', 3
WHERE (SELECT COUNT(*) FROM skills) = 2;

INSERT INTO projects (title, type, description, technologies, position)
SELECT 'Portfolio personnel', 'Interface web', 'Une vitrine personnelle responsive pour présenter mon parcours, mes compétences et mes projets.', 'HTML, CSS, Responsive', 1
WHERE NOT EXISTS (SELECT 1 FROM projects);
INSERT INTO projects (title, type, description, technologies, position)
SELECT 'Application mobile', 'Application', 'Une interface mobile simple, intuitive et centrée sur l’expérience utilisateur.', 'UX, Mobile, Design', 2
WHERE (SELECT COUNT(*) FROM projects) = 1;

INSERT INTO experiences (label, title, description, period, position)
SELECT 'Formation', 'Licence en Informatique', 'Développement d’applications web et mobile', '2024 - 2025', 1
WHERE NOT EXISTS (SELECT 1 FROM experiences);
INSERT INTO experiences (label, title, description, period, position)
SELECT 'Objectif actuel', 'Disponible pour un stage', 'Mettre mes compétences au service d’une équipe et apprendre au contact du terrain.', 'Maintenant', 2
WHERE (SELECT COUNT(*) FROM experiences) = 1;
