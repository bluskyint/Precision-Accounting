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
# {{ $consultingData['subject'] }}

<strong>First Name :</strong>  {{ $consultingData['first_name'] }} <br>
<strong>Last Name :</strong>  {{ $consultingData['last_name'] }} <br>
<strong>Email Address :</strong>  {{ $consultingData['email'] }} <br>
<strong>Phone Number:</strong>  {{ $consultingData['phone'] }} <br>
<strong>Address:</strong>  {{ $consultingData['address'] }} <br>
<strong>Business Service:</strong>  {{ $consultingData['business_service'] }} <br>
<strong>Business Type:</strong>  {{ $consultingData['business_type'] }} <br>
<strong>State:</strong>  {{ $consultingData['state'] }} <br>
<strong>Meeting Type:</strong>  {{ $consultingData['meeting'] }} <br>
<strong>Messege:</strong>  {{ $consultingData['messege'] }} <br>


Thanks,<br>

@endcomponent
