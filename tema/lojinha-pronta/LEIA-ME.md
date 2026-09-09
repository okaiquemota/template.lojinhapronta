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

## Trocar a cara da loja por cliente

Toda a aparência sai de **quatro cores no `theme.json`**. Não existe cor
escrita à mão em nenhum outro lugar do tema.

| slug | onde aparece |
| --- | --- |
| `lp-marca` | faixa da chamada, títulos, preço, número dos passos |
| `lp-marca-escura` | rodapé e faixa do crédito |
| `lp-destaque` | botões |
| `lp-suave` | faixas claras, texto sobre o rodapé escuro |

**A única regra:** `lp-marca` e `lp-marca-escura` precisam ser escuras o
bastante para carregar texto branco por cima — contraste 4,5:1 ou mais. Se a
cliente quer rosa, laranja ou amarelo, a cor vai no `lp-destaque`, que é fundo
de botão e nunca fundo de faixa inteira.

Errar isso não deixa o site feio: deixa ilegível, e só aparece depois de
entregue.

## As fontes

Nunito nos títulos, Nunito Sans no texto, carregadas do Google Fonts no
`functions.php`. Arredondadas e quentes, que é como material de professora se
apresenta — o tema-pai vem com a fonte do sistema, que não erra e também não
diz nada.

Para trocar: muda a URL no `lojinha_pronta_estilos()` e os dois nomes em
`settings.typography.fontFamilies` do `theme.json`.

