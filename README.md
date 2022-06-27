#   <p align="center" style="color:#b5a600"> authentication api token for mongodb </p>


## install 
 >  composer require esperlos98/esauthenticationmongo

## add middlware EsAuthenticationCheckEncrypt to App\Http\Kernel.php
       'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'EsAuthenticationCheckEncrypt', //this
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
   
## add api drive  config/auth.php array guards and use middleware auth:apiMongo
    guards[

        'apiMongo' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ]

## using middleware for exsample
> 
<img src="./images/useApiMongo.png"
     alt="Markdown Monster icon"
     style="margin-right: 10px; width:100%;" />   

## Config model User  /app/Models/User.php
fillable add api_token

## for exsample
> 
<img src="./images/User.png"
     alt="Markdown Monster icon"
     style="margin-right: 10px; width:100%;" />   

## publish config 
 >
 > php artisan vendor:publish --tag=config

 ##  Config esauthenticationMongo   /config/esauthentication

 ># <p style="color:red">Note</p> 
 > in config User adding any field 
 > if you  wanting can change login of email to username or anything
 > <p> and remove from Login email </p>
     
     "rules" => [
        "Register" => [
            'username' => 'required',
            'email' => 'required|email|unique:mongodb.users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|unique:mongodb.users',
            'status' => 'boolean',
            'api_token' => 'unique:mongodb.users'
        ],

        "Login" => [
            'username' => 'required',
            'password' => 'required',
        ],

        "Verfiy"=>[
            'id' => 'required',
            'code' => 'required|numeric',
        ],
    ],

    "massages" => [
        "required" => 601,
        "confirmed" => 602,
        "min" => 603,
        "email" => 604,
        "unique" => 605,
        "numeric" => 606,
    ],

    "userFileds" => [
        "username" => "username",
        "phone" => "phone",
        "email" => "email",
        "password" => "password",
        "code_verify" => "code_verify",
        "status" => "status"
    ],

    "username" => "email", //here change to anything
    "safeCode" => true, // for length code verfiy  four or five 


## Routings
> ### for login 
> <p>yourdomine/api/es/v1/login</p>
> <p>parameters : username ,password</p> 

> ### for register  
> <p>youerdomine/api/es/v1/register</p>
> <p>parameters : email , username , password , password_confirmation</p>

> ### for register  
> <p>youerdomine/api/es/v1/verfiy</p>
> <p>parameters : code , id </p>
