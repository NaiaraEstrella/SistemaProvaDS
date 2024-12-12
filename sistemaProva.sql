CREATE database provaDS;
use provaDS;

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    sexo ENUM('masculino', 'feminino', 'outro') NOT NULL
);

CREATE TABLE aulas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_aula VARCHAR(255) NOT NULL,
    professor VARCHAR(255) NOT NULL,
    quantidade_maxima INT NOT NULL CHECK (quantidade_maxima > 0),
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    CONSTRAINT chk_hora CHECK (hora_inicio < hora_fim)
);

CREATE TABLE professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    sexo ENUM('masculino', 'feminino', 'outro') NOT NULL,
    especialidade VARCHAR(255) NOT NULL
    
);

-- Inserindo alunos
INSERT INTO alunos (nome, data_nascimento, telefone, sexo) VALUES
('Harry Potter', '1980-07-31', '99999999901', 'masculino'),
('Hermione Granger', '1979-09-19', '99999999902', 'feminino'),
('Ron Weasley', '1980-03-01', '99999999903', 'masculino'),
('Draco Malfoy', '1980-06-05', '99999999904', 'masculino'),
('Neville Longbottom', '1980-07-30', '99999999905', 'masculino'),
('Ginny Weasley', '1981-08-11', '99999999906', 'feminino'),
('Luna Lovegood', '1981-02-13', '99999999907', 'feminino'),
('Fred Weasley', '1978-04-01', '99999999908', 'masculino'),
('George Weasley', '1978-04-01', '99999999909', 'masculino'),
('Severus Snape', '1960-01-09', '99999999910', 'masculino'),
('Cho Chang', '1979-05-25', '99999999911', 'feminino'),
('Cedric Diggory', '1977-09-07', '99999999912', 'masculino');

-- Inserindo aulas
INSERT INTO aulas (nome_aula, professor, quantidade_maxima, hora_inicio, hora_fim) VALUES
('Feitiçaria e Magia', 'Minerva McGonagall', 25, '08:00:00', '10:00:00'),
('Defesa Contra as Artes das Trevas', 'Remus Lupin', 20, '10:30:00', '12:30:00'),
('Poções', 'Severus Snape', 15, '13:00:00', '15:00:00');

-- Inserindo professores
INSERT INTO professores (nome, data_nascimento, telefone, sexo, especialidade) VALUES
('Minerva McGonagall', '1935-10-04', '99999999911', 'feminino', 'Feitiçaria e Magia'),
('Remus Lupin', '1960-03-10', '99999999912', 'masculino', 'Defesa Contra as Artes das Trevas'),
('Severus Snape', '1960-01-09', '99999999913', 'masculino', 'Poções');

------------------------------------------------------------------

-- Inserindo alunos
INSERT INTO alunos (nome, data_nascimento, telefone, sexo) VALUES
('Frodo Baggins', '2980-09-22', '99999999901', 'masculino'),
('Samwise Gamgee', '2983-04-06', '99999999902', 'masculino'),
('Gimli', '2879-11-14', '99999999903', 'masculino'),
('Legolas', '2900-01-01', '99999999904', 'masculino'),
('Aragorn', '2931-03-01', '99999999905', 'masculino'),
('Gandalf', '3000-07-14', '99999999906', 'masculino'),
('Arwen', '2921-11-18', '99999999907', 'feminino'),
('Galadriel', '2000-03-25', '99999999908', 'feminino'),
('Éowyn', '2985-07-25', '99999999909', 'feminino'),
('Merry Brandybuck', '2982-09-15', '99999999910', 'masculino'),
('Pippin Took', '2983-04-14', '99999999911', 'masculino'),
('Boromir', '2975-10-05', '99999999912', 'masculino');


-- Inserindo aulas
INSERT INTO aulas (nome_aula, professor, quantidade_maxima, hora_inicio, hora_fim) VALUES
('Treinamento de Arco e Flecha', 'Legolas', 20, '08:00:00', '10:00:00'),
('Curso de Espada e Combate', 'Aragorn', 15, '11:00:00', '13:00:00'),
('Magia e Feitiçaria', 'Gandalf', 10, '14:00:00', '16:00:00');


-- Inserindo professores
INSERT INTO professores (nome, data_nascimento, telefone, sexo, especialidade) VALUES
('Gandalf', '3000-07-14', '99999999906', 'masculino', 'Magia e Feitiçaria'),
('Legolas', '2900-01-01', '99999999904', 'masculino', 'Arco e Flecha'),
('Aragorn', '2931-03-01', '99999999905', 'masculino', 'Espada e Combate');
