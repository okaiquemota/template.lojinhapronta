# Especificação da loja-mãe

A instalação-mestre, configurada uma vez e **nunca entregue**. Cada cliente
recebe um clone dela.

Este documento existe para que montar a loja-mãe seja **executar uma lista**, não
tomar decisões. Siga na ordem; cada item traz o valor exato e o porquê.

> Os nomes de menu mudam entre versões do WordPress e do WooCommerce, e não tenho
> uma instalação aqui para conferir. Se algum caminho estiver diferente do que
> está escrito, me diga o que aparece na sua tela e eu corrijo esta página.

---

## Parte 1 — Plugins

**Cinco.** Cada plugin instalado aqui vai existir em toda loja que você entregar,
para sempre: é atualização que quebra, é conflito, é suporte. A lista curta não é
economia, é o produto.

| plugin | por quê |
|---|---|
| **WooCommerce** | a loja em si |
| **Mercado Pago payments for WooCommerce** | o oficial deles. Pix, cartão e boleto |
| **FluentSMTP** | entrega de e-mail. Sem ele, confirmação de compra cai no spam |
| **All-in-One WP Migration** | é o mecanismo de clonagem — exporta a loja-mãe inteira num arquivo |
| **The SEO Framework** | SEO que funciona sem configuração. Sem anúncio dentro do painel |

### O que NÃO instalar, e o que usa no lugar

| tentação | por que não | o que usar |
|---|---|---|
| Plugin de entrega automática | o WooCommerce faz nativo | produto **virtual + para download** |
| Elementor ou outro page builder | pesado, e a cliente teria que aprender ferramenta proprietária | tema de blocos, editor nativo |
| Plugin de botão de WhatsApp | 20 linhas não valem um plugin | código no tema filho |
| Plugin de Google Analytics | idem | snippet no tema filho |
| Plugin de backup | a hospedagem já faz | painel da hospedagem |
| Yoast / Rank Math | pedem configuração e enchem o painel de aviso | The SEO Framework |

---

## Parte 2 — Configurações

### 2.1 WordPress · Configurações → Geral

- [ ] Idioma do site: **Português do Brasil**
- [ ] Fuso horário: **São Paulo**
- [ ] Formato de data: **d/m/Y**
- [ ] Formato de hora: **H:i**
- [ ] A semana começa em: **domingo**

### 2.1b WordPress · Painel → Atualizações

- [ ] **Atualizar traduções**, se oferecido

> Trocar o idioma do site traduz o WordPress, mas **não** os plugins. Sem este
> passo o WooCommerce continua em inglês e a cliente recebe um painel pela
> metade — "Orders", "Customers", "Settings" — que ela não vai saber navegar.

### 2.1c WooCommerce · dispensar o assistente do painel

- [ ] Esconder o bloco **"Welcome to… / 0 out of 6 complete"** pelos três
      pontinhos (⋮)
- [ ] Esconder também o bloco **"Things to do next"**

> Esses blocos viajam no clone. A cliente abre o painel dela e encontra uma lista
> mandando "Set up payments" e "Select your shipping options", sem saber se
> precisa fazer — e liga para você perguntar. Some uma vez aqui, some em todas.

### 2.2 WordPress · Configurações → Links permanentes

- [ ] Estrutura: **Nome do post** (`/%postname%/`)

> O padrão do WordPress é `?p=123`. Endereço feio prejudica busca e passa
> amadorismo quando a cliente manda o link do produto no WhatsApp.

### 2.3 WordPress · Configurações → Leitura

- [ ] **Na loja-mãe: deixe "Sugerir aos mecanismos de busca..." MARCADO**

> Marcado = pede para não indexar. É o correto aqui, porque a loja-mãe nunca deve
> aparecer no Google. **Desmarcar faz parte do checklist de entrega** — é o passo
> que mais se esquece, e a loja da cliente fica invisível por meses.

### 2.4 WordPress · Configurações → Discussão

- [ ] Desmarcar **"Permitir comentários em novos posts"**

> Loja não precisa de comentário, e comentário aberto é entrada de spam — que
> vira e-mail para a cliente e suporte para você.

### 2.5 WooCommerce → Configurações → Geral

