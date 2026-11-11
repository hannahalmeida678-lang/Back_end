# teoricos

**Protocolo Stateless:** O que significa afirmar que o protocolo HTTP é "stateless" e por que o mecanismo de cookies/sessões é necessário para aplicações modernas?

> Dizer que o protocolo HTTP é stateless significa que ele não mantém automaticamente informações sobre as requisições anteriores de um usuário.

Cada requisição é independente. Por exemplo, quando um usuário faz login em um site, o HTTP não lembra sozinho que ele já está autenticado na próxima página.

**Cookies vs. Sessões:** Qual é a diferença entre os dados armazenados em um cookie e os dados mantidos no array superglobal $_SESSION? Qual dos dois apresenta maior segurança para informações confidenciais?
> Cookies: ficam armazenados no navegador do usuário e são enviados ao servidor nas requisições correspondentes.
Sessões ($_SESSION): ficam armazenadas no servidor, sendo identificadas normalmente por um ID de sessão enviado ao navegador por meio de um cookie.

Por isso, são utilizados cookies e sessões, que permitem armazenar informações de identificação do usuário e manter seu estado de autenticação durante a navegação.


**A Flag HttpOnly**: Explique detalhadamente como a configuração httponly => true impede o sequestro de sessão (Session Hijacking) mesmo se a aplicação possuir uma vulnerabilidade de Cross-Site Scripting (XSS).
> A configuração HttpOnly => true impede que scripts JavaScript acessem diretamente o cookie por meio de comandos como document.cookie.

Isso ajuda a proteger o identificador da sessão contra o roubo por meio de ataques XSS (Cross-Site Scripting).

Mesmo que um invasor consiga executar JavaScript malicioso na página, ele não conseguirá ler diretamente o cookie protegido por essa flag.

**A Flag SameSite:** Qual é a finalidade do atributo SameSite=Lax em cookies e contra qual tipo de ataque corporativo ele atua?
>O atributo SameSite=Lax controla quando um cookie pode ser enviado em requisições iniciadas por outros sites.


**Ataque de Fixação de Sessão:** O que é o ataque de Session Fixation e por que é mandatório executar session_regenerate_id(true) imediatamente após o login do usuário?
>O Session Fixation acontece quando um invasor consegue fazer com que a vítima utilize um identificador de sessão conhecido por ele.

**MD5 e Rainbow Tables:** Por que é considerado negligência técnica armazenar senhas com algoritmos rápidos como MD5 ou SHA256? Como as Rainbow Tables operam contra esses hashes?
O Papel do Salt: O que é o Salt criptográfico e por que ele garante que dois usuários com a mesma senha possuam hashes completamente distintos no banco de dados?
> MD5 e SHA-256 são algoritmos rápidos de hash. Isso representa um problema para o armazenamento de senhas, pois permite que invasores testem muitas combinações em pouco tempo caso obtenham acesso ao banco de dados.

**Argon2id vs Bcrypt:** Por que o algoritmo Argon2id é considerado superior ao Bcrypt na proteção contra ataques de força bruta realizados por placas de vídeo (GPUs) e circuitos ASIC?
> O Salt é um valor aleatório adicionado à senha antes do processo de geração do hash. Mesmo que os dois usuários tenham a mesma senha, os hashes serão diferentes porque cada um possui um Salt exclusivo.

**Timing Attacks:** Por que a verificação de senhas deve ser feita com password_verify() em vez do operador de comparação comum ===?
> Um Timing Attack é um tipo de ataque que explora diferenças no tempo de execução de operações para tentar obter informações confidenciais. Uma comparação comum utilizando === pode revelar diferenças de tempo dependendo de onde ocorre a primeira divergência entre duas strings.