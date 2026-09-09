<?php
/**
 * O ÚNICO ARQUIVO QUE MUDA POR CLIENTE.
 *
 * Fica separado do functions.php de propósito: na entrega você edita quatro
 * linhas num arquivo que só tem configuração, sem risco de encostar em código.
 *
 * As cores não estão aqui — elas ficam no theme.json, que é o que o editor do
 * WordPress lê.
 */

return [
    // Só números, com 55 e DDD. Vazio esconde o botão.
    'whatsapp' => '',

    // Mensagem que já vem digitada quando a pessoa toca no botão.
    'whatsapp_texto' => 'Oi! Vi sua loja e queria tirar uma dúvida.',

    // ID do Google Analytics 4, formato G-XXXXXXXXXX. Vazio não carrega nada.
    'analytics_ga4' => '',

    /*
     * Barra de aviso no topo do site. Vazio esconde a barra inteira.
     *
     * É o lugar de "10% no Pix" ou "coleção de Páscoa no ar". Uma frase curta:
     * a barra não quebra em duas linhas no celular sem ficar feia.
     */
    'aviso' => '',

    // Para onde a barra leva. Vazio deixa a barra sem link.
    'aviso_link' => '',

    /*
     * Crédito "Loja criada por Lojinha Pronta" no rodapé.
     *
     * É o motor de aquisição do negócio: quem navega numa loja do nicho é o
     * próximo cliente. Só desligue se estiver combinado e cobrado à parte.
     */
    'creditos' => true,
];
