<?php

# DOC. REF: https://github.com/spatie/dropbox-api

# Auto load do composer
require __DIR__.'/vendor/autoload.php';

# Dependências da classe do sdk
use Spatie\Dropbox\Client as DropboxClient;

# Token de acesso obtido direto em dropbox.com/developers/apps -> após criar um app e passar as permissões 
$token = '';

$obDropBoxClient = new DropboxClient($token);

// # Cria uma pasta no dropbox | Após criar pasta, comentar para não gerar erro ou passar param. (ref. acima)
try{
    $obDropBoxClient->createFolder('/AmbienteDEV');
}
catch(Exception $erro){
    echo "<hr><h3>Falha ao criar pasta!</h3><br>Não foi possivel criar a pasta, possivelmente pasta já existente";
    echo "<br><br>".$erro."<br><br><hr>";
}

# UPLOAD DE ARQUIVO | Para subscrever arquivo, mudar o ADD por overwrite
$obDropBoxClient->upload('/imagem.png',file_get_contents(__DIR__.'/upload/imagem.png'),'add');

# UPLOAD DE ARQUIVO PASSANDO PASTA QUE VAI SER ADC. 
$obDropBoxClient->upload('/AmbienteDEV/dev.txt',file_get_contents(__DIR__.'/upload/dev.txt'),'overwrite');

# Lista os arquivos da pasta
$list = $obDropBoxClient->listFolder('/AmbienteDEV');
print_r($list);

# LINK TEMPORARIO de um caminho temporario que quando acessado gera o download
$link = $obDropBoxClient->getTemporaryLink('AmbienteDEV/dev.txt');
print_r($link);

echo "<br><br><br> OK | @joaopnk !";

?>