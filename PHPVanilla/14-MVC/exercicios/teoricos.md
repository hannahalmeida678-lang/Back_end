
# Questões Teóricas de Fixação

1- O Colapso do Código Espaguete: Explique por que manter consultas SQL, regras de validação e marcação HTML no mesmo arquivo inviabiliza a manutenção e a escalabilidade de um sistema corporativo.
> Misturar consultas SQL, regras de validação e marcação HTML no mesmo arquivo cria o que chamamos de arquitetura de arquivo único (ou monolito acoplado). Embora pareça prático para sistemas pequenos ou protótipos, essa abordagem viola os princípios fundamentais da engenharia de software e inviabiliza o crescimento de um sistema corporativo.

A Tríade MVC: Qual é a função específica de cada um dos três componentes do padrão MVC (Model, View, Controller)? Qual deles deve conter as regras de negócio?
O Papel do Composer: Diferencie o papel do arquivo composer.json do arquivo composer.lock. Por que a pasta vendor/ nunca deve ser versionada no Git?
>O padrão MVC (Model-View-Controller) e o gerenciador de dependências Composer são pilares fundamentais no desenvolvimento de software moderno (especialmente no ecossistema PHP).

A Especificação PSR-4: Como o Autoloader PSR-4 consegue localizar o arquivo src/Controllers/ProdutoController.php a partir do namespace App\Controllers\ProdutoController?
> O autoloader PSR-4 consegue localizar o arquivo correspondente mapeando o prefixo do namespace para um diretório base específico e convertendo o restante das subnamespaces em subdiretórios.

Front Controller: Qual é a principal vantagem de segurança ao centralizar todas as requisições em public/index.php e isolar os arquivos-fonte do projeto fora da raiz pública da web?
Roteador HTTP: Como o objeto Roteador diferencia uma requisição GET /produtos de uma requisição POST /produtos?
> No padrão de arquitetura MVC (Model-View-Controller), o sistema é dividido em três componentes interdependentes para separar as responsabilidades visuais, de controle e de dados.

Injeção de Dados na View: Como a função nativa extract() atua no método renderizar() do Controller para disponibilizar variáveis para as Views?
> A função nativa extract() do PHP transforma as chaves de um array associativo em variáveis locais. Quando utilizada dentro do método renderizar() de um Controller, ela pega o array de dados passados pelo desenvolvedor e injeta os índices diretamente no escopo do arquivo da View que será incluído a seguir.

Segurança contra XSS nas Views: Por que todas as saídas dinâmicas exibidas em tabelas e formulários devem ser envolvidas com htmlspecialchars()?
> O uso da função htmlspecialchars() serve para evitar ataques de Cross-Site Scripting (XSS), convertendo caracteres especiais de HTML em suas respectivas entidades de texto. Quando dados dinâmicos vindos do banco de dados ou de envios de usuários são inseridos diretamente em tabelas ou formulários sem essa proteção, o navegador pode interpretar esses dados como código executável em vez de texto puro.

Single Responsibility no Controller: Por que um Controller nunca deve conter comandos SQL com strings concatenadas ou conexões diretas via new PDO()?
> No padrão de arquitetura MVC (Model-View-Controller) e sob a ótica do princípio Single Responsibility (Princípio da Responsabilidade Única - SRP), um Controller nunca deve conter comandos SQL ou conexões diretas via new PDO() porque a única responsabilidade de um Controller é coordenar o fluxo da aplicação (receber uma requisição HTTP, acionar quem sabe resolver o problema e retornar uma resposta).

Transição para o Framework Laravel: Identifique quais conceitos aprendidos neste MVC artesanal são exatamente os mesmos utilizados pelo Laravel 11.

>Na transição de um padrão MVC (Model-View-Controller) feito de forma "artesanal" (do zero) para o Laravel 11, você perceberá que a lógica estrutural e o fluxo da aplicação permanecem idênticos. O Laravel não inventou a arquitetura Web; ele apenas automatizou e padronizou as dores que você teve ao construir o seu próprio framework.