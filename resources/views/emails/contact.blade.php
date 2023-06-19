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
# {{ $contactData['subject'] }}

<strong>Name :</strong>  {{ $contactData['name'] }} <br>
<strong>Email :</strong>  {{ $contactData['email'] }} <br>
<strong>Phone :</strong>  {{ $contactData['phone'] }} <br>
<strong>Messege :</strong>  {{ $contactData['messege'] }} <br>


Thanks,<br>

@endcomponent
