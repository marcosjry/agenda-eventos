# Sistema de Agenda de Eventos

Este é um sistema de gerenciamento de eventos desenvolvido em PHP puro, permitindo o cadastro de usuários, criação de eventos por administradores e inscrição de participantes.

## 🚀 Como Executar o Projeto

### 1. Pré-requisitos
*   Servidor local (XAMPP)
*   PHP 7.4 ou superior
*   MySQL

### 2. Configuração do Banco de Dados
Crie um banco de dados no seu MySQL (ex: `agenda_eventos`) e execute o arquivo **`backup-bd-agenda-eventos.sql`**.

### 3. Ajuste de Configuração
Edite o arquivo `config/database.php` para refletir suas credenciais locais:

```php
// config/database.php
$host = 'localhost';
$dbname = 'nome_do_seu_banco';
$user = 'root';
$pass = '';
```

---

## ⚠️ Observação Importante: Hospedagem vs. Local

O diretório e as importações nos arquivos atuais estão configurados especificamente para a hospedagem no **InfinityFree**.

### Caminhos de Arquivos (CSS/JS)
Nos arquivos como `includes/header.php`, os caminhos para CSS e JS estão usando caminhos absolutos baseados na raiz do domínio (ex: `/css/style.css`).

**Para rodar localmente em subpastas (ex: `localhost/teste-agenda/`):**
Você deve alterar os caminhos nos arquivos PHP para que incluam o nome da pasta do projeto ou usar caminhos relativos.

Exemplo em `includes/header.php`:
*   **Atual (InfinityFree):** `<link rel="stylesheet" href="/css/style.css">`
*   **Local (Sugerido):** `<link rel="stylesheet" href="css/style.css">` ou `<link rel="stylesheet" href="/teste-agenda/css/style.css">`

### Importações PHP
Por questões de problemas que enfrentamos na hospedagem gratuíta utilizada, foi necessário padronizar a importação dos arquivos usando `__DIR__` o que nos garantiu compatibilidade com o ambiente. Nesse sentido, verifique se ao tentar executar a aplicação localmente você conseguirá acessar o projeto. Caso não consiga, será necessário alterar o modo de importar os arquivos. Os links em tags `<a>` e redirecionamentos `header('Location: ...')` também precisam de ajuste conforme o ambiente.

---

## 🛠️ Tecnologias Utilizadas
*   PHP (Procedural)
*   MySQL (PDO)
*   Bootstrap 5 (Layout)
*   JavaScript (Validações e busca AJAX)
