##### CLONANDO PROJETOS

* Clone, mantendo nome original do projeto:
```sh
git clone https://github.com/nailtonmauricio/jitte-acl.git
```
ou

* Clone, alterando o nome do projeto:
```sh
git clone --recurse-submodules https://github.com/nailtonmauricio/jitte-acl.git novo_nome_projeto
```

##### QUANDO NECESSÁRIO AJUSTE AS PERMISSÕES DE DIRETÓRIOS E ARQUIVOS
ALTERAR O PROPRIETÁRIO DO DIRETÓRIO DO PROJETO PARA O USUÁRIO HOST
```sh
sudo chown -R $USER:$USER /caminho_do_projeto
```

#### ACESSE O DIRETÓRIO DO PROJETO
```sh
cd app-laravel/
```

###### Crie o Arquivo .env
```sh
cp .env.example .env
```


###### Atualize as variáveis de ambiente do arquivo .env
```
APP_NAME="Nome App"
APP_URL=http://localhost:80

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user_name
DB_PASSWORD=db_user_pass

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


###### Suba os containers do projeto
```sh
docker compose up -d
```


###### Acessar o container
```sh
docker compose exec app bash
```


###### INSTALAÇÃO DAS DEPENDÊNCIAS DO PROJETO
```sh
composer install
npm install
```


GERAR O KEY DA APLICAÇÃO
```sh
php artisan key:generate
```

RODAR AS MIGRATIONS
```sh
php artisan migrate
```

RODAR AS SEEDERS
```sh
php artisan db:seed
```

INICIAR O VITE
```sh
npm run dev
```


Acessar o projeto
[http://localhost](http://localhost)

Acessar o PHPMyadmin
[http://localhost:8080](http://localhost:8080)

Login no Sistema
* E-Mail: admin@admin.com.br
* Senha: admin
