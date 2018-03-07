# Estrutura de pastas
## app
   - ### classes
         Contém classes com características de utilidade
        - #### ControllersPermissions
   - ### controllers
         Contém os classes *controllers* da aplicação
   - ### exceptions
        Contém as classes de exceções
   - ### functions
        Contém arquivos com funções que podem ser utilizadas em qualquer parte do sistema
   - ### interfaces
    - #### IModel.php
        Contém as interfaces
   - ### models
   - ### traits
   - ### validate
   - ### views
## core
## public

## Sintaxe do PostgreSQL
###### Mostra informações da tabela
`\d tb_usuarios`
###### Renomea uma coluna
`ALTER TABLE tb_permissoes RENAME COLUMN action TO method`
###### Insere um registro na tabela
`INSERT INTO tb_permissoes (user_id, controller, method) VALUES (1, 'PermissoesController', 'update')`
###### Apaga todos os registros da tabela
`DELETE * FROM tb_permissoes`
###### Seleciona todos os registros da tabela
`SELECT * FROM tb_permissoes`
###### Atualiza um registro na tabela
`UPDATE tb_usuarios SET nome = 'Marcelo Augusto da Silva Costa' WHERE master = 1`