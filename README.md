Primeiramente, gostaria de agradecer pela oportunidade de realizar este teste prático. Durante o desenvolvimento, explorei novos conceitos e reforcei a importância do aprendizado contínuo. Em especial, destaco o uso mais aprofundado do PHP, incluindo **attributes** e **DTOs** na estruturação do CRUD de Produtos.

# Requisitos para rodar este projeto
- PHP **8.3 ou superior** (XAMPP, Laravel Herd ou outro servidor compatível)
- Composer
- Node.js e npm

# Instalação e Execução

## Clone o repositório
```bash
git clone https://github.com/UltraGalaxyBro/teste-pratico-growth.git
cd teste-pratico-growth
```

## Instale as dependências do PHP e do Node.js
```bash
composer install
npm install
```

## Configure o ambiente
O projeto utiliza **SQLite** como banco de dados, já configurado para uso imediato.  
Caso necessário, edite o arquivo `.env` para configurar outro banco de dados.

Defina a chave da aplicação:
```bash
php artisan key:generate
```

Se estiver rodando o projeto pelo **Laravel Herd**, altere a variável `APP_URL` no arquivo `.env`:
```env
APP_URL=http://teste-pratico-growth.test
```

## Execute as migrações
```bash
php artisan migrate
```

## Crie um usuário administrador para o Filament
```bash
php artisan make:filament-user
```
Esse usuário será necessário para acessar o painel administrativo.

## Compile os assets (caso utilize Vite ou Laravel Mix)
Se estiver rodando pelo **Laravel Herd**, **apenas este comando já será suficiente**:
```bash
npm run dev
```

Caso contrário, execute também o servidor:
```bash
php artisan serve
```

## Acesse o sistema
🔹 **Área Pública:**  
- Se estiver rodando com Laravel Herd: [http://teste-pratico-growth.test](http://teste-pratico-growth.test)  
- Caso contrário: [http://localhost:8000](http://localhost:8000)  

🔹 **Área Administrativa:**  
- Se estiver rodando com Laravel Herd: [http://teste-pratico-growth.test/admin](http://teste-pratico-growth.test/admin)  
- Caso contrário: [http://localhost:8000/admin](http://localhost:8000/admin)  

---

# Testes
Os testes principais já estão implementados no projeto, cobrindo funcionalidades essenciais do CRUD de produtos e as interações com o banco de dados. Para executar os testes, utilize o seguinte comando:

```bash
php artisan test
```

---

# Estrutura do Projeto

📌 **Área Pública:** Implementada com **Livewire**, focada na busca dinâmica de produtos.  
📌 **Área Administrativa:** CRUD de produtos e exibição de logs registrados por **Observers**, utilizando **Filament**.