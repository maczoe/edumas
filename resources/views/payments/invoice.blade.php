<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Impresi&oacute;n de recibo</title>
    <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset("/css/all.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <style>
    .invoice-box{
        max-width:750px;
        margin:auto;
        padding:10px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:2px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(3){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding:0px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:30px;
        line-height:30px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:5px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(3){
        border-top:2px solid #eee;
        font-weight:bold;
        width: 200px;
    }
    
    @media only screen and (max-width: 500px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
    <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
    <script src="{{ asset("/js/printThis.js") }}" type="text/javascript"></script>
</head>

<body>
    <div class="invoice-box">
        <table id="invoice" cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h3 style="max-width:500px;">Academia de Computaci&oacute;n SARC</h3>
<!--                            <img src="http://nextstepwebs.com/images/logo.png" style="width:100%; max-width:300px;">-->
                            </td>
                            <td>
                                <strong>RECIBO</strong><br>
                                Serie: {{ $payment->document_series }}<br>
                                Recibo #: {{ $payment->document_number }}<br>
                                Fecha: {{ \Carbon\Carbon::parse($payment->date_time)->format('d/m/Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Cliente: {{ $payment->customer }}<br>
                                Direcci&oacute;n: {{ $payment->student->address }}
                                Carnet: {{ $payment->student->id_number }}
                            </td>
                            
                            <td>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Cantidad
                </td>
                <td>
                    Descripci&oacute;n
                </td>
                
                <td>
                    Precio
                </td>
            </tr>
            @foreach($payment->paymentDetails as $detail)
            <tr @if ($detail == end($payment->paymentDetails)) class="item last" @endif>
                <td>
                    {{ $detail->quantity }}
                </td>
                <td>
                    {{ $detail->detail }}
                </td>
                
                <td>
                    {{ $detail->amountCurrency }}
                </td>
            </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Total: {{ $payment->paymentCurrency }}
                </td>
            </tr>
        </table>
    </div>
    <div class="row text-center">
            <a class="btn btn-primary fa fa-home" href="{{ url('/') }}">&nbsp;Regresar</a>
            <a class="btn btn-primary fa fa-print"">&nbsp;Imprimir</a>
        </div>
<script>
$(document).on("click", ".fa-print", function() {
    $('.invoice-box').printThis({
        printContainer: true,
        importCSS: true,            
        importStyle: true,
    });
});
</script>
</body>
</html>