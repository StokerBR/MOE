# MOE
Sistema Web do Mural de Oportunidades de Estágio
## Instruções para execução
### Pré requisitos (softwares instalados)
- PHP 7.4
- Composer
- NPM
- PostgreSQL

### Passo a passo

 1. Criar um banco com as seguintes informações:
	- Nome: `moe`
	- Username: `postgres`
	- Senha: `postgres`
2. Entrar (cd) neste diretório (/MOE), para executar os comandos a seguir
3. `composer install`
4. `npm install`
5. `npm run prod`
6. `php artisan migrate:fresh --seed` *(fazer as migrations e popular o banco)*
7. `php artisan serve` *(iniciar o servidor de desenvolvimento, será aberto em http://localhost:8000)*

#### Informações para acesso
-	Usuário Universitário padrão: universitario@moe.com
-	Usuário Empresa padrão: empresa@moe.com
-	Usuário Coordenador de Curso padrão: coordenador@moe.com
-	Usuário Administrador padrão: admin@moe.com

Senha padrão para todos os usuários: `moe`
