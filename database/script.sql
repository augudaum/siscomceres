-- CRIANDO A TABELA DE PAÍSES
CREATE TABLE IF NOT EXISTS tb_paises (
    codigo VARCHAR(4) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    sigla VARCHAR(5),
    CONSTRAINT tb_paises_pk PRIMARY KEY (codigo)
);

-- CRIANDO A TABELA DE ESTADOS
CREATE TABLE IF NOT EXISTS tb_estados (
    codigo VARCHAR(2) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    sigla VARCHAR(2) NOT NULL,
    pais_codigo VARCHAR(4) NOT NULL,
    CONSTRAINT tb_estados_pk PRIMARY KEY (codigo),
    CONSTRAINT pais_fk FOREIGN KEY (pais_codigo) REFERENCES tb_paises (codigo) 
);

-- CRIANDO A TABELA DE CIDADES
CREATE TABLE IF NOT EXISTS tb_cidades (
    codigo VARCHAR(7) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    estado_codigo VARCHAR(2) NOT NULL,
    CONSTRAINT tb_cidades_pk PRIMARY KEY (codigo),
    CONSTRAINT estado_fk FOREIGN KEY (estado_codigo) REFERENCES tb_estados (codigo)
);

-- CRIANDO A TABELA DE CONTATOS
CREATE TABLE tb_contatos
(
  participante_id integer NOT NULL,
  tipo_contato character varying(25) NOT NULL, 
  valor character varying(50), 
  categoria character varying(50), 
  observacao character varying(50), 
  whatsapp character varying(1), 
  CONSTRAINT tb_contatos_pk PRIMARY KEY (participante_id, valor),
  CONSTRAINT tb_contatos_fk FOREIGN KEY (participante_id) REFERENCES tb_participantes(id)
)

-- CRIANDO A TABELA DE PARTICIPANTES
CREATE SEQUENCE tb_participantes_seq;
CREATE TABLE IF NOT EXISTS tb_participantes(
    id INTEGER NOT NULL DEFAULT NEXTVAL('tb_participantes_seq'),
    nome_pessoa VARCHAR(255),
    apelido VARCHAR(100),
    cpf_cnpj VARCHAR(14),
    data_nascimento DATE,
    data_expedicao_rg DATE,
    numero_rg VARCHAR(15),
    orgao_rg VARCHAR(20),
    uf_rg VARCHAR(2),
    matricula VARCHAR(60),
    funcao VARCHAR(100),
    cargo VARCHAR(100),
    salario NUMERIC(9,2),
    data_admissao DATE,
    ctps VARCHAR(25),
    razao_social VARCHAR(60),
    nome_fantasia VARCHAR(60),
    ie VARCHAR(14),
    uf_ie VARCHAR(2),
    cnae VARCHAR(7),
    crt VARCHAR(1),
    data_fundacao DATE,
    numero_casa VARCHAR(5),
    complemento VARCHAR(255),
    referencia VARCHAR(255),
    nome_bairro VARCHAR(255),
    cep VARCHAR(8),
    nome_rua VARCHAR(255),
    cidade VARCHAR(7),
    estado VARCHAR(2),
    pais VARCHAR(2), 
    CONSTRAINT tb_pessoas_fisicas_pk PRIMARY KEY (id),
    CONSTRAINT uf_rg_fk FOREIGN KEY (uf_rg) REFERENCES tb_estados (codigo),
    CONSTRAINT uf_ie_fk FOREIGN KEY (uf_ie) REFERENCES tb_estados (codigo),
    CONSTRAINT cidade_fk FOREIGN KEY (cidade) REFERENCES tb_cidades (codigo),
    CONSTRAINT estado_fk FOREIGN KEY (estado) REFERENCES tb_estados (codigo),
    CONSTRAINT pais_fk FOREIGN KEY (pais) REFERENCES tb_paises (codigo)
);

-- COMENTÁRIOS PARA AS COLUNAS DA TABELA DE PARTICIPANTES
COMMENT ON COLUMN tb_participantes.matricula IS 'Matrícula do funcionário';
COMMENT ON COLUMN tb_participantes.funcao IS 'Função do funcionário na empresa';
COMMENT ON COLUMN tb_participantes.cargo IS 'Cargo do funcionário na empresa';
COMMENT ON COLUMN tb_participantes.salario IS 'Salário do funcionário';
COMMENT ON COLUMN tb_participantes.data_admissao IS 'Data de admissão do funcionário';
COMMENT ON COLUMN tb_participantes.ctps IS 'Número da Carteira de Trabalho do funcionário';

-- CRIANDO A TABELA DE UNIDADES
CREATE SEQUENCE tb_unidades_seq;
CREATE TABLE IF NOT EXISTS tb_unidades (
    id INTEGER NOT NULL DEFAULT NEXTVAL('tb_unidades_seq'),
    sigla VARCHAR(7),
    descricao VARCHAR(50),
    CONSTRAINT tb_unidades_pk PRIMARY KEY (id)
);

