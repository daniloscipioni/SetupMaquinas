<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');
require '../class/access.php';
require('../rpdf/rpdf.php');


$setup_data = new Access_setups();

$setup_data->SearchById($_GET['id']);


if ($setup_data->height_value[1]!=''){$height_value = $setup_data->height_value[1];}else{$height_value = '-';}
if ($setup_data->customer_name[1]!=''){$customer = $setup_data->customer_name[1];}else{$customer = '-';}
if ($setup_data->pu_name[1]!=''){$pu = $setup_data->pu_name[1];}else{$pu = '-';}
if ($setup_data->diameter_value[1]!=''){$diameter_value = $setup_data->diameter_value[1];}else{$diameter_value = '-';}
if ($setup_data->prod_sap[1]!=''){$prod = $setup_data->prod_sap[1];}else{$prod = '-';}

if ($setup_data->version_no[1]!=''){$version = $setup_data->version_no[1];}else{$version = '-';}


if(!isset($_SESSION['order'])){
    $order = '-';
}else{$order = $_SESSION['order'];}



if (trim($setup_data->p001[1])!=''){$p001 = $setup_data->p001[1];}else{$p001 = '-';}
if (trim($setup_data->p002[1])!=''){$p002 = $setup_data->p002[1];}else{$p002 = '-';}
if (trim($setup_data->p003[1])!=''){$p003 = $setup_data->p003[1];}else{$p003 = '-';}
if (trim($setup_data->p004[1])!=''){$p004 = $setup_data->p004[1];}else{$p004 = '-';}
if (trim($setup_data->p005[1])!=''){$p005 = $setup_data->p005[1];}else{$p005 = '-';}
if (trim($setup_data->p006[1])!=''){$p006 = $setup_data->p006[1];}else{$p006 = '-';}
if (trim($setup_data->p007[1])!=''){$p007 = $setup_data->p007[1];}else{$p007 = '-';}
if (trim($setup_data->p008[1])!=''){$p008 = $setup_data->p008[1];}else{$p008 = '-';}
if (trim($setup_data->p009[1])!=''){$p009 = $setup_data->p009[1];}else{$p009 = '-';}
if (trim($setup_data->p010[1])!=''){$p010 = $setup_data->p010[1];}else{$p010 = '-';}
if (trim($setup_data->p011[1])!=''){$p011 = $setup_data->p011[1];}else{$p011 = '-';}
if (trim($setup_data->p012[1])!=''){$p012 = $setup_data->p012[1];}else{$p012 = '-';}
if (trim($setup_data->p013[1])!=''){$p013 = $setup_data->p013[1];}else{$p013 = '-';}
if (trim($setup_data->p014[1])!=''){$p014 = $setup_data->p014[1];}else{$p014 = '-';}
if (trim($setup_data->p015[1])!=''){$p015 = $setup_data->p015[1];}else{$p015 = '-';}
if (trim($setup_data->p016[1])!=''){$p016 = $setup_data->p016[1];}else{$p016 = '-';}
if (trim($setup_data->p017[1])!=''){$p017 = $setup_data->p017[1];}else{$p017 = '-';}
if (trim($setup_data->p018[1])!=''){$p018 = $setup_data->p018[1];}else{$p018 = '-';}
if (trim($setup_data->p019[1])!=''){$p019 = $setup_data->p019[1];}else{$p019 = '-';}
if (trim($setup_data->p020[1])!=''){$p020 = $setup_data->p020[1];}else{$p020 = '-';}
if (trim($setup_data->p021[1])!=''){$p021 = $setup_data->p021[1];}else{$p021 = '-';}
if (trim($setup_data->p022[1])!=''){$p022 = $setup_data->p022[1];}else{$p022 = '-';}
if (trim($setup_data->p023[1])!=''){$p023 = $setup_data->p023[1];}else{$p023 = '-';}
if (trim($setup_data->p024[1])!=''){$p024 = $setup_data->p024[1];}else{$p024 = '-';}
if (trim($setup_data->p025[1])!=''){$p025 = $setup_data->p025[1];}else{$p025 = '-';}
if (trim($setup_data->p026[1])!=''){$p026 = $setup_data->p026[1];}else{$p026 = '-';}
if (trim($setup_data->p027[1])!=''){$p027 = $setup_data->p027[1];}else{$p027 = '-';}
if (trim($setup_data->p028[1])!=''){$p028 = $setup_data->p028[1];}else{$p028 = '-';}
if (trim($setup_data->p029[1])!=''){$p029 = $setup_data->p029[1];}else{$p029 = '-';}
if (trim($setup_data->p030[1])!=''){$p030 = $setup_data->p030[1];}else{$p030 = '-';}
if (trim($setup_data->p031[1])!=''){$p031 = $setup_data->p031[1];}else{$p031 = '-';}
if (trim($setup_data->p032[1])!=''){$p032 = $setup_data->p032[1];}else{$p032 = '-';}
if (trim($setup_data->p033[1])!=''){$p033 = $setup_data->p033[1];}else{$p033 = '-';}
if (trim($setup_data->p034[1])!=''){$p034 = $setup_data->p034[1];}else{$p034 = '-';}
if (trim($setup_data->p035[1])!=''){$p035 = $setup_data->p035[1];}else{$p035 = '-';}
if (trim($setup_data->p036[1])!=''){$p036 = $setup_data->p036[1];}else{$p036 = '-';}
if (trim($setup_data->p037[1])!=''){$p037 = $setup_data->p037[1];}else{$p037 = '-';}
if (trim($setup_data->p038[1])!=''){$p038 = $setup_data->p038[1];}else{$p038 = '-';}
if (trim($setup_data->p039[1])!=''){$p039 = $setup_data->p039[1];}else{$p039 = '-';}
if (trim($setup_data->p040[1])!=''){$p040 = $setup_data->p040[1];}else{$p040 = '-';}
if (trim($setup_data->p041[1])!=''){$p041 = $setup_data->p041[1];}else{$p041 = '-';}
if (trim($setup_data->p042[1])!=''){$p042 = $setup_data->p042[1];}else{$p042 = '-';}
if (trim($setup_data->p043[1])!=''){$p043 = $setup_data->p043[1];}else{$p043 = '-';}
if (trim($setup_data->p044[1])!=''){$p044 = $setup_data->p044[1];}else{$p044 = '-';}
if (trim($setup_data->p045[1])!=''){$p045 = $setup_data->p045[1];}else{$p045 = '-';}
if (trim($setup_data->p046[1])!=''){$p046 = $setup_data->p046[1];}else{$p046 = '-';}
if (trim($setup_data->p047[1])!=''){$p047 = $setup_data->p047[1];}else{$p047 = '-';}
if (trim($setup_data->p048[1])!=''){$p048 = $setup_data->p048[1];}else{$p048 = '-';}
if (trim($setup_data->p049[1])!=''){$p049 = $setup_data->p049[1];}else{$p049 = '-';}
if (trim($setup_data->p050[1])!=''){$p050 = $setup_data->p050[1];}else{$p050 = '-';}
if (trim($setup_data->p051[1])!=''){$p051 = $setup_data->p051[1];}else{$p051 = '-';}
if (trim($setup_data->p052[1])!=''){$p052 = $setup_data->p052[1];}else{$p052 = '-';}
if (trim($setup_data->p053[1])!=''){$p053 = $setup_data->p053[1];}else{$p053 = '-';}
if (trim($setup_data->p054[1])!=''){$p054 = $setup_data->p054[1];}else{$p054 = '-';}
if (trim($setup_data->p055[1])!=''){$p055 = $setup_data->p055[1];}else{$p055 = '-';}
if (trim($setup_data->p056[1])!=''){$p056 = $setup_data->p056[1];}else{$p056 = '-';}
if (trim($setup_data->p057[1])!=''){$p057 = $setup_data->p057[1];}else{$p057 = '-';}
if (trim($setup_data->p058[1])!=''){$p058 = $setup_data->p058[1];}else{$p058 = '-';}
if (trim($setup_data->p059[1])!=''){$p059 = $setup_data->p059[1];}else{$p059 = '-';}





