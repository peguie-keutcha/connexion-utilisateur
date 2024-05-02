## Jobs
You need todo these :
 - Create Interfaces
   - IUtilisateur
     - GetIdentity() : string
     - GetEMail() : string
     - GetAdresses() : array
     - __toString()
    - IAdresse
      - __toString()

 - Create classes
   - Utilisateur : IUtilisateur
   - Adresse : IAdresse

 - Create main page
   - Must contains
     - textbox for username and password
     - button for send form

 - Create script file
   - Procedural and consumptions
     - Consume form datas
     - Need use DbLoader to load users datas
     - Allow acces or loop to login page (main page)
     - If allow, show user informations and store in session the user object

> Password are dynamicly created and store on demand in text file on root folder
> JSon file is edited during password binding to contains hashed password
