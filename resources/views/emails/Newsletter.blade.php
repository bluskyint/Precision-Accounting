<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
    body,*{
        font-family: 'Open Sans', sans-serif !important;
    }
    h2 , strong{
        color: rgb(26, 26, 26)
    }
</style>
@component('mail::message')
# {{ $newsletterData['subject'] }}

{!! $newsletterData['content'] !!}

Thanks,<br>

@endcomponent
