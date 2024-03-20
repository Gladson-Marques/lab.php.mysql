<?php

// Obtém uma lista de artigos mais visualizados no site
$sql = <<<SQL

SELECT 
cmt_article, 
    art_title, art_summary, 
    COUNT(*) AS total_comments
FROM comment
    INNER JOIN article ON cmt_article = art_id
WHERE cmt_status = 'on'
GROUP BY cmt_article
ORDER BY total_comments DESC
LIMIT 3;

SQL;

// Executa a query e armazena os resultados em '$res'
$res = $conn->query($sql);

// Variável acumuladora. Armazena cada um dos artigos.
$aside_commented = '<h3>Artigos + comentados</h3><div class="commented">';

// Loop para obter cada registro
while ($mv = $res->fetch_assoc()) :

    // Cria uma variável '$art_summary' para o resumo
    $art_summary = $mv['art_summary'];

    // Se o resumo tem mais de X caracteres
    // Referências: https://www.w3schools.com/php/func_string_strlen.asp
    if (strlen($mv['art_summary']) > $site['summary_length'])

        // Corta o resumo para a quantidade de caracteres correta
        // Referências: https://www.php.net/mb_substr
        $art_summary = mb_substr(
            $mv['art_summary'],         // String completa, a ser cortada
            0,                          // Posição do primeiro caracter do corte
            $site['summary_length']     // Tamanho do corte
        ) . "...";                      // Concatena reticências no final

    // Monta a view HTML
    $aside_commented .= <<<HTML

<div onclick="location.href = '_comments.php?id={$mv['art_id']}'">
    <img src="{$mv['art_thumbnail']}" alt="{$mv['art_title']}">
    <div>
    <h5>{$mv['art_title']}</h5>
    <p><small title="{$mv['art_summary']}">{$art_summary}</small></p>
    </div>
</div>

HTML;
endwhile;

$aside_commented .= '</div>';

// Envia para a view
echo $aside_commented;