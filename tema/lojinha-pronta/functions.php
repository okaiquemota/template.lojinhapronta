<?php
/**
 * Tema Lojinha Pronta.
 *
 * Três coisas que o tema-pai não faz e que estão prometidas na página de
 * vendas: botão de WhatsApp, Google Analytics e o crédito de rodapé.
 *
 * Nenhuma delas justifica um plugin — plugin instalado aqui existiria em toda
 * loja entregue, para sempre, com atualização podendo quebrar em todas de uma
 * vez.
 */

if (!defined('ABSPATH')) {
    exit; // acesso direto ao arquivo
}

/**
 * Lê config-cliente.php uma vez e devolve um valor.
 */
function lojinha_pronta_config($chave, $padrao = '') {
    static $config = null;

    if ($config === null) {
        $arquivo = get_stylesheet_directory() . '/config-cliente.php';
        $config  = is_readable($arquivo) ? (array) require $arquivo : [];
    }

    return $config[$chave] ?? $padrao;
}

/**
 * Carrega o CSS do tema filho depois do pai.
 */
function lojinha_pronta_estilos() {
    /*
     * Nunito para título e Nunito Sans para texto: arredondadas e quentes, que
     * é como material de professora se apresenta. O tema-pai vem com a fonte do
     * sistema, que não erra e também não diz nada.
     */
    wp_enqueue_style(
        'lojinha-pronta-fontes',
        'https://fonts.googleapis.com/css2?family=Nunito:wght@700;800&family=Nunito+Sans:wght@400;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'lojinha-pronta',
        get_stylesheet_uri(),
        ['twentytwentyfive-style', 'lojinha-pronta-fontes'],
        wp_get_theme()->get('Version')
    );
}

/**
 * Abre a conexão com o servidor de fontes antes do navegador precisar dela.
 */
function lojinha_pronta_preconnect($urls, $relation) {
    if ($relation === 'preconnect') {
        $urls[] = ['href' => 'https://fonts.googleapis.com'];
        $urls[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin' => ''];
    }

    return $urls;
}
add_filter('wp_resource_hints', 'lojinha_pronta_preconnect', 10, 2);
add_action('wp_enqueue_scripts', 'lojinha_pronta_estilos');

/**
 * Google Analytics 4.
 *
 * Não carrega nada quando o ID está vazio: loja sem Analytics configurado não
 * deve pagar o custo de um script de terceiro.
 */
function lojinha_pronta_analytics() {
    $id = lojinha_pronta_config('analytics_ga4');

    if (empty($id) || is_admin()) {
        return;
    }

    $id = esc_js($id);
    ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo rawurlencode($id); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo $id; ?>');
</script>
    <?php
}
add_action('wp_head', 'lojinha_pronta_analytics');

/**
 * Botão flutuante de WhatsApp e crédito de rodapé.
 *
 * Saem no wp_footer, que é o último ponto antes do </body> — depois do rodapé
 * do tema de blocos, que é justamente onde o crédito deve aparecer.
 */
function lojinha_pronta_rodape() {
    $numero = preg_replace('/\D/', '', (string) lojinha_pronta_config('whatsapp'));

    if (!empty($numero)) {
        $texto = lojinha_pronta_config('whatsapp_texto');
        $link  = 'https://wa.me/' . $numero;

        if (!empty($texto)) {
            $link .= '?text=' . rawurlencode($texto);
        }
        ?>
<a class="lp-zap" href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer"
   aria-label="Falar no WhatsApp">
  <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" aria-hidden="true" focusable="false">
    <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.76-1.66-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.61-.92-2.21-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.01-1.04 2.47 0 1.46 1.06 2.87 1.21 3.07.15.2 2.09 3.2 5.07 4.49.71.3 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2-1.41.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z"/>
    <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.46 1.32 4.96L2 22.5l5.77-1.51a9.86 9.86 0 0 0 4.27.97h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm0 18.13h-.01c-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.05-.2-.31a8.22 8.22 0 0 1-1.26-4.38c0-4.54 3.7-8.23 8.25-8.23 2.2 0 4.27.86 5.83 2.42a8.19 8.19 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.23 8.23z"/>
  </svg>
</a>
        <?php
    }

    /*
     * A linha de copyright sai daqui, e não do rodapé em blocos, porque o ano
     * precisa virar sozinho: escrito à mão, toda loja entregue amanhece em 1º
     * de janeiro dizendo o ano passado.
     */
    ?>
<p class="lp-credito">
  <span>&copy; <?php echo esc_html(date_i18n('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?></span>
    <?php if (lojinha_pronta_config('creditos', true)) : ?>
  <a href="https://lojinhapronta.com.br" target="_blank" rel="noopener">Loja criada por Lojinha Pronta</a>
    <?php endif; ?>
</p>
    <?php
}
add_action('wp_footer', 'lojinha_pronta_rodape');

/**
 * CSS do botão e do crédito.
 *
 * Inline porque são poucas regras: um arquivo separado custaria uma requisição
 * a mais em cada página, e velocidade importa em loja aberta pelo 4G.
 */
function lojinha_pronta_css_rodape() {
    $css = '
.lp-zap{position:fixed;right:16px;bottom:16px;z-index:9990;display:grid;place-items:center;
  width:56px;height:56px;border-radius:50%;background:#25d366;color:#fff;
  box-shadow:0 6px 20px rgba(0,0,0,.25);transition:transform .3s ease}
.lp-zap:hover,.lp-zap:focus-visible{transform:scale(1.08);color:#fff}
.lp-credito{margin:0;padding:1.25rem 1rem;font-size:.8rem;line-height:1.5;
  display:flex;flex-wrap:wrap;gap:.25rem .75rem;justify-content:center;align-items:center;
  border-top:1px solid rgba(255,255,255,.12)}
.lp-credito a{color:inherit;opacity:.75;text-decoration:none}
.lp-credito a::before{content:"\00b7";margin-right:.75rem;opacity:.6}
.lp-credito a:hover{opacity:1;text-decoration:underline}
@media (max-width:781px){.lp-credito{padding-bottom:5.5rem}}
@media (prefers-reduced-motion:reduce){.lp-zap{transition:none}}';

    wp_add_inline_style('lojinha-pronta', $css);
}
add_action('wp_enqueue_scripts', 'lojinha_pronta_css_rodape', 20);
