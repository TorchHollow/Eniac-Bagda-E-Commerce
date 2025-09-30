# Eniac-Bagda-E-Commerce

# Projeto Eniac Store

Este é um projeto de e-commerce para a venda de produtos usados, desenvolvido para a disciplina de Projeto Integrador da faculdade Eniac em Guarulhos.

## Como Rodar o Projeto

Siga os passos abaixo para configurar e rodar o projeto localmente.

### Pré-requisitos
- XAMPP (ou qualquer outro servidor local com Apache, PHP e MySQL)

### 1. Configuração do Banco de Dados

1.  Abra o phpMyAdmin no seu XAMPP.
2.  Crie um novo banco de dados vazio com o nome `eniac_store`.
3.  Selecione o banco `eniac_store` que você acabou de criar e clique na aba "Importar".
4.  Clique em "Escolher arquivo" e selecione o arquivo `eniac_store.sql` que está na pasta `/database` deste projeto.
5.  Clique em "Importar" no final da página.

Isso irá criar todas as tabelas e inserir os dados iniciais (usuário admin e produtos de exemplo).

### 2. Rodando o Site

1.  Coloque a pasta do projeto (`eniac_store`) dentro da sua pasta `htdocs` do XAMPP.
2.  Inicie os módulos Apache e MySQL no painel de controle do XAMPP.
3.  Acesse o projeto no seu navegador através da URL: `http://localhost/eniac_store/`

### Credenciais de Administrador

- **Email:** `admin@eniac.com`
- **Senha:** `admin123`
