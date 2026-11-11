# ex teoricos

1. Semântica RESTful: Por que uma ação de exclusão de dados nunca deve ser implementada através de uma requisição HTTP do tipo GET? Explique o risco associado a robôs de busca.
> Uma ação de exclusão nunca deve ser feita por uma requisição GET porque esse método deve apenas consultar dados, sem modificar o sistema. Robôs de busca podem acessar links automaticamente e, se encontrarem um link de exclusão, podem executá-lo sem intenção, causando a perda de dados.

2. Idempotência: O que significa o conceito de idempotência no protocolo HTTP e por que o método PUT é considerado idempotente enquanto o POST não é?
> Idempotência significa que realizar a mesma requisição várias vezes produz o mesmo resultado final que realizá-la apenas uma vez. O método PUT é idempotente porque atualizar um recurso repetidamente com os mesmos dados mantém o mesmo estado. Já o POST não é necessariamente idempotente, pois pode criar vários registros a cada envio.

3.Resource Controllers: Quais são as 7 ações canônicas geradas pelo comando php artisan make:controller --resource e qual é a responsabilidade de cada uma?
> O comando php artisan make:controller --resource gera sete ações canônicas:
Ação	Responsabilidade
index	Listar todos os registros.
create	Exibir o formulário de criação.
store	Salvar um novo registro.
show	Exibir os detalhes de um registro.
edit	Exibir o formulário de edição.
update	Atualizar um registro existente.
destroy	Excluir um registro.

4.Injeção de Dependências: Como o Service Container do Laravel entrega automaticamente uma instância de Request ao método do controller sem que tenhamos que instanciá-la com new Request()?
>O Service Container do Laravel identifica automaticamente o tipo Request informado nos parâmetros do método do controller. Assim, ele cria e fornece a instância necessária automaticamente, sem precisar utilizar new Request(). Esse processo é chamado de injeção de dependências.

5. Method Spoofing: Por que os navegadores web não conseguem enviar requisições nativas de PUT e DELETE através de formulários HTML convencionais? Como o Laravel contorna essa limitação?
>Os navegadores não conseguem enviar requisições PUT e DELETE diretamente por formulários HTML convencionais, pois eles aceitam nativamente apenas GET e POST. O Laravel contorna essa limitação utilizando o campo oculto @method('PUT') ou @method('DELETE'), que informa ao framework qual método HTTP deve ser interpretado.

6. Ataques CSRF: O que é um ataque do tipo Cross-Site Request Forgery e como a diretiva Blade @csrf impede que sites maliciosos forjem requisições em nome do usuário?
>CSRF é um ataque em que um site malicioso tenta realizar ações em nome de um usuário que está autenticado em outro site. O Laravel utiliza a diretiva @csrf para gerar um token de segurança exclusivo da sessão. Esse token é verificado nas requisições para impedir ações falsificadas.

7. Constraints de Rota: Para que servem métodos de restrição como whereNumber('id') ou whereAlphaNumeric('codigo') e qual código de status HTTP o Laravel retorna quando o formato é violado?
>As constraints servem para restringir os valores que podem ser recebidos pelos parâmetros das rotas. Por exemplo, whereNumber('id') aceita apenas números, enquanto whereAlphaNumeric('codigo') aceita letras e números. Quando o formato não corresponde à restrição, o Laravel retorna o erro HTTP 404 (Not Found).

8. Rotas Nomeadas: Cite duas vantagens corporativas de utilizar a função auxiliar route('clientes.show', $id) nas views em vez de escrever strings estáticas como "/clientes/{$id}".
>Utilizar route('clientes.show', $id) oferece duas vantagens principais:
1. Manutenção: se o endereço da rota mudar, não será necessário alterar manualmente todos os links espalhados pelas views.
2. Organização: facilita a identificação e o gerenciamento das rotas, tornando o código mais limpo e reduzindo erros.

9. Single Responsibility no Controller: Por que a validação de formulários com $request->validate() ou Form Requests deve ser mantida enxuta dentro do controller para respeitar o limite de 20 linhas por função?
> A validação deve ser mantida enxuta no controller para que ele não fique sobrecarregado com muitas responsabilidades. Utilizar $request->validate() ou Form Requests ajuda a separar as regras de validação da lógica principal, tornando o código mais organizado, reutilizável e fácil de manter.

10. A Ferramenta route:list: Como o comando php artisan route:list auxilia equipes multidisciplinares a documentar e auditar os endpoints disponíveis em uma API ou aplicação web?
> O comando php artisan route:list exibe todas as rotas cadastradas na aplicação, incluindo métodos HTTP, URLs, nomes e controllers responsáveis. Isso facilita a documentação, a auditoria e a comunicação entre desenvolvedores, testadores e outros profissionais da equipe.