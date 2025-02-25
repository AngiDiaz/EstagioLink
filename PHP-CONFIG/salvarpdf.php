<?php
if (isset($_POST['pdf'])) {
    $pdfBase64 = $_POST['pdf'];
    $pdfDecodificado = base64_decode($pdfBase64);
    if ($pdfDecodificado === false) {
        echo "Erro ao decodificar o PDF.";
        exit;
    }
    include '../raiz.php';
    $diretorio = getRaiz() . '\PDF\\';

    $nomeArquivo = 'CurriculoEstagiario_' . uniqid() . '.pdf';
    $caminhoArquivo = $diretorio . $nomeArquivo;
    
    // Salva o arquivo PDF
    if (file_put_contents($caminhoArquivo, $pdfDecodificado)) {
        echo "PDF salvo com sucesso!";
        include 'banco.php';
        $id = $_COOKIE['id_usuario'];
        addCurriculo($nomeArquivo, $id);

    } else {
        echo "Erro ao salvar o PDF.";
    }
} else {
    echo "Nenhum PDF recebido.";
}


?>
