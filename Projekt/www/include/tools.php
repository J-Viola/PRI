<?php

// seznam jmen XML souborů
function xmlFileList($dir)
{
    $list = [];

    foreach (glob("$dir/*.xml") as $filename)
        $list[] = basename($filename, '.xml');

    return $list;
}

// výpis chyb
function xmlPrintErrors()
{ ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Line</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (libxml_get_errors() as $error) { ?>
                <tr>
                    <td><?= $error->line ?></td>
                    <td><?= $error->message ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    libxml_clear_errors();
}

// transformace XML pomocí XSL
function xmlTransform($xmlPath, $xslPath): false|string
{
    $xml = new DOMDocument;
    $xsl = new DOMDocument;
    $xslt = new XSLTProcessor();

    if (@!$xml->load($xmlPath) || !$xsl->load($xslPath) || !$xslt->importStylesheet($xsl))
        return false;

    return $xslt->transformToXml($xml);
}
?>