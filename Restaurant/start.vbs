Set shell = WScript.CreateObject ("WScript.Shell")
shell.run "firefox -url http://127.0.0.1:8000"
shell.run "cmd /k php artisan serve" ,1 , true
Set shell = Nothing