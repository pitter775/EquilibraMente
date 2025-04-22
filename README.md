# 🧘 Projeto Equilibra Mente - Sistema de Aluguel de Salas

Este é um sistema web para **gestão e reserva de salas por horário**, desenvolvido em **Laravel 8+** com foco em clínicas e espaços de sublocação. O projeto permite que clientes reservem salas disponíveis, e que administradores gerenciem reservas, usuários e recursos.

## ⚙️ Tecnologias Utilizadas

- **Laravel 8+**
- **PHP 7.4+**
- **MySQL**
- **Blade + Bootstrap**
- **Docker (ambiente local)**
- **JavaScript personalizado**
- **Integração com Google OAuth**
- **Polimorfismo com morphOne (endereços)**

## 🔐 Funcionalidades Principais

### Área Pública (Site)
- Exibição de salas disponíveis
- Página de detalhes com imagens rotativas e calendário de disponibilidade
- Botão "Logar para reservar" com redirecionamento após login

### Área do Cliente
- Dashboard com resumo das reservas
- Tela de reservas com visualização por data
- Modal com detalhes da sala e chave liberada 30min antes do horário
- Histórico de reservas

### Área Administrativa
- Cadastro e gerenciamento de salas
- Upload de múltiplas imagens por sala
- Controle de horários disponíveis (disponibilidades)
- CRUD de usuários e reservas
- Painel para cadastrar códigos das fechaduras eletrônicas (em desenvolvimento)

## 🔄 Funcionalidades Futuras
- Integração com fechaduras Intelbras FR101
- Geração de faturas e controle de transações
- Integração com gateway de pagamento (PagBank)
- Sistema de notificações (e-mail/SMS)

## 🧠 Organização
O sistema é dividido em 3 ambientes:
1. **Site institucional**  
2. **Área do Cliente (reservas)**  
3. **Administração (painel completo)**

## 🧪 Como Rodar Localmente

```bash
git clone https://github.com/pitter775/equilibra-mente.git
cd equilibramente
cp .env.example .env
# configure seu .env
docker-compose up -d
composer install
php artisan key:generate
php artisan migrate --seed
