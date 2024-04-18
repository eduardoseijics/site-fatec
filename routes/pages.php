<?php

use App\Http\Response;
use App\Controller\Pages;
use App\Controller\Pages\Page;

//ROTA HOME
$obRouter->get('/', [
  function() {
    return new Response(Response::HTTP_OK, Pages\Home::getHome());
  }
]);

//ROTA SOBRE
$obRouter->get('/sobre', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/sobre'));
  }
]);

$obRouter->get('/trabalho-de-graduacao', [
  function() {
    return new Response(Response::HTTP_OK, Pages\TrabalhoDeGraduacao::getTrabalhoDeGraduacao());
  }
]);

$obRouter->get('/cursos/analise-e-desenvolvimento-de-sistemas', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/analise-e-desenvolvimento-de-sistemas'));
  }
]);

$obRouter->get('/cursos/biocombustiveis', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/biocombustiveis'));
  }
]);

$obRouter->get('/cursos/gestao-empresarial', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/gestao-empresarial'));
  }
]);

$obRouter->get('/monitoria', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/monitoria'));
  }
]);

$obRouter->get('/iniciacao-cientifica', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/iniciacao-cientifica'));
  }
]);

$obRouter->get('/processo-seletivo-simplificado', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/processo-seletivo-simplificado'));
  }
]);

$obRouter->get('/estagio', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/estagio'));
  }
]);

$obRouter->get('/CPA', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/CPA'));
  }
]);

$obRouter->get('/contato', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/contato'));
  }
]);

$obRouter->get('/noticias', [
  function() {
    return new Response(Response::HTTP_OK, Pages\Noticia::getPageNoticias());
  }
]);

$obRouter->get('/sematec', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/sematec'));
  }
]);

$obRouter->get('/hackathon', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/hackathon'));
  }
]);

$obRouter->get('/fatec-aberta', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/fatec-aberta'));
  }
]);

$obRouter->get('/siga', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/siga'));
  }
]);

$obRouter->get('/biblioteca', [
  function() {
    return new Response(Response::HTTP_OK, Page::getStaticPage('pages/biblioteca'));
  }
]);
