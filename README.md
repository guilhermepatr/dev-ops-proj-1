# Insumos Agrícolas

Este é um sistema de gerenciamento de insumos agrícolas que permite o CRUD (Criar, Ler, Atualizar, Deletar) de produtos. A aplicação é desenvolvida em PHP e utiliza um banco de dados MySQL para armazenar as informações dos insumos.

## Funcionalidades

- Listar insumos
- Adicionar novos insumos
- Visualizar detalhes de um insumo
- Editar informações de um insumo
- Deletar insumos
- Tratamento de erros e validação de entradas

## Requisitos

Para rodar esta aplicação, você precisará de:

- PHP 8.3 ou superior
- MySQL
- Servidor Web Apache ou Nginx

## Instalação

1. Clone este repositório ou faça o download dos arquivos.
2. Crie um banco de dados no MySQL com o nome `insumos_agricolas`.
3. Execute o script SQL disponível em `insumos_agricolas.sql` para criar as tabelas necessárias.
4. Edite o arquivo `config.php` para ajustar as credenciais do banco de dados conforme necessário.
5. Coloque os arquivos da aplicação na raiz do seu servidor web.
6. Acesse a aplicação pelo seu navegador em `http://localhost/nome_do_seu_projeto/index.php`.

## Neste link você vai tera acesso ao arquivo docs com os codigos que seão utilizado:
https://docs.google.com/document/d/175FxNKoUloYdA-6bemie6KJVSxcNPH6FzOfKWT1MjxA/edit?usp=sharing

## Estrutura do Banco de Dados

A estrutura da tabela `insumos` é a seguinte:

```sql
CREATE TABLE insumos (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    tipo ENUM('Ração', 'Equipamento', 'Remédio', 'Outros') NOT NULL,
    quantidade INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);


