-- CRIANDO A TABELA DE FUNCIONÁRIOS
CREATE SEQUENCE IF NOT EXISTS tb_funcionarios_seq;
CREATE TABLE IF NOT EXISTS tb_funcionarios (
    id INTEGER DEFAULT NEXTVAL(tb_funcionarios_seq),
    matricula VARCHAR(60) NOT NULL,
    funcao VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    salario NUMERIC(9,2) NOT NULL,
    data_admissao DATE NOT NULL DEFAULT CURRENT_DATE,
    ctps VARCHAR(25) NOT NULL,
    pessoa_fisica_id INTEGER NOT NULL,
    CONSTRAINT tb_funcionario_pk PRIMARY KEY (id),
    CONSTRAINT tb_pessoa_fisica_fk FOREIGN KEY (pessoa_fisica_id) REFERENCES tb_pessoas_fisicas (id)
);
-- COMENTÁRIOS PARA AS COLUNAS DA TABELA DE FUNCIONÁRIOS
COMMENT ON COLUMN tb_funcionarios.matricula IS 'Matrícula do funcionário';
COMMENT ON COLUMN tb_funcionarios.funcao IS 'Função do funcionário na empresa';
COMMENT ON COLUMN tb_funcionarios.cargo IS 'Cargo do funcionário na empresa';
COMMENT ON COLUMN tb_funcionarios.salario IS 'Salário do funcionário';
COMMENT ON COLUMN tb_funcionarios.data_admissao IS 'Data de admissão do funcionário';
COMMENT ON COLUMN tb_funcionarios.ctps IS 'Número da Carteira de Trabalho do funcionário';

-- CRIANDO A TABELA DE PESSOAS FÍSICAS
CREATE SEQUENCE IF NOT EXISTS tb_pessoas_fisicas_seq;
CREATE TABLE IF NOT EXISTS tb_pessoas_fisicas (
    id INTEGER NOT NULL DEFAULT NEXTVAL('tb_pessoas_fisicas_seq'),
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    data_nascimento DATE NOT NULL,
    data_expedicao_rg DATE NOT NULL,
    numero_rg VARCHAR(15) NOT NULL,
    orgao_rg VARCHAR(20) NOT NULL,
    uf_rg VARCHAR(2) NOT NULL,
    CONSTRAINT tb_pessoas_fisicas_pk PRIMARY KEY (id),
    CONSTRAINT uf_rg_fk FOREIGN KEY (uf_rg) REFERENCES tb_estados (codigo)
);

-- CRIANDO A TABELA DE PESSOAS JURÍDICAS
CREATE TABLE IF NOT EXISTS tb_pessoas_juridicas (
    id INTEGER DEFAULT NEXTVAL(),
    razao_social VARCHAR(60) NOT NULL,
    nome_fantasia VARCHAR(60) NOT NULL,
    cnpj VARCHAR(14) NOT NULL,
    ie VARCHAR(14) NOT NULL,
    uf_ie VARCHAR(2) NOT NULL,
    cnae VARCHAR(7) NOT NULL,
    crt VARCHAR(1) NOT NULL,
    data_fundacao DATE NOT NULL
)

-- CRIANDO A TABELA DE ENDERECOS
CREATE SEQUENCE IF NOT EXISTS tb_enderecos_seq;
CREATE TABLE IF NOT EXISTS tb_enderecos (
    id INTEGER NOT NULL DEFAULT NEXTVAL(tb_enderecos_seq),
    numero VARCHAR(5),
    logradouro_id INTEGER NOT NULL,
    complemento VARCHAR(255),
    referencia VARCHAR(255),
    CONSTRAINT tb_endereco_pk PRIMARY KEY (id),
    CONSTRAINT logradouro_id_fk FOREIGN KEY (logradouro_id) REFERENCES tb_logradouros (id)
);

-- CRIANDO A TABELA DE LOGRADOUROS
CREATE SEQUENCE IF NOT EXISTS tb_logradouros_seq;
CREATE TABLE IF NOT EXISTS tb_logradouros (
    id INTEGER NOT NULL DEFAULT NEXTVAL('tb_logradouros_seq'),
    nome VARCHAR(255) NOT NULL,
    bairro_codigo VARCHAR(8) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    CONSTRAINT tb_logradouros_pk PRIMARY KEY (id),
    CONSTRAINT bairro_fk FOREIGN KEY (bairro_codigo) REFERENCES tb_bairros (codigo)
);

