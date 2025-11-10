# 🚀 JITTE-ACL

![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-2.8-885630?style=for-the-badge&logo=composer&logoColor=white)
![NodeJS](https://img.shields.io/badge/Node.js-18.20-339933?style=for-the-badge&logo=nodedotjs&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)

---

### 📌 Descrição
Este projeto tem por objetivo servir como base de desenvolvimento para sistemas maiores, abstraindo rotinas iniciais

📂 Estrutura do Projeto
.  
├── docker-compose.yml  
├── Dockerfile  
├── .env-exemple  
├── app/               # Código-fonte do projeto  
└── README.md
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

#### ACESSE O DIRETÓRIO DO PROJETO
```sh
cd app-name/
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


###### Acessar o container app
```sh
docker compose exec app bash
```


###### INSTALAÇÃO DAS DEPENDÊNCIAS DO PROJETO
```sh
composer install
npm install
```


###### GERAR O KEY DA APLICAÇÃO
```sh
php artisan key:generate
```

###### RODAR AS MIGRATIONS
```sh
php artisan migrate
```

###### RODAR AS SEEDERS
```sh
php artisan db:seed
```

###### INICIAR O VITE
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
