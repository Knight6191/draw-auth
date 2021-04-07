<html>
<head>
    <title>Activation Email - Draw Auth</title>
</head>
<body>
    <h1>Welcome to Draw Auth</h1>
    <p>
        Welcome {{$user->name}} has registered as a member at Draw Auth. Please click on the following link to complete the registration.
    </p>
    <a href="{{ $user->activation_link }}" style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;display:block;display:inline-block;width:200px;min-height:20px;padding:10px;background-color:#3869d4;border-radius:3px;color:#ffffff;font-size:15px;line-height:25px;text-align:center;text-decoration:none;background-color:#3869d4" class="m_5607350064113787047button" target="_blank">
        Activate You Account
    </a>
</body>
</html>