class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $pdf->Image('../images/logo.png',10,6,30);
    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
  
    
}

}


//$pdf = new RPDF();
$pdf = new RPDF('P','mm',array(210,297)); // P = Portrait, em milimetros, e A4 (210x297)
$pdf->AddPage();
$pdf->SetTitle('SetupCard - Print');
$pdf->SetFont('Arial','',7.7);
$pdf->SetAutoPageBreak(TRUE, 1);
$pdf->SetMargins( 7,2,7,2 );
//parametros (margem esquerda,y,margem direita,z)
$height = 4.15;
  
  

  
  
  $pdf->Image('../images/logo.png',170,7,30);
  $pdf->ln(1);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(0,$height,'Setup Card',0,1,'L',0); 
  $pdf->SetFont('Arial','',7.7);
  $pdf->SetfillColor(220,220,220);
  
  $pdf->Cell(18,$height,'Altura:',0,0,'L',1);
  $pdf->Cell(30,$height,$height_value,0,0,'L',1);
  $pdf->Cell(20,$height,'Cliente:',0,0,'L',1); 
  $pdf->Cell(40,$height,$customer,0,0,'L',1);
  $pdf->Cell(15,$height,utf8_decode('Máquina:'),0,0,'L',1); 
  $pdf->Cell(25,$height,$pu,0,0,'L',1); 
  $pdf->Cell(12,$height,utf8_decode('Data:'),0,0,'L',1); 
  $pdf->Cell(0,$height, date('d/m/Y').' - '. date('H:i'),0,1,'L',1); 
  
  $pdf->Cell(18,$height,utf8_decode('Diâmetro:'),0,0,'L',1); 
  $pdf->Cell(30,$height,$diameter_value,0,0,'L',1);
  $pdf->Cell(20,$height,'Produto SAP:',0,0,'L',1); 
  $pdf->Cell(40,$height,$prod,0,0,'L',1); 
  $pdf->Cell(15,$height,'OP:',0,0,'L',1); 
  $pdf->Cell(25,$height,$order,0,0,'L',1);
  $pdf->Cell(12,$height,utf8_decode('Versão:'),0,0,'L',1); 
  $pdf->Cell(0,$height,$version,0,1,'L',1); 
  

  
  
  $pdf->Cell(123,6, utf8_decode('Parâmetros'),1,0,'C',0); 
  $pdf->Cell(0,6,'Valores',1,1,'C',0); 
  
  //GERAL
  $pdf->Cell(55,3*$height,utf8_decode('Geral'),1,0,'C',0); 
  
  $pdf->Cell(15,$height,'P001',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Rotação da máquina'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p001),1,1,'C',0);
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P002',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Rotação dos mandris'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p002),1,1,'C',0);
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P003',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Altura da última ponta'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p003),1,1,'C',0); 
  ////
  