-- CRIANDO A TABELA DE PRODUTOS
CREATE TABLE IF NOT EXISTS tb_produtos (
    codigo VARCHAR(4) NOT NULL,
    marca VARCHAR(50),
    fabricante VARCHAR(50),
    cean VARCHAR(14),
    descricao VARCHAR(50),
    ncm VARCHAR(8),
    extipi VARCHAR(3),
    unidade_id INTEGER NOT NULL,
    pc_compra NUMERIC,
    pc_custo NUMERIC,
    pc_venda NUMERIC,
    CONSTRAINT tb_produtos_pk PRIMARY KEY (codigo),
    CONSTRAINT tb_unidade_fk FOREIGN KEY (unidade_id) REFERENCES tb_unidades(id)
);

-- CRIANDO A TABELA DE SIMULAÇÕES (LEIÕES/PREGÕES/LICITAÇÕES)
CREATE SEQUENCE tb_requisicoes_compra_seq;
CREATE TABLE IF NOT EXISTS tb_requisicoes_compra (
    numero INTEGER NOT NULL DEFAULT NEXTVAL('tb_requisicoes_compra_seq'),
    data_requisicao DATE NOT NULL,
    data_cadastro TIMESTAMP WITH TIME ZONE NOT NULL,
    cadastrado_por INTEGER NOT NULL,
    data_confirmacao TIMESTAMP WITH TIME ZONE,
    confirmado_por INTEGER,
    data_modificacao TIMESTAMP WITH TIME ZONE,
    modificado_por INTEGER,
    CONSTRAINT tb_requisicoes_compra_pk PRIMARY KEY (numero),
    CONSTRAINT tb_requisicoes_compra_cadastro_fk FOREIGN KEY (cadastrado_por) REFERENCES tb_participantes (id),
    CONSTRAINT tb_requisicoes_compra_confirmacao_fk FOREIGN KEY (confirmado_por) REFERENCES tb_participantes (id),
    CONSTRAINT tb_requisicoes_compra_modificacao_fk FOREIGN KEY (modificado_por) REFERENCES tb_participantes (id)
);

-- CRIANDO A TABELA DE ITENS DE SIMULAÇÃO
CREATE TABLE IF NOT EXISTS tb_item_requisicao_compra (
    numero_requisicao INTEGER NOT NULL,
    codigo_produto INTEGER NOT NULL,
    quantidade INTEGER NOT NULL,
    CONSTRAINT tb_item_requisicao_compra_numero_fk FOREIGN KEY (numero_requisicao) REFERENCES tb_requisicoes_compra (id),
    CONSTRAINT tb_item_requisicao_compra_produto_fk FOREIGN KEY (codigo_produto) REFERENCES tb_produtos (id)
);

-- CRIANDO A TABELA DE PEDIDO DE COMPRA
CREATE TABLE IF NOT EXISTS tb_pedido_compra (
    numero INTEGER NOT NULL,
    data_pedido TIMESTAMP WITH TIME ZONE NOT NULL,
    codigo_fornecedor INTEGER NOT NULL,
    numero_requisicao INTEGER NOT NULL,
    data_cadastro TIMESTAMP WITH TIME ZONE NOT NULL,
    cadastrado_por INTEGER NOT NULL,
    data_confirmacao TIMESTAMP WITH TIME ZONE,
    confirmado_por INTEGER,
    data_modificacao TIMESTAMP WITH TIME ZONE,
    modificado_por INTEGER,
    data_previsao_entrega DATE,
    codigo_politica_venda INTEGER,
    total_pedido_compra NUMERIC(9,2),
    CONSTRAINT tb_pedido_compra_pk PRIMARY KEY (numero),
    CONSTRAINT tb_pedido_compra_cadastro_fk FOREIGN KEY (cadastrado_por) REFERENCES tb_participantes (id),
    CONSTRAINT tb_pedido_compra_confirmacao_fk FOREIGN KEY (confirmado_por) REFERENCES tb_participantes (id),
    CONSTRAINT tb_pedido_compra_modificacao_fk FOREIGN KEY (modificado_por) REFERENCES tb_participantes (id)
);

-- CRIANDO A TABELA DE ITENS DE PEDIDO DE COMPRA
CREATE TABLE IF NOT EXISTS tb_item_pedido_compra (
    numero_pedido INTEGER NOT NULL,
    codigo_produto INTEGER NOT NULL,
    quantidade INTEGER NOT NULL,
    preco_produto NUMERIC(9,2)
);

-- CRIANDO A TABELA DE ITENS DE PEDIDO DE COMPRA
CREATE TABLE IF NOT EXISTS tb_cfop (
    codigo VARCHAR(4) NOT NULL,
    descricao VARCHAR(200),
    indnfe CHAR(1),
    indcomunica CHAR(1),
    indtransp CHAR(1),
    inddevol CHAR(1),
    CONSTRAINT tb_cfop_pk PRIMARY KEY (codigo)
);