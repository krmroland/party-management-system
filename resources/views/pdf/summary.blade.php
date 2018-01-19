<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dickson Weds Florence</title>
    @include('pdf.styles')
</head>
<body>
    <h1 class="text-center">Dickson Weds FLorence (Reviewed Budget)</h1>
    <h3>This is the best we could do</h3>
    @include('pdf.budget')
    <div class="page-break"></div>
    @include('pdf.pledges')
    <div class="page-break"></div>
    @include('pdf.providers')
    <div class="page-break"></div>
    @include('pdf.expenditures')
    <div class="page-break"></div>
    @include('pdf.cards')
</body>
</html>