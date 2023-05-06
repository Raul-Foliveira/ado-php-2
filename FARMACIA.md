# Sistema de farmácia

Campos da tabela `medicamento`:

* `chave` - `INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT`
* `nome_comum` - `TEXT NOT NULL`
* `nome_substancia` - `TEXT NOT NULL`
* `tarja` - `TEXT NOT NULL` (preta ou vermelha)
* `preco` - `INTEGER NOT NULL` - O valor é expresso em centavos. Para mostrar na tela depois, divida por 100.
* `tipo` - `TEXT NOT NULL` (pílula, comprimido, líquido bebível, injetável, pomada, pastilha, inalável, bombinha)
* `qtd_por_caixa` - `REAL NOT NULL`
* `unidade_medida` - `TEXT NOT NULL`
* `fabricante` - `TEXT NOT NULL`

Há uma tabela adicional `tipo_tarja` com apenas um campo:

* `cor` - `TEXT NOT NULL PRIMARY KEY`

Insira os valores `preta` e `vermelha` nesta tabela.

Há uma segunda tabela adicional `tipo_medicamento` com apenas um campo:

* `tipo` - `TEXT NOT NULL PRIMARY KEY`

Insira os valores `Pílula`, `Comprimido`, `Líquido bebível`, `Injetável`, `Pomada`, `Pastilha`, `Inalável`, `Bombinha` e `Xampú` nesta tabela.

Há uma terceira tabela adicional `tipo_unidade_medida` com apenas um campo:

* `sigla` - `TEXT NOT NULL PRIMARY KEY`

Insira os valores `g`, `mg`, `mcg` e `ml`.

Há ainda as seguintes restrições a serem modeladas com `CHECK`:

* Nenhum campo numérico pode ter valor zero ou negativo.
* Os campos `nome_comum`, `nome_substancia` e `fabricante` devem ter pelo menos 5 e no máximo 200 caracteres.

E essas restrições de chave estrangeira:

* O campo `tipo` da tabela `medicamento` é chave estrangeira para o campo `tipo` da tabela `tipo_medicamento`.
* O campo `unidade_medida` da tabela `medicamento` é chave estrangeira para o campo `sigla` da tabela `tipo_unidade_medida`.



# Objetivo

Desenvolva um CRUD utilizando o SQLite como banco de dados (assim fica mais fácil de testar).


* [Farmácia](FARMACIA.md) - Uthiele, Raul, Leonel, Thiago Lima


