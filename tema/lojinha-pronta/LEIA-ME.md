# Tema Lojinha Pronta

Tema filho do **Twenty Twenty-Five**. Herda todos os modelos de página do pai e
continua recebendo atualização de segurança pelo próprio WordPress — você não
vira responsável por manter um tema inteiro em cinquenta lojas.

Carrega só o que é da entrega e o tema-pai não faz:

- a paleta da cliente
- botão flutuante de WhatsApp
- Google Analytics
- o crédito **"Loja criada por Lojinha Pronta"** no rodapé

## Instalar

1. Copie a pasta `lojinha-pronta` para `wp-content/themes/`
2. Painel → **Aparência → Temas** → ativar **Lojinha Pronta**

O Twenty Twenty-Five precisa continuar instalado. É o pai: apagar quebra a loja.

## O que muda por cliente

**Só dois arquivos.**

### `config-cliente.php`

```php
'whatsapp'      => '5516999999999',   // com 55 e DDD, só números
'analytics_ga4' => 'G-XXXXXXXXXX',    // vazio não carrega nada
'creditos'      => true,              // o crédito de rodapé
```

### `theme.json` → as quatro cores

| slug | onde aparece |
|---|---|
| `lp-marca` | links e hover de botão |
| `lp-marca-escura` | variação escura |
| `lp-destaque` | fundo dos botões — é a cor que mais aparece |
| `lp-suave` | fundo da faixa do crédito |

Tire as cores do logo da cliente. Confira o contraste do texto branco sobre
`lp-destaque` antes de entregar: botão ilegível no sol do celular é o defeito
mais caro de uma loja.

## Por que o crédito fica no código

`'creditos' => true` mora no tema, não numa configuração do painel, porque é o
motor de aquisição do negócio: quem navega numa loja do nicho é o próximo
cliente. Configuração no painel é coisa que se esquece de marcar; código viaja
no clone.
