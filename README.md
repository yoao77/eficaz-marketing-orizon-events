# Orizon Events

O **Orizon Events** é uma plataforma completa para a gestão do ciclo de vida de eventos. O sistema foi projetado para oferecer uma experiência fluida tanto para organizadores — que possuem controle total sobre suas criações — quanto para participantes, garantindo a integridade dos dados através de regras de negócio rigorosas e análise estática de código.

---

## Requisitos do Sistema

O projeto foi construído sobre três pilares principais:

### 1. Gestão de Eventos (CRUD & Business Logic)
* **Controle Total:** Criação, edição, visualização e exclusão de eventos com campos detalhados (Título, Descrição, Data/Hora, Local e Capacidade).
* **Status Dinâmico:** Gerenciamento de estados (Ativo/Cancelado) para controle de disponibilidade.
* **Painel do Organizador:** Acesso exclusivo à lista detalhada de inscritos apenas para os criadores de cada evento.

### 2. Experiência do Participante
* **Inscrições Inteligentes:** Fluxo simplificado de adesão a eventos com validações em tempo real.
* **Autogestão:** Área de "Minhas Inscrições" para acompanhamento e possibilidade de cancelamento da própria participação.

### 3. Regras de Negócio e Segurança
* **Validação de Lotação:** Impedimento automático de novas inscrições em eventos que atingiram a capacidade máxima.
* **Prevenção de Duplicidade:** Garantia de que um usuário não se inscreva mais de uma vez no mesmo evento.
* **Consistência Temporal:** Bloqueio de interações (inscrição/cancelamento) em eventos com datas retroativas.
* **Proteção de Acesso:** Camadas de autorização que garantem que apenas usuários permitidos visualizem dados sensíveis ou realizem alterações.

<br>

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
npm run build
npm install

# Configurar o arquivo de ambiente e gerar a chave
cp .env.example .env
php artisan key:generate

# Ajustar permissões (Necessário para WSL2 ou Linux)
chmod -R 775 storage bootstrap/cache
chmod -R 777 storage bootstrap/cache

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
