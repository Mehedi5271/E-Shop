<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <table>
        <thead>
           <tr>
               <th>Serial</th>
               <th>Title</th>
               <th>Price</th>
           </tr>
        </thead>
        <tbody>
           @foreach ($products as $product)
           <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$product->title}}</td>
               <td>{{$product->price}}</td>
           </tr>
           @endforeach
        </tbody>
    </table>
</body>
</html>
