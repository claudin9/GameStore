# GameStore - E-commerce para Gamers

Uma plataforma de e-commerce especializada em produtos para gamers, desenvolvida em PHP.

## Requisitos

- PHP 8.0 ou superior
- MySQL 8.0 ou superior
- Composer (Gerenciador de dependências PHP)
- Servidor web (Apache/Nginx)

## Instalação

1. Clone o repositório:
```bash
git clone [URL_DO_REPOSITÓRIO]
cd gamestore
```

2. Instale as dependências via Composer:
```bash
composer install
```

3. Configure as permissões das pastas:
```bash
chmod -R 755 public/uploads
chmod -R 755 public/cache
```

4. Importe o banco de dados:
```bash
mysql -u root -p < database.sql
```

5. Configure o arquivo `.env` com suas configurações:
- Configure as credenciais do banco de dados
- Configure as credenciais do email (se necessário)
- Configure as chaves do Stripe (se necessário)

6. Configure seu servidor web para apontar para a pasta `public/`

## Iniciando o Servidor

Para desenvolvimento, você pode usar o servidor embutido do PHP:
```bash
php -S localhost:8000 -t public
```

## Acessando a Aplicação

- URL local: http://localhost:8000 ou http://localhost/gamestore
- Credenciais do admin:
  - Email: admin@gamestore.com
  - Senha: admin123

## Estrutura do Projeto

```
gamestore/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── config/
├── includes/
├── public/
│   ├── index.php
│   ├── .htaccess
│   └── uploads/
├── src/
│   ├── controllers/
│   ├── models/
│   └── views/
├── vendor/
├── .env
├── .gitignore
├── composer.json
└── database.sql
```

## Funcionalidades

- Catálogo de produtos
- Carrinho de compras
- Sistema de login e registro
- Painel administrativo
- Sistema de pagamentos
- Avaliações de produtos
- Sistema de busca
- Filtros por categorias

## Segurança

- Todas as senhas são hasheadas
- Proteção contra SQL injection
- Validação de dados
- Sanitização de inputs
- Controle de acesso (admin/user)

## Manutenção

Para atualizar a aplicação:
```bash
git pull
composer update
```

Para limpar o cache:
```bash
rm -rf public/cache/*
```

## Logs

Os logs são armazenados em:
```
public/logs/
```

## Backup

Para fazer backup do banco de dados:
```bash
mysqldump -u root -p gamestore > backup.sql
```

## Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes. 