Exemplo de como fica o ADO concluído:
* [Flores](https://github.com/victorwss/exemplos-php-js/tree/main/flores2)

## 2. Desenvolva as seguintes telas para o seu pequeno sistema:

### a. Banco de dados

Crie o banco de dados conforme descrito pela alternativa que você descreveu e salve o script de criação de banco de dados num arquivo `bd.sql`.

Esse arquivo deve ter todas as instruções `CREATE TABLE` necessárias para a criação do banco de dados, bem como quaisquer outras instruções que forem necessárias.

A nota será dada da seguinte forma, julgada pelo conteúdo do arquivo `bd.sql`:

* 12% da nota é pela definição correta da(s) tabela(s), incluindo os tipos dos campos e restrições `UNIQUE` e `NOT NULL`.
* 6% pela definição das restrições de integridade (`CHECK` e chave estrangeira).

No total, isso soma 18% da nota.

### b. Crie um arquivo PHP que seja responsável pelas operações no banco de dados

Ele deve ter as seguintes funções:

A página com as funções do banco de dados deve estar num arquivo `operacoes.php`. Os arquivos `abrir_transacao.php` e `fechar_transacao.php` também devem estar presentes.

* Uma função para listar todos os dados da tabela principal.
* Uma função para inserir os dados da tabela principal.
* Uma função para, a partir da respectiva chave, alterar os dados da tabela principal.
* Uma função para, a partir da respectiva chave, excluir os dados da tabela principal.
* Uma função para, a partir da respectiva chave, ler os dados da tabela principal.

A implementação correta de cada uma destas vale 6% da nota, sendo que 1% de cada é a correta participação da função na transação.

No caso onde a chave primária não for `AUTOINCREMENT`, a função de inserção e de alteração é a mesma. Use o comando `REPLACE` do SQLite. Neste caso, essa funcionalidade passa a valer 12% da nota.

No caso onde a tabela principal tenha um campo `UNIQUE`, uma função de pesquisa será necessária, ela valerá 4% da nota e as outras duas funções de pesquisa 4% cada.

Outros 4% são atribuídos para a função que realiza a abertura correta da conexão. Este deve estar num arquivo seperado `conectar.php` se você julgar melhor.

Vulnerabilidade de injeção de SQL dá uma penalidade -2% em cada um desses itens onde isso aparecer.

No total, isso soma 34% da nota.

### c. Listagem de todos os elementos da tabela principal

A página de listagem deve estar num arquivo `listar.php`.

A lista deve ser feita numa tabela com uma coluna para cada campo. Coloque também numa coluna extra, um botão para ir para a tela de edição.

No final da tabela, coloque também um link para a página de inserção.

A página deve ser acessível por meio de GET.

Essa parte tem um peso de 10% da nota. Sendo:
* 5% para a montagem correta da tabela.
* 1% pelo correto gerenciamento de transações. (1% = tudo certo, 0% = nada ou não funciona).
* 1% para realizar a pesquisa no banco de dados corretamente utilizando o arquivo desenvolvido na parte b.
* 1% para a presença correta do link para a página de inserção.
* 1% para a ausência de erros de validação de HTML.
* 1% por garantir que a página só responde a GETs e nunca a POSTs.

### d. Páginas de inserção e de alteração

A página de inserção e alteração devem estar no mesmo arquivo `cadastrar.php`.

Se o acesso for por GET e não houver chave na URL, trata-se de uma inserção. Se houver chave na URL é uma alteração.

Nos casos onde a chave primária é `AUTOINCREMENT`, se o acesso for por POST, realize o `INSERT` no banco de dados se a chave não estiver presente ou o `UPDATE` se estiver presente.

Nos casos onde a chave primária não é `AUTOINCREMENT`, realize sempre um comando `REPLACE` (que é a forma abreviada de `INSERT OR REPLACE`), que combina a ideia do `INSERT` e do `UPDATE` num comando só.

A página deve conter um formulário para inserir todos os dados, campo a campo.

Campos `AUTOINCREMENT` não devem estar presentes na inserção e não devem ser editáveis na alteração.

Campos com comboboxes, selects, checkbox e radio buttons devem ser aplicados onde for pertinente.

O formulário deve fazer o envio via POST.

Antes de tentar realizar a inserção ou alteração, certifique-se (no lado do PHP) que todos os dados inseridos estão corretos de acordo com as regras definidas para cada um.
Se não estiverem, não realize a operação no banco de dados e ao invés disso, devolva o mesmo formulário com uma mensagem de erro e mantenha os dados informados preenchidos tal como o usuário os deixou.

Caso a inclusão ou alteração sejam bem sucedidas, redirecione à página de listagem.

Caso trate-se de uma alteração, coloque também um botão para exclusão, que faz POST numa URL diferente efetuando a exclusão e redirecionando para a página de listagem, após a confirmação do usuário.

Essa parte tem um peso de 28% da nota. Sendo:
* 10% pela correta validação de todos os campos no PHP.
* 4% pela correta montagem do formulário na inserção.
* 4% pela correta montagem do formulário na alteração.
* 2% pelo correto gerenciamento de transações. (2% = tudo certo, 1% = parcial, 0% = nada ou não funciona).
* 2% por garantir que os GETs e POSTs funcionem como esperado, além de separar a inserção e a alteração onde devem ser separados.
* 1% por chamar a função de inserção corretamente onde for o caso.
* 1% por chamar a função de alteração corretamente onde for o caso.
* 1% por mostrar o botão de exclusão e o formulário correspondente corretamente apenas na página de alteração.
* 1% para a ausência de erros de validação de HTML.
* 1% pela confirmação do usuário na exclusão.
* 1% por redirecionar para a tela de listagem após confirmada a inclusão ou alteração.

### e. Arquivo PHP de exclusão

Esse arquivo deve se chamar `excluir.php` e deve responder a POSTs realizados a partir do botão de exclusão na página de alteração.

Isso corresponde a 5% da nota. Sendo:
* 1% pelo correto gerenciamento de transações. (1% = tudo certo, 0% = nada ou não funciona).
* 1% por garantir que a página só responde a GETs e nunca a POSTs.
* 2% por realizar a exclusão corretamente.
* 1% por redirecionar para a tela de listagem após confirmada a exclusão.

### f. Entrega

Coloque o nome de todos os integrantes num arquivo `README.MD` no GitHub e coloque também as observações que achar pertinente para a correção do projeto.

Convide o professor para o seu projeto no GitHub.

Isso vale 5% da nota distribuídos assim:

* 2% pelo `README.MD` com o nome dos alunos.
* 3% pela presença de todos os arquivos `bd.sql`, `conectar.php`, `operacoes.php`, `listar.php`, `cadastrar.php`, `excluir.php`, `abrir_transacao.php` e `fechar_transacao.php` e nada mais além do que eles.


