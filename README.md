# Dashboard IF Control

Painel administrativo web que gerencia o aplicativo IF Control e analisa os dados gerados pelo seu uso. 

<h1 align="center">
    <a href="https://if-control.vercel.app/login">
        <img src="https://i.imgur.com/ZOLK3Eo.png" alt="Tela de login da dashboard do IF Control" width="800">
    </a>
    <br/>
</h1>

## Setup 

### Dependências

- [PHP](https://www.php.net/);
- [Composer](https://getcomposer.org/);
- [Laravel](https://laravel.com/);
- [Git](https://git-scm.com/);
- [Axios](https://axios-http.com/);
- [Bootstrap](https://mdbootstrap.com/);
- [Vite](https://vitejs.dev/).

### Instalação Local

Este é um passo a passo para a realição de uma instalação local da aplicação; A instalação em um servidor em cloud poderá variar de acordo com o provedor utilizado para a hospedagem.

1. Crie um diretório local e clone o repositório:

```
$ mkdir dashboard
$ cd dashboard
$ git clone https://github.com/IF-Control/app-dashboard.git .
```

2. Copie o arquivo *.env.example* e renomeie-o para *.env* e cole novamente o arquivo *.env.example*

3. Para rodar a aplicação, digite a sequência de comandos em seu terminal:

```
$ composer install
$ php artisan key:generate
$ php artisan serve
```

## Equipe

* *[Débora Miyake](https://github.com/DeboraMiyake)*
* *[Victor Sousa](https://github.com/VictorPSousa)*

## Erros e bugs

Se algo não está funcionando corretamente, isso é um bug e deve ser reportado.

[Reporte aqui um bug ou erro por meio das issues](https://github.com/IF-Control/app-web-dashboard/issues).

## Como contribuir

Todas as contribuições são bem-vindas. Sugerimos usar este workflow:
 
1. Faça um Fork no projeto;
2. Crie um branch: `git checkout -b nome_da_branch`;
3. Faça a sua adição de funcionalidade ou correção de bug e faça o commit: `git commit -m 'mensagem_descritiva_do_commit'`;
4. Envie uma Pull Request com a descrição do seu trabalho.

## Copyright

© Copyright 2022 IF Control, Débora Miyake & Victor Sousa. 

## Licença

Lançado com a licença [MIT](https://github.com/IF-Control/app-web-dashboard/blob/main/LICENSE).
