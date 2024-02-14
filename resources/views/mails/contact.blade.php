<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        {{ __("Hi Sir/Mam") }}, <br /><br />
        <strong>
            {{ $data['subject'] }} 
        </strong>
        <br><br>
        <b>Name:</b> {{ $data['name'] ?? '' }}<br>
        <b>Mobile Number:</b> {{ $data['mobile_number'] ?? '' }}<br>
        <b>Descriptions:</b> {{ $data['description'] ?? '' }}
    </body>
</html>