- [ ] País/Região: **Brasil**
- [ ] Moeda: **Real brasileiro (R$)**
- [ ] Posição da moeda: **Esquerda com espaço** (`R$ 19,90`)
- [ ] Separador decimal: **,** · Separador de milhar: **.** · Casas decimais: **2**
- [ ] **Habilitar impostos: desmarcado**

> Imposto desmarcado é decisão consciente: a cliente vende com CPF ou MEI e não
> destaca tributo na nota. Ligar isso criaria um campo que ela não sabe preencher.

### 2.6 WooCommerce → Configurações → Produtos → Downloads

Esta seção é o coração da entrega automática. Erre aqui e a loja vende sem
entregar, ou entrega sem receber.

- [ ] Método de download: **Redirecionamento forçado**
- [ ] **Conceder acesso ao download após o pagamento** — marcado
- [ ] Restringir acesso a usuários logados: **desmarcado**

> "Após o pagamento" é o item crítico. Sem ele, um pedido de boleto ainda não pago
> já libera o arquivo — a cliente entrega de graça e só descobre depois.
>
> "Redirecionamento forçado" impede que alguém compartilhe o link direto do PDF.

### 2.7 WooCommerce → Configurações → Contas e privacidade

- [ ] **Permitir compra como visitante** — marcado
- [ ] **Permitir criação de conta durante a finalização** — marcado
- [ ] **Criar conta automaticamente ao finalizar** — marcado

> Essa combinação entrega as duas promessas ao mesmo tempo: a compradora não
> encontra barreira de cadastro, e mesmo assim ganha conta — que é a "área do
> cliente para rebaixar o que já comprou".

### 2.8 WooCommerce → Configurações → Pagamentos

- [ ] Desativar **Transferência bancária**, **Cheque** e **Pagamento na entrega**
- [ ] Ativar **Mercado Pago** (as credenciais são preenchidas por cliente)

> Deixar meio de pagamento manual ligado é pedir para a cliente receber pedido que
> nunca será pago — e o produto digital some do estoque mental dela.

### 2.9 WooCommerce → Configurações → E-mails

- [ ] "De" (nome): deixe genérico na mãe, troca por cliente
- [ ] Cor base: a cor da marca (trocada por cliente)
- [ ] Conferir que **Novo pedido**, **Pedido processando** e **Pedido concluído** estão ativos

### 2.10 FluentSMTP

- [ ] Configurar um remetente e **enviar e-mail de teste**
- [ ] Confirmar que chegou **na caixa de entrada, não no spam**

> Este é o passo invisível que decide se a promessa "e-mail automático de
> confirmação" existe de verdade. Hospedagem compartilhada enviando por PHP puro
> cai em spam com frequência alta.

---

## Parte 2.11 — Rodapé do tema-pai

O Twenty Twenty-Five traz o próprio rodapé escrito, e ele viaja para toda loja
entregue.

- [ ] **Aparência → Editor → Padrões → Partes de modelo → Rodapé**
- [ ] Trocar **"Twenty Twenty-Five"** pelo nome do site
- [ ] Remover **"Designed with WordPress"**
- [ ] Salvar

> Sem isso, a loja da sua cliente exibe no rodapé o nome de um tema que ela não
> conhece. Não quebra nada, mas é a diferença entre loja feita e loja montada.
>
> O crédito "Loja criada por Lojinha Pronta" **não fica aqui** — ele é gerado
> pelo tema, fora do rodapé editável, justamente para que nem a cliente nem você
> apaguem sem querer.

---

## Parte 3 — Páginas que já vêm prontas

Escreva uma vez, com marcadores para trocar por cliente.

- [ ] Política de privacidade (LGPD)
- [ ] Termos de uso
- [ ] Política de reembolso de produto digital
- [ ] Sobre
- [ ] Contato

> Use marcadores literais tipo `[NOME_DA_LOJA]` e `[CPF_CNPJ]` no texto. Na
> entrega é localizar e substituir — e fica óbvio se sobrou algum.

---

## Parte 4 — Exportar

- [ ] All-in-One WP Migration → **Exportar para arquivo**
- [ ] Guardar como `loja-mae-v1.wpress` com a data
- [ ] Anotar a versão em `versoes.md`: o que mudou e quando

> Toda correção descoberta numa entrega volta **para a loja-mãe** e vira `v2`.
> Correção feita só no clone se perde; feita na mãe, vale para todas as próximas.
