# Template Lojinha Pronta

Ferramentas e material de apoio para montar as lojas entregues pela
[Lojinha Pronta](https://lojinhapronta.vercel.app) — WordPress + WooCommerce,
escopo fechado, entrega repetível.

## O método

Cada entrega **não** reinstala e reconfigura tudo. Das 25 promessas da landing,
13 são configuração (Mercado Pago, entrega automática, e-mails, SSL, LGPD, SEO,
Analytics…), e configuração não cabe num tema — ela vive no banco.

Por isso a peça central é uma **loja-mãe**: uma instalação WordPress + Woo
completa, configurada uma vez, que nunca é entregue. Cada cliente recebe um
clone dela. As 13 configurações viajam junto; sobra trocar o que é do cliente.

O que muda por cliente:

| item | onde |
|---|---|
| cores | paleta do `theme.json` |
| logo | identidade do site |
| textos | briefing |
| produtos | CSV importado (ver abaixo) |
| domínio, chaves do Mercado Pago, e-mail | configuração do clone |

## `ferramentas/catalogo-para-woo.mjs`

Converte um catálogo em CSV de importação nativa do WooCommerce.

```bash
node ferramentas/catalogo-para-woo.mjs <produtos.js> <saida.csv> [--base=URL]
```

Cadastrar produto na mão é o item mais caro de cada entrega. O Woo importa CSV
nativamente, então dez produtos viram um upload de dois minutos. **O briefing do
cliente deve ser desenhado pra desembocar exatamente nestas colunas.**

Detalhes que o script já resolve:

- `Type: simple, virtual, downloadable` — o Woo entrega o arquivo sozinho, sem
  plugin de entrega automática
- `Published: -1` (rascunho) — produto sem PDF anexado é produto que vende e não
  entrega; entra escondido até o arquivo existir
- `--base` aponta as imagens pra uma URL pública e o Woo as baixa durante a
  importação, sem upload manual
- produtos de afiliado (link com `afid=`) são ignorados: a venda precisa
  acontecer no checkout do produtor, e o arquivo não é nosso

> **Ainda não validado num WooCommerce real.** As colunas seguem o formato do
> exportador do Woo, mas a primeira importação é que confirma. Rodar primeiro
> num ambiente de teste.

## `lojas/loja-do-kiwi/`

Primeira loja real a rodar no template. Gerado a partir do catálogo de
[movcodebr/lojadokiwi](https://github.com/movcodebr/lojadokiwi):

- 16 produtos no catálogo, **10 são de afiliado** e ficam de fora
- 6 produtos próprios exportados, todos como rascunho

Pendente para publicar:

- [ ] PDFs dos 6 produtos (coluna `Download 1 URL` vazia)
- [ ] Imagens de 4: Cartão de Votos, Lembrancinha Dia das Mães, Suspiros de
      Amor, Hot Wheels Personalizado
- [ ] Hospedagem definida
- [ ] Conta do Mercado Pago

## `ESPECIFICACAO-LOJA-MAE.md`

Como montar a instalação-mestre: cinco plugins com a justificativa de cada um, o
que **não** instalar e o que usar no lugar, e as configurações com valor exato
campo a campo. Feito para ser executado como lista, sem decidir nada no caminho.

## `CHECKLIST-ENTREGA.md`

O roteiro de uma entrega, do clone à mensagem final. Cada linha aponta para uma
das 25 promessas da landing (`[P01]`…`[P25]`), então não dá pra esquecer o que
foi vendido.

Marca também o que **vem pronto do clone** e o que é **trabalho por cliente** —
é essa separação que faz a entrega caber numa tarde em vez de num dia.

Os tempos são estimativa (somam ~3h50). Cronometre a primeira entrega real e
corrija: a promessa de 4–6h só vale com número medido.

## Próximos passos

1. Executar a especificação numa instalação WordPress
2. Tema filho: cores em variáveis, botão de WhatsApp, snippet do Analytics e o
   rodapé "Loja criada por Lojinha Pronta" fixo — é o motor de aquisição, não
   pode depender de alguém lembrar
3. Briefing que desemboca no CSV
4. Vídeos e manual (feitos uma vez, servem pra sempre)
