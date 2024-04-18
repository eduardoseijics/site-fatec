# Fatec
* Projeto do novo site institucional da Fatec Araçatuba. Construido pelos aluno do curso de Análise e Desenvolvimento de Sistemas

## ✨ Pré-requisitos

**PHP**
* PHP na versão 7.4 ou superior

**MySql**
* Mysql para poder acessar o banco de dados

**Composer**
 
* Para rodar o projeto, é necessario ter o composer instalado (https://getcomposer.org/download/)

## ✨ Instalação do projeto

**Composer**

* Através de um terminal, instale as dependências do projeto com o comando *`composer install`* na raiz do projeto

**Configurar variáveis de ambiente**

* Copie o arquivo .env.example e crie um arquivo .env, alterando as variáveis conforme seu ambiente necessite. Por ex, se voce roda o projeto em localhost na porta 8000, *localhost:8000*, troque a URL_BASE para *localhost:8000*, se utiliza xampp, troque para *localhost/nomeDaPasta*, etc...

**Criar banco de dados**
* Crie o banco de dados com a collate `utf8_general_ci` e execute o arquivo .sql presente na raiz do projeto para criar as tabelas do mesmo