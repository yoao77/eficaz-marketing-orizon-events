## Guia de Instalação e Execução

Siga os passos abaixo para configurar o ambiente de desenvolvimento local utilizando Docker.

### 1. Clonar o Repositório
```bash
git clone git@github.com:yoao77/eficaz-marketing-orizon-events.git
cd eficaz-marketing-orizon-events
```

### 2. Subir os Containers
```bash
docker compose up -d --build
```

### 3. Configuração da Aplicação (Dentro do Container)
Acesse o terminal do container para executar os comandos do PHP e Laravel:

```bash
# Entrar no container da aplicação
docker exec -it orizon_events_app bash

# Instalar as dependências do projeto
composer install

# Configurar o arquivo de ambiente e gerar a chave
cp .env.example .env
php artisan key:generate

# Ajustar permissões (Necessário para WSL2 ou Linux)
chmod -R 775 storage bootstrap/cache

# Rodar as migrações e popular o banco de dados
php artisan migrate
php artisan db:seed
```
<br>

## Acesso à Aplicação

Após subir os containers, você poderá acessar os serviços nos seguintes endereços:

| Serviço        | Endereço                    | Porta |
|----------------|-----------------------------|-------|
| **Aplicação** | [http://localhost:8000](http://localhost:8000) | 8000  |
| **phpMyAdmin** | [http://localhost:8080](http://localhost:8080) | 8080  |

---

## Credenciais do Banco (Desenvolvimento)

Caso precise acessar o banco de dados via **phpMyAdmin** ou ferramenta externa (DBeaver/HeidiSQL):

* **Host:** `mysql` (dentro do Docker) ou `localhost` (fora do Docker)
* **Database:** `orizon_events`
* **Usuário:** `root` ou `laravel`
* **Senha:** `root` ou `laravel`
* **Porta Local:** `3306` 
<br>
<br>

## Ferramentas de Desenvolvimento

Para garantir a qualidade do código e a estabilidade da aplicação, você pode utilizar os seguintes comandos configurados:

### Testes e Cobertura
* **Rodar Testes (Pest/PHPUnit):**
    ```bash
    composer test
    ```
* **Verificar Cobertura de Testes:**
    ```bash
    composer test:coverage
    ```

### Padronização e Análise Estática
* **Laravel Pint (Linter de Estilo):**
    ```bash
    composer pint
    ```
    *Utilizado para manter o código seguindo as PSRs e o padrão Laravel.*

* **PHPStan (Análise Estática):**
    ```bash
    composer stan
    ```
    *Verifica erros de tipagem e lógica sem precisar executar o código.*