//LINHAS RP
    $pdf->Cell(15,12*$height,$pdf->TextWithDirection(15,77,'Linhas RP','U') ,1,0,'C',0); 
    
  $pdf->Cell(40,3*$height,utf8_decode('Ferramenta final de acabamento'),1,0,'C',0); 
  $pdf->Cell(15,$height,'P004',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP5-03'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p004),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P005',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP5-02'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p005),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P006',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP5-01'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p006),1,1,'C',0); 
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  
  $pdf->Cell(40,3*$height,utf8_decode('Ferramenta pré de acabamento'),1,0,'C',0); 
  $pdf->Cell(15,$height,'P007',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP4-03'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p007),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P008',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP4-02'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p008),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P009',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP4-01'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p009),1,1,'C',0);
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  
  $x = $pdf->GetX();
  $y = $pdf->GetY();
  
  $pdf->MultiCell(40,1.5*$height,utf8_decode('Ferramenta pré acabamento (RP16 4 estações)'),1,'C',0); 
  $pdf->SetXY($x, $y);
  $pdf->Cell(40,60,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P010',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP3-03'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p010),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P011',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP3-02'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p011),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P012',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP3-01'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p012),1,1,'C',0); 
  
      $pdf->Cell(15,60,'',0,0,'C',0); 
  
  $pdf->Cell(40,3*$height,utf8_decode('Ferramenta Ombro'),1,0,'C',0); 
  $pdf->Cell(15,$height,'P013',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP2-03'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p013),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P014',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP2-02'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p014),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P015',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP2-01'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p015),1,1,'C',0); 
 ////
  
 //maçaricos
   $pdf->Cell(15,20*$height, $pdf->TextWithDirection(15,140, utf8_decode('maçaricos'),'U'),1,0,'C',0); 
  
  $pdf->Cell(40,3*$height,utf8_decode('pré corte'),1,0,'C',0); 
  $pdf->Cell(15,$height,'P016',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Nº Furo maçarico pré corte 1'),1,0,'C',0); 
  $pdf->Cell(0,$height, utf8_decode(trim($p016)),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P017',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Nº Furo maçarico pré corte 2'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p017)),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P018',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Distância entre maçaricos e tubo'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p018),1,1,'C',0);
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  
  $pdf->Cell(40,3*$height,'Corte',1,0,'C',0); 
  $pdf->Cell(15,$height,'P019',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico de corte (interno e externo)'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p019)),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P020',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Distância entre maçaricos e tubo 2'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p020),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P021',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico canhão do corte'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p021)),1,1,'C',0);
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  
  $pdf->Cell(40,5*$height,utf8_decode('Ombro'),1,0,'C',0); 
  
  $pdf->Cell(15,$height,'P022',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico ombro 1'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p022)),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P023',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico do furo'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p023)),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P024',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico ombro 2'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p024)),1,1,'C',0);
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P025',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico ombro 3'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p025)),1,1,'C',0); 
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P026',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico ombro 4'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p026)),1,1,'C',0);
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  $pdf->Cell(40,2*$height,utf8_decode('pré Acabamento'),1,0,'C',0); 
  
  $pdf->Cell(15,$height,'P027',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico pré 1'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p027)),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P028',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico pré 2'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p028)),1,1,'C',0); 
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  $pdf->Cell(40,2*$height,utf8_decode('Acabamento'),1,0,'C',0); 
  
  $pdf->Cell(15,$height,'P029',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico acabamento'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p029)),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P030',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Distância maçarico acabamento'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p030),1,1,'C',0); 
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  $pdf->Cell(40,3*$height,utf8_decode('Fundo'),1,0,'C',0); 
  
  $pdf->Cell(15,$height,'P031',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico fundo 1'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p031)),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P032',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico fundo 2'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p032)),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P033',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('maçarico fundo 3'),1,0,'C',0); 
  $pdf->Cell(0,$height,utf8_decode(trim($p033)),1,1,'C',0);
  
  $pdf->Cell(15,60,'',0,0,'C',0); 
  $pdf->Cell(40,2*$height,utf8_decode('Pedra do Fundo'),1,0,'C',0); 
  
  $pdf->Cell(15,$height,'P034',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Pedra do fundo'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p034),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P035',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('Grau da pedra do fundo'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p035),1,1,'C',0); 
  ///////
  
  ////Velocidade das ferramentas
  
  $pdf->Cell(15,8*$height,$pdf->TextWithDirection(15,205, utf8_decode('Velocidade das Ferram.'),'U'),1,0,'C',0); 
  
  $pdf->Cell(40,2*$height,utf8_decode('Ombro'),1,0,'C',0); 
  $pdf->Cell(15,$height,'P036',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP2 - Ferramenta'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p036),1,1,'C',0); 
  
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P037',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP2 - Pino'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p037),1,1,'C',0); 
  
  $x = $pdf->GetX();
  $y = $pdf->GetY();
 
  $pdf->Cell(15,10,'',0,0,'C',0); 
  $pdf->MultiCell(40,$height,utf8_decode('pré-acabamento (RP16 4 estágios)'),1,'C',0); 
  $pdf->SetXY($x, $y);
 
  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P038',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP3 - Ferramenta'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p038),1,1,'C',0); 

  $pdf->Cell(55,3*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P039',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP3 - Pino'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p039),1,1,'C',0); 
 
  $pdf->Cell(15,2*$height,'',0,0,'C',0); 
  $pdf->Cell(40,2*$height,utf8_decode('pré-acabamento'),1,0,'C',0); 
  $pdf->Cell(15,$height,'P040',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP4 - Ferramenta'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p040),1,1,'C',0); 
  
  $pdf->Cell(15,2*$height,'',0,0,'C',0); 
  $pdf->Cell(40,2*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P041',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP4 - Pino'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p041),1,1,'C',0); 
  
  $pdf->Cell(15,2*$height,'',0,0,'C',0); 
  $pdf->Cell(40,2*$height,utf8_decode('Acabamento'),1,0,'C',0); 
  $pdf->Cell(15,$height,'P042',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP5 - Ferramenta'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p042),1,1,'C',0); 
  
  $pdf->Cell(15,2*$height,'',0,0,'C',0); 
  $pdf->Cell(40,2*$height,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P043',1,0,'C',0); 
  $pdf->Cell(53,$height,utf8_decode('RP5 - Pino'),1,0,'C',0); 
  $pdf->Cell(0,$height,trim($p043),1,1,'C',0); 
  //////////////////////////////
  
  //PARAMETROS ON/OFF
  $pdf->Cell(15,16*$height,$pdf->TextWithDirection(15,253, utf8_decode('Parâmetros ON/OFF'),'U'),1,0,'C',0); 
  
  $pdf->Cell(40,4*$height,utf8_decode('Ombro'),1,0,'C',0); 
  
  $pdf->Cell(15,$height,'P044',1,0,'C',0);  
  $pdf->Cell(53,2*$height,utf8_decode('RP2 - Pino'),1,0,'C',0); 
  
  $pdf->Cell(36,$height,"ON",1,0,'C',1); 
  $pdf->Cell(0,$height,"OFF",1,1,'C',1); 
  $pdf->Cell(55,$height,'',0,0,'C',0); 
 
  $pdf->Cell(15,$height,'P045',1,0,'C',0); 
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p044),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p045),1,1,'C',0);

  $pdf->Cell(15,40,'',0,0,'C',0); 
  
  $pdf->Cell(40,10,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P046',1,0,'C',0); 
  $pdf->Cell(53,2*$height,utf8_decode('RP2 - Ferramenta'),1,0,'C',0); 
  $pdf->Cell(36,$height,"ON",1,0,'C',1);
  $pdf->Cell(0,$height,"OFF",1,1,'C',1); 
  $pdf->Cell(55,$height,'',0,0,'C',0); 
  
  $pdf->Cell(15,$height,'P047',1,0,'C',0); 
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p046),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p047),1,1,'C',0); 
  
  $x = $pdf->GetX();
  $y = $pdf->GetY();
 
  $pdf->Cell(15,20,'',0,0,'C',0); 
  $pdf->MultiCell(40,2*$height,utf8_decode('pré-acabamento (RP16 4 estágios)'),1,'C',0); 
  $pdf->SetXY($x, $y);
  
  ///////////////////////////////////////////////
  
  $pdf->Cell(15,40,'',0,0,'C',0); 
  
  $pdf->Cell(40,10,'',0,0,'C',0); 
  $pdf->Cell(15,$height,'P048',1,0,'C',0);
  $pdf->Cell(53,2*$height,utf8_decode('RP3 - Pino'),1,0,'C',0);
  $pdf->Cell(36,$height,"ON",1,0,'C',1);
  $pdf->Cell(0,$height,"OFF",1,1,'C',1);
  $pdf->Cell(55,$height,'',0,0,'C',0);
  
  $pdf->Cell(15,$height,'P049',1,0,'C',0);
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p048),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p049),1,1,'C',0);
  
  ///////////////////////////////////////////////
  
  $pdf->Cell(15,40,'',0,0,'C',0);
  
  $pdf->Cell(40,10,'',0,0,'C',0);
  $pdf->Cell(15,$height,'P050',1,0,'C',0);
  $pdf->Cell(53,2*$height,utf8_decode('RP3 - Ferramenta'),1,0,'C',0);
  $pdf->Cell(36,$height,"ON",1,0,'C',1);
  $pdf->Cell(0,$height,"OFF",1,1,'C',1);
  $pdf->Cell(55,$height,'',0,0,'C',0);
  
  $pdf->Cell(15,$height,'P051',1,0,'C',0);
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p050),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p051),1,1,'C',0);
  
  ///////////////////////////////////////////////
  
  $pdf->Cell(15,40,'',0,0,'C',0);
  
  $pdf->Cell(40,4*$height,utf8_decode('pré-acabamento'),1,0,'C',0);
  $pdf->Cell(15,$height,'P052',1,0,'C',0);
  $pdf->Cell(53,2*$height,utf8_decode('RP4 - Pino'),1,0,'C',0);
  $pdf->Cell(36,$height,"ON",1,0,'C',1);
  $pdf->Cell(0,$height,"OFF",1,1,'C',1);
  $pdf->Cell(55,$height,'',0,0,'C',0);
  
  $pdf->Cell(15,$height,'P053',1,0,'C',0);
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p052),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p053),1,1,'C',0);
  
  ///////////////////////////////////////////////
  
  $pdf->Cell(15,40,'',0,0,'C',0);
  
  $pdf->Cell(40,10,'',0,0,'C',0);
  $pdf->Cell(15,$height,'P054',1,0,'C',0);
  $pdf->Cell(53,2*$height,utf8_decode('RP4 - Ferramenta'),1,0,'C',0);
  $pdf->Cell(36,$height,"ON",1,0,'C',1);
  $pdf->Cell(0,$height,"OFF",1,1,'C',1);
  $pdf->Cell(55,$height,'',0,0,'C',0);
  
  $pdf->Cell(15,$height,'P055',1,0,'C',0);
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p054),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p055),1,1,'C',0);
  
  ///////////////////////////////////////////////
  
  $pdf->Cell(15,4*$height,'',0,0,'C',0);
  
  $pdf->Cell(40,4*$height,'Acabamento',1,0,'C',0);
  $pdf->Cell(15,$height,'P056',1,0,'C',0);
  $pdf->Cell(53,2*$height,utf8_decode('RP5 - Pino'),1,0,'C',0);
  $pdf->Cell(36,$height,"ON",1,0,'C',1);
  $pdf->Cell(0,$height,"OFF",1,1,'C',1);
  $pdf->Cell(55,$height,'',0,0,'C',0);
  
  $pdf->Cell(15,$height,'P057',1,0,'C',0);
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p056),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p057),1,1,'C',0);
  
///////////////////////////////////////////////
  $pdf->Cell(15,4*$height,'',0,0,'C',0);
  
  $pdf->Cell(40,2*$height,'',0,0,'C',0);
  $pdf->Cell(15,$height,'P058',1,0,'C',0);
  $pdf->Cell(53,2*$height,utf8_decode('RP5 - Ferramenta'),1,0,'C',0);
  $pdf->Cell(36,$height,"ON",1,0,'C',1);
  $pdf->Cell(0,$height,"OFF",1,1,'C',1);
  $pdf->Cell(55,$height,'',0,0,'C',0);
  
  $pdf->Cell(15,$height,'P059',1,0,'C',0);
  $pdf->Cell(53,$height,'',0,0,'C',0);
  $pdf->Cell(36,$height,trim($p058),1,0,'C',0);
  $pdf->Cell(0,$height,trim($p059),1,1,'C',0);
  
  
///
$pdf->Output();


?>
 