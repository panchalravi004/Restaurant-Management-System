Set shell = WScript.CreateObject ("WScript.Shell")
shell.run "cmd /k php artisan serve" ,1 , true
Set shell = Nothing