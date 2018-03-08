# Estrutura de pastas
## app
   - ### classes
         Contém classes com características de utilidade
        - #### ControllersPermissions.php
   - ### controllers
         Contém os classes *controllers* da aplicação
   - ### exceptions
         Contém as classes de exceções
   - ### functions
         Contém arquivos com funções que podem ser utilizadas em qualquer parte do sistema
   - ### interfaces
         Contém as interfaces
        - #### IModel.php
   - ### models
         Contém os models
   - ### traits
         Contém as classes que possuem características a serem usadas (herdadas) por outras
   - ### validate
         Contém as classes que possuem validações específicas para cada formulário
   - ### views
         Contém os arquivos html
## core
         Contém as classes que fazem funcionar a arquitetura MVC
   - #### Controller.php
   - #### Method.php
   - #### Parameters.php
   - #### Twig.php
## public
         Contém os arquivos de recursos
   - ### assets
         - ### css
         - ### fonts
         - ### images
         - ### js
         - ### themes
## vendor
         Contém os arquivos gerenciados pelo composer

## Sintaxe do PostgreSQL
###### Mostra informações da tabela
`\d tb_usuarios`
###### Renomea uma coluna
`ALTER TABLE tb_permissoes RENAME COLUMN action TO method`
###### Adiciona uma coluna na tabela
`ALTER TABLE tb_usuarios ADD ativo SMALLINT NOT NULL DEFAULT 1`
###### Insere um registro na tabela
`INSERT INTO tb_permissoes (user_id, controller, method) VALUES (1, 'PermissoesController', 'update')`
###### Apaga todos os registros da tabela
`DELETE * FROM tb_permissoes`
###### Seleciona todos os registros da tabela
`SELECT * FROM tb_permissoes`
###### Atualiza um registro na tabela
`UPDATE tb_usuarios SET nome = 'Marcelo Augusto da Silva Costa' WHERE master = 1`