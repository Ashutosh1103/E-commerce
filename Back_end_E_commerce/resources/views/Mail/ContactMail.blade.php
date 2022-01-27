<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .styled-table {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.9em;
          font-family: sans-serif;
          min-width: 400px;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }
    </style>
</head>
<body>
   <img src="data:image/png;base64,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"
    height="100px" width="100px" alt="image_logo">

   
   <h3>Contact Registered Successfully.</h3>
   <p style="background-color:lightgreen;">
   Hello {{$name}}, Thank you for writing to us. We got your request and within 2 business days, we will get in touch. Meanwhile, take a look at our other products. We’ve selected, especially for you.
   <p>Contact Details</p>
    <table class="styled-table">
    <tr>
      <th>Name</th>
      <td>{{$name}}</td>
    </tr>
    <tr>
    <th>Email</th>
    <td>{{$email}}</td>
    </tr>
   <tr>
   <th>Phone No.</th>
   <td>{{$phone}}</td>
   </tr>
   
  </tbody>
</table>





</body>
</html>