-- CRIANDO A TABELA DE BAIRROS
CREATE SEQUENCE IF NOT EXISTS tb_bairros_seq;
CREATE TABLE IF NOT EXISTS tb_bairros (
    codigo VARCHAR(8),
    nome VARCHAR(60) NOT NULL,
    cidade_codigo VARCHAR(7) NOT NULL,
    CONSTRAINT tb_bairros_pk PRIMARY KEY (codigo),
    CONSTRAINT cidade_fk FOREIGN KEY (cidade_codigo) REFERENCES tb_cidades (codigo)
);

-- CRIANDO A TABELA DE CIDADES
CREATE SEQUENCE IF NOT EXISTS tb_cidades_seq;
CREATE TABLE IF NOT EXISTS tb_cidades (
    codigo VARCHAR(7) NOT NULL,
    nome VARCHAR(60) NOT NULL,
    estado_codigo VARCHAR(2) NOT NULL,
    CONSTRAINT tb_cidades_pk PRIMARY KEY (codigo),
    CONSTRAINT estado_fk FOREIGN KEY (estado_codigo) REFERENCES tb_estados (codigo)
);

-- CRIANDO A TABELA DE ESTADOS
CREATE SEQUENCE IF NOT EXISTS tb_estados_seq;
CREATE TABLE IF NOT EXISTS tb_estados (
    codigo VARCHAR(2) NOT NULL,
    nome VARCHAR(25) NOT NULL,
    sigla VARCHAR(2) NOT NULL,
    pais_codigo VARCHAR(4) NOT NULL,
    CONSTRAINT tb_estados_pk PRIMARY KEY (codigo),
    CONSTRAINT pais_fk FOREIGN KEY (pais_codigo) REFERENCES tb_paises (codigo) 
);

-- CRIANDO A TABELA DE PAÍSES
CREATE SEQUENCE IF NOT EXISTS tb_paises_seq;
CREATE TABLE IF NOT EXISTS tb_paises (
    codigo VARCHAR(4) NOT NULL,
    nome VARCHAR(25) NOT NULL,
    sigla VARCHAR(5),
    CONSTRAINT tb_paises_pk PRIMARY KEY (codigo)
);

-- CRIANDO A TABELA DE CONTATOS
CREATE SEQUENCE IF NOT EXISTS tb_contatos_seq;
CREATE TABLE IF NOT EXISTS tb_contatos (
    id INTEGER NOT NULL DEFAULT NEXTVAL('tb_contatos_seq'),
    participante_id INTEGER NOT NULL,
    tipo_contato VARCHAR(25) NOT NULL,
    CONSTRAINT tb_contatos_pk PRIMARY KEY (id)
);
COMMENT ON COLUMN tb_contatos.tipo_contato IS 'Tipo do contato (particular, residencial, emergência, entre outros)';

-- CRIANDO A TABELA DE EMAILS
CREATE SEQUENCE IF NOT EXISTS tb_emails_seq;
CREATE TABLE IF NOT EXISTS tb_emails (
    id INTEGER NOT NULL DEFAULT NEXTVAL('tb_emails_seq'),
    contato_id INTEGER NOT NULL,
    endereco VARCHAR(50) NOT NULL,
    observacao VARCHAR(50) NULL,
    CONSTRAINT tb_emails_pk PRIMARY KEY (id),
    CONSTRAINT contato_email_fk FOREIGN KEY (contato_id) REFERENCES tb_contatos (id)
);
COMMENT ON COLUMN tb_emails.observacao IS '(facebook, skype, institucional, entre outros)';

-- CRIANDO A TABELA DE TELEFONES
CREATE SEQUENCE IF NOT EXISTS tb_telefones_seq;
CREATE TABLE IF NOT EXISTS tb_telefones (
    id INTEGER NOT NULL DEFAULT NEXTVAL('tb_telefones_seq'),
    contato_id INTEGER NOT NULL,
    ddi VARCHAR(3) NOT NULL,
    ddd VARCHAR(3) NOT NULL,
    numero VARCHAR(9) NOT NULL,
    observacao VARCHAR(50) NULL,
    CONSTRAINT tb_telefones_pk PRIMARY KEY (id),
    CONSTRAINT contato_telefone_fk FOREIGN KEY (contato_id) REFERENCES tb_contatos (id)
);
COMMENT ON COLUMN tb_telefones.observacao IS '(whatsapp, fixo, celular, entre outros)';