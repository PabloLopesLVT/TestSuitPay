
# Projeto de Gestão de Cursos e Matrículas

Este é um projeto Laravel desenvolvido para gerenciar alunos, cursos e matrículas. A aplicação permite criar, listar, editar e excluir alunos e cursos, além de gerenciar matrículas de acordo com regras de negócio específicas.

---

## **Tecnologias Utilizadas**
- **PHP** (Laravel Framework)
- **MySQL** (Banco de Dados)
- **Docker** (Para o ambiente de desenvolvimento)
- **Bootstrap** (Frontend)
- **Nginx** (Servidor web)
- **Docker Compose** (Gerenciamento de containers)

---

## **Configuração do Projeto**

### **1. Clone o Repositório**
Clone o projeto em sua máquina local:
```bash
git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio
```

---

### **2. Configuração do Arquivo `.env`**
1. Copie o arquivo de exemplo `.env.example` para `.env`:
   ```bash
   cp .env.example .env
   ```
2. Configure o arquivo `.env` para definir as credenciais do banco de dados conforme o `docker-compose.yml`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```

---

### **3. Configuração do Docker**
O projeto utiliza **Docker Compose** para configurar o ambiente. Certifique-se de que o arquivo `docker-compose.yml` esteja configurado corretamente e execute o seguinte comando para subir os containers:
```bash
docker-compose up -d
```

Isso criará os serviços:
- **`app`**: Container com o Laravel.
- **`db`**: Container com o MySQL.
- **`nginx`**: Container do servidor web.

---

### **4. Instalação das Dependências do Laravel**
1. Entre no container do Laravel:
   ```bash
   docker exec -it laravel_app bash
   ```
2. Instale as dependências do projeto:
   ```bash
   composer install
   ```

---

### **5. Configuração do Banco de Dados**
1. Execute as **migrations** para criar as tabelas no banco de dados:
   ```bash
   php artisan migrate
   ```
2. Caso necessário, execute os **seeds** para popular o banco de dados:
   ```bash
   php artisan db:seed
   ```

---

### **6. Geração da Chave da Aplicação**
Gere a chave de criptografia do Laravel:
```bash
php artisan key:generate
```

---

### **7. Acessar o Projeto**
Depois de configurar tudo, abra o navegador e acesse:
```
http://localhost:8080
```

---

## **Estrutura do Projeto**

### **Funcionalidades**
- **Alunos**:
  - CRUD completo (Criar, Listar, Editar, Excluir).
- **Cursos**:
  - CRUD completo (Criar, Listar, Editar, Excluir).
  - Validação de vagas e data limite para matrículas.
- **Matrículas**:
  - Gerenciamento completo:
    - Criar, Listar e Excluir.
    - Validação de regras de negócio:
      - Impede matrícula após a data limite do curso.
      - Verifica se o limite de vagas foi alcançado.
      - Evita duplicação de matrícula para o mesmo curso.

---

### **Estrutura de Navegação**
O projeto conta com um layout de navegação com **sidebar**, permitindo alternar entre as seções:
- **Alunos**: `/alunos`
- **Cursos**: `/cursos`
- **Matrículas**: `/matriculas`

A navegação está acessível em todas as páginas, com destaque para a seção atual.

---

## **Comandos Úteis**

### **Subir e Parar os Containers**
- Subir os containers:
  ```bash
  docker-compose up -d
  ```
- Parar os containers:
  ```bash
  docker-compose down
  ```

---

### **Acessar o Container Laravel**
Entre no container Laravel para executar comandos do Artisan:
```bash
docker exec -it laravel_app bash
```

---

### **Rodar Migrations**
```bash
php artisan migrate
```

---

### **Rodar Seeds**
```bash
php artisan db:seed
```

---

## **Problemas Comuns**

### **1. Banco de Dados não Conectando**
- Certifique-se de que o serviço MySQL está rodando e que as credenciais no arquivo `.env` correspondem ao configurado no `docker-compose.yml`.

### **2. Erro de Permissão em Containers**
- Execute os comandos com privilégios administrativos:
  ```bash
  sudo docker-compose up -d
  ```

---

## **Contribuição**
Contribuições são bem-vindas! Sinta-se à vontade para enviar pull requests ou abrir issues com sugestões de melhorias.

---

## **Licença**
Este projeto é licenciado sob a [MIT License](LICENSE).
