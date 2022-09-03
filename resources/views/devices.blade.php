<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <ul>
    @foreach ($devices as $device)
       <li>{{$device->id}} - {{$device->description}} - {{$device->department->name}} - @foreach ($device->utilizers as $utilizer) <span>{{$utilizer->name}}</span> @endforeach</li> 
    @endforeach
    </ul>
    
</body>
</html>