<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>d9fca54a-9688-4786-9024-5e00131dad85</title>
<meta name="author" content="Luis Antonio Hernández Tzoc"/>
<style type="text/css"> * {margin:0; padding:0; text-indent:0; }
 .s1 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; }
 .s2 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 8pt; }
 .s3 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt; }
 .s4 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 10pt; }
 p { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt; margin:0pt; }
 .s5 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt; }
 table, tbody {vertical-align: top; overflow: visible; }
</style>
</head>
<body>
<table style="border-collapse:collapse;margin-left:298.91pt" cellspacing="0">
<tr style="height:20pt">
<td style="width:87pt">
<p style="text-indent: 0pt;text-align: left;">
<br/>
</p>
</td>
<td style="width:198pt">
<p class="s1" style="padding-left: 73pt;text-indent: 0pt;line-height: 12pt;text-align: left;">REPORTE DE SALDOS</p>
</td>
<td style="width:121pt">
<p style="text-indent: 0pt;text-align: left;">
<br/>
</p>
</td>
</tr>
<tr style="height:17pt">
<td style="width:87pt">
<p class="s2" style="padding-top: 7pt;padding-left: 2pt;text-indent: 0pt;line-height: 8pt;text-align: left;">Usuario:</p>
</td>
<td style="width:198pt">
<p class="s2" style="padding-top: 7pt;padding-left: 56pt;text-indent: 0pt;line-height: 8pt;text-align: left;">Fecha de Impresión:</p>
</td>
<td style="width:121pt">
<p class="s2" style="padding-top: 7pt;padding-left: 75pt;text-indent: 0pt;line-height: 8pt;text-align: left;">Página 1 de 1</p>
</td>
</tr>
</table>
<p style="text-indent: 0pt;text-align: left;">
<br/>
</p>
<table style="border-collapse:collapse;margin-left:5.33pt" cellspacing="0">
<tr style="height:13pt">
<td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#FAE3D4">
<p class="s1" style="padding-left: 44pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Codigo Cliente</p>
</td>
<td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#FAE3D4">
<p class="s1" style="padding-left: 36pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Nombre de cliente</p>
</td>
<td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#FAE3D4">
<p class="s1" style="padding-left: 1pt;text-indent: 0pt;line-height: 12pt;text-align: center;">Total Abono</p>
</td>
<td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#FAE3D4">
<p class="s1" style="padding-left: 8pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Total Credito</p>
</td>
<td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#FAE3D4">
    <p class="s1" style="padding-left: 8pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Dias Credito</p>
    </td>
<td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#FAE3D4">
<p class="s1" style="padding-left: 26pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Saldo</p>
</td>
</tr>

@foreach ($estado_cuenta as $item)
<tr style="height:13pt">
    <td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
    <p style="text-indent: 0pt;text-align: left;">{{$item['cliente']['codigo_interno']}}</p>
    </td>
    <td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
        <p style="text-indent: 0pt;text-align: left;">{{$item['cliente']['nombre_empresa']}}</p>
    </td>
    <td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
        <p style="text-indent: 0pt;text-align: left;">Q. {{$item['total_abono']}}</p>
    </td>
    <td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
        <p style="text-indent: 0pt;text-align: left;">Q. {{$item['total_credito']}}</p>
    </td>
    <td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
        <p style="text-indent: 0pt;text-align: left;">{{$item['cliente']['dias_limite_credito']}} Dias</p>
    </td>
    <td style="width:140pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
        <p style="text-indent: 0pt;text-align: left;">Q. {{$item['total_credito']-$item['total_abono']}}</p>
    </td>

</tr>

@endforeach
</table>


</body>
</html>
