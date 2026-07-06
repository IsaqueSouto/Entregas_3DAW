# Simone Belezas — Sistema de Agendamento

Sistema web para agendamento de serviços de beleza, desenvolvido como atividade avaliativa da disciplina **3DAW**.

A aplicação permite que clientes escolham profissionais, visualizem horários disponíveis, selecionem serviços (avulsos ou mensais) e finalizem o agendamento com pagamento via **Pix**, **Cartão** ou **Boleto**.

---

## Tecnologias

- **Frontend:** HTML5, CSS3, JavaScript (vanilla)
- **Backend:** PHP 8+ (API REST)
- **Banco de Dados:** MySQL / MariaDB
- **Servidor Web:** Apache com `mod_rewrite` e suporte a PHP

---

## Arquitetura

O projeto adota a separação clara entre **apresentação** e **lógica de negócio**:

- **Páginas estáticas (`*.html`)** — Interface do usuário; consomem a API via `fetch`.
- **API (`api/*.php`)** — Endpoints PHP que processam dados, acessam o banco e retornam JSON.
- **JavaScript compartilhado (`js/`)** — `comum.js` (autenticação e topo dinâmico) e `api.js` (wrapper para requisições).
- **Banco de Dados (`schema.sql`)** — Script SQL completo para criação das tabelas e carga inicial.

---

## Estrutura de Pastas

```
AV2_3DAW/
├── api/                    # Endpoints PHP (REST)
│   ├── login.php
│   ├── logout.php
│   ├── criar-conta.php
│   ├── sessao.php
│   ├── profissionais.php
│   ├── profissional.php
│   ├── mensal.php
│   ├── mensal-servicos.php
│   ├── horarios.php
│   ├── agendar.php
│   ├── pagar.php
│   ├── pix-qr.php
│   ├── boleto.php
│   └── ultimo-agendamento.php
├── css/
│   └── estilo.css          # Estilos responsivos (tema escuro)
├── js/
│   ├── comum.js            # Funções compartilhadas (login, topo)
│   └── api.js              # Helper para chamadas fetch
├── img/                    # Ícones de pagamento
├── index.html              # Redirecionamento automático
├── login.html              # Tela de autenticação
├── criar-conta.html        # Cadastro de novo usuário
├── menu.html               # Menu principal
├── profissionais.html      # Lista de profissionais
├── profissional.html       # Detalhes e dias do profissional
├── mensal.html             # Calendário de serviços mensais
├── mensal-servicos.html    # Serviços disponíveis por dia
├── horarios.html           # Horários e confirmação
├── pagamento.html          # Escolha da forma de pagamento
├── pix.html / pix-qr.html / pix-copia.html
├── cartao.html
├── boleto.html
├── concluido.html          # Confirmação final
├── funcoes.php             # Configuração do banco e funções utilitárias
├── schema.sql              # Script de criação do banco
└── README.md               # Este arquivo
```

---

## Instalação

### 1. Requisitos

- PHP 8.0 ou superior
- MySQL 5.7+ / MariaDB 10.3+
- Servidor Apache (ou equivalente)
- Extensão `pdo_mysql` habilitada no PHP

### 2. Banco de Dados

Importe o arquivo `schema.sql` no MySQL:

```bash
mysql -u root -p < schema.sql
```

> O script cria o banco `smbel`, as tabelas e insere dados iniciais (profissionais e serviços).

### 3. Configuração

Edite `funcoes.php` com as credenciais do seu ambiente:

```php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'smbel');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 4. Deploy

Coloque todos os arquivos na raiz do documento do Apache (ex: `htdocs/AV2_3DAW/`).

Acesse pelo navegador:

```
http://localhost/AV2_3DAW/
```

---

## Fluxo de Uso

1. **Login ou Cadastro** — O usuário acessa `login.html` e entra com email e senha, ou cria uma conta em `criar-conta.html`.
2. **Menu Principal** — Escolha entre agendar com um profissional específico ou visualizar serviços mensais.
3. **Escolha do Profissional / Serviço** — Seleciona o dia e o tipo de serviço.
4. **Horários** — Escolhe um dos horários disponíveis (11:30 às 16:30).
5. **Pagamento** — Seleciona a forma de pagamento (Pix, Cartão ou Boleto).
6. **Confirmação** — Recebe comprovante/visualização do pagamento e confirma o agendamento.

---

## Endpoints da API

| Endpoint | Método | Descrição |
|----------|--------|-----------|
| `api/sessao.php` | GET | Verifica se o usuário está logado |
| `api/login.php` | POST | Autenticação (email + senha) |
| `api/logout.php` | POST | Encerra a sessão |
| `api/criar-conta.php` | POST | Cadastro de novo usuário |
| `api/profissionais.php` | GET | Lista todos os profissionais |
| `api/profissional.php` | GET | Detalhes e dias de um profissional |
| `api/mensal.php` | GET | Dias da semana com serviços mensais |
| `api/mensal-servicos.php` | GET | Serviços disponíveis para um dia |
| `api/horarios.php` | GET | Lista de horários padrão |
| `api/agendar.php` | POST | Salva o agendamento na sessão |
| `api/pagar.php` | POST | Finaliza o pagamento e salva no banco |
| `api/pix-qr.php` | POST | Gera dados para pagamento Pix |
| `api/boleto.php` | POST | Gera dados para pagamento Boleto |
| `api/ultimo-agendamento.php` | GET | Retorna o último agendamento do usuário |

---

## Segurança

- Senhas armazenadas com `password_hash()` (bcrypt).
- Verificação com `password_verify()` no login.
- Todas as APIs que exigem autenticação utilizam `exige_login_api()`.
- Comunicação via sessões PHP (`session_start()`).
- Requisições fetch incluem `credentials: 'same-origin'` para manter cookies de sessão.

---

## Autor

Projeto acadêmico desenvolvido para a disciplina **3DAW**.

---

## Licença

Uso educacional. Não destinado a produção comercial sem adaptações.
