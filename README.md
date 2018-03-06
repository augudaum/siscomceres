\d tb_usuarios // Mostra os atributos da tabela
ALTER TABLE tb_permissoes RENAME COLUMN action TO method // Renomea uma coluna
INSERT INTO tb_permissoes (user_id, controller, method) VALUES (1, 'PermissoesController', 'update');
DELETE * FROM tb_permissoes
SELECT * FROM tb_permissoes
UPDATE tb_usuarios SET nome = 'Marcelo Augusto da Silva Costa' WHERE master